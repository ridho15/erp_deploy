<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnInSupplierOrderDetailTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_order_detail_temps', function (Blueprint $table) {
            $table->renameColumn('qty', 'jumlah_diminta');
            $table->double('jumlah_kurang')->default(0);
            $table->double('stock_sekarang')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_order_detail_temp', function (Blueprint $table) {
            //
        });
    }
}
