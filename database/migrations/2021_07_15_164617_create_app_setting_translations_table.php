<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_setting_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('app_setting_id')->unsigned();
            $table->string('locale')->index();
      
            $table->string('name');
            $table->text('description');
            $table->text('about_us');
            $table->text('privacy_policy');

            $table->unique(['app_setting_id', 'locale']);

            $table->foreign('app_setting_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_setting_translations');
    }
}
