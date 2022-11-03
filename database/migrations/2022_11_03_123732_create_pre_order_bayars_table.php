<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOrderBayarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order_bayars', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pre_order');
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
        Schema::dropIfExists('pre_order_bayars');
    }
}
