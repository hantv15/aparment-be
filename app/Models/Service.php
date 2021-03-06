<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    const WATER_SERVICE = 1;

    protected $table = 'services';
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'category'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
