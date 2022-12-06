<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsInTemplatePekerjaanDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_pekerjaan_detail', function (Blueprint $table) {
            $table->dropColumn('keterangan');
            $table->dropColumn('status');
            $table->dropColumn('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_pekerjaan_details', function (Blueprint $table) {
            //
        });
    }
}
