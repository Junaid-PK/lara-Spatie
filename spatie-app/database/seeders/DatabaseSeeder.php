<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
    }
=======
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();
		// run permission seeder
		$this->call(PermissionSeeder::class);
		$this->call(UserSeeder::class);
	}
>>>>>>> 462df4aa93575d54a2eaca4fe565dc2b20053343
}
