<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = 'bill_details';
    protected $fillable = [
        'service_id',
        'bill_id',
        'quantity',
        'total_price'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
