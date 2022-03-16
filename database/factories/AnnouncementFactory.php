<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => $this->faker->randomElement(Country::pluck('id')),
            'state_id' => function(array $attributes) {
                return State::where('country_id', $attributes['country_id'])->inRandomOrder()->first()->id;
            },
            'name' => $this->faker->name,
            'email' => $this->faker->freeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'company' => $this->faker->company,
            'title' => $this->faker->realText(60),
            'content' => $this->faker->realText(3000),
            'is_vip' => $this->faker->boolean(5),
            'type' => $this->faker->numberBetween(Announcement::TYPE_BORROW, Announcement::TYPE_LEND),
            'created_at' => $this->faker->dateTimeThisMonth('now', config('app.timezone'))
        ];
    }

    public function borrow()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Announcement::TYPE_BORROW,
            ];
        });
    }

    public function lend()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => Announcement::TYPE_LEND,
            ];
        });
    }
}
