<?php

use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPekerjaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('riwayat_pekerjaan', function($t) {
            $t->increments('id');
            //$t->integer('user_id');
            $t->integer('user_id')
                ->unsigned()->nullable()
                ->references('id')->on('user');

            $t->string('perusahaan', 125)->nullable();
            $t->string('jabatan', 125)->nullable();
            $t->string('periode', 50)->nullable();
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
        Schema::drop('riwayat_pekerjaan');
	}

}