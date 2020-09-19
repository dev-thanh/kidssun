<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('full_name')->nullable();
            $table->text('user_name')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('password');
            $table->text('mentor')->nullable();
            $table->text('avartar')->nullable();
            $table->text('address')->nullable();
            $table->text('bank_account')->nullable();
            $table->text('bank_address')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('so_cmnd')->nullable();
            $table->text('cmnd1')->nullable();
            $table->text('cmnd2')->nullable();
            $table->text('active')->nullable()->default('0');
            $table->text('code')->comment('DLPP hoặc là DLBL');
            $table->text('link_aff')->nullable();

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
        Schema::dropIfExists('member');
    }
}
