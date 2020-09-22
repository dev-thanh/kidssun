<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('mavd')->nullable();
            $table->bigInteger('tongtien')->nullable();
            $table->integer('id_member')->nullable();
            $table->dateTime('ngay_giaodich')->nullable();
            $table->integer('mentor')->nullable();
            $table->text('code')->nullable();
            $table->integer('id_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
