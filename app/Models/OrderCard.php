<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCard extends Model
{
    protected $fillable = [

        'order_id',

        'user_card_id'

    ];

    // =========================
    // CARD
    // =========================

    public function userCard()
    {
        return $this->belongsTo(
            UserCard::class
        );
    }
    // =========================
    // ORDER
    // =========================

    public function order()
    {
        return $this->belongsTo(
            Order::class
        );
    }
}