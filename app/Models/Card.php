<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';
    protected $fillable = [
        'number',
        'name',
        'status',
        'expire_time',
        'apartment_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function apartment(){
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
