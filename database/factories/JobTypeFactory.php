<?php

namespace Database\Factories;

use App\Models\JobType;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jobtype = array('locum', 'permanent');
        return [
            'unique_id' => Str::random(10),
            'jobtype' => $jobtype[rand(0, 1)],
            'user_id' => User::where("role", 1)->pluck('id')->random(),
            'status' => "1",
        ];
    }
}
