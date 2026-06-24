<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'gacha_histories',
            function (Blueprint $table) {

                $table->foreignId(
                    'user_card_id'
                )
                ->nullable();

            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'gacha_histories',
            function (Blueprint $table) {

                $table->dropColumn(
                    'user_card_id'
                );

            }
        );
    }
};