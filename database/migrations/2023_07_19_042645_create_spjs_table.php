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
        Schema::create('spjs', function (Blueprint $table) {
            $table->id();
            $table->string('no_st');
            $table->string('no_sppd');
            $table->bigInteger('pegawai_id');
            $table->date('tanggal_pelaksanaan');
            $table->date('tanggal_selesai');
            $table->string('tujuan');
            $table->bigInteger('uang_harian');
            $table->string('kendaraan');
            $table->string('tiket');
            $table->string('hotel');
            $table->bigInteger('uang_hotel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spjs');
    }
};
