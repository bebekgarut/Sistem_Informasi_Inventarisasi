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
        Schema::create('kibcs', function (Blueprint $table) {
            $table->id();
            $table->string('NAMA_BARANG');
            $table->string('KODE_BARANG');
            $table->string('NOMOR_REGISTER');
            $table->string('KONDISI_BANGUNAN');
            $table->string('BANGUNAN_BERTINGKAT');
            $table->string('BANGUNAN_BETON');
            $table->integer('LUAS_LANTAI');
            $table->string('LETAK_ALAMAT');
            $table->date('TANGGAL_DOKUMEN');
            $table->string('NOMOR_DOKUMEN');
            $table->integer('LUAS');
            $table->string('STATUS_TANAH');
            $table->string('NOMOR_KODE_TANAH');
            $table->string('PENGGUNA_BARANG');
            $table->string('ASAL_USUL');
            $table->bigInteger('HARGA');
            $table->text('KETERANGAN');
            $table->string('FOTO');
            $table->string('LINK');
            $table->string('KOORDINAT');
            $table->string('DOWNLOAD');

            $table->integer('KODE_BIDANG');
            $table->integer('KODE_UNITS');
            $table->integer('KODE_SUB_UNITS');

            $table->foreign('KODE_BIDANG')->references('KODE_BIDANG')->on('bidangs')->onDelete('cascade');
            $table->foreign('KODE_UNITS')->references('KODE_UNITS')->on('units')->onDelete('cascade');
            $table->foreign('KODE_SUB_UNITS')->references('KODE_SUB_UNITS')->on('subunits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kibcs');
    }
};
