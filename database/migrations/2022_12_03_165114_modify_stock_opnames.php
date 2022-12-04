<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyStockOpnames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('stock_opnames', function(Blueprint $table) {
        //     $table->double('jumlah_tercatat')->nullable()->change();
        //     $table->double('jumlah_mutasi')->nullable()->change();
        //     $table->double('jumlah_terjual')->nullable()->change();
        //     $table->double('jumlah_terbaru')->nullable()->change();
        // });
        DB::statement('alter table stock_opnames modify jumlah_tercatat DOUBLE(15,2) DEFAULT 0');
        DB::statement('alter table stock_opnames modify jumlah_mutasi DOUBLE(15,2) DEFAULT 0');
        DB::statement('alter table stock_opnames modify jumlah_terjual DOUBLE(15,2) DEFAULT 0');
        DB::statement('alter table stock_opnames modify jumlah_terbaru DOUBLE(15,2) DEFAULT 0');
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
