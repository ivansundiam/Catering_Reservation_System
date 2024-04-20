<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'transaction_number',
        'package_id',
        'menu_id',
        'address',
        'date',
        'time',
        'occasion',
        'pax',
        'total_cost',
        'amount_paid',
        'payment_percent',
        'receipt_img',
        'payment_dates'
    ];

    protected $casts = [
        'date' => 'datetime',
        'time' => 'datetime:H:i:s',
        'payment_dates' => 'array'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package() : BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function menu() : BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
