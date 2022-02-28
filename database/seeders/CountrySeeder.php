<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = Country::COUNTRY_DATASET;
        if (Storage::exists($file)) {
            $countries = Storage::get($file);
            $countries = json_decode($countries, true);

            $data = [];
            $now = now();
            foreach ($countries as $country) {
                $data[] = [
                    'id' => $country['id'],
                    'name' => $country['name'],
                    'iso3' => $country['iso3'],
                    'iso2' => $country['iso2'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('countries')->insert($data);
        }
    }
}
