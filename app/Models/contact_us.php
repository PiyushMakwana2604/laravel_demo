<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_us extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'email',
        'message'
    ];
    
    protected $table = 'tbl_contact_us';
}
