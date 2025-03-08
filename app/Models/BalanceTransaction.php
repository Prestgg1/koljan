<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_code',
        'total_price',
        'basket_items',
        'address',
        'status',
    ];

    protected $casts = [
        'basket_items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
