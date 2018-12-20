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
            $table->string('displayname')->after('name')->nullable();
            if(config('ddvue.adminpanel.auth.type')=='ldap' || config('ddvue.adminpanel.auth.type')=='mix'){
                $table->string('name')->nullable()->change();
                $table->string('password')->nullable()->change();
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
            if(config('ddvue.adminpanel.auth.type')=='db'){
                $table->dropUnique('users_name_unique');
            }

        });
    }
}
