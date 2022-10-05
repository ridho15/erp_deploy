<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTotalProdukToTotalBarangInSupplierOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_orders', function (Blueprint $table) {
            $table->renameColumn('total_produk', 'total_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('total_barang_in_supplier_orders', function (Blueprint $table) {
            //
        });
    }
}
