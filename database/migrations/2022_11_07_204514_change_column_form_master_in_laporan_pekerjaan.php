<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnFormMasterInLaporanPekerjaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_pekerjaan', function (Blueprint $table) {
                $table->renameColumn('form_master', 'id_form_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_pekerjaan', function (Blueprint $table) {
            //
        });
    }
}
