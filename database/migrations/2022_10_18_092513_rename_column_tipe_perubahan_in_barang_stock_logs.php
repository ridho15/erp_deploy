<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnTipePerubahanInBarangStockLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_stock_logs', function (Blueprint $table) {
            $table->renameColumn('tipe_perubahan', 'id_tipe_perubahan_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_stock_logs', function (Blueprint $table) {
            //
        });
    }
}
