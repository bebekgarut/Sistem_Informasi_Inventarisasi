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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->enum('role', ['admin', 'dinas']);
            $table->integer('KODE_UPB');
            $table->foreign('KODE_UPB')->references('KODE_UPB')->on('upbs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['KODE_UPB']);
            $table->dropColumn('KODE_UPB');
            $table->dropColumn('role');
        });
    }
};
