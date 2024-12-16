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
        Schema::create('pengirims', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_wa');
            $table->string('email');
            $table->string('judul_berita');
            $table->string('file_path');
            $table->date('tanggal');
            $table->string('paket');
            $table->string('bukti_bayar')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirims');
    }
};
