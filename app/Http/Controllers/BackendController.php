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

    public function post_tutorial(TutorialPostRequest $request){
    //add tutorial fields
        $tutorial = new Tutorial();
        $tutorial->title = $request->title;
        $tutorial->post_image = $request->post_image;
        $tutorial->short_description = $request->short_description!=null ? $request->short_description : null;
        $tutorial->content_bangla = $request->content!=null ? $request->content : null;
        $tutorial->paper = $request->paper;
        
    //create syllabus association
        $syllabus = Syllabus::find($request->syllabus_module_topic);
        $tutorial->syllabus()->associate($syllabus);

    //save tutorial to access its id further ahead for images & resources
        $tutorial->save();

    //extract & save images from tutorial's content text
        $images = BackendHelper::extract_images_from_text($request->content);

    //if there is one or more images save them to the database
        if(count($images)>0){
            foreach ($images as $key => $value) {
                $tutorial->images()->create(['url'=>$images[$key],'imageable_id'=>$tutorial->id]);   
            }//end foreach  
        }//end if

    //check if there are any resources added
        $resource_array = array();
        if($request->resource_type!=null AND $request->resource_link !=null){
            foreach ($request->resource_type as $key => $value) {
                $resource_array [] =[$value,$request->resource_link[$key]]; 
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
    //validation is completed even before this method is called thanks to laravel's form request mechanism

        // update all required tutorial fields
            $tutorial = Tutorial::find($request->id);
            $tutorial->title = $request->title;
            $tutorial->post_image = $request->post_image;
            $tutorial->short_description = $request->short_description!=null ? $request->short_description:null;
            $tutorial->content_bangla = $request->content!=null?$request->content:null;
            $tutorial->paper = $request->paper;

        //update syllabus & delete previous association
            $tutorial->syllabus()->delete();
            $syllabus = Syllabus::find($request->syllabus_module_topic);
        //associate new syllabus topic (even if it has NOT been changed)
            $tutorial->syllabus()->associate($syllabus);
        
        //delete previous image relationships for content images
            $tutorial->images()->delete();
        //add new images relationship to this tutorial
        //extract & save images from tutorial's content text
            $images = BackendHelper::extract_images_from_text($request->content);

        //if there is one or more images save them to the database
            if(count($images)>0){
                foreach ($images as $key => $value) {
                    $tutorial->images()->create(['url'=>$images[$key],'imageable_id'=>$tutorial->id]);   
                }//end foreach  
            }//end if

        //check if there are any resources added 
            $resource_array = array();
            if($request->resource_type!=null AND $request->resource_link !=null){
                //delete all previous resource relations 
                    $tutorial->resources()->delete();
                foreach ($request->resource_type as $key => $value) {
                    $resource_array [] =[$value,$request->resource_link[$key]]; 
                }//end foreach
            }//end if

        //add new resource relations to database
            if(count($resource_array)!=0){
                foreach ($resource_array as $key => $value) {
                    $tutorial->resources()->create(['type'=>$request->resource_type[$key],
                                                    'link'=>$request->resource_link[$key],
                                                    'resourceable_id'=>$tutorial->id]);    
                }//end foreach
            }//end if

        //update all done!! now redirect back to the previous page with success massage
            return redirect()->back()->with('tutorial_update_success','Tutorial Updated successfully!');

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
