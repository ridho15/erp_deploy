<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_detail_subs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_project_detail');
            $table->string('nama_sub_pekerjaan');
            $table->integer('kondisi_1_bulan')->nullable();
            $table->integer('kondisi_2_bulan')->nullable();
            $table->integer('kondisi_3_bulan')->nullable();
            $table->integer('kondisi_6_bulan')->nullable();
            $table->integer('kondisi_1_tahun')->nullable();
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
        Schema::dropIfExists('project_detail_subs');
    }
}
