<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReview extends Migration
{
    public function up()
    {
        Schema::create('product_review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('rating_star')->default(5);
            $table->string('review_person_name')->nullable();
            $table->string('review_comment',2000)->change()->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('show_home')->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('product_review');
    }
}
