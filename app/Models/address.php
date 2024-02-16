<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city_id',
        'name',
        'company',
        'address',
        'postal_code',
        'latitude',
        'longitude',

    ];

    protected $table = 'tbl_address';

}
