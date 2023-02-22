<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_usulan_unit', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_unit")->unsigned()->index()->nullable();
            $table->bigInteger("id_jenis_kerjasama")->unsigned()->index()->nullable();
            $table->bigInteger("id_mitra")->unsigned()->index()->nullable();
            $table->bigInteger("id_bentuk_kerjasama")->unsigned()->index()->nullable();
            $table->date('tanggal_usul');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('t_usulan_unit', function($table) {
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
        Schema::dropIfExists('t_usulan_unit');
    }
}
