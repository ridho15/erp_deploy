<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("tipe_notifikasi")->comment('1 = Stock Minimumm, 2 = Pembayaran Supplier Order, 3= Pembayaran Pre Order yang akan jatuh tempo');
            $table->text('pesan')->nullable();
            $table->smallInteger('status_lihat')->default(0);
            $table->date('tanggal');
            $table->string('route')->nullable();
            $table->integer('id_user');
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
        Schema::dropIfExists('notifikasis');
    }
}
