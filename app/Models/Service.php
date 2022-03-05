<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    const  WATER_SERVICE = 6;

    protected $table = 'services';
    protected $fillable = [
        'name',
        'price',
        'icon',
        'description'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
