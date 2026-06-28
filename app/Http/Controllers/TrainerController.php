<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Journal;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrainerController extends Controller
{
    public function list(Request $request) {
        $user = User::all();
        $user_group = UserGroup::all();
        $group = Group::all();
        $salary = [];

        $month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 

        foreach($user as $u) {
            $journal = Journal::where('user_id', $u->id)->where('created_at', 'like', '%' .$month. '%')->get();
            $time = 0;
            $danc_count = 0;
            foreach($journal as $j) {
                $group_arr = Group::where('id', $j->group_id)->first();
                $time = $group_arr->hours;
                $danc_arr = json_decode($j->dancers_id,true);

                $danc_count += count($danc_arr);
            }
    
            $salary[$u->id] = (($time / 60)) * $danc_count * $u->per;
        }
        
        return view('trainer.list', [
            'user' => $user,
            'user_group' => $user_group,
            'group' => $group,
            'salary' => $salary
        ]);
    }
    public function confirm(Request $request) {
        User::where('id', $request->id)->update([
            'role' => 1
        ]);
        return redirect()->back();
    }
    public function balance(Request $request)
    {
        User::where('id', $request->id)->update([
            'balance' => 0
        ]);
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        User::where('id', $request->id)->delete();
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $user_group = UserGroup::where('user_id', $request->id)->get();
        $group = Group::all();
        $user = User::where('id', $request->id)->first();
        return view('trainer.update', [
            'user' => $user,
            'user_group' => $user_group,
            'group' => $group
        ]);
    }
    public function updatePost(Request $request)
    {
        UserGroup::where('user_id', $request->id)->delete();
        if(!empty($request->group)) {
            foreach($request->group as $value) {
                $dg = new UserGroup;
                $dg->group_id = $value;
                $dg->user_id = $request->id;
                $dg->save();
            }
        }
        User::where('id', $request->id)->update([
            'per' => $request->per
        ]);
        return redirect()->route('trainer');
    }
}
