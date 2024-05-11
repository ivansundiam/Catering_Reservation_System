<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'category',
        'price',
        'quantity',
        'item_img',
    ];

    public function itemReports(): HasMany
    {
        return $this->hasMany(ItemReport::class);
    }
}
