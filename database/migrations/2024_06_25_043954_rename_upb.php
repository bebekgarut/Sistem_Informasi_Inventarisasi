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
        Schema::table('upbs', function (Blueprint $table) {
            $table->renameColumn('NAMA_SUB_UNITS', 'NAMA_UPB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upbs', function (Blueprint $table) {
            $table->renameColumn('NAMA_UPB', 'NAMA_SUB_UNITS');
        });
    }
};
