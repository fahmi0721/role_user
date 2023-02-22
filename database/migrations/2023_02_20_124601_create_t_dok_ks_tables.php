<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDokKsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_dok_ks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_usulan")->unsigned()->index()->nullable();
            $table->bigInteger("id_unit")->unsigned()->index()->nullable();
            $table->bigInteger("id_jenis_kerjasama")->unsigned()->index()->nullable();
            $table->bigInteger("id_bentuk_kerjasama")->unsigned()->index()->nullable();
            $table->bigInteger("id_mitra")->unsigned()->index()->nullable();
            $table->string("nama_dokumen",100)->default("-");
            $table->enum('status',['draft','publish'])->default('draft');
            $table->date("tgl_draf");
            $table->date("tgl_awal");
            $table->date("tgl_akhir");
            $table->string("deskripsi",255);
            $table->string("file_draft",100);
            $table->string("file_publih",100);
            $table->integer("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_dok_ks');
    }
}
