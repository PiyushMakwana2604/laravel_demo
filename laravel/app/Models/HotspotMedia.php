<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotspotMedia extends Model
{
    use HasFactory;
    protected $table = 'tbl_hotspot_media';
    protected $fillable = [
        'media'
    ];
    public function hotspots()
    {
        // return $this->belongsTo(Products::class, 'id');
        return $this->hasMany(Hotspot::class, 'image_id');

    }
}
