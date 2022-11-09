<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdLaporanPekerjaanToLaporanPekerjaanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_pekerjaan_users', function (Blueprint $table) {
            $table->integer('id_laporan_pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_pekerjaan_user', function (Blueprint $table) {
            //
        });
    }
}
