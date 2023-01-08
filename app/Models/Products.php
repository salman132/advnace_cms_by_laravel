<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $casts = [
        'gallery' => 'object',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function order(){
        return $this->belongsToMany(Order::class);
    }

}
