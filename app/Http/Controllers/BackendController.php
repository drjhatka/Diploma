<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function syllabus_add(Request $request){
        //dd($request->all());
        //no error checking for now
        $subject = $request->subject;
        $topic   = $request->topic;
        $module  = $request->module;

        $syllabus = new Syllabus();
        $syllabus->subject = $subject;
        $syllabus->topic    = $topic;
        $syllabus->module   =$module;

        $syllabus->save();

        return view('backend.syllabus-home')->with('success','Syllabus topic added');
    }

    public function tutorial_add_home(){
        return view('backend.tutorial-add');
    }
}
