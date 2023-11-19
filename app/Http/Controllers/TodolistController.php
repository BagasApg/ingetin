<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class TodolistController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;
        // dd($user_id);
        $loadings = [
            'Loading your todos...',
            'Fetching your activities...',
            'Preparing your schedules...',
            'Calculating ROI...',
            'Predicting your favorite football team...',
            'Speculating your final exams score...'
        ];
        $lists = Todolist::where('user_id', $user_id)->get();
        return view('main', compact('lists', 'loadings'));
    }
    

    public function store(Request $request){
        // dd($request);
        $user_id = auth()->user()->id;
        
        $list = new Todolist();
        
        $list->user_id = $user_id;
        $list->name = $request->name;
        $list->save();
        Cookie::queue('selected-id', $list->id, 10);

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $list = Todolist::find($id);
        // dd($request->name);
        $list->name = $request->name;
        $list->save();
        return redirect()->back();
    }

    public function delete($id){
        // dd($id);
        $user_id = auth()->user()->id;


        $list = Todolist::find($id);
        $list->delete();
        $firstList = Todolist::where('id', $user_id)->first();
        // dd($firstList);
        if(!is_null($firstList)){
            Cookie::queue('selected-id', $firstList->id, 10);
            return redirect('/');
        }
        Cookie::queue('selected-id', 0, 10);
        
        // dd($lists);
        return redirect('/');
    }
}
