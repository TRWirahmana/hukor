<?php

use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPendidikanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('riwayat_pendidikan', function($t) {
            $t->increments('id');

            //$t->integer('user_id');
            $t->integer('user_id')
                ->unsigned()->nullable()
                ->references('id')->on('user');

            $t->string('sd', 50)->nullable();
            $t->string('sd_tahun', 4)->nullable();

            $t->string('smp', 50)->nullable();
            $t->string('smp_tahun', 4)->nullable();

            $t->string('sma', 50)->nullable();
            $t->string('sma_tahun', 4)->nullable();

            $t->string('prasarjana_universitas', 50)->nullable();
            $t->string('prasarjana_tahun', 4)->nullable();
            $t->string('prasarjana_jurusan', 4)->nullable();

            $t->string('pascasarjana_universitas', 50)->nullable();
            $t->string('pascasarjana_tahun', 4)->nullable();
            $t->string('pascasarjana_jurusan', 4)->nullable();

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
        Schema::drop('riwayat_pendidikan');
	}

}