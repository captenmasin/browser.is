<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['uuid', 'data'];

    protected $casts = [
        'data' => 'json',
    ];
}
