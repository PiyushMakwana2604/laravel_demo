<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'tbl_order';

    protected $fillable = [
        'user_id',
        'address_id',
        'coupan_id',
        'order_no',
        'order_date',
        'order_status',
        'transaction_id',
        'payment_method',
        'payment_status',
        'sub_total',
        'discount',
        'tax_charge',
        'grand_total',
        'delivery_date',
    ];

    public function order_data()
    {
        return $this->hasMany(order_details::class, 'order_id');
    }

        public function product()
    {
        return $this->belongsTo(Products::class, 'id');
        // return $this->hasMany(Products::class, 'order_id');

    }

}
