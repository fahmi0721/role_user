<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasiTDokKsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_dok_ks', function (Blueprint $table) {
            $table->foreign('id_usulan')->references('id')->on('t_usulan_unit')->onDelete('cascade');
            $table->foreign('id_unit')->references('id')->on('t_unit')->onDelete('cascade');
            $table->foreign('id_jenis_kerjasama')->references('id')->on('m_jenis_ks')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id')->on('t_mitra')->onDelete('cascade');
            $table->foreign('id_bentuk_kerjasama')->references('id')->on('m_bksd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_dok_ks', function (Blueprint $table) {
            //
        });
    }
}
