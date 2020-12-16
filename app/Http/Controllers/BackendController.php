<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Tutorial;
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
        //dd($request->all());
        $rules =[
            'title'=>'required|max:300',
            'thumbnail'=>'required',
            'short_description'=>'required',
            'content'=>'required',
            'paper'=>'required',
            'syllabus_topic'=>'required'

        ];
        $resource_array = array();
        if($request->resource_type!=null AND $request->resource_link !=null){
            foreach ($request->resource_type as $key => $value) {
                $resource_array [] =[$value,$request->resource_link[$key]]; 
            }
        }//end if

        //add tutorial
        $tutorial = new Tutorial();
        $tutorial->title = $request->title;
        $tutorial->short_description = $request->short_description ? $request->short_description:null;
        $tutorial->content_bangla = $request->content;
        $tutorial->paper = $request->paper;

        //create syllabus
        //$syllabus = 

        //create resource (if any)
        


    }//end method

    //-------------JSON Methods-------------//
    public function get_syllabus_modules(){
        $syllabus = Syllabus::all();
        return BackendHelper::categorize_syllabus_module($syllabus);
    }

    public function get_syllabus_module_topics($subject,$module){
        return BackendHelper::extract_syllabus_topic($subject,$module);
    }

}
