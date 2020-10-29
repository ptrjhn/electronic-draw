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
				'id' => '1',
				'username' => 'providers.itadmin',
				'email' => 'providers.itadmin@coop.com',
				'first_name' => 'IT Providers',
				'last_name' => 'Admin',
				'password' => bcrypt('@dmin1234'),
				'is_enabled' => 1,
				'created_by' => 1,
        'user_type' => 'admin',
				'created_at' => now()
			],
		]);
	}
}
