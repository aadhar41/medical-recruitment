<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class JobCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "jobcategory lists";
        $module = "jobcategory";
        $data = JobCategory::active()->latest()->get();
        return view('admin.jobcategory.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(JobCategory::query())->make(true);

        $jobcategorydata = JobCategory::select('job_categories.id', 'job_categories.name', 'job_categories.status', 'job_categories.created_at', 'job_categories.updated_at');
        return Datatables::of($jobcategorydata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('job_categories.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('job_categories.name', 'like', "%{$request->get('name')}%");
                    });
                }
            })
            ->addColumn('name', function ($jobcategorydata) {
                return $name = (isset($jobcategorydata->name)) ? ucwords($jobcategorydata->name) : "";
            })
            ->addColumn('created_at', function ($jobcategorydata) {
                return $created_at = (isset($jobcategorydata->created_at)) ? date("F j, Y, g:i a", strtotime($jobcategorydata->created_at)) : "";
            })
            ->addColumn('status', function ($jobcategorydata) {
                return $status = (isset($jobcategorydata->status) && ($jobcategorydata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($jobcategorydata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('jobcategory.trash', $jobcategorydata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to trash the jobcategory?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.jobcategory.enable', $jobcategorydata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';

                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.jobcategory.disable', $jobcategorydata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.jobcategory.edit', $jobcategorydata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                if (Gate::allows('isAdmin')) {
                    $final = ($jobcategorydata->status == 1) ? $editlink . $link . $inactivelink : $editlink . $link . $activelink;
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
        $title = "add job category";
        $module = "jobcategory";
        return view('admin.jobcategory.add', compact('title', 'module'));
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
                'name' => 'required|max:30|unique:job_categories',
            ]
        );

        $jobcategory = new JobCategory;
        $jobcategory->name = ($request->input('name'));
        $jobcategory->user_id = Auth::user()->id;
        $jobcategory->save();

        return redirect()->route('admin.jobcategory.list')->with('success', 'Job Category added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param  \App\Models\JobCategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobcategory)
    {
        $listings = JobCategory::findOrFail($jobcategory->id);
        $title = "jobcategory";
        $module = "jobcategory";
        return view('admin.jobcategory.edit', compact('listings', 'title', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobcategory)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:40|unique:job_categories,name,' . $jobcategory->name,
            ]
        );

        // Update data
        $jobCategory = JobCategory::findOrFail($jobcategory->id);
        $jobCategory->name = $request->input("name");
        $jobCategory->save();

        return redirect()->route('admin.jobcategory.list')->with('success', 'Details Updated.');
    }

    /**
     * Enable the specified jobcategory in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCategory  $jobtype
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, JobCategory $jobtype, $id)
    {
        $jobcategory = JobCategory::findOrFail($id);
        $jobcategory->status = "1";
        $jobcategory->save();
        return redirect()->route('admin.jobcategory.list')->with('success', 'JobCategory enabled.');
    }

    /**
     * Disable the specified jobcategory in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, JobCategory $jobcategory, $id)
    {
        $jobcategory = JobCategory::findOrFail($id);
        $jobcategory->status = "0";
        $jobcategory->save();
        return redirect()->route('admin.jobcategory.list')->with('warning', 'JobCategory disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     *
     * @param $id
     * @param  \App\Models\JobCategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobcategory, $id)
    {
        // $jobtype = JobType::where('id', $id)->withTrashed()->first();

        $jobcategory = JobCategory::findOrFail($id);
        $jobcategory->delete();

        // Shows the remaining list of jobcategory.
        return redirect()->route('admin.jobcategory.list')->with('error', 'JobCategory deleted successfully.');
    }
}
