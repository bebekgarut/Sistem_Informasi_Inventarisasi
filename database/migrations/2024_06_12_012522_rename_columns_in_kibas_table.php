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
        Schema::table('kibas', function (Blueprint $table) {
            $table->renameColumn('TAHUN_PENGGADAAN', 'TAHUN_PENGADAAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kibas', function (Blueprint $table) {
            $table->renameColumn('TAHUN_PENGADAAN', 'TAHUN_PENGGADAAN');
        });
    }
};
