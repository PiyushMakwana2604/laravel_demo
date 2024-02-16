<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class store extends Model
{
    use HasFactory;
    protected $table = 'tbl_store';
    
    public function products()
    {
        return $this->hasMany(Products::class, 'store_id');
    }
    public function productImage(){
        return $this->hasMany('App\Models\product_image', 'product_id');

    }
}
