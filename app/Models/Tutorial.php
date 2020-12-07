<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'foreign_key', 'local_key');
    }

    
    public function resources()
    {
        return $this->hasMany('App\Models\Resource', 'foreign_key', 'local_key');
    }

    
}
