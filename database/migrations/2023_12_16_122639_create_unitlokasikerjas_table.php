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
        Schema::create('unitlokasikerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasikerja_id');
            $table->foreignId('unitkerja_id');
            $table->boolean('sts')->default(1);

            $table->foreign('lokasikerja_id')->references('id')->on('lokasikerja');
            $table->foreign('unitkerja_id')->references('id')->on('unit_kerjas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unitlokasikerja');
    }
};
