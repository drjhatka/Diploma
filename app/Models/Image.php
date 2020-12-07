<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function tutorial()
    {
        return $this->hasOne('App\Models\Tutorial', 'foreign_key', 'local_key');
    }

    public function news(){
        return $this->hasOne('App\Models\News', 'foreign_key', 'local_key');

    }
}
