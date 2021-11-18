<?php

namespace App\Http\Controllers\Front;

use App\Models\JobApplication;
use App\Models\Job;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\User;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{

    /**
     * Quickly Apply.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function quickapply(JobApplication $jobapplication, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:job_applications',
            'message' => 'required|max:500',
            'job_id' => 'required',
            'job_type' => 'required|max:150',
            'cv' => 'mimes:doc,docx,pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->route('job')->with('error', 'Application has some errors.')->with('quickapplication', 'With errors.')->withErrors($validator)->withInput();
        }

        $file1 = $request->file('cv');

        if ($request->file('cv')) {
            $name1 = 'cv_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/cvs');
            $file1->move($destinationPath1, $name1);
        }

        // Insert Job Application.
        $jobApplication = new JobApplication;
        $jobApplication->email = $request->input("email");
        $jobApplication->message = $request->input("message");
        $jobApplication->cv = (isset($name1)) ? $name1 : "";
        $jobApplication->job_id = $request->input("job_id");
        $jobApplication->job_type = $request->input("job_type");
        $jobApplication->save();

        return redirect()->route('job')->with('success', 'Application sent successfully.');
    }

    /**
     * Job Application Module.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $jobapplication
     * @return \Illuminate\Http\Response
     */
    public function apply(JobApplication $jobapplication, Request $request, $id)
    {
        $title = "job application form";
        $module = "jobapplication";
        $jobtypes = JobType::active()->get(["id", "unique_id", "jobtype"]);
        $jobcategories = JobCategory::active()->get(["id", "unique_code", "name"]);
        $medicalcenters = User::active()->medicalcenter()->get(["id", "name", "email"]);
        $professions = Profession::active()->get(["id", "unique_code", "profession"]);
        $specialities = Specialty::active()->get(["id", "unique_code", "specialty"]);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        return view('admin.jobapplications.apply', compact("jobtypes", "title", "module", "jobcategories", "medicalcenters", "professions", "specialities", "states", "cities", "suburbs"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeapplication(Request $request, JobApplication $jobapplication)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|unique:job_applications|max:100',
            'contact' => 'required|numeric',
            'work_place' => 'required|max:200',
            'location' => 'required|max:200',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('job')->with('error', 'Application has some errors.')->with('application', 'With errors.')->withErrors($validator)->withInput();
        }

        $job = Job::where(["slug" => $request->input("slug")])->first();

        if (!isset($job)) {
            abort(404);
        }

        // Insert Job Application.
        $jobApplication = new JobApplication;
        $jobApplication->job_id = $job->id;
        $jobApplication->job_type = $job->job_type;
        $jobApplication->first_name = $request->input("first_name");
        $jobApplication->email = $request->input("email");
        $jobApplication->last_name = $request->input("last_name");
        $jobApplication->contact = $request->input("contact");
        $jobApplication->work_place = $request->input("work_place");
        $jobApplication->ahpra = $request->input("ahpra");
        $jobApplication->location = $request->input("location");
        $jobApplication->suburb = $request->input("suburb");
        $jobApplication->state = $request->input("state");
        $jobApplication->postcode = $request->input("postcode");
        $jobApplication->quickapply = "2";
        $jobApplication->save();

        $str = "JOBALTN";
        $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobApplication->id;

        $jobApplication->unique_code = $ubid;
        $jobApplication->save();

        return redirect()->route('jobdetails', [$request->input("slug")])->with('success', 'Application sent successfully.');
    }
}
