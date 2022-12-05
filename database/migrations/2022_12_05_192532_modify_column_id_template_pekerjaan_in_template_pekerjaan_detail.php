<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnIdTemplatePekerjaanInTemplatePekerjaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_pekerjaan_detail', function (Blueprint $table) {
            $table->integer('id_template_pekerjaan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_pekerjaan_detail', function (Blueprint $table) {
            //
        });
    }
}
