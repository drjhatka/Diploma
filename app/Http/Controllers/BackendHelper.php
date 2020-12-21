<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use DOMDocument;
use Illuminate\Http\Request;

class BackendHelper extends Controller
{

//extract and categorize syllabus modules for each subject, eliminate duplicate modules
    public static function categorize_syllabus_module($syllabus=null){
        $return_array = array();
        $current_subject = null;
        $next_subject = null;
        foreach ($syllabus as $key => $fields) {
            $return_array[$fields->subject][$fields->module]=$fields->module;

        }//end foreach
       return $return_array;
    }//end method

//extract syllabus topics based on subject and module
    public static function extract_syllabus_topic($subject,$module){
      //  dd($subject,$module);
        $syllabus = Syllabus::all(); 
        $return_array = array();
        foreach ($syllabus as $key => $fields) {
            if($subject === $fields->subject AND $module === $fields->module){
                $return_array[$fields->id][]=$fields->topic;
            }//end if
        }//end foreach
        return $return_array;
    }//end method

//extract all image src from the post's content text
    public static function extract_images_from_text( $content_text){
        $img_src_array = array();
        $dom_document = new DOMDocument();
        $dom_document->loadHTML($content_text);
        foreach ($dom_document->getElementsByTagName('img') as $key => $value) {
            $img_src_array[]= $value->getAttribute('src');
        }//end foreach
        return $img_src_array;
    }//end method

    public static function get_subject_fullname($subject){
        switch ($subject) {
            case 'eco':
                return "Principles of Economics";
                
                case 'acct':
                    return "Accounting";
                 
        }//end switch
    }//end method

    public static function get_form_subject_array(){
        $subject_array = array();
        $syllabus = Syllabus::distinct()->get(['subject']);
    
        foreach($syllabus as $key => $value){
          $subject_array [$value->subject] = BackendHelper::get_subject_fullname($value->subject); 
        }
        return $subject_array;
    }
    public static function insert_images_in_content($content_text){
        $return_text = $content_text;
        //insert random images at random location inside the content text
        //get the length of the content text 
        $content_text_length = strlen($content_text);

        //get images links in an array
        $images_array = array();
        foreach (\App\Models\Image::all() as $image) {
            $images_array[]=$image->url;
        }//end foreach

        for ($i=0; $i <$content_text_length ; $i++) { 
            if($content_text_length % 2 ==0 ){
                $return_text =substr_replace($return_text,'<img src="'.$images_array[$i].'" width=360 height=300>',($content_text_length / 2),0);
                return $return_text;
            }
            else {
                $return_text =substr_replace($return_text,'<img src="'.$images_array[$i].'">',($content_text_length/4),0);
                return $return_text;
            }
        }//end for
    }//end method
}//end class
