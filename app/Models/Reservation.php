<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package',
        'address',
        'date',
        'time',
        'occasion',
        'theme',
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
}
