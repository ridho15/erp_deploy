<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->double('jumlah_tercatat')->default(0);
            $table->double('jumlah_mutasi')->default(0);
            $table->double('jumlah_terjual')->default(0);
            $table->double('jumlah_terbaru')->default(0);
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal');
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
        Schema::dropIfExists('stock_opnames');
    }
}
