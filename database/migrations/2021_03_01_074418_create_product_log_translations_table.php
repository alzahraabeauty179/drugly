<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLogTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_log_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_log_id')->unsigned();
            $table->string('locale')->index();
            
            $table->string('name');
            $table->text('description')->nullable();


            $table->string('unit');

            $table->string('type');

            $table->unique(['product_log_id', 'locale']);

            $table->foreign('product_log_id')->references('id')->on('product_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_log_translations');
    }
}
