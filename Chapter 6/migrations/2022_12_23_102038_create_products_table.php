<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            // $table->bigInteger('categories_id')->unsigned();

            $table->string('name');
            $table->string('slug');
            $table->integer('categories_id');
            // $table->string('type');
            $table->longText('description');
            $table->integer('price');
            $table->integer('quantity');

            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('categories_id')->references('categories_id')->on('categories');
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
