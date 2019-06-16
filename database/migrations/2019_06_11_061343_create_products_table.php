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
        // Schema::create('products', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('title');
        //     $table->string('photo');
        //     $table->string('content');

        //     $table->bigInteger('department_id')->unsigned()->nullable();
        //     $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

        //     $table->bigInteger('trade_id')->unsigned()->nullable();
        //     $table->foreign('trade_id')->references('id')->on('trade_marks')->onDelete('cascade');

        //     $table->bigInteger('manu_id')->unsigned()->nullable();
        //     $table->foreign('manu_id')->references('id')->on('manufacturers')->onDelete('cascade');

        //     $table->bigInteger('mall_id')->unsigned()->nullable();
        //     $table->foreign('mall_id')->references('id')->on('malls')->onDelete('cascade');

        //     $table->bigInteger('color_id')->unsigned()->nullable();
        //     $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

        //     $table->bigInteger('size_id')->unsigned()->nullable();
        //     $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

        //     $table->longText('other_data');

        //     $table->bigInteger('weight_id')->unsigned()->nullable();
        //     $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');

        //     $table->timestamps();
        // });
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
