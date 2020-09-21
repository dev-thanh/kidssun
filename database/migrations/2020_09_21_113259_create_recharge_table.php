<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('sender')->comment('Người gửi');
            $table->text('bankname')->comment('Ngân hàng người gửi');
            $table->text('receiver')->comment('Người nhận');
            $table->integer('amount_money')->comment('Số tiền chuyển');
            $table->text('image')->comment('Hình ảnh bil chuyển tiền');
            $table->text('trading_code')->comment('Mã giao dịch');
            $table->text('note')->nullable()->comment('Gi chú');
            $table->integer('id_status')->comment('Xác nhận chuyển tiền');
            $table->integer('member_id');
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
        Schema::dropIfExists('recharge');
    }
}
