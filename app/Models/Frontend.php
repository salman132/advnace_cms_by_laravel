<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    protected $fillable = [
        'key', 'value'
    ];

    protected $casts = [
      'value' => 'object'
    ];
}
