<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    use HasFactory;
    protected $table = 'tbl_hotspots';
    protected $fillable = [
        'image_id',
        'order_id',
        'x_axis',
        'y_axis',
        'message'
    ];
}
