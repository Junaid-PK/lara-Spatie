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
		\App\Models\User::factory(5)->create();
		\App\Models\Team::factory(5)->create();
		\App\Models\TeamMember::factory(5)->create();
	}
}
