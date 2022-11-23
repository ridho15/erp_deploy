<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierOrderDetailTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_order_detail_temps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->double('qty')->default(0);
            $table->double('harga_satuan')->default(0);
            $table->smallInteger('status');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('supplier_order_detail_temps');
    }
}
