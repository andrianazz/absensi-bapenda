<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lokasikerja', function (Blueprint $table) {
            $table->id();
            $table->string('nm_lokasi', 30);
            $table->string('alamat_lokasi', 100);

            $table->string('lang', 100);
            $table->string('lat', 100);
            $table->integer('maxradius');
            $table->boolean('sts')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasikerja');
    }
};
