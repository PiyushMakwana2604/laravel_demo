<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_otp extends Model
{
    use HasFactory;

    protected $table = 'tbl_otp';
    protected $fillable = [
        'phone',
        'otp',
        'is_verify'
    ];
}
