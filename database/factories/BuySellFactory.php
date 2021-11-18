<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuySellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuySell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'user_id' => User::whereIn("role", array(1, 3))->pluck('id')->random(),
            'type' => rand(1, 2),
            'property_type' => rand(1, 2),
            'promotional_flag' => rand(1, 3),
            'state_id' => State::pluck('id')->random(),
            'city_id' => City::pluck('id')->random(),
            'suburb_id' => Suburb::pluck('id')->random(),
            'price' => rand(100000, 900000),
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence(), '-'),
            'description' => $this->faker->realText($maxNbChars = 600, $indexSize = 2),
            'number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'rating' => rand(1, 5),
            'order' => rand(1, 10),
            'status' => "1",
        ];
    }
}
