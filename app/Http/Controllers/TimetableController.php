<?php

namespace App\Http\Controllers;

use App\Models\Dancers;
use App\Models\Group;
use App\Models\Timetable;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    public function list(Request $request)
    {
        $timetable = Timetable::where('room', $request->room)->get();
        $group = Group::all();
        $dancer = Dancers::all();
        return view('timetable.list', [
            'timetable' => $timetable,
            'room' => $request->room,
            'group' => $group,
            'dancer' => $dancer
        ]);
    }
    public function userList(Request $request)
    {
        $timetable = Timetable::where('room', $request->room)->get();
        $group = Group::all();
        $dancer = Dancers::all();
        $user_id = Auth::user()->id;
        $user_group = UserGroup::all();
        return view('timetable.userlist', [
            'timetable' => $timetable,
            'room' => $request->room,
            'group' => $group,
            'dancer' => $dancer,
            'user_id' => $user_id,
            'user_group' => $user_group
        ]);
    }
    public function create(Request $request) {
        return view('timetable.create', [
            'room' => $request->room,
            'day' => $request->day,
            'group' => Group::all(),
            'dancer' => Dancers::all()
        ]);
    }
    public function userCreate(Request $request) {
        return view('timetable.usercreate', [
            'room' => $request->room,
            'day' => $request->day,
            'group' => Group::all(),
            'dancer' => Dancers::all()
        ]);
    }
    public function createPost(Request $request)
    {
        $timetable = Timetable::where('day', $request->day)->where('room', $request->room)->get();
        $time = [];
        // Вынужденная мера
        $time[0]['time_start']['hour'] = 0; 
        $time[0]['time_start']['min'] = 0; 
        $time[0]['time_end']['hour'] = 0; 
        $time[0]['time_end']['min'] = 0; 

        $time[1]['time_start']['hour'] = 24; 
        $time[1]['time_start']['min'] = 0; 
        $time[1]['time_end']['hour'] = 24; 
        $time[1]['time_end']['min'] = 0; 
        $count = 2;
        foreach($timetable as $value) {
            $count++;
            $t_start = explode(":", $value->time_start);
            $t_end = explode(":", $value->time_end);
            $time[$count]['time_start']['hour'] = $t_start[0];
            $time[$count]['time_start']['min'] = $t_start[1];

            $time[$count]['time_end']['hour'] = $t_end[0];
            $time[$count]['time_end']['min'] = $t_end[1];
        }
        usort($time, function($a, $b) {
            return $a['time_start']['hour'] <=> $b['time_start']['hour'];
           });
        echo "<pre>";

        $intervals = [];
        for($i = 0; $i < count($time) - 1; $i++) {
            $interval = 0;
            $interval_hour = $time[$i + 1]['time_start']['hour'] - $time[$i]['time_end']['hour'];
  
            $interval = 60 - $time[$i]['time_end']['min'];
            $interval += $time[$i + 1]['time_start']['min'];
    
            $intervals[$i]['interval'] = $interval + ($interval_hour - 1) * 60; 
            $intervals[$i]['time_start']['hour'] = $time[$i]['time_end']['hour'];
            $intervals[$i]['time_start']['min'] = $time[$i]['time_end']['min'];
            $intervals[$i]['time_end']['hour'] = $time[$i + 1]['time_start']['hour'];
            $intervals[$i]['time_end']['min'] = $time[$i + 1]['time_start']['min'];
        }

        $cur_interval_res = 0;
        $cur_interval = 60 - $request->min_start;
        $cur_interval +=  $request->min_end;
        $cur_interval_res =  $cur_interval + (($request->hour_end - $request->hour_start) - 1) * 60;  

        $can = false;
        foreach($intervals as $key =>  $value) {
            if($value['time_start']['hour'] <= $request->hour_start && $value['time_end']['hour'] >= $request->hour_start && $value['time_end']['hour'] >= $request->hour_end  && $cur_interval_res <= $value['interval'] ) {
                
                
                if($request->min_start >= $value['time_start']['min'] || $value['time_start']['hour'] < $request->hour_start) {
                    $can = true;
                } else {
                    $can = false;
                }
                if($request->min_end <= $value['time_end']['min'] || $value['time_end']['hour'] > $request->hour_end) {
                    $can = true;
                } else {
                    $can = false;
                    
                }

                if($value['time_start']['hour'] < $request->hour_start && $value['time_end']['hour'] > $request->hour_end) {
                    $can = true;
                }
            }
        }
        if($can) {
            $comment = $request->comment;
            if($request->comment == '') {
                $comment = ' ';
            }
            $timetable= new Timetable;
            $timetable->group_id = $request->group_id;
            $timetable->dancer_id = $request->dancer_id;
            $timetable->time_start = $request->hour_start.':'.$request->min_start;
            $timetable->time_end = $request->hour_end.':'.$request->min_end;
            $timetable->comment = $comment;
            $timetable->day = $request->day;
            $timetable->room = $request->room;
            $timetable->def = $request->def;
            $timetable->save();
            return redirect()->back();
        }
        // return $request->group_id;
        // return Timetable::create($request->except('_token'));
        // return redirect()->route('timetable');
        return "Некорректный ввод данных!";
    }
    public function update(Request $request)
    {
        $timetable = Timetable::where('id',$request->id)->first();
        return view('timetable.update',[
            'timetable' => $timetable
        ]);
    }
    public function updatePost(Request $request)
    {
        Timetable::where('id',$request->id)->update($request->except('_token'));
        return redirect()->route('timetable');
    }
    public function delete(Request $request)
    {
        $room = Timetable::where('id',$request->id)->first()->room;
        Timetable::where('id',$request->id)->delete();
        return redirect()->route('timetable', $room);
    }
}
