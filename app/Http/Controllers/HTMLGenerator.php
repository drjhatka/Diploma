<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Form;
class HTMLGenerator extends Controller
{
    public static function generate_form_text_block( $model_field=null, $attr_array, $placeholder=null){
            $html ='<div class="col-md-12 mt-3">'.
                        '<div class="form-group col-md-12 card input-div">'.
                            Form::label($attr_array['label_for'], $attr_array['label_text'],$attr_array['label_options']).
                            Form::text($attr_array['input_name'], $model_field, array_merge($attr_array['input_options'],['placeholder'=>$placeholder])).
                        '</div>'.
                    '</div>';
            return $html;
        }//end method

        public static function generate_form_textarea_block( $model_field=null,  $attr_array, $placeholder=null, $rows=3 ){
            $html ='<div class="col-md-12 mt-3">'.
                        '<div class="form-group col-md-12 card input-div">'.
                            Form::label($attr_array['label_for'], $attr_array['label_text'], $attr_array['label_options']).
                            Form::textarea($attr_array['input_name'], $model_field, array_merge($attr_array['input_options'],['rows'=>$rows,'placeholder'=>$placeholder])).
                        '</div>'.
                    '</div>';
           // dd($html);
           return $html;
        }//end method

        public static function generate_dropdown_block( $list,  $attr_array, $selected=null ){
            $html ='<div class="col-md-12 mt-3">'.
                        '<div class="form-group col-md-12 card input-div">'.
                            Form::label($attr_array['label_for'], $attr_array['label_text'], $attr_array['label_options']).
                            Form::select($attr_array['input_name'], $list,$selected, $attr_array['input_options']).
                        '</div>'.
                    '</div>';
           // dd($html);
           return $html;
        }//end method
}
