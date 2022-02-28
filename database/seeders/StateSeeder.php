<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = State::STATE_DATASET;
        if (Storage::exists($file)) {
            $states = Storage::get($file);
            $states = json_decode($states, true);

            $data = [];
            $now = now();
            foreach ($states as $state) {
                $data[] = [
                    'id' => $state['id'],
                    'country_id' => $state['country_id'],
                    'name' => $state['name'],
                    'state_code' => $state['state_code'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            DB::table('states')->insert($data);
        }
    }
}
