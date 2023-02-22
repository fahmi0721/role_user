<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDekripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_provinsi', function (Blueprint $table) {
            $table->renameColumn("deskripi","deskripsi");
        });

        Schema::table('m_kab_kota', function (Blueprint $table) {
            $table->renameColumn("deskripi","deskripsi");
        });

        Schema::table('m_kecamatan', function (Blueprint $table) {
            $table->renameColumn("deskripi","deskripsi");
        });

        Schema::table('m_kel_desa', function (Blueprint $table) {
            $table->renameColumn("deskripi","deskripsi");
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_provinsi', function (Blueprint $table) {
            //
        });
    }
}
