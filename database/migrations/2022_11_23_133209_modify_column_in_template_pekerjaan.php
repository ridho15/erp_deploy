<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnInTemplatePekerjaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_pekerjaan', function (Blueprint $table) {
            $table->string('periode')->nullable();
            $table->integer('id_parent')->nullable();
            $table->integer('id_form_master')->nullable()->change();
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
        Schema::table('template_pekerjaan', function (Blueprint $table) {
            //
        });
    }
}
