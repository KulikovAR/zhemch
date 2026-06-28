<?php

namespace App\Http\Controllers;

use App\Models\DancerGroup;
use App\Models\Group;
use App\Models\Dancers;
use App\Models\Payment;
use App\Models\Subcribtion;
use App\Models\Timetable;
use App\Models\User;
use Facade\FlareClient\Time\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{ 
	public function list(Request $request) {

        // $p = Payment::all();
        // foreach ($p as $value) {
        //     $dan = Dancers::where('id',$value->dancer_id)->first();
        //     $sub = Subcribtion::where('id', $dan->subscription_id)->first();
        //     if($dan->balance == 0) {
        //         Dancers::where('id',$value->dancer_id)->update([
        //             'class_count' => $sub->count * 60,
        //             'balance' => $value->count
        //         ]);
        //     } else {
        //         Dancers::where('id', $value->dancer_id)->update([
        //             'balance' => $value->count + $dan->balance  
        //         ]);
        //     }
        // }
        // die();
		$group = Group::all();
        $month = Carbon::now()->format('Y-m');

        if(isset($_GET['m'])) {
            $month = Carbon::now()->subMonth($request->m)->format('Y-m');
        } 
        $payment = Payment::where('group_id', $request->group_id)->where('created_at', 'like', '%' .$month. '%')->get();
		$dancer = Dancers::all();
		$user = User::all();
		return view('payment.list', [
			'group' => $group,
			'payment' => $payment,
			'dancer' => $dancer,
			'user' => $user
		]);
	}
    public function create(Request $request)
    {
        $sub = Subcribtion::all();
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
        return view('payment.create',[
            'dancers' => $dancers,
            'id' => $timetable->id,
            'sub' => $sub
        ]);
    }
    public function createPost(Request $request)
    {
        $timetable = Timetable::where('id', $request->id)->first();
        $count = 0;
        $mes = "Информация об оплате ";
        $mes .= "Преподаватель: ".Auth::user()->name.' Сдали: ';
        // $dolg = $request->dolg;
        // echo "<pre>";
        // print_r($dolg);
        // die();
        if($timetable->group_id != 0) {
            foreach($request->dancers as $key => $value) {
                if($value != '' || $value != 0) {
                    $dancer = Dancers::where('id', $key)->first();
                    $mes .= $dancer->name." - ".$value.' ';
                    $count += $value;
                    $payment = new Payment;
                    $payment->group_id = $timetable->group_id;
                    $payment->dancer_id = $key;
                    $payment->count = $value;
                    $payment->trainer_id = Auth::user()->id;
                    $payment->subcribion_id = 0;
                    $payment->save();

                    $dans_count = $request->dancers;
                    $dolg = $request->dolg;
                    $dan = Dancers::where('id',$key)->first();
                    $sub = Subcribtion::where('id', $dan->subscription_id)->first();
                    if ($dolg != null && array_key_exists($key, $dolg)) {
                        Dancers::where('id', $key)->update([
                            'dolg' => $dan->dolg - $dans_count[$key]   
                        ]);     
                    } else {
                        if($dan->balance == 0) {
                             Dancers::where('id', $key)->update([
                                'class_count' => $sub->count * 60,
                                'balance' => $dans_count[$key]
                            ]);
                        } else {
                            Dancers::where('id', $key)->update([
                                'balance' => $dans_count[$key] + $dan->balance  
                            ]);
                        }
                    }
                }
            }
        }

        $path = "https://api.telegram.org/bot5030252708:AAGZPYjwlrulKK3oTrrTCNGN5AKv15EGk7I";

        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $path."/sendmessage?chat_id=1881760749&text=".$mes."");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);
        $user = User::where('id', Auth::user()->id)->first();
        $count += $user->balance;
        User::where('id',Auth::user()->id)->update(['balance' => $count]);
        return redirect()->route('usertimetable', $timetable->room);
    }
    public function delete(Request $request) {
        Payment::where('id',$request->id)->delete();
        return redirect()->back();
    }
}
