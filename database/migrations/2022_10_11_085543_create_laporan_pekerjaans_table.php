<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_customer');
            $table->integer('id_project');
            $table->integer('id_merk');
            $table->integer('nomor_lift');
            $table->text('keterangan')->nullable();
            $table->dateTime('jam_mulai')->nullable();
            $table->dateTime('jam_selesai')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('laporan_pekerjaan');
    }
}
