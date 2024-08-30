<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('subunits')
            ->where('KODE_SUB_UNITS', 1)
            ->update(['NAMA_SUB_UNITS' => 'Sekretariat DPRD']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('subunits')
            ->where('KODE_SUB_UNITS', 1)
            ->update(['NAMA_SUB_UNITS' => 'SEKRETARIAT DAERAH']);
    }
};
