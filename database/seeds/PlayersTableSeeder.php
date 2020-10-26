<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('players')->insert([
                [
                    'event_id' => 1,
                    'full_name' => 'Player ' . $i,
                    'email' => 'player.' . $i . '@gmail.com',
                    'company' => 'Company 1',
                    'created_by' => 1,
                    'created_at' => now()
                ],
            ]);
        }
    }
}
