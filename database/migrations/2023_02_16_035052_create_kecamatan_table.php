<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_provinsi")->unsigned()->index()->nullable();
            $table->bigInteger("id_kab_kota")->unsigned()->index()->nullable();
            $table->string("nama_kab_kota",100);
            $table->string("deskripi",100);
            $table->integer("user_id");
            $table->timestamps();
        });

        Schema::table('m_kecamatan', function($table) {
            $table->foreign('id_provinsi')->references('id')->on('m_provinsi')->onDelete('cascade');
            $table->foreign('id_kab_kota')->references('id')->on('m_kab_kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kecamatan');
    }
}
