<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $fillable = [
        'plate_number',
        'vehicle_type_id',
        'card_id',
        'status',
        'image',
        'apartment_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function category(){
        return $this->belongsTo(VehicleType::class,'vehicle_type_id');
    }
}
