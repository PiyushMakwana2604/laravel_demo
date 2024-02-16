<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'sub_total'
    ];

    
    public function product()
    {
        return $this->belongsTo(Products::class, 'id');
        // return $this->hasMany(Products::class, 'order_id');

    }
}
