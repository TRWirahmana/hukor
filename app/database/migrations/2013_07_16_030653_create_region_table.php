<?php

use Illuminate\Database\Migrations\Migration;

class CreateRegionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('region', function($t) {
                    // auto increment id (primary key)
                    $t->increments('id');

                    $t->string('kode', 15)->nullable();
                    $t->string('nama', 50)->nullable();
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
        Schema::drop('region');
    }

}