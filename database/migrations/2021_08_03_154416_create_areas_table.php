<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('created_by')->unsigned(); // super admin id
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('areas')->onDelete('cascade');

            $table->tinyInteger('active')->default(1);

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
        Schema::dropIfExists('areas');
    }
}
