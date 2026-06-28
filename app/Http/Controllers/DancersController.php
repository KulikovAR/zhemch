<?php

namespace App\Http\Controllers;

use App\Models\DancerGroup;
use App\Models\Dancers;
use App\Models\Group;
use App\Models\Subcribtion;
use App\Models\UserGroup;
use App\Models\Journal;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class DancersController extends Controller
{
    public function list(Request $request) {

        $dancers = Dancers::orderBy('name', 'ASC')->get();

        // С прошлого месяца
        $month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 
        
        $prev_month = Carbon::now()->subMonth()->format("Y-m");

        $journal = Journal::where('created_at', 'like', '%' .$prev_month. '%')->get();

        foreach ($dancers as $value) {  
            $last_update = Carbon::parse($value->last_update)->format('Y-m');
 
            $curr_month =  Carbon::now()->subMonth()->format('Y-m');


            //if ($last_update > $curr_month) {
                continue;
            //}
        
            
            $id = $value->id;
            $payment = Payment::where('dancer_id', $value->id)->where('created_at', 'like', '%' .$prev_month. '%')->get();
            $pay_count = 0;
            foreach ($payment as $p) {
                $pay_count += $p->count;
            }

            $hours = 0;
            $sub_hours = Subcribtion::where('id', $value->subscription_id)->first()->count;
            $sub_price = Subcribtion::where('id', $value->subscription_id)->first()->price;
            foreach ($journal as $j) {
                $dancers_ids = json_decode($j->dancers_id, true);
                foreach ($dancers_ids as $di) {
                    $group = Group::where('id', $j->group_id)->first();
                    if ($di == $value->id && $group != null) {
                        $hours += $group->hours;
                    }
                }
            }
            $hours = $hours / 60;
            $pere = 0;

            if ($pay_count < $sub_price) {
                if ($hours * 150 > $sub_price) {
                    $dolg = $sub_price - $pay_count;
                } else {
                    $dolg = $hours * 150 -$pay_count;
                }
                // $dolg = $sub_price - $pay_count;
            } else {
                $dolg = 0;
                $pere = $pay_count - $sub_price;
            }
            if ($hours < $sub_hours) {
                // $pere_hours = $sub_hours - $hours;
                if ($hours * 150 < $pay_count) {
                    $pere =  $pay_count - $hours * 150;
                } 
            } 



            Dancers::where('id', $value->id)->update([
                'dolg' => $value->dolg + $dolg,
                'pere' => $value->pere + $pere,
                'last_update' => now()
            ]);

        }  



        $sub = Subcribtion::all();

        $month = Carbon::now()->format('Y-m');

        $not_curr_month = true;
        
        if(isset($_GET['m'])) {
            $not_curr_month = false;
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 

        $dancer_pay = [];

        $journal = Journal::where('created_at', 'like', '%' .$month. '%')->get();
        
        
        // Оптимизация 
        $groups = Group::all();
        $groups_arr = [];
        foreach($groups as $group) {
            $groups_arr[$group->id] = $group->hours;
        }
            
        foreach ($dancers as $value) {
            $id = $value->id;
            $payment = Payment::where('dancer_id', $value->id)->where('created_at', 'like', '%' .$month. '%')->get();
            $pay_count = 0;
            foreach ($payment as $p) {
                $pay_count += $p->count;
            }
            $dancer_pay[$value->id]['payment'] = $pay_count;
            $hours = 0;
            $sub_hours = Subcribtion::where('id', $value->subscription_id)->first()->count;
            $sub_price = Subcribtion::where('id', $value->subscription_id)->first()->price;
            foreach ($journal as $j) {
                $dancers_ids = json_decode($j->dancers_id, true);
                foreach ($dancers_ids as $di) {
                    if ($di == $value->id && isset($groups_arr[$j->group_id])) {
                        $hours +=  $groups_arr[$j->group_id];
                    }
                }
            }
            $hours = $hours / 60;
            $dancer_pay[$id]['hours'] = $hours;
            $dancer_pay[$id]['sub_hours'] = $sub_hours;
            $dancer_pay[$id]['sub_price'] = $sub_price;
            $pere = 0;

         
            if ($pay_count < $sub_price) {
                if ($hours * 150 > $sub_price) {
                    $dolg = $sub_price - $pay_count;
                } else {
                    $dolg = $hours * 150 - $pay_count;
                }
            } else {
                $dolg = 0;
                if ($hours < $sub_hours) {
                    if ($hours * 150 < $sub_price) {
                        $pere =  $pay_count - $hours * 150;
                    } 
                } else {
                    $pere = $pay_count - $sub_price;
                }   
            }

            if ($not_curr_month) {
                $dolg = $dolg + $value->dolg;
                $pere = $value->pere + $pere;
            }
  
            if ($dolg > $pere) {
                $dolg = $dolg - $pere;
                $pere = 0;
            }
            if ($pere > $dolg) {
                $pere = $pere - $dolg;
                $dolg = 0;
            }
            if ($pere == $dolg) {
                $pere = 0;
                $dolg = 0;
            }
            $dancer_pay[$id]['dolg'] = $dolg;
            $dancer_pay[$id]['pere'] = $pere;
            $dancer_pay[$id]['name'] = $value->name; 
        }   
 

        $dancer_groups = DancerGroup::all();

        return view('dancers.list', [
            'dancers' => $dancers,
            'sub' => $sub,
            'dancer_pay' => $dancer_pay,
            'groups' => $groups,
            'dancer_groups' => $dancer_groups
        ]);
    }
    
    public function dolg(Dancers $dancer) {
        Dancers::where('id', $dancer->id)->update([
            'dolg' => 0,
            'pere' => 0
        ]);
        return redirect()->back();
    }
    public function userlist(Request $request) {

        $user_groups = UserGroup::where('user_id', Auth::user()->id)->get();
        $data = [];

        foreach($user_groups as $value) {
            $data[] = $value->group_id;
        }
        $groups = Group::whereIn('id',$data)->get();
        $dancer_groups = DancerGroup::whereIn('group_id',$data)->get();
        $data = [];
        foreach($dancer_groups as $value) {
            $data[] = $value->dancer_id;
        }

        $dancers = Dancers::whereIn('id', $data)->orderBy('name', 'ASC')->get();
        
        $sub = Subcribtion::all();
        
        $month = Carbon::now()->format('Y-m');

        $not_curr_month = true;
        
        if(isset($_GET['m'])) {
            $not_curr_month = false;
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 



        
        $dancer_pay = [];

        $journal = Journal::where('created_at', 'like', '%' .$month. '%')->get();
        // Оптимизация 
        $groups = Group::all();
        $groups_arr = [];
        foreach($groups as $group) {
            $groups_arr[$group->id] = $group->hours;
        }
        
        foreach ($dancers as $value) {
            $id = $value->id;
            $payment = Payment::where('dancer_id', $value->id)->where('created_at', 'like', '%' .$month. '%')->get();
            $pay_count = 0;
            foreach ($payment as $p) {
                $pay_count += $p->count;
            }
            $dancer_pay[$value->id]['payment'] = $pay_count;
        
            $hours = 0;
            $sub_hours = Subcribtion::where('id', $value->subscription_id)->first()->count;
            $sub_price = Subcribtion::where('id', $value->subscription_id)->first()->price;
            foreach ($journal as $j) {
                $dancers_ids = json_decode($j->dancers_id, true);
                foreach ($dancers_ids as $di) {
                    if ($di == $value->id && isset($groups_arr[$j->group_id])) {
                        $hours +=  $groups_arr[$j->group_id];
                    }
                }
            }
            $hours = $hours / 60;
            $dancer_pay[$id]['hours'] = $hours;
            $dancer_pay[$id]['sub_hours'] = $sub_hours;
            $dancer_pay[$id]['sub_price'] = $sub_price;
            $pere = 0;

            if ($pay_count < $sub_price) {
                if ($hours * 150 > $sub_price) {
                    $dolg = $sub_price - $pay_count;
                } else {
                    $dolg = $hours * 150 - $pay_count;
                }
            } else {
                $dolg = 0;
                if ($hours < $sub_hours) {
                    if ($hours * 150 < $sub_price) {
                        $pere =  $pay_count - $hours * 150;
                    } 
                } else {
                    $pere = $pay_count - $sub_price;
                }   
            }

            if ($not_curr_month) {
                $dolg = $dolg + $value->dolg;
                $pere = $value->pere + $pere;
            }
  
            if ($dolg > $pere) {
                $dolg = $dolg - $pere;
                $pere = 0;
            }
            if ($pere > $dolg) {
                $pere = $pere - $dolg;
                $dolg = 0;
            }
            if ($pere == $dolg) {
                $pere = 0;
                $dolg = 0;
            }
            
            $dancer_pay[$id]['dolg'] = $dolg;
            $dancer_pay[$id]['pere'] = $pere;
            $dancer_pay[$id]['name'] = $value->name; 
        }   
 
        return view('dancers.userlist', [
            'dancers' => $dancers,
            'sub' => $sub,
            'dancer_pay' => $dancer_pay,
            'groups' => $groups,
            'dancer_groups' => $dancer_groups
        ]);
    }
    public function create() {
        $sub = Subcribtion::all();
        return view('dancers.create', [
            'group' => Group::all(),
            'sub' => $sub
        ]);
    }
    public function createPost(Request $request)
    {
        $path = '';
        if($request->hasFile('image')){
            $img = $request->file('image');
            $imageName = time().'1.'.$request->image->extension(); 
            $request->file('image')->move(public_path() . '/uploads',$imageName);
            $path = '/uploads/'.$imageName;
        }
        $birth = $request->birth;
        if($request->bitrh == '') {
            $birth = ' ';
        }
        $comment = $request->comment;
        if($request->comment == '') {
            $comment = ' ';
        }
        $dancers = new Dancers;
        $dancers->name = $request->name;
        $dancers->birth = $birth;
        $dancers->phone = $request->phone;
        $dancers->viber_phone = $request->viber_phone;
        $dancers->parent_name = $request->parent_name;
        $dancers->subscription_id = $request->subscription_id;
        $dancers->image = $path;
        $dancers->comment = $comment;
        $dancers->last_update = Carbon::now();
        $dancers->save();
        foreach($request->group as $value) {
            $dg = new DancerGroup;
            $dg->group_id = $value;
            $dg->dancer_id = $dancers->id;
            $dg->save();
        }
        return redirect()->route('dancers');
    }
    public function update(Request $request)
    {
        $sub = Subcribtion::all();
        $dancer = Dancers::where('id',$request->id)->first();
        $dancer_group = DancerGroup::where('dancer_id', $request->id)->get();
        return view('dancers.update',[
            'dancer' => $dancer,
            'group' => Group::all(),
            'dancer_group' => $dancer_group,
            'sub' => $sub
        ]);
    }
    public function updatePost(Request $request)
    {
        $dancer = Dancers::where('id',$request->id)->first();
        $path = $dancer->image;
        if($request->hasFile('image')){
            $img = $request->file('image');
            $imageName = time().'1.'.$request->image->extension(); 
            $request->file('image')->move(public_path() . '/uploads',$imageName);
            $path = '/uploads/'.$imageName;
        }
        $birth = $request->birth;
        if($request->bitrh == '') {
            $birth = ' ';
        }
        $comment = $request->comment;
        if($request->comment == '') {
            $comment = ' ';
        }
        Dancers::where('id',$request->id)->update([
            'name' => $request->name,
            'birth' => $birth,
            'phone' => $request->phone,
            'viber_phone' => $request->viber_phone,
            'parent_name' => $request->parent_name,
            'subscription_id' => $request->subscription_id,
            'image' => $path,
            'comment' => $comment
        ]);
        DancerGroup::where('dancer_id', $request->id)->delete();
        if(!empty($request->group)) {
            foreach($request->group as $value) {
                $dg = new DancerGroup;
                $dg->group_id = $value;
                $dg->dancer_id = $request->id;
                $dg->save();
            }
        }
        return redirect()->route('dancers');
    }
    public function delete(Request $request)
    {
        Dancers::where('id',$request->id)->delete();
        DancerGroup::where('dancer_id',$request->id)->delete();
        return redirect()->route('dancers');
    }
}
