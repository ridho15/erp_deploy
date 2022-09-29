<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project')->nullable();
            $table->integer('id_customer')->nullable();
            $table->text('alamat_project')->nullable();
            $table->string('keterangan_project')->nullable();
            $table->tinyInteger('diketahui_pelanggan')->nullable();
            $table->double('total_barang')->default(0);
            $table->double('total_harga');
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
        Schema::dropIfExists('projects');
    }
}
