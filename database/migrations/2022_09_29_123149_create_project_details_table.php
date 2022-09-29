<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_project')->nullable();
            $table->string('nama_pekerjaan')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('id_user')->nullable();
            $table->text('keterangan')->nullable();
            $table->dateTime('jam_mulai');
            $table->dateTime('jam_selesai');
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
        Schema::dropIfExists('project_details');
    }
}
