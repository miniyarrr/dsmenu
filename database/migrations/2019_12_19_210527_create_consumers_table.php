<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumersTable extends Migration
{
    public function up()
    {
        Schema::create('Consumers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('consumer_login',100);
            $table->string('password',200);
            $table->string('consumer_name',100);
            $table->string('first_name',40)->nullable();
            $table->string('last_name',40)->nullable();
            $table->string('middle_name',40)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Consumers');
    }
}
