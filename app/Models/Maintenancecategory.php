<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenancecategory extends Model
{
    use HasFactory;
    protected $table = 'maintenance_category';
    protected $fillable =[
        'building_id',
        'name'
    ];
}
