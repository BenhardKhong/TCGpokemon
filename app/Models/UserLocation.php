<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $fillable = [

        'user_id',

        'location_name',

        'receiver_name',

        'phone',

        'address',

        'city',

        'province',

        'postal_code',

        'is_default'

    ];
}