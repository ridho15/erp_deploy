<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('id_supplier');
            $table->integer('id_user');
            $table->tinyInteger('status_order');
            $table->double('total_produk')->default(0);
            $table->double('total_harga')->default(0);
            $table->dateTime('tanggal_order');
            $table->string('keterangan')->nullable();
            $table->tinyInteger('id_tipe_pembayaran')->default(0);
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
        Schema::dropIfExists('supplier_orders');
    }
}
