<?php

namespace App\Models;

use App\Models\PaymentGateway;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = ['order_stack'=> 'array'];
    public function product(){
        return $this->belongsToMany(Products::class);
    }

    public function payment_method(){
        return $this->belongsTo(PaymentGateway::class,'payment_gateway','id');
    }


}
