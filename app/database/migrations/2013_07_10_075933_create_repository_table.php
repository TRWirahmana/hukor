<?php

use Illuminate\Database\Migrations\Migration;

class CreateRepositoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('repository', function($t) {
            // auto increment id (primary key)
            $t->increments('id');

            //$t->foreign('user_id')->references('id')->on('user');
            //$t->integer('user_id');
            $t->integer('user_id')
                ->unsigned()->nullable()
                ->references('id')->on('user');

            $t->string('context', 25); // Constant => Lampiran, Foto, dll
            $t->string('file', 100);

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
        Schema::drop('repository');
	}

}