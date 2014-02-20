<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('categories')->truncate();

		$categories = array(
			array(
				"nama_kategori" => "Edukasi",
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			),
			array(
				"nama_kategori" => "Olahraga",
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			),
			array(
				"nama_kategori" => "Umum",
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")	
			)
		);

		// Uncomment the below to run the seeder
		DB::table('categories')->insert($categories);
	}

}
