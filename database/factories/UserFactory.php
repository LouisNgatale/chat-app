<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElements(['male','female'])[0];

        return [
            'firstName' => $this->faker->firstName(".$gender."),
            'secondName' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'userName' => $this->faker->unique()->userName,
            'phoneNumber' => $this->faker->phoneNumber,
            'gender' => $gender,
            'birthDate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
