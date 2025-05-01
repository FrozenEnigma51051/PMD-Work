<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get region IDs
        $punjabId = Region::where('name', 'Punjab')->first()->id;
        $kpkId = Region::where('name', 'KPK')->first()->id;

        // Define stations
        $stations = [
            // Punjab stations
            [
                'name' => 'Jhelum',
                'region_id' => $punjabId
            ],
            [
                'name' => 'Faisalabad',
                'region_id' => $punjabId
            ],
            // KPK stations
            [
                'name' => 'Balakot',
                'region_id' => $kpkId
            ],
            [
                'name' => 'Cherat',
                'region_id' => $kpkId
            ],
        ];

        foreach ($stations as $station) {
            Station::create($station);
        }

        $this->command->info('Stations seeded successfully.');
    }
}