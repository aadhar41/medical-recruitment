<?php

namespace App\Http\Controllers\Admin;

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

class SuburbController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $title = "suburb lists";
        $module = "suburb";
        $data = Suburb::active()->orderBy('id', 'asc')->get();
        return view('admin.suburb.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Suburb::query())->make(true);

        $suburbdata = Suburb::select('suburbs.id', 'suburbs.ssc_code', 'suburbs.suburb', 'suburbs.urban_area', 'suburbs.postcode', 'suburbs.state', 'suburbs.state_name', 'suburbs.type', 'suburbs.local_goverment_area', 'suburbs.statistic_area', 'suburbs.status');
        return Datatables::of($suburbdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.suburb', 'like', "%{$request->get('name')}%");
                    });
                }
                if ($request->has('postcode') && $request->get('postcode') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.postcode', '=', $request->get('postcode'));
                    });
                }

                if ($request->has('ssc_code') && $request->get('ssc_code') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.ssc_code', '=', $request->get('ssc_code'));
                    });
                }

                if ($request->has('state') && $request->get('state') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.state', 'like', "%{$request->get('state')}%");
                    });
                }

                if ($request->has('local_goverment_area') && $request->get('local_goverment_area') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('suburbs.local_goverment_area', 'like', "%{$request->get('local_goverment_area')}%");
                    });
                }
            })
            ->addColumn('ssc_code', function ($suburbdata) {
                return $ssc_code = (isset($suburbdata->ssc_code)) ? ucwords($suburbdata->ssc_code) : "";
            })
            ->addColumn('suburb', function ($suburbdata) {
                return $suburb = (isset($suburbdata->suburb)) ? ucwords($suburbdata->suburb) : "";
            })
            ->addColumn('urban_area', function ($suburbdata) {
                return $urban_area = (isset($suburbdata->urban_area)) ? ucwords($suburbdata->urban_area) : "";
            })
            ->addColumn('postcode', function ($suburbdata) {
                return $postcode = (isset($suburbdata->postcode)) ? ucwords($suburbdata->postcode) : "";
            })
            ->addColumn('state', function ($suburbdata) {
                return $state = (isset($suburbdata->state)) ? ucwords($suburbdata->state) : "";
            })
            ->addColumn('state_name', function ($suburbdata) {
                return $state_name = (isset($suburbdata->state_name)) ? ucwords($suburbdata->state_name) : "";
            })
            ->addColumn('type', function ($suburbdata) {
                return $type = (isset($suburbdata->type)) ? ucwords($suburbdata->type) : "";
            })
            ->addColumn('local_goverment_area', function ($suburbdata) {
                return $local_goverment_area = (isset($suburbdata->local_goverment_area)) ? ucwords($suburbdata->local_goverment_area) : "";
            })
            ->addColumn('statistic_area', function ($suburbdata) {
                return $statistic_area = (isset($suburbdata->statistic_area)) ? ucwords($suburbdata->statistic_area) : "";
            })
            ->addColumn('status', function ($suburbdata) {
                return $status = (isset($suburbdata->status) && ($suburbdata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($suburbdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('suburb.delete', $suburbdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the state?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.suburb.enable', $suburbdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.suburb.disable', $suburbdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.suburb.edit', $suburbdata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                if (Gate::allows('isAdmin')) {
                    $final = ($suburbdata->status == 1) ? $editlink . $link . $inactivelink : $editlink . $link . $activelink;
                } else {
                    $final = '
                        <span class="bg-warning p-1">
                            You are not an admin.
                        </span>
                    ';
                }

                // $link = '<a href="' . route('jobtype.delete', $suburbdata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param  \App\Models\Suburb  $suburb
     * @return \Illuminate\Http\Response
     */
    public function edit(Suburb $suburb, $id)
    {
        $count = Suburb::where("id", $id)->count();
        if ($count > 0) {
            $listings = Suburb::where("id", $id)->first();
            $title = "suburb";
            $module = "suburb";
            return view('admin.suburb.edit', compact('listings', 'title', 'module'));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suburb  $suburb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suburb $suburb, $id)
    {
        $this->validate(
            $request,
            [
                'suburb' => 'required|max:40|unique:suburbs,suburb,' . $suburb->suburb,
                'postcode' => 'required|numeric',
                'ssc_code' => 'required|numeric',
            ]
        );

        // Update data
        $suburb = Suburb::findOrFail($id);
        $suburb->suburb = $request->input("suburb");
        $suburb->postcode = $request->input("postcode");
        $suburb->ssc_code = $request->input("ssc_code");
        $suburb->save();

        return redirect()->route('admin.suburb.list')->with('success', 'Details Updated.');
    }


    /**
     * Enable the specified suburb in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suburb  $suburb
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Suburb $suburb, $id)
    {
        $suburb = Suburb::findOrFail($id);
        $suburb->status = "1";
        $suburb->save();
        return redirect()->route('admin.suburb.list')->with('success', 'Suburb service enabled.');
    }

    /**
     * Disable the specified Suburb in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suburb  $suburb
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Suburb $suburb, $id)
    {
        $suburb = Suburb::findOrFail($id);
        $suburb->status = "0";
        $suburb->save();
        return redirect()->route('admin.suburb.list')->with('warning', 'Suburb service disabled.');
    }
}
