<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBksdTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_bksd', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_bentuk_kerjasama_umum")->unsigned()->index()->nullable();
            $table->string("nama_bentuk_kerjasam_detail",100);
            $table->string("rincian_bentuk_kerjasam_detail",255);
            $table->timestamps();
        });

        Schema::table('m_bksd', function($table) {
            $table->foreign('id_bentuk_kerjasama_umum')->references('id')->on('m_bksu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_bksd');
    }
}
