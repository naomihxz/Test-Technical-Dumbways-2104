<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'brand_id', 'status'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
