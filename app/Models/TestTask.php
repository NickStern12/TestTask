<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTask extends Model
{
    protected $fillable = [
        'id',
        'title,',
        'slug',
        'image'
    ];

}
