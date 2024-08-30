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
        Schema::create('upbs', function (Blueprint $table) {
            $table->integer('KODE_UPB')->primary();
            $table->string('NAMA_UPB');
            $table->integer('KODE_BIDANG');
            $table->integer('KODE_UNITS');
            $table->integer('KODE_SUB_UNITS');
            $table->timestamps();

            $table->foreign('KODE_BIDANG')->references('KODE_BIDANG')->on('bidangs')->onDelete('cascade');
            $table->foreign('KODE_UNITS')->references('KODE_UNITS')->on('units')->onDelete('cascade');
            $table->foreign('KODE_SUB_UNITS')->references('KODE_SUB_UNITS')->on('subunits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upbs');
    }
};
