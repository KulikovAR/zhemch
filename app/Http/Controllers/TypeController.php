<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function list() {
        $type = Type::orderBy('name', 'ASC')->get();
        return view('type.list', [
                'type' => $type
            ]);
    }
    public function create() {
        return view('type.create');
    }
    public function createPost(Request $request)
    {
        Type::create($request->except('_token'));
        return redirect()->route('type');
    }
    public function update(Request $request)
    {
        $type = Type::where('id',$request->id)->first();
        return view('type.update',[
            'type' => $type
        ]);
    }
    public function updatePost(Request $request)
    {
        Type::where('id',$request->id)->update($request->except('_token'));
        return redirect()->route('type');
    }
    public function delete(Request $request)
    {
        Type::where('id',$request->id)->delete();
        return redirect()->route('type');
    }
}
