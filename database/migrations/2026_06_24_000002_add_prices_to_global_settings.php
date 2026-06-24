<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->bigInteger('price_50')->default(50000)->after('epic_chance');
            $table->bigInteger('price_150')->default(150000)->after('price_50');
            $table->bigInteger('price_300')->default(300000)->after('price_150');
        });
    }

    public function down(): void
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->dropColumn(['price_50','price_150','price_300']);
        });
    }
};
