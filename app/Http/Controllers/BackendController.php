<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorialPostRequest;
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
        //TODO: change request to Request service later     
    //set rules for validation
        $rules =[
            'title'=>'required|max:300',
            'thumbnail'=>'required',
            'short_description'=>'required',
            'content'=>'required',
            'paper'=>'required',
            'syllabus_topic'=>'required'

        ];
        
    //check if there are any resources added
        $resource_array = array();
        if($request->resource_type!=null AND $request->resource_link !=null){
            foreach ($request->resource_type as $key => $value) {
                $resource_array [] =[$value,$request->resource_link[$key]]; 
            }
        }//end if

    //add tutorial fields
        $tutorial = new Tutorial();
        $tutorial->title = $request->title;
        $tutorial->short_description = $request->short_description!=null ? $request->short_description:null;
        $tutorial->content_bangla = $request->content!=null?$request->content:null;
        $tutorial->paper = $request->paper;
        
    //create syllabus
        $syllabus = Syllabus::find($request->syllabus_module_topic);
    //associate syllabus with tutorial
        $tutorial->syllabus()->associate($syllabus);

    //save post image
        $tutorial->post_image = $request->post_image;
        $tutorial->save();
    //save content images from tutorial 
        $images = BackendHelper::extract_images_from_text($request->content);
    //check if at least one image exists
        if(count($images)>0){
            foreach ($images as $key => $value) {
                $tutorial->images()->create(['url'=>$images[$key],'imageable_id'=>$tutorial->id]);   
            }//end foreach  
        }//end if

    //add resources if provided
        if(count($resource_array)!=0){
            foreach ($resource_array as $key => $value) {
                $tutorial->resources()->create(['type'=>$request->resource_type[$key],
                                                'link'=>$request->resource_link[$key],
                                                'resourceable_id'=>$tutorial->id]);    
            }//end foreach
        }//end if
    //return to the previous page with a success massage 
        return redirect()->back()->with('tutorial_add_success','Tutorial added successfully!');
    }//end method


    public function manage_tutorial(){
        return view('backend.tutorials.manage-tutorial');
    }//end method

    public function view_tutorial($id){
        return view('backend.tutorials.view-tutorial')->with('id',$id);
    }//end method

    public function edit_tutorial($id){
        return view('backend.tutorials.edit-tutorial')->with('id',$id);
    }//end method

    public function update_tutorial(TutorialPostRequest $request){
        dd($request);
    }//end method

    public function delete_tutorial($id){

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
