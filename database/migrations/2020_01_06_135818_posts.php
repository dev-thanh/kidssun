<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('name_en')->nullable();
            $table->text('slug')->nullable();
            $table->text('desc')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('content')->nullable();
            $table->text('content_en')->nullable();
            $table->text('image')->nullable();
            $table->text('type')->nullable();
            $table->integer('hot')->nullable();
            $table->integer('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
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
        Schema::dropIfExists('Posts');
    }
}
