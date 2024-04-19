<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
