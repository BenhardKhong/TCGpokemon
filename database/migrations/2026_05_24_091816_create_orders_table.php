<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'orders',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId(
                    'user_id'
                );

                $table->foreignId(
                    'location_id'
                );

                $table->bigInteger(
                    'total_price'
                );

                $table->enum(
                    'status',
                    [
                        'paid',
                        'shipping',
                        'done'
                    ]
                )->default('paid');

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'orders'
        );
    }
};