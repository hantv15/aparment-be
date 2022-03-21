<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    use HasFactory;

    const PAYMENT_SUCCESS = 1;
    const NOT_YET_PAYMENT = 0;

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
        'receiver_id',
    ];

    /**
     * @return BelongsTo
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    /**
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'bill_details', 'bill_id', 'service_id');
    }

    /**
     * @return HasMany
     */
    public function billDetail(): HasMany
    {
        return $this->hasMany(BillDetail::class);
    }
}
