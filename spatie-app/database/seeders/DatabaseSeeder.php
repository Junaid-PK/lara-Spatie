<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// run permission seeder
		$this->call(PermissionSeeder::class);
		$this->call(UserSeeder::class);


		// \App\Models\Task::factory(5)->create();
	}
}
