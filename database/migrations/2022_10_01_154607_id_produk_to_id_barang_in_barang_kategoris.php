<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdProdukToIdBarangInBarangKategoris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_kategoris', function (Blueprint $table) {
            $table->renameColumn('id_produk', 'id_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_barang_in_barang_kategoris', function (Blueprint $table) {
            //
        });
    }
}
