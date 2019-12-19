<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::create('MenuItems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_item_parent_id')->nullable();
            $table->integer('group_l')->nullable();
            $table->string('menu_item_name',100)->nullable();
            $table->string('menu_item_code', 100)->nullable();
            $table->integer('line_n')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('MenuItems');
    }
}
