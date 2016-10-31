<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->string('nickname')->nullable();
            $table->date('birthday');
            $table->integer('gender');
            $table->text('about')->nullable();
            $table->text('status')->nullable();
            $table->boolean('is_admin')->default('0');
            $table->string('privacity')->default('public');
            $table->string('profilepic')->default('NULL');
            $table->string('wallpaper')->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
