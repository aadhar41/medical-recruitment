<?php

namespace Database\Factories;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Specialty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'specialty' => $this->faker->company(),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'user_id' => User::where("role", 1)->pluck('id')->random(),
            'status' => "1",
        ];
    }
}
