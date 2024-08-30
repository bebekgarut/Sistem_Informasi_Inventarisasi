<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kibcs', function (Blueprint $table) {
            $table->string('KONDISI_BANGUNAN')->nullable()->change();
            $table->string('BANGUNAN_BERTINGKAT')->nullable()->change();
            $table->string('BANGUNAN_BETON')->nullable()->change();
            $table->integer('LUAS_LANTAI')->nullable()->change();
            $table->string('LETAK_ALAMAT')->nullable()->change();
            $table->date('TANGGAL_DOKUMEN')->nullable()->change();
            $table->string('NOMOR_DOKUMEN')->nullable()->change();
            $table->integer('LUAS')->nullable()->change();
            $table->string('STATUS_TANAH')->nullable()->change();
            $table->string('NOMOR_KODE_TANAH')->nullable()->change();
            $table->string('ASAL_USUL')->nullable()->change();
            $table->bigInteger('HARGA')->nullable()->change();
            $table->text('KETERANGAN')->nullable()->change();
            $table->string('LINK')->nullable()->change();
            $table->string('KOORDINAT')->nullable()->change();
            $table->string('FOTO')->nullable()->change();
            $table->string('DOWNLOAD')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kibcs', function (Blueprint $table) {
            $table->string('KONDISI_BANGUNAN')->nullable(false)->change();
            $table->string('BANGUNAN_BERTINGKAT')->nullable(false)->change();
            $table->string('BANGUNAN_BETON')->nullable(false)->change();
            $table->integer('LUAS_LANTAI')->nullable(false)->change();
            $table->string('LETAK_ALAMAT')->nullable(false)->change();
            $table->date('TANGGAL_DOKUMEN')->nullable(false)->change();
            $table->string('NOMOR_DOKUMEN')->nullable(false)->change();
            $table->integer('LUAS')->nullable()->change(false);
            $table->string('STATUS_TANAH')->nullable(false)->change();
            $table->string('NOMOR_KODE_TANAH')->nullable(false)->change();
            $table->string('ASAL_USUL')->nullable(false)->change();
            $table->bigInteger('HARGA')->nullable(false)->change();
            $table->text('KETERANGAN')->nullable(false)->change();
            $table->string('LINK')->nullable(false)->change();
            $table->string('KOORDINAT')->nullable(false)->change();
            $table->string('FOTO')->nullable(false)->change();
            $table->string('DOWNLOAD')->nullable(false)->change();
        });
    }
};
