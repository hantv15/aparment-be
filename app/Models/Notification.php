<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    const INACTIVE_USER = 1;
    const ACTIVE_USER = 0;
    protected $table = 'notifications';
    protected $guarded = ['id'];
}
