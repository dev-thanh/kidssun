<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('id_category')->unsigned();
            $table->string('name');
            $table->string('name_en');
            $table->string('slug');
            $table->string('image');
            $table->string('more_image')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('size')->nullable();
            $table->string('status')->nullable();
            $table->string('pr_code')->nullable();
            $table->longText('content')->nullable();
            $table->longText('meta')->nullable();
            $table->longText('meta_en')->nullable();
            $table->longText('hot')->nullable();
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
        Schema::dropIfExists('products');
    }
}
