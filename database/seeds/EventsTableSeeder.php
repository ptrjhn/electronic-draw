<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
			[
                'slug' => slugifyEvent('November 2020 Raffle Draw'),
                'name' => 'November 2020 Raffle Draw',
                'prize' => 'Powerbank 5000amp',
                'location' => 'PMPC Main Office',
                'event_date' => '2020-11-05',
                'path' => 'events/sample-qr-code.png',
                'is_active' => 1,
				'created_by' => 1,
				'created_at' => now()
            ],
            
            [
                'slug' => slugifyEvent('December 2020 Raffle Draw'),
                'name' => 'December 2020 Raffle Draw',
                'prize' => 'Powerbank 5000amp',
                'location' => 'PMPC Main Office',
                'event_date' => '2020-12-05',
                'path' => 'events/sample-qr-code.png',
                'is_active' => 1,
				'created_by' => 1,
				'created_at' => now()
            ],
            [
                'slug' => slugifyEvent('January 2021 Raffle Draw'),
                'name' => 'January 2021 Raffle Draw',
                'prize' => 'Powerbank 5000amp',
                'location' => 'PMPC Main Office',
                'event_date' => '2021-01-05',
                'path' => 'events/sample-qr-code.png',
                'is_active' => 1,
				'created_by' => 1,
				'created_at' => now()
			],
		]);
    }
}
