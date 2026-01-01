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
        Schema::create('kibds', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang');
            $table->string('nibar');
            $table->string('nomor_register');
            $table->string('spesifikasi_nama_barang')->nullable();
            $table->string('spesifikasi_lainnya')->nullable();
            $table->string('nomor_ruas_jalan')->nullable();
            $table->string('nomor_ruas_jembatan')->nullable();
            $table->string('nomor_ruas_jaringan_irigasi')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('titik_koordinat')->nullable();
            $table->string('status_kepemilikan_tanah')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->bigInteger('harga_satuan_perolehan')->nullable();
            $table->string('cara_perolehan')->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->bigInteger('nilai_perolehan')->nullable();
            $table->string('status_penggunaan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('PENGGUNA_BARANG');
            $table->string('FOTO')->nullable();
            $table->string('DOWNLOAD')->nullable();

            $table->integer('KODE_BIDANG');
            $table->integer('KODE_UNITS');
            $table->integer('KODE_SUB_UNITS');
            $table->integer('KODE_UPB');

            $table->foreign('KODE_BIDANG')->references('KODE_BIDANG')->on('bidangs')->onDelete('cascade');
            $table->foreign('KODE_UNITS')->references('KODE_UNITS')->on('units')->onDelete('cascade');
            $table->foreign('KODE_SUB_UNITS')->references('KODE_SUB_UNITS')->on('subunits')->onDelete('cascade');
            $table->foreign('KODE_UPB')->references('KODE_UPB')->on('upbs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kibds');
    }
};
