<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // $table->integer('brand_id')->unsigned();
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->double('amount');
            $table->string('unit');
            $table->double('unit_price');

            $table->date('expiry_date')->nullable();

            // $table->integer('parent_id')->nullable()->unsigned();
            // $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');

            // $table->tinyInteger('active')->default(0);
            // $table->string('image')->nullable();

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
        Schema::dropIfExists('product_logs');
    }
}
