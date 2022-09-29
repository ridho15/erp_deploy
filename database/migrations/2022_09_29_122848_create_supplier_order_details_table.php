<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_supplier_order');
            $table->integer('id_produk');
            $table->double('qty')->default(0);
            $table->double('harga_satuan')->default(0);
            $table->tinyInteger('status_order')->default(0);
            $table->string('keterangan');
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
        Schema::dropIfExists('supplier_order_details');
    }
}
