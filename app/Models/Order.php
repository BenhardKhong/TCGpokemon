<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',

        'location_id',

        'total_price',

        'status'

    ];

    // =========================
    // ITEMS
    // =========================

    public function items()
    {
        return $this->hasMany(
            OrderItem::class
        );
    }

    // =========================
    // CARDS
    // =========================

    public function cards()
    {
        return $this->hasMany(
            OrderCard::class
        );
    }
    // =========================
    // LOCATION
    // =========================

    public function location()
    {
        return $this->belongsTo(
            UserLocation::class,
            'location_id'
        );
    }
}