<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatePekerjaanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_pekerjaan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->integer('checklist_1_bulan')->default(0);
            $table->integer('checklist_2_bulan')->default(0);;
            $table->integer('checklist_3_bulan')->default(0);;
            $table->integer('checklist_6_bulan')->default(0);;
            $table->integer('checklist_1_tahun')->default(0);;
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
        Schema::dropIfExists('template_pekerjaan_detail');
    }
}
