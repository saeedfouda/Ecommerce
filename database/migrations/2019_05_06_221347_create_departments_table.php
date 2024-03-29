<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dep_name_ar');
            $table->string('dep_name_en');
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->string('keyword')->nullable();

            $table->bigInteger('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('departments')->onDelete('cascade');


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
        Schema::dropIfExists('departments');
    }
}
