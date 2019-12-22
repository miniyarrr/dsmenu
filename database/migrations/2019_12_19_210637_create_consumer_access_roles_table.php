<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerAccessRolesTable extends Migration
{
    public function up()
    {
        Schema::create('_ConsumerAccessRoles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('access_role_id')->nullable();
            $table->integer('consumer_id')->nullable();
            $table->boolean('main_l')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('_ConsumerAccessRoles');
    }
}
