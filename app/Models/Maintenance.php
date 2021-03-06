<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
