<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_profits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_donhang')->nullable();
            $table->integer('id_capduoi')->nullable();
            $table->text('name_capduoi')->nullable();
            $table->integer('id_nguoinhan')->nullable();
            $table->text('name_nguoinhan')->nullable();
            $table->bigInteger('money')->nullable();
            $table->integer('id_status')->nullable();
            $table->text('name_status')->nullable();
            $table->timestamp('ngay_nhan')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_profits');
    }
}
