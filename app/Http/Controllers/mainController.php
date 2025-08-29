<?php

namespace App\Http\Controllers;

use App\Models\todo_app;
use Illuminate\Http\Request;

class mainController extends Controller
{
    public function index(){
        $datas = todo_app::all();
        return view('main',compact('datas'));
    }

    public function post_it(request $request){
        $validated_task = $request->validate([
            'title' => 'required|string|max:255',
            'task' => 'required|string'
        ]);

        todo_app::create($validated_task);
        return redirect('/home');
    }

    public function delete_it($id){
        $task = todo_app::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }
}
