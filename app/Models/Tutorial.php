<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Models\TutorialFactory;

class Tutorial extends Model
{
    use HasFactory;

    
    public function syllabus()
    {
        return $this->belongsTo('App\Models\Syllabus');
    }
    
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }

    
    public function resources(){
        return $this->morphMany(Resource::class,'resourceable');
        
    }

    protected static function newFactory()
    {
        return TutorialFactory::new();
    }



    
}
