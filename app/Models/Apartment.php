<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'apartments';
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'apartment_id');
    }

    /**
     * @return BelongsTo
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function cards(){
        return $this->hasMany(Card::class, 'apartment_id');
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class, 'apartment_id');
    }

    public function vehicleTypes(){
        return $this->belongsToMany(VehicleType::class, 'vehicles', 'apartment_id', 'vehicle_type_id');
    }
}
