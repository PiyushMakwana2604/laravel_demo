<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $table = 'tbl_cart';

    protected $fillable = [
    'user_id',
    'product_id',
    'size',
    'quantity',
    'price',
    'comments',
    'charge',
    'tax',
    'total_amount'
    ];
}
