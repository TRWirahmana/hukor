<?php

use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPrestasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('riwayat_prestasi', function($t) {
            $t->increments('id');
            //$t->integer('user_id');
            $t->integer('user_id')
                ->unsigned()->nullable()
                ->references('id')->on('user');

            $t->string('nama_prestasi', 125)->nullable();
            $t->string('periode', 4)->nullable();
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
        Schema::drop('riwayat_prestasi');
	}

}