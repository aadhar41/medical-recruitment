<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\JobSeekerRegistration;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        // DB::table('users')->truncate();
        DB::table('jobs')->truncate();
        DB::table('job_seeker_registrations')->truncate();
        // DB::table('job_types')->truncate();
        // DB::table('job_categories')->truncate();
        // DB::table('professions')->truncate();
        // DB::table('specialties')->truncate();
        DB::statement("SET foreign_key_checks=1");
        //


        // \App\Models\User::factory(10)->create();
        // \App\Models\JobType::factory(2)->create();
        // \App\Models\JobCategory::factory(10)->create();
        // \App\Models\Profession::factory(9)->create();
        // \App\Models\Specialty::factory(11)->create();
        \App\Models\JobSeekerRegistration::factory(10)->create();
        \App\Models\Job::factory(10)->create();
    }
}
