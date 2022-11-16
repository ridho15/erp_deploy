<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnTemplatePekerjaanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_pekerjaan_detail', function(Blueprint $table){
            $table->dropColumn('checklist_6_bulan');
            $table->dropColumn('checklist_1_tahun');
            $table->text('kondisi')->nullable();
            $table->integer('periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
