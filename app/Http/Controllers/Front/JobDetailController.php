<?php

namespace App\Http\Controllers\Front;

use App\Models\Settings;
use App\Models\Job;
use App\Models\JobDetail;
use App\Models\JobType;
use App\Models\SocialLink;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JobDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $settings = Settings::orderBy("created_at", "desc")->first();
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);

        return view('front.jobdetails', compact("sociallinks", "professions", "specialties", "states", "cities", "suburbs", "jobtypes", "settings"));
    }



    /**
     * Display the specified resource.
     *
     * @param $slug
     * @param  \App\Models\JobDetail  $jobDetail
     * @return \Illuminate\Http\Response
     */
    public function show(JobDetail $jobDetail, Request $request, $slug)
    {

        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        $settings = Settings::orderBy("created_at", "desc")->first();
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);

        $count = Job::active()->where(["slug" => $slug])->count();
        if ($count > 0) {
            $job = Job::active()->where(["slug" => $slug])
                ->with("createdby", "associatedJobtype", "jobcategory", "medicalcenter", "associatedProfession", "associatedSpeciality", "associatedState", "associatedCity", "associatedSuburb")
                ->first();

            return view('front.jobdetails', compact("sociallinks", "professions", "specialties", "states", "cities", "suburbs", "job", "jobtypes", "settings"));
        }
        abort("404", "Record not found.");
    }
}
