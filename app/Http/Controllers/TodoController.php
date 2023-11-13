<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Todo;
use App\Models\Todolist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class TodoController extends Controller {


    public function getTodos() {
        // dd(request('id'));
        $requestedId = request('id');
        $todolist = Todolist::find($requestedId);
        // dd($todolist);
        if($requestedId == 0){
            // resetted
            $result = 'home';
            return view('todos', compact('result'));
        }
        if(Todolist::find($requestedId)){
            // todolist found
            $result = Todo::where('list_id', $requestedId)->get();
            Cookie::queue('selected-id', $requestedId, 10);
            return view('todos', compact('result', 'todolist'));
            // dd($result);
        } else {
            // no todolist found
            
            $result = "tes";
            return view('todos', compact('result'));
        }

        // $todos = Todolist::where('id', $requestedId)->with('todos')->first();
        // $todos = Todolist::find(1)->todos();
        // dd($todos);
    }

    public function getDescription($id){
        $todo = Todo::find($id);
        // dd($todo->name);
        return view('details', compact('todo'));
    }

    public function createTodo(Request $request){
        // dd($request->name . $request->id);
        $id = $request->id;
        $name = $request->name;
        $todo = new Todo();
        $todo->list_id = $id;
        $todo->status = 0;
        $todo->name = $name;
        $todo->save();
        $id_new = $todo->id;
        return response()->json(['id' => $id_new, 'name' => $name]);

    }

    public function deleteTodo(Request $request, $id){
        // dd($request);
        $todo = Todo::find($id);
        $todo->delete();
        return response()->json(['message' => "Nice"]);
    }

    public function updateStatus(Request $request, $id) {
        $todo = Todo::find($id);
        if ($todo->status) {
            $todo->status = false;
        } else {
            $todo->status = true;
        }
        $todo->save();
    }
    
    public function updateDate(Request $request, $id){
        // dd($request->deadline);
        // dd(Carbon::now());
        $todo = Todo::find($id);
        $todo->deadline = Carbon::parse($request->deadline)->format('Y-m-d H:i');
        $todo->save();
        return response()->json(['id'=> $id, 'deadline' => $todo->diff(), 'status' => $todo->diffStatus()]);
    }

    public function updateName(Request $request, $id) {
        // dd($request->name);
        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->save();
        return response()->json(['id' => $id]);
    }

    public function updateDescription(Request $request, $id){
        $todo = Todo::find($id);
        $todo->description = $request->description;
        $todo->save();
    }
}
