<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumBukitBayarInSupplierOrderPembayarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_order_pembayarans', function (Blueprint $table) {
            $table->string('bukti_bayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_order_pembayarans', function (Blueprint $table) {
            //
        });
    }
}
