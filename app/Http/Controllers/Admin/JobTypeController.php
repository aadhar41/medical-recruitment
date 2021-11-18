<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "jobtype ( services ) lists";
        $module = "jobtype";
        $data = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        return view('admin.jobtype.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(JobType::query())->make(true);

        $jobtypedata = JobType::select('job_types.id', 'job_types.jobtype', 'job_types.status', 'job_types.created_at', 'job_types.updated_at');
        return Datatables::of($jobtypedata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('job_types.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('jobtype') && $request->get('jobtype') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('job_types.jobtype', 'like', "%{$request->get('jobtype')}%");
                    });
                }
            })
            ->addColumn('jobtype', function ($jobtypedata) {
                return $jobtype = (isset($jobtypedata->jobtype)) ? ucwords($jobtypedata->jobtype) : "";
            })
            ->addColumn('created_at', function ($jobtypedata) {
                return $created_at = (isset($jobtypedata->created_at)) ? date("F j, Y, g:i a", strtotime($jobtypedata->created_at)) : "";
            })
            ->addColumn('status', function ($jobtypedata) {
                return $status = (isset($jobtypedata->status) && ($jobtypedata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($jobtypedata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('jobtype.delete', $jobtypedata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to trash this entry?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.jobtype.edit', $jobtypedata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.jobtype.enable', $jobtypedata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.jobtype.disable', $jobtypedata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                if (Gate::allows('isAdmin')) {
                    $final = ($jobtypedata->status == 1) ? $editlink . $link . $inactivelink : $editlink . $link . $activelink;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "add job type / service";
        $module = "jobtype";
        return view('admin.jobtype.add', compact('title', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'jobtype' => 'required|max:30|unique:job_types',
            ]
        );

        $jobtype = new JobType;
        $jobtype->jobtype = $this->sanitizeString($request->input('jobtype'));
        $jobtype->user_id = Auth::user()->id;
        $jobtype->save();

        return redirect()->route('admin.jobtype.list')->with('success', 'Job Type added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param $id
     * @param  \App\Models\JobType  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function edit(JobType $jobtype)
    {
        $listings = JobType::findOrFail($jobtype->id);
        $title = "jobtype";
        $module = "Jobtype";
        return view('admin.jobtype.edit', compact('listings', 'title', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobType  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobType $jobtype)
    {
        $this->validate(
            $request,
            [
                'jobtype' => 'required|max:30|unique:job_types,jobtype,' . $jobtype->jobtype,
            ]
        );

        $jobCategory = JobType::findOrFail($jobtype->id);
        $jobCategory->jobtype = $request->input("jobtype");
        $jobCategory->save();

        return redirect()->route('admin.jobtype.list')->with('success', 'Details Updated.');
    }



    /**
     * Enable the specified jobtype in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobType  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, JobType $jobtype, $id)
    {
        $jobtype = JobType::findOrFail($id);
        $jobtype->status = "1";
        $jobtype->save();
        return redirect()->route('admin.jobtype.list')->with('success', 'JobType enabled.');
    }

    /**
     * Disable the specified jobtype in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobType  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, JobType $jobtype, $id)
    {
        $jobtype = JobType::findOrFail($id);
        $jobtype->status = "0";
        $jobtype->save();
        return redirect()->route('admin.jobtype.list')->with('warning', 'JobYype disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     * 
     * @param $id
     * @param  \App\Models\JobType  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobType $jobtype, $id)
    {
        // $jobtype = JobType::where('id', $id)->withTrashed()->first();

        $jobtype = JobType::findOrFail($id);
        $jobtype->delete();

        // Shows the remaining list of jobtypes.
        return redirect()->route('admin.jobtype.list')->with('error', 'JobType deleted successfully.');
    }
}
