<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('category_url');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('category', function (Blueprint $table) 
        {
            $table->foreign('parent_id')->references('id')->on('category')->onUpdate('cascade')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('category');
    }
}
