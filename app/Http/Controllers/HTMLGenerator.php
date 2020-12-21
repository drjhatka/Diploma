<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Form;
class HTMLGenerator extends Controller
{
    public static function generate_form_text_block( $model_field,  $label_att_array=null, $input_att_array=null,$class_array=null){
            $html ='<div class="col-md-12 mt-3">'.
                        '<div class="form-group col-md-12 card input-div">'.
                            Form::label($label_att_array[0], $label_att_array[1], $label_att_array[2]).
                            Form::text($input_att_array[0], $model_field, ['class'=>'form-control','placeholder'=>'Add title here (maximum 50 words)']).
                        '</div>'.
                    '</div>';
           // dd($html);
           return $html;
        }//end method

        public static function generate_form_textarea_block( $model_field,  $label_att_array=null, $input_att_array=null,$class_array=null){
            $html ='<div class="col-md-12 mt-3">'.
                        '<div class="form-group col-md-12 card input-div">'.
                            Form::label($label_att_array[0], $label_att_array[1], $label_att_array[2]).
                            Form::textarea($input_att_array[0], $model_field, ['class'=>'form-control','rows'=>3,
                                                            'placeholder'=>'Add Short description here (maximum 3 lines)']).
                        '</div>'.
                    '</div>';
           // dd($html);
           return $html;
        }//end method
}
