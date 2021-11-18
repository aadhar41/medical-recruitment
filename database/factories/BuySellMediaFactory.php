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

class BuySellMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuySellMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'user_id' => User::pluck('id')->random(),
            'buysell_id' => BuySell::pluck('id')->random(),
            'type' => "1",
            'file' => "https://lorempixel.com/640/480/transport/",
            // 'file' => "https://source.unsplash.com/1600x900/?car",
            // 'file' => $this->faker->imageUrl($width = 640, $height = 480),
            'order' =>  rand(1, 30),
            'status' =>  "1",

        ];
    }
}
