<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDdvueMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddvue_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('index')->nullable()->comment('类型为submenu,group时为空,为item时填写RouteName');
            $table->string('type')->comment('类型：submenu,group,item');
            $table->string('icon')->nullable();
            $table->json('limits')->nullable()->comment('能够查看该节点的权限id');
            $table->integer('sort_id')->default(99);
            $table->integer('parent_id');
            $table->string('class_list')->nullable();
            $table->string('class_layer')->nullable();
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
        Schema::dropIfExists('ddvue_menus');
    }
}
