<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kibas', function (Blueprint $table) {
            $table->dropColumn('LINK');

            $table->bigInteger('HARGA')->nullable()->change();

            $table->bigInteger('LUAS')->nullable()->change();

            $table->year('TAHUN_PENGADAAN')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
