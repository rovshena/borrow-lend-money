<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use MenaraSolutions\Geographer\Country as EarthCountry;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cis_countries = Country::CIS_COUNTRIES;
        foreach ($cis_countries as $code) {
            $earth_country = EarthCountry::build($code)->setLocale('ru');
            $country = Country::create([
                'name' => $earth_country->name,
                'iso3' => $earth_country->code3,
                'iso2' => $earth_country->code,
            ]);

            $earth_states = $earth_country->getStates()->setLocale('ru');
            foreach ($earth_states as $state) {
                $earth_cities = $state->getCities()->setLocale('ru');
                foreach ($earth_cities as $city) {
                    $country->cities()->create(['name' => $city->name]);
                }
            }
        }
    }
}
