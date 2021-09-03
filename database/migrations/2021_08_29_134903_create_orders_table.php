<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('from_id')->unsigned(); // pharmacy
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('to_id')->unsigned(); // store
            // $table->foreign('to_id')->references('id')->on('stores')->onDelete('cascade');

            $table->enum('status', ['waiting','accepted','proccessing','done','refused'])->default('waiting');

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
        Schema::dropIfExists('orders');
    }
}
