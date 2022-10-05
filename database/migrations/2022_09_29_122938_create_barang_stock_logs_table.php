<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangStockLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_stock_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->double('stok_awal')->default(0);
            $table->double('perubahan')->default(0);
            $table->tinyInteger('tipe_perubahan')->default(0);
            $table->dateTime('tanggal_perubahan');
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
        Schema::dropIfExists('barang_stock_logs');
    }
}
