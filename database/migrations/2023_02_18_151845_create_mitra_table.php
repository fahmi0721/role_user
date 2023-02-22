<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_mitra', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_jenis_mitra")->unsigned()->index()->nullable();
            $table->bigInteger("id_provinsi")->unsigned()->index()->nullable();
            $table->bigInteger("id_kab_kota")->unsigned()->index()->nullable();
            $table->bigInteger("id_kecamatan")->unsigned()->index()->nullable();
            $table->bigInteger("id_kel_desa")->unsigned()->index()->nullable();
            $table->string("nama_mitra",25);
            $table->string("email",25);
            $table->string("no_tlp",15);
            $table->string("alamat",35);
            $table->string("website",35)->default(null);
            $table->integer("user_id");
            $table->timestamps();
        });

        Schema::table('t_mitra', function($table) {
            $table->foreign('id_jenis_mitra')->references('id')->on('m_jenis_mitra')->onDelete('cascade');
            $table->foreign('id_provinsi')->references('id')->on('m_provinsi')->onDelete('cascade');
            $table->foreign('id_kab_kota')->references('id')->on('m_kab_kota')->onDelete('cascade');
            $table->foreign('id_kecamatan')->references('id')->on('m_kecamatan')->onDelete('cascade');
            $table->foreign('id_kel_desa')->references('id')->on('m_kel_desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_mitra');
    }
}
