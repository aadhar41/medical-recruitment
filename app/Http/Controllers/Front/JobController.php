<?php

namespace App\Http\Controllers\Front;

use App\Models\Job;
use App\Models\JobType;
use App\Models\SocialLink;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use QueryHelper;
use Illuminate\Pipeline\Pipeline;

class JobController extends Controller
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
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        $jobs = Job::active()->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")->get();
        // QueryHelper::logquery($jobs);
        return view('front.jobs', compact("jobtypes", "sociallinks", "professions", "specialties", "states", "cities", "suburbs", "jobs", "settings"));
    }

    /**
     * Search a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Job $job)
    {
        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);

        // Pipeline implementation for searching.
        $jobs = Job::searchResult();

        $settings = Settings::orderBy("created_at", "desc")->first();
        return view('front.jobsearch', compact("sociallinks", "professions", "specialties", "states", "cities", "suburbs", "jobs", "jobtypes", "settings"));
    }


    /**
     * Search a resource in storage (Previous approch).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function search_backup(Request $request, Job $job)
    {
        $jobtype = (int) $request->input("jobtype");
        $state = (int) $request->input("states");
        $city = (int) $request->input("cities");
        $suburb = (int) $request->input("suburb");
        $profession = (int) $request->input("profession");
        $specialty = (int) $request->input("specialty");

        if (!empty($jobtype)) {
            $request->session()->put('jobtype', $jobtype);
        }

        if (!empty($state)) {
            $request->session()->put('states', $state);
        }

        if (!empty($city)) {
            $request->session()->put('cities', $city);
        }

        if (!empty($suburb)) {
            $request->session()->put('suburb', $suburb);
        }

        if (!empty($profession)) {
            $request->session()->put('profession', $profession);
        }

        if (!empty($specialty)) {
            $request->session()->put('specialty', $specialty);
        }

        // $data = $request->session()->all();
        // // echo "<pre>";
        // // print_r($data);
        // // die;

        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);

        $sjobtype = $request->session()->get('jobtype');
        $sstate = $request->session()->get('states');
        $scity = $request->session()->get('cities');
        $ssuburb = $request->session()->get('suburb');
        $sprofession = $request->session()->get('profession');
        $sspecialty = $request->session()->get('specialty');

        if (!empty($sjobtype) && !empty($sstate) && !empty($scity) && !empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate,
                    "city" => $scity,
                    "suburb" => $ssuburb
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && !empty($sstate) && !empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate,
                    "city" => $scity
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && !empty($scity) && !empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate,
                    "city" => $scity,
                    "suburb" => $ssuburb
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && !empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate,
                    "city" => $scity,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && empty($scity) && !empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate,
                    "suburb" => $ssuburb
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && empty($sstate) && !empty($scity) && !empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "city" => $scity,
                    "suburb" => $ssuburb
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && empty($sstate) && !empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "city" => $scity,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && empty($sstate) && empty($scity) && !empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "suburb" => $ssuburb
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && !empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate,
                    "profession" => $sprofession,
                    "speciality" => $sspecialty,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "state" => $sstate,
                    "profession" => $sprofession,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate,
                    "profession" => $sprofession,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "profession" => $sprofession,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && !empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "profession" => $sprofession,
                    "speciality" => $sspecialty,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (!empty($sjobtype) && empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && !empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "job_type" => $sjobtype,
                    "speciality" => $sspecialty,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && !empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && !empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "state" => $sstate,
                    "speciality" => $sspecialty,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && empty($sstate) && empty($scity) && empty($ssuburb) && !empty($sprofession) && empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "profession" => $sprofession,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } elseif (empty($sjobtype) && empty($sstate) && empty($scity) && empty($ssuburb) && empty($sprofession) && !empty($sspecialty)) {
            $jobs = Job::active()->where(
                [
                    "speciality" => $sspecialty,
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        } else {
            $jobs = Job::active()->where(
                [
                    "job_type" => $request->session()->get('jobtype')
                ]
            )
                ->with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")
                ->get();
        }

        $settings = Settings::orderBy("created_at", "desc")->first();
        return view('front.jobsearch', compact("sociallinks", "professions", "specialties", "states", "cities", "suburbs", "jobs", "jobtypes", "settings"));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function filterjobs(Request $request, Job $job)
    {

        if ($request->ajax()) {
            if ($_POST['name'] == "jobtype") {
                $jobtype = isset($_POST["name"]) ? (int) $_POST["name"] : "";
                $profession = "";
                $specialty = "";
                $state = "";
            } else if ($_POST['name'] == "profession") {
                $profession = isset($_POST["name"]) ? (int) $_POST["name"] : "";
                $specialty = "";
                $state = "";
                $jobtype = "";
            } else if ($_POST['name'] == "specialty") {
                $specialty = isset($_POST["name"]) ? (int) $_POST["name"] : "";
                $state = "";
                $jobtype = "";
                $profession = "";
            } else if ($_POST['name'] == "state") {
                $state = isset($_POST["name"]) ? (int) $_POST["name"] : "";
                $jobtype = "";
                $profession = "";
                $specialty = "";
            }


            $jobs = Job::where(
                [
                    "status" => "1",
                    "job_type" => $jobtype,
                    "state" => $state,
                    "speciality" => $specialty,
                    "profession" => $profession
                ]
            )
                ->with("createdby", "associatedJobtype", "jobcategory", "medicalcenter", "associatedProfession", "associatedSpeciality", "associatedState", "associatedCity", "associatedSuburb")
                ->get();

            return view('ajax.joblisting', compact("jobs"));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function clearsearch(Request $request, Job $job)
    {
        $request->session()->forget('jobtype');
        $request->session()->forget('states');
        $request->session()->forget('cities');
        $request->session()->forget('suburb');
        $request->session()->forget('profession');
        $request->session()->forget('specialty');
        $request->session()->forget('postcode');
        $request->session()->forget('min');
        $request->session()->forget('max');
        $request->session()->forget('city');
        return redirect()->route('job');
    }
}
