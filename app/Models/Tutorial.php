<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    
    public function syllabus()
    {
        return $this->belongsTo('App\Models\Syllabus');
    }
    
    public function images(){
        return $this->hasMany('App\Models\Image');
    }

    
    public function resources(){
        return $this->hasMany('App\Models\Resource');
    }



    
}
