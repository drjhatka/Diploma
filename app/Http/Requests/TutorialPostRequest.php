<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'title'=>'required|max:300',
                'post_image'=>'required',
                'short_description'=>'required',
                'content'=>'required',
                'paper'=>'required',
                'syllabus_topic'=>'required'
        ];
    }
}
