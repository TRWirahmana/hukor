<?php

use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admin', function($t) {
                    // auto increment id (primary key)
                    $t->increments('id');

                    $t->integer('region_id')
                            ->unsigned()->nullable()
                            ->references('id')->on('region');

                    $t->string('nama_lengkap', 50)->nullable();
                    $t->string('email', 50)->nullable();
                    $t->string('username', 50)->nullable();
                    $t->string('password', 100)->nullable();
                    // created_at, updated_at DATETIME
                    $t->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('admin');
    }

}