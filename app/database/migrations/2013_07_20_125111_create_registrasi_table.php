<?php

use Illuminate\Database\Migrations\Migration;

class CreateRegistrasiTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('registrasi', function($t) {
                    // auto increment id (primary key)
                    $t->increments('id');
                    $t->string('no_ktp', 50)->nullable();
                    $t->string('email', 50)->nullable();
                    $t->string('username', 50)->nullable();
                    $t->string('password', 100)->nullable();
                    $t->integer('status')->nullable();
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
        Schema::drop('registrasi');
    }

}