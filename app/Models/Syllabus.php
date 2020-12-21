<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Database\Factories\Models\SyllabusFactory;

class Syllabus extends Authenticatable
{
    use HasFactory;
    
    // protected static function newFactory()
    // {
    //     //return SyllabusFactory::new();
    // }
}
