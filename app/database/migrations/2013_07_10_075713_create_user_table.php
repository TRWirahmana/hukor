<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function($t) {
                    // auto increment id (primary key)
                    $t->increments('id');

                    $t->integer('role_id')
                            ->unsigned()->nullable()
                            ->references('id')->on('role');

                    $t->string('username', 50)->nullable();
                    $t->string('password', 100)->nullable();
                    $t->integer('status'); // 0 : pending, 1 : Aktif, 2 : Block

                    $t->string('nama_lengkap', 50)->nullable();
                    $t->string('jenis_kelamin', 1)->nullable();
                    $t->string('tempat_lahir', 75)->nullable();
                    $t->date('tanggal_lahir')->nullable();
                    $t->text('alamat')->nullable();

                    //provinsi_id
                    // $t->string('region_id', 2)->nullable();
                    $t->integer('provinsi_id')
                            ->unsigned()->nullable()
                            ->references('id')->on('provinsi');
                    
                    $t->integer('status_nikah'); // 1 : Nikah, 2 : Belum, 3 : Janda / Duda
                    $t->string('telepon', 15)->nullable();
                    $t->string('hp', 15)->nullable();
                    $t->string('email', 50)->nullable();
                    $t->string('no_ktp', 25)->nullable();
                    $t->string('no_sim', 25)->nullable();
                    $t->text('keterampilan_bakat')->nullable();
                    $t->text('hobi')->nullable();
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
        Schema::drop('user');
    }

}