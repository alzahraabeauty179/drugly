<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('calls')->default(0)->comment('number of calls');
            $table->tinyInteger('whats')->default(0)->comment('number of whats messages');
            $table->tinyInteger('meeting')->default(0)->comment('number of meeting');
            $table->tinyInteger('care')->default(0)->comment('number of person care');
            $table->tinyInteger('nocare')->default(0)->comment('number of person not care');
            $table->string('description', 255)->nullable()->comment('description for this col');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
