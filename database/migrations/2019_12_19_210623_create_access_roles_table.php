<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRolesTable extends Migration
{
    public function up()
    {
        Schema::create('_AccessRoles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interface_id')->nullable();
            $table->string('access_role_code',30)->nullable();
            $table->string('access_role_name',100)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('_AccessRoles');
    }
}
