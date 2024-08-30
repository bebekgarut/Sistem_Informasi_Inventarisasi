<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKibasTableNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kibas', function (Blueprint $table) {
            $table->string('LUAS')->nullable()->change();
            $table->year('TAHUN_PENGADAAN')->nullable()->change();
            $table->string('LETAK_ALAMAT')->nullable()->change();
            $table->string('HAK')->nullable()->change();
            $table->date('TANGGAL_SERTIFIKAT')->nullable()->change();
            $table->string('NO_SERTIFIKAT')->nullable()->change();
            $table->string('PENGGUNAAN')->nullable()->change();
            $table->string('ASAL_USUL')->nullable()->change();
            $table->string('HARGA')->nullable()->change();
            $table->string('KETERANGAN')->nullable()->change();
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
        Schema::table('kibas', function (Blueprint $table) {
            $table->string('LUAS')->nullable(false)->change();
            $table->year('TAHUN_PENGADAAN')->nullable(false)->change();
            $table->string('LETAK_ALAMAT')->nullable(false)->change();
            $table->string('HAK')->nullable(false)->change();
            $table->date('TANGGAL_SERTIFIKAT')->nullable(false)->change();
            $table->string('NO_SERTIFIKAT')->nullable(false)->change();
            $table->string('PENGGUNAAN')->nullable(false)->change();
            $table->string('ASAL_USUL')->nullable(false)->change();
            $table->string('HARGA')->nullable(false)->change();
            $table->string('KETERANGAN')->nullable(false)->change();
            $table->string('LINK')->nullable(false)->change();
            $table->string('KOORDINAT')->nullable(false)->change();
            $table->string('FOTO')->nullable(false)->change();
            $table->string('DOWNLOAD')->nullable(false)->change();
        });
    }
}
