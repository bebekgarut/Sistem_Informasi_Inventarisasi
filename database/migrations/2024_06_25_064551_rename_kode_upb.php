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
            $table->renameColumn('KODE_UPBS', 'KODE_UPB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upbs', function (Blueprint $table) {
            $table->renameColumn('KODE_UPB', 'KODE_UPBS');
        });
    }
};
