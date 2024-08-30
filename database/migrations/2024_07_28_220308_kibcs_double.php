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
        Schema::table('kibcs', function (Blueprint $table) {
            $table->double('HARGA')->nullable()->change();
            $table->double('LUAS')->nullable()->change();
            $table->double('LUAS_LANTAI')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
