<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $casts = [
        'visitor_info' => 'object',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
