<?php

namespace App\Http\Controllers;

use App\Models\Subcribtion;
use Illuminate\Http\Request;

class SubcribtionController extends Controller
{
    public function list() {
        $sub = Subcribtion::orderBy('name', 'ASC')->get();
        return view('sub.list', [
                'sub' => $sub
        ]);
    }
    public function create() {
        return view('sub.create');
    }
    public function createPost(Request $request)
    {
        Subcribtion::create($request->except('_token'));
        return redirect()->route('sub');
    }
    public function update(Request $request)
    {
        $sub = Subcribtion::where('id',$request->id)->first();
        return view('sub.update',[
            'sub' => $sub
        ]);
    }
    public function updatePost(Request $request)
    {
        Subcribtion::where('id',$request->id)->update($request->except('_token'));
        return redirect()->route('sub');
    }
    public function delete(Request $request)
    {
        Subcribtion::where('id',$request->id)->delete();
        return redirect()->route('sub');
    }
}
