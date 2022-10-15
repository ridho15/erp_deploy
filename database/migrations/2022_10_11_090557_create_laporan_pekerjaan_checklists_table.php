<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPekerjaanChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pekerjaan_checklist', function (Blueprint $table) {
            $table->id();
            $table->integer('id_laporan_pekerjaan');
            $table->integer('id_template_pekerjaan_detail');
            $table->integer('id_kondisi');
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
        Schema::dropIfExists('laporan_pekerjaan_checklists');
    }
}
