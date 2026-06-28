<?php

namespace App\Http\Controllers;

use App\Models\DancerGroup;
use App\Models\Dancers;
use App\Models\Group;
use App\Models\Journal;
use App\Models\Subcribtion;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class JournalController extends Controller
{
    public function list(Request $request)
    {
        $month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 
    
        $journal = Journal::where('created_at', 'like', '%' .$month. '%')->get();
        $jounal_dancers = [];
        foreach($journal as $item) {
            $day = (int)date("d", strtotime($item->created_at));
            $dj = json_decode($item->dancers_id);
            foreach($dj as $danc) {
                $jounal_dancers[$item->group_id][$day][] = $danc; 
            }
        }
        $dg = DancerGroup::all();
        $dancer_group = [];
        foreach ($dg as $key => $value) {
        	$dancer_group[$value->group_id][] = $value->dancer_id;
        }
        return view('journal.list',
        [
            'journal' => $journal,
            'dancers' => Dancers::all(),
            'group' => Group::all(),
            'jounal_dancers' => $jounal_dancers,
            'dancer_group' => $dancer_group
        ]);
    }

    public function listAll(Request $request)
    {
    	$month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 
        
        return view('journal.listall',
        [
            'journal' => Journal::where('created_at', 'like', '%' .$month. '%')->orderBy('created_at', 'desc')->get(),
            'dancers' => Dancers::all(),
            'group' => Group::all()
        ]);
    }


    // public function monthend() {
    	
    // }
    public function create(Request $request)
    {
        $timetable = Timetable::where('id', $request->id)->first();
        if($timetable->group_id != 0) {
            $dg = DancerGroup::where('group_id', $timetable->group_id)->get();
            $data = [];
            foreach($dg as $value) {
                $data[] = $value->dancer_id;
            }
            $dancers = Dancers::whereIn('id', $data)->get();
        } else {
            $dancers = Dancers::where('id', $timetable->dancer_id)->get();
        }
        return view('journal.create',[
            'dancers' => $dancers,
            'id' => $timetable->id
        ]);
    }
    public function createPost(Request $request)
    {
        $timetable = Timetable::where('id', $request->id)->first();
        $dancers = $request->dancers;
        $dancers_arr = Dancers::whereIn('id', $dancers)->get();
        $group = Group::where('id', $timetable->group_id)->first();
        foreach($dancers_arr as $d) {
            $time_update = $d->class_count - $group->hours;
            Dancers::where('id', $d->id)->update([
                'class_count' => $time_update
            ]);
        }
    
        if($timetable->group_id != 0) {
            $journal = new Journal;
            $journal->timetable_id = $timetable->id;
            $journal->group_id = $timetable->group_id;
            $journal->dancers_id = json_encode($request->dancers);
            $journal->user_id = Auth::user()->id;
            $journal->save();
        }
        return redirect()->route('usertimetable', $timetable->room);
    }
    public function update(Request $request)
    {
        $journal = Journal::where('id', $request->id)->first();
        return view('journal.update', [
            'journal' => $journal
        ]);
    }
    public function updatePost(Request $request)
    {
        Journal::where('id', $request->id)->update([
            'created_at' => $request->created_at
        ]);
        return redirect()->route('journalall');
    }
    public function delete(Request $request)
    {
        Journal::where('id', $request->id)->delete();
        return redirect()->back();
    }

}
