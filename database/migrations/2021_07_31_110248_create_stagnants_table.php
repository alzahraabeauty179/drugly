<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagnantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagnants', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description')->nullable();

            $table->double('amount')->nullable();
            $table->double('price')->nullable(); // price for one pices
            $table->double('discount')->nullable(); // discount with percentage
            $table->date('expiry_date')->nullable(); 

           // this is for self join to get all stagnant and his offer applay from other pharm
             // i dont need to make another table becouse they have the same data
            $table->integer('stagnant_id')->nullable()->unsigned();
            $table->foreign('stagnant_id')->references('id')->on('stagnants')->onDelete('cascade');

            $table->tinyInteger('status')->nullable(); // null not read  1=> approved for make a deal  0 => not approve the deal

            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            $table->tinyInteger('active')->default(1); // if stagnant is avilable or not
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
        Schema::dropIfExists('stagnants');
    }
}
