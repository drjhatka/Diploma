<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use Illuminate\Http\Request;

class BackendHelper extends Controller
{

    public static function categorize_syllabus_module($syllabus=null){
        $return_array = array();
        $current_subject = null;
        $next_subject = null;
        foreach ($syllabus as $key => $fields) {
            $return_array[$fields->subject][$fields->module]=$fields->module;

        }//end foreach
       //dd($return_array);

       return $return_array;
    }//end method

    public static function extract_syllabus_topic($subject,$module){
      //  dd($subject,$module);
        $syllabus = Syllabus::all(); 
        $return_array = array();
        foreach ($syllabus as $key => $fields) {
            if($subject === $fields->subject AND $module === $fields->module){
                $return_array[$fields->id][]=$fields->topic;

            }

        }//end foreach
       //dd($return_array);
        return $return_array;
    }
}
