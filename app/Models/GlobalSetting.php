<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = [
        'epic_chance',
        'price_50',
        'price_150',
        'price_300'
    ];
}