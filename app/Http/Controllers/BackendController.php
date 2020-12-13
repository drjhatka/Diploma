<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;

class BackendController extends Controller
{

//--------show the backend dashboard----------//
    public function dashboard(){
        return view('backend.dashboard');
    }

//-------show the backend interface for adding syllabus topic-----//
    public function add_syllabus(){
        return view('backend.syllabus.add-syllabus');
    }

//-------process syllabus posting-----//
    public function post_syllabus(Request $request){
        $rules = ['topic'=>'required|bail|max:100'];
        $request->validate($rules);

        $syllabus = new Syllabus();
        $syllabus->subject = $request->subject;
        $syllabus->topic = $request->topic;
        $syllabus->module = $request->module;

        $syllabus->save();
        //session()->flash()
        session()->flash('success','Topic Added Successfully.');

        return redirect()->route('add.syllabus')->with('success',"Topic Added Successfully.");

    }//end method
    public function add_tutorial(){
        $syllabus = Syllabus::all();
        return view('backend.tutorials.add-tutorial');
    }//end method

    public function post_tutorial(Request $request){
        dd($request->all());
        $rules =[
            'title'=>'',
            'short_description'=>'',
            'content'=>'',
            'paper'=>'',
            'syllabus_topic'=>''

        ];
    }//end method

    //-------------JSON Methods-------------//
    public function get_syllabus(){
        $syllabus = Syllabus::all();
        return BackendHelper::categorize_syllabus_topic($syllabus);
    }

}
