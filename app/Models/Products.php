<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';   
    
    public function productImages(){
        // return $this->hasOne('App\Models\product_image', 'product_id');
        return $this->hasMany(product_image::class, 'product_id');
                    
        // ->orderBy('id', 'DESC')->limit(1);
    }
    
}