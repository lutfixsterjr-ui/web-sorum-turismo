<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('power')->nullable()->after('image');
            $table->string('acceleration')->nullable()->after('power');
            $table->string('top_speed')->nullable()->after('acceleration');
            $table->string('seats')->nullable()->after('top_speed');
            $table->string('drivetrain')->nullable()->after('seats');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['power', 'acceleration', 'top_speed', 'seats', 'drivetrain']);
        });
    }
};
