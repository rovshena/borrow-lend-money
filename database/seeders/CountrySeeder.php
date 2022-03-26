<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    use Sluggable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_dataset = Country::COUNTRY_DATASET;
        if (Storage::exists($countries_dataset)) {
            $countries = Storage::get($countries_dataset);
            $countries = json_decode($countries, true);
            $country_model = new Country();
            foreach ($countries as $country) {
                $slug = $this->generateSlug($this->slug($country['name']), $country_model);
                Country::create([
                    'name' => $country['name'],
                    'slug' => $slug,
                    'iso3' => $country['iso3'],
                    'iso2' => $country['iso2'],
                    'status' => $country['iso2'] == 'RU' ? 1 : 0
                ]);
            }

            $cities_dataset = City::CITY_DATASET;
            if (Storage::exists($cities_dataset)) {
                $cities = Storage::get($cities_dataset);
                $cities = json_decode($cities, true);
                $country = Country::where('iso2', 'RU')->first();
                $city_model = new City();
                if ($country) {
                    foreach ($cities as $city) {
                        $slug = $this->generateSlug($this->slug($city['city']), $city_model);
                        $country->cities()->create([
                            'oblast' => isset($city['oblast']) ? $city['oblast'] : '',
                            'region' => isset($city['region']) ? $city['region'] : '',
                            'name' => $city['city'],
                            'slug' => $slug,
                            'lat' => isset($city['lat']) ? $city['lat'] : '',
                            'lon' => isset($city['lon']) ? $city['lon'] : '',
                            'timezone_sign' => isset($city['timezone_sign']) ? $city['timezone_sign'] : '',
                            'timezone_value' => isset($city['timezone_value']) ? $city['timezone_value'] : '',
                            'population' => isset($city['population']) ? $city['population'] : ''
                        ]);
                    }
                }
            }
        }
    }

    public function generateSlug($value, Model $model, $next = 0)
    {
        $slug = $value;
        while ($model->newQuery()->where('slug', $slug)->first()) {
            $slug = $value . '-' . ++$next;
        }
        return $slug;
    }
}
