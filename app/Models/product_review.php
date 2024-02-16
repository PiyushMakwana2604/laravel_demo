<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_review extends Model
{
    use HasFactory;
    protected $table = 'tbl_product_review';

    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating'
    ];

    public function productImage(){
        // return $this->hasOne('App\Models\product_image', 'product_id');
        return $this->hasMany(product_image::class, 'product_id');
                    
        // ->orderBy('id', 'DESC')->limit(1);
    }
}
