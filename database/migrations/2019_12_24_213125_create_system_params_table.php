<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SystemParameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_bg_color', 20)->nullable();
            $table->string('menu_text_color', 20)->nullable();
            $table->string('header_bg_color', 20)->nullable();
            $table->string('header_text_color', 20)->nullable();
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
        Schema::dropIfExists('SystemParameters');
    }
}
