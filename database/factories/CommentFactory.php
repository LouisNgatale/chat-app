<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->realText(),
            'post_id' => $this->faker->numberBetween(1,3),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'isMain' => $this->faker->numberBetween(0,1),
            'hasParent' => $this->faker->numberBetween(0,1),
            'parentId' => $this->faker->numberBetween(1,3),
            'authorId' => $this->faker->numberBetween(1,20)
        ];
    }
}
