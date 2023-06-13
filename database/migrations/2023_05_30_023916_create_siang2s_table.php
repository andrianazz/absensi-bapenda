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
        Schema::create('siang2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId("absensi_id");
            $table->string("jam_siang2");
            $table->string("long");
            $table->string("lang");
            $table->string("radius");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siang2s');
    }
};
