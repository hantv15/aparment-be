<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function user(){
        return $this->hasOne(User::class, 'apartment_id');
    }
}
