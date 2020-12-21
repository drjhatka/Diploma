<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Models\ImageFactory;

class Image extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function imageable(){
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return ImageFactory::new();
    }
}
