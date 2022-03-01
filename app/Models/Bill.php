<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = [
        'name',
        'amount',
        'status',
        'type_payment',
        'payment_method',
        'image',
        'fax',
        'apartment_id',
        'notes',
        'receiver_id'
    ];
}
