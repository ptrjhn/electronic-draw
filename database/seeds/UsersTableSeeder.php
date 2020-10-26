<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'email' => 'system.admin@example.com',
				'password' => bcrypt('secret'),
				'is_enabled' => 1,
				'created_by' => 1,
        'user_type' => 'admin',
				'created_at' => now()
			],

		]);
	}
}
