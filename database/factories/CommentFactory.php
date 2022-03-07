<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'announcement_id' => $this->faker->randomElement(Announcement::pluck('id')),
            'name' => $this->faker->name,
            'email' => $this->faker->freeEmail,
            'content' => $this->faker->realText(500),
            'created_at' => $this->faker->dateTimeThisMonth('now', config('app.timezone'))
        ];
    }
}
