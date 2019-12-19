<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemAccessRolesTable extends Migration
{
    public function up()
    {
        Schema::create('MenuItemAccessRoles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_item_id')->nullable();
            $table->integer('access_role_id')->nullable();
            $table->boolean('menu_item_view_l')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('MenuItemAccessRoles');
    }
}
