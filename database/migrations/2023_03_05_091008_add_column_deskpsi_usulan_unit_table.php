<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeskpsiUsulanUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_usulan_unit', function (Blueprint $table) {
            $table->string("deskripsi",100)->nullable()->after("tanggal_usul");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_usulan_unit', function (Blueprint $table) {
           
        });
    }
}
