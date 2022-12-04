<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrderPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_order_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_supplier_order');
            $table->integer('total_bayar_sebelumnya');
            $table->integer('pembayaran_sekarang');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_order_pembayarans');
    }
}
