<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\JobSeekerRegistration;

class JobSeekerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('job_seeker_registrations')->truncate();
        DB::statement("SET foreign_key_checks=1");

        \App\Models\JobSeekerRegistration::factory(10)->create();
    }
}
