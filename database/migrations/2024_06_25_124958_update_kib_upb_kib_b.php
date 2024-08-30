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
        Schema::table('kibbs', function (Blueprint $table) {
            $table->integer('KODE_UPB')->nullable();

            $table->foreign('KODE_UPB')->references('KODE_UPB')->on('upbs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kibbs', function (Blueprint $table) {
            $table->dropForeign(['KODE_UPB']);
            $table->dropColumn('KODE_UPB');
        });
    }
};
