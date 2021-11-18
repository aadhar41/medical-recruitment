<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreJobFormRequest;
use App\Http\Requests\UpdateJobFormRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return "Returns a view contain the list of Jobs created at the backend."
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "job lists";
        $module = "job";
        $jobtypes = JobType::active()->get(["id", "unique_id", "jobtype"]);
        $jobcategories = JobCategory::active()->get(["id", "unique_code", "name", "status"]);
        $medicalcenters = User::active()->medicalcenter()->get();
        $professions = Profession::active()->get(["id", "unique_code", "profession"]);
        $specialities = Specialty::active()->get(["id", "unique_code", "specialty"]);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $data = Job::active()->latest()->get();
        return view('admin.job.index', compact('data', 'title', 'module', "jobtypes", "jobcategories", "medicalcenters", "professions", "specialities", "states"));
    }

    /**
     * Process datatables ajax request.
     * @param "status, jobtype, jobcategory, medicalcenter, profession, speciality and state for ajax filter for datatables"
     * @param  \Illuminate\Http\Request  $request
     * @return "Returns Json response for listing Jobs created at frontend in the backpanel."
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Job::query())->make(true);

        $jobdata = Job::select('jobs.id', 'jobs.job_type', 'jobs.job_category', 'jobs.medical_center', 'jobs.profession', 'jobs.speciality', 'jobs.state', 'jobs.status', 'jobs.created_at', 'jobs.updated_at')->with("createdby", "associatedJobtype", "jobcategory", "medicalcenter", "associatedProfession", "associatedSpeciality", "associatedState");
        return Datatables::of($jobdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.status', 'like', $request->get('status'));
                    });
                }

                if ($request->has('jobtype') && $request->get('jobtype') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.job_type', 'like', $request->get('jobtype'));
                    });
                }

                if ($request->has('jobcategory') && $request->get('jobcategory') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.job_category', '=', $request->get('jobcategory'));
                    });
                }

                if ($request->has('medicalcenter') && $request->get('medicalcenter') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.medical_center', '=', $request->get('medicalcenter'));
                    });
                }
                if ($request->has('profession') && $request->get('profession') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.profession', '=', $request->get('profession'));
                    });
                }
                if ($request->has('speciality') && $request->get('speciality') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.speciality', '=', $request->get('speciality'));
                    });
                }
                if ($request->has('state') && $request->get('state') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('jobs.state', '=', $request->get('state'));
                    });
                }
            })
            ->addColumn('jobtype', function ($jobdata) {
                return $jobtype = (isset($jobdata->associatedJobtype->jobtype)) ? ucwords($jobdata->associatedJobtype->jobtype) : "";
            })
            ->addColumn('jobcategory', function ($jobdata) {
                return $jobcategory = (isset($jobdata->jobcategory->name)) ? ucwords($jobdata->jobcategory->name) : "";
            })
            ->addColumn('medicalcenter', function ($jobdata) {
                return $medicalcenter = (isset($jobdata->medicalcenter->name)) ? ucwords($jobdata->medicalcenter->name) : "";
            })
            ->addColumn('profession', function ($jobdata) {
                return $profession = (isset($jobdata->associatedProfession->profession)) ? ucwords($jobdata->associatedProfession->profession) : "";
            })
            ->addColumn('speciality', function ($jobdata) {
                return $speciality = (isset($jobdata->associatedSpeciality->specialty)) ? ucwords($jobdata->associatedSpeciality->specialty) : "";
            })
            ->addColumn('state', function ($jobdata) {
                return $state = (isset($jobdata->associatedState->name)) ? ucwords($jobdata->associatedState->name) : "";
            })
            ->addColumn('created_at', function ($jobdata) {
                return $created_at = (isset($jobdata->created_at)) ? date("F j, Y, g:i a", strtotime($jobdata->created_at)) : "";
            })
            ->addColumn('status', function ($jobdata) {
                return $status = (isset($jobdata->status) && ($jobdata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($jobdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('job.delete', $jobdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the job?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.job.enable', $jobdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.job.disable', $jobdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $detailslink = '
                    <div class="btn-group">
                        <a href="' . route('admin.job.show', $jobdata->id) . '" class="btn btn-sm btn-primary" title="View Details" ><i class="fas fa-eye"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.job.edit', $jobdata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                if (Gate::allows('isAdmin')) {
                    $final = ($jobdata->status == 1) ? $editlink . $link . $inactivelink . $detailslink : $editlink . $link . $activelink . $detailslink;
                    // $final = ($jobdata->status == 1) ? $link . $inactivelink . $detailslink : $link . $activelink . $detailslink;
                } else {
                    $final = '
                        <span class="bg-warning p-1">
                            You are not an admin.
                        </span>
                    ';
                }

                return $final;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return "Return a form for job creation."
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "create a job";
        $module = "job";
        $jobtypes = JobType::active()->get(["id", "unique_id", "jobtype"]);
        $jobcategories = JobCategory::active()->get(["id", "unique_code", "name", "status"]);
        $medicalcenters = User::active()->medicalcenter()->get();
        $professions = Profession::active()->get(["id", "unique_code", "profession"]);
        $specialities = Specialty::active()->get(["id", "unique_code", "specialty"]);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        // $cities = City::active()->get();
        // $suburbs = Suburb::active()->get();
        return view('admin.job.add', compact('title', 'module', "jobtypes", "jobcategories", "medicalcenters", "professions", "specialities", "states"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobFormRequest $request)
    {
        $request->merge(["user_id" => Auth::user()->id]);
        $validated = $request->validated();
        $input = $request->all();
        $user = Job::create($input);
        return redirect()->route('admin.job.list')->with('success', 'Job created added successfully.');
    }

    /**
     * Display the specified resource.
     * @param $id
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Job $job)
    {
        $title = "Job Details";
        $module = "job";
        $job = Job::with("createdby", "associatedJobtype", "jobcategory", "medicalcenter", "associatedProfession", "associatedSpeciality", "associatedState", "associatedCity", "associatedSuburb")->findOrFail($job->id);
        return view('admin.job.show', compact('title', 'module', 'job'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $listings = Job::with("createdby:id,name,email", "associatedJobtype:id,jobtype", "jobcategory:id,name", "medicalcenter:id,name,email", "associatedProfession:id,profession", "associatedSpeciality:id,specialty", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")->findOrFail($job->id);
        $title = "job edit";
        $module = "job";
        $jobtypes = JobType::active()->get(["id", "unique_id", "jobtype"]);
        $jobcategories = JobCategory::active()->get(["id", "unique_code", "name", "status"]);
        $medicalcenters = User::active()->medicalcenter()->get();
        $professions = Profession::active()->get(["id", "unique_code", "profession"]);
        $specialities = Specialty::active()->get(["id", "unique_code", "specialty"]);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $city = City::active()->where(["id" => $listings->city])->first(["id", "name", "postcode", "state_code"]);
        $suburb = Suburb::active()->where(["id" => $listings->suburb])->first(["id", "suburb", "postcode"]);
        return view('admin.job.edit', compact('listings', 'title', 'module', 'jobtypes', 'jobcategories', 'medicalcenters', 'professions', 'specialities', 'states', 'city', 'suburb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobFormRequest $request, Job $job)
    {
        $request->merge(["user_id" => Auth::user()->id]);
        $validated = $request->validated();
        $input = $request->all();
        $user = $job->update($input);

        return redirect()->route('admin.job.list')->with('success', 'Details Updated.');
    }


    /**
     * Enable the specified job in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Job $job, $id)
    {
        $job = Job::findOrFail($id);
        $job->status = "1";
        $job->save();
        return redirect()->route('admin.job.list')->with('success', 'Job enabled.');
    }

    /**
     * Disable the specified job in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Job $job, $id)
    {
        $job = Job::findOrFail($id);
        $job->status = "0";
        $job->save();
        return redirect()->route('admin.job.list')->with('warning', 'Job disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     * @param $id
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job, $id)
    {
        // $job = Job::where('id', $id)->withTrashed()->first();

        $job = Job::findOrFail($id);
        $job->delete();

        // Shows the remaining list of jobs.
        return redirect()->route('admin.job.list')->with('error', 'Job deleted successfully.');
    }
}
