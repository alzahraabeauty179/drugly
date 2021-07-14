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
            $table->increments('id');

            // $table->integer('owner_id')->unsigned();
            // $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            // $table->integer('parent_id')->nullable()->unsigned();
            // $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');

            $table->tinyInteger('active')->default(0);
            $table->string('image')->nullable();

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
