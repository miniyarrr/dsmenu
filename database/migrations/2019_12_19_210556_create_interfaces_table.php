<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterfacesTable extends Migration
{
    public function up()
    {
        Schema::create('__UserInterfaces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_item_id')->nullable();
            $table->string('interface_code', 100)->nullable();
            $table->string('interface_name', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('__UserInterfaces');
    }
}
