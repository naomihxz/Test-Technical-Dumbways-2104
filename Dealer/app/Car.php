<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name', 'brand_id', 'image', 'color', 'description', 'stock'];

    public function brand(){
        return $this->belongsTo('App\Brand');
    }
}
