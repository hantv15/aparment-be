<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table='maintenances';
    protected $fillable = [
        'name',
        'maintenance_id',
        'progress'
    ];
    public function category(){
        return $this->belongsTo(Maintenancecategory::class,'maintenance_id');
    }
}
