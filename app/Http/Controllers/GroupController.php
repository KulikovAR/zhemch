<?php

namespace App\Http\Controllers;

use App\Models\DancerGroup;
use App\Models\Dancers;
use App\Models\Payment;
use App\Models\Group;
use App\Models\Type;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GroupController extends Controller
{
    
    public function list() {
        $type = Type::all();
        $group = Group::orderBy('name', 'ASC')->get();
        $dancer_group = DancerGroup::all();
        $dancer = Dancers::orderBy('name', 'ASC')->get();
        $month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 
        
        $payment = Payment::where('created_at', 'like', '%' .$month. '%')->get();
        $payment_price = 0;
        foreach ($payment as $key => $value) {
            $payment_price += $value->count;
        }
        return view('group.list', [
                'group' => $group,
                'type' => $type,
                'dancer_group' => $dancer_group,
                'dancer' => $dancer,
                'payment_price' => $payment_price
            ]);
    }
    public function create() {
        $type = Type::all();
        return view('group.create', [
            'type' => $type
        ]);
    }
    public function createPost(Request $request)
    {
        Group::create($request->except('_token'));
        return redirect()->route('group');
    }
    public function update(Request $request)
    {
        $type = Type::all();
        $group = Group::where('id',$request->id)->first();
        return view('group.update',[
            'group' => $group,
            'type' => $type
        ]);
    }
    public function updatePost(Request $request)
    {
        Group::where('id',$request->id)->update($request->except('_token'));
        return redirect()->route('group');
    }
    public function delete(Request $request)
    {
        Group::where('id',$request->id)->delete();
        return redirect()->route('group');
    }
}
