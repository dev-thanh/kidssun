<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->text('mavd')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('price_total')->nullable();
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
        Schema::dropIfExists('order_detail');
    }
}
