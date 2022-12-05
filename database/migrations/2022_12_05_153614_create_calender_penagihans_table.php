<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalenderPenagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calender_penagihans', function (Blueprint $table) {
            $table->id();
            $table->integer('tipe');
            $table->integer('id_accounts');
            $table->text('description')->nullable();
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('calender_penagihans');
    }
}
