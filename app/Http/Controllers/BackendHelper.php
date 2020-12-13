<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendHelper extends Controller
{

    public static function categorize_syllabus_topic($syllabus=null){
        $return_array = array();
        $current_subject = null;
        $next_subject = null;
        foreach ($syllabus as $key => $fields) {
            $return_array[$fields->subject][]=$fields->module;

        }//end foreach
       //dd($return_array);

       return $return_array;
    }//end method
}
