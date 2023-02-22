<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_unit', function (Blueprint $table) {
            $table->id();
            $table->string("nama_unit",25);
            $table->string("pd_unit",25);
            $table->string("email",25)->default(null);
            $table->string("web",25)->default(null);
            $table->string("no_telp",15)->default(null);
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
        Schema::dropIfExists('t_unit');
    }
}
