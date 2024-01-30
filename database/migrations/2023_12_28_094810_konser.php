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
        Schema::create('konser', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama_konser')->nullable();
            $table->date('tanggal_konser')->nullable();
            $table->string('lokasi')->nullable();
            $table->bigInteger('harga')->unique();
            $table->integer('tiket')->nullable();
            $table->text('image')->nullable();
            $table->string('jenis_bank')->nullable();
            $table->string('atas_nama')->nullable();
            $table->bigInteger('rekening')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konser');
    }
};
