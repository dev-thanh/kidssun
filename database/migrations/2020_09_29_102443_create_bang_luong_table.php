<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBangLuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bang_luong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_daily')->nullable();
            $table->integer('luong_thang')->nullable();
            $table->bigInteger('money')->nullable();
            $table->integer('bu_tru')->nullable();
            $table->text('noidung')->nullable();
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
        Schema::dropIfExists('bang_luong');
    }
}
