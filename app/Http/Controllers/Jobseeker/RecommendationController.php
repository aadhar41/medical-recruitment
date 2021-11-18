<?php

namespace App\Http\Controllers\Jobseeker;

use App\Models\Recommendation;
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

class RecommendationController extends Controller
{
    /**
     * Apply default authentication middleware for backend routes.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "recommendation lists";
        $module = "recommendation";
        $jobtypes = JobType::active()->get(["id", "unique_id", "jobtype"]);
        $jobcategories = JobCategory::active()->get(["id", "unique_code", "name", "status"]);
        $medicalcenters = User::active()->medicalcenter()->get();
        $professions = Profession::active()->get(["id", "unique_code", "profession"]);
        $specialities = Specialty::active()->get(["id", "unique_code", "specialty"]);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $city = City::active()->first(["id", "name", "postcode", "state_code"]);
        $suburb = Suburb::active()->first(["id", "suburb", "postcode"]);
        $data = Recommendation::active()->latest()->get();
        return view('jobseeker.recommendation.index', compact('data', 'title', 'module', 'jobtypes', 'jobcategories', 'medicalcenters', 'professions', 'specialities', 'states'));
    }

    /**
     * Process datatables ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Recommendation::query())->make(true);

        $recommendationdata = Recommendation::select('professions.id', 'professions.profession', 'professions.status', 'professions.created_at', 'professions.updated_at');
        return Datatables::of($recommendationdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('professions.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('profession') && $request->get('profession') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('professions.profession', 'like', "%{$request->get('profession')}%");
                    });
                }
            })
            ->addColumn('profession', function ($recommendationdata) {
                return $profession = ucwords($recommendationdata->profession);
            })
            ->addColumn('created_at', function ($recommendationdata) {
                return $status = date("F j, Y, g:i a", strtotime($recommendationdata->created_at));
            })
            ->addColumn('status', function ($recommendationdata) {
                return $status = ($recommendationdata->status == 1) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($recommendationdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('recommendation.delete', $recommendationdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the record?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.recommendation.enable', $recommendationdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.recommendation.disable', $recommendationdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                if (Gate::allows('isAdmin')) {
                    $final = ($recommendationdata->status == 1) ? $link . $inactivelink : $link . $activelink;
                } else {
                    $final = '
                        <span class="bg-warning p-1">
                            You are not an admin.
                        </span>
                    ';
                }
                // $link = '<a href="' . route('recommendation.delete', $recommendationdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
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
        $title = "add recommendation";
        $module = "recommendation";
        $users = User::active()->latest()->get();
        return view('jobseeker.recommendation.add', compact('title', 'module', 'users'));
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
                'title' => 'required|max:300',
                'for' => 'required',
                'description' => 'required|max:1000',
            ]
        );

        $recommendation = new Recommendation;
        $recommendation->title = ($request->input('title'));
        $recommendation->description = ($request->input('description'));
        $recommendation->user_id = Auth::user()->id;
        $recommendation->for = $request->input('for');
        $recommendation->role_id = Auth::user()->role;
        $recommendation->save();

        $str = "RECDTN";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $recommendation->id;

        $recommendation->unique_code = $uid;
        $recommendation->save();

        return redirect()->route('admin.recommendation.list')->with('success', 'Recommendation added successfully.');
    }

    /**
     * Enable the specified profession in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Recommendation $recommendation, $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->status = "1";
        $recommendation->save();
        return redirect()->route('admin.recommendation.list')->with('success', 'Record enabled.');
    }

    /**
     * Disable the specified recommendation in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Recommendation $recommendation, $id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->status = "0";
        $recommendation->save();
        return redirect()->route('admin.recommendation.list')->with('warning', 'Record disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     *
     * @param $id
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation, $id)
    {
        // $recommendation = Recommendation::where('id', $id)->withTrashed()->first();

        $recommendation = Recommendation::findOrFail($id);
        $recommendation->delete();

        // Shows the remaining list of recommendations.
        return redirect()->route('admin.recommendation.list')->with('error', 'Recommendation removed successfully.');
    }
}
