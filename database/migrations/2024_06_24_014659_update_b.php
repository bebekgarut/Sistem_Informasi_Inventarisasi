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
        Schema::table('kibbs', function (Blueprint $table) {
            $table->string('MERK_TYPE')->nullable()->change();
            $table->string('UKURAN_CC')->nullable()->change();
            $table->string('BAHAN')->nullable()->change();
            $table->year('TAHUN_PEMBELIAN')->nullable()->change();
            $table->string('NOMOR_PABRIK')->nullable()->change();
            $table->string('NOMOR_RANGKA')->nullable()->change();
            $table->string('NOMOR_MESIN')->nullable()->change();
            $table->string('NOMOR_BPKB')->nullable()->change();
            $table->string('ASAL_USUL')->nullable()->change();
            $table->text('KETERANGAN')->nullable()->change();
            $table->bigInteger('HARGA')->nullable()->change();
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
        Schema::table('kibbs', function (Blueprint $table) {
            $table->string('MERK_TYPE')->nullable(false)->change();
            $table->string('UKURAN_CC')->nullable(false)->change();
            $table->string('BAHAN')->nullable(false)->change();
            $table->year('TAHUN_PEMBELIAN')->nullable(false)->change();
            $table->string('NOMOR_PABRIK')->nullable(false)->change();
            $table->string('NOMOR_RANGKA')->nullable(false)->change();
            $table->string('NOMOR_MESIN')->nullable(false)->change();
            $table->string('NOMOR_BPKB')->nullable(false)->change();
            $table->string('ASAL_USUL')->nullable(false)->change();
            $table->text('KETERANGAN')->nullable(false)->change();
            $table->bigInteger('HARGA')->nullable(false)->change();
            $table->string('FOTO')->nullable(false)->change();
            $table->string('DOWNLOAD')->nullable(false)->change();
        });
    }
};
