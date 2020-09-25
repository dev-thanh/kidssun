<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuyenloiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quyenloi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hhds_dlbl');
            $table->integer('hhm_dlbl');
            $table->integer('hhds_dlpp');
            $table->integer('hhtk_dlbl');
            $table->integer('hhtk_dlpp');
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
        Schema::dropIfExists('quyenloi');
    }
}
