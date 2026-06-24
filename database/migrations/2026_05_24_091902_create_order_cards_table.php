<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'order_cards',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId(
                    'order_id'
                );

                $table->foreignId(
                    'user_card_id'
                );

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'order_cards'
        );
    }
};