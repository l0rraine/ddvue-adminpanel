<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('displayname')->nullable();
            if(config('ddvue.adminpanel.auth.type')=='ldap' || config('ddvue.adminpanel.auth.type')=='mix'){
                $table->string('password')->nullable();
            }else{
                $table->unique('name');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('displayname');
            $table->dropUnique('users_name_unique');
        });
    }
}
