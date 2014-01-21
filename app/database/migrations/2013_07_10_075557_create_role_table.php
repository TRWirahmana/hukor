<?php

use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function($t) {
            // auto increment id (primary key)
            $t->increments('id');
            $t->string('name', 25);
            // created_at, updated_at DATETIME
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role');
    }
}