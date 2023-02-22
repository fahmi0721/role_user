<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKabKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kab_kota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_provinsi")->unsigned()->index()->nullable();
            $table->string("nama_kab_kota",100);
            $table->string("deskripi",100);
            $table->integer("user_id");
            $table->timestamps();
        });

        Schema::table('m_kab_kota', function($table) {
            $table->foreign('id_provinsi')->references('id')->on('m_provinsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kab_kota');
    }
}
