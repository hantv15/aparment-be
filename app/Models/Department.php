<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'departments';
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function bills(){
        return $this->hasMany(Bill::class, 'department_id');
    }
    public function user_department(){
        return $this->hasMany(UserDepartment::class, 'department_id');
    }
    public function users(){
        return $this->belongsToMany(User::class, 'user_department', 'department_id', 'user_id');
    }
}
