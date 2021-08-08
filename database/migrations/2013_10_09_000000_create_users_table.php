<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('active')->default(1);
            
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('national_id_image')->nullable();
            $table->string('license_image')->nullable();

            $table->enum('type', ['super_admin', 'medical_store', 'beauty_company', 'pharmacy'])->default('medical_store');

            $table->integer('area_id')->unsigned()->nullable();
            // $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');

            $table->integer('store_id')->unsigned()->nullable();
            // $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

            $table->integer('app_setting_id')->unsigned()->nullable();
            // $table->foreign('app_setting_id')->references('id')->on('app_settings')->onDelete('cascade');
            
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
