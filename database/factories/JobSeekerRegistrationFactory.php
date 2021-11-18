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
use App\Models\JobSeekerRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobSeekerRegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobSeekerRegistration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_code' => Str::random(10),
            'user_id' => User::where("role", 2)->pluck('id')->random(),
            'gender' => rand(1, 2),
            'profession' => Profession::pluck('id')->random(),
            'specialty' => Specialty::pluck('id')->random(),
            'mobile' => $this->faker->e164PhoneNumber(),
            'postcode' => $this->faker->postcode(),
            'location' => State::pluck('id')->random(),
            'city' => City::pluck('id')->random(),
            'suburb' => Suburb::pluck('id')->random(),
            'token' => Str::random(50),
            'status' => "1",
        ];
    }
}
