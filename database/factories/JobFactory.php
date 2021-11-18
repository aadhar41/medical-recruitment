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
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

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
            'job_type' => JobType::pluck('id')->random(),
            'job_category' => JobCategory::pluck('id')->random(),
            'medical_center' => User::where("role", 3)->pluck('id')->random(),
            'profession' => Profession::pluck('id')->random(),
            'speciality' => Specialty::pluck('id')->random(),
            'state' => State::pluck('id')->random(),
            'city' => City::pluck('id')->random(),
            'suburb' => Suburb::pluck('id')->random(),
            'address' => $this->faker->address(),
            'rate' => rand(100, 200) . " Hours",
            'work_days' => rand(5, 7) . " Days Week",
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence(), '-'),
            'from_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'to_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'description' => $this->faker->realText($maxNbChars = 600, $indexSize = 2),
            'practice_offer' => $this->faker->realText($maxNbChars = 1200, $indexSize = 2),
            'essential_criteria' => $this->faker->realText($maxNbChars = 1200, $indexSize = 2),
            'status' => "1",
        ];
    }
}
