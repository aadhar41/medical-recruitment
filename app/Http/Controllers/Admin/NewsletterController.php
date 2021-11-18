<?php

namespace App\Http\Controllers\Admin;

use App\Models\Newsletter;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "job newsletter lists";
        $module = "newsletters";
        $newsletters = Newsletter::active()->get();
        return view('admin.newsletters.index', compact("newsletters", "title", "module"));
    }

    /**
     * Process datatables ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Newsletter::query())->make(true);

        $newslettersdata = Newsletter::select('newsletters.id', 'newsletters.email', 'newsletters.status', 'newsletters.created_at', 'newsletters.updated_at');
        return Datatables::of($newslettersdata)
            ->filter(function ($query) use ($request) {

                if ($request->has('email') && $request->get('email') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('newsletters.email', '=', $request->get('email'));
                    });
                }

                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('newsletters.status', '=', $request->get('status'));
                    });
                }
            })
            ->addColumn('email', function ($newslettersdata) {
                return $email = (isset($newslettersdata->email)) ? ucwords($newslettersdata->email) : "";
            })
            ->addColumn('created_at', function ($newslettersdata) {
                return $created_at = (isset($newslettersdata->created_at)) ? date("F j, Y, g:i a", strtotime($newslettersdata->created_at)) : "";
            })
            ->addColumn('status', function ($newslettersdata) {
                return $status = (isset($newslettersdata->status) && ($newslettersdata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($newslettersdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('newsletter.delete', $newslettersdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete this entry?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.newsletter.enable', $newslettersdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';

                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.newsletter.disable', $newslettersdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                if (Gate::allows('isAdmin')) {
                    $final = ($newslettersdata->status == 1) ? $link . $inactivelink  : $link . $activelink;
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
     * Enable the specified newsletter in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Newsletter $newsletter, $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->status = "1";
        $newsletter->save();
        return redirect()->route('admin.newsletter.list')->with('success', 'Newsletter enabled.');
    }

    /**
     * Disable the specified newsletter in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Newsletter $newsletter, $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->status = "0";
        $newsletter->save();
        return redirect()->route('admin.newsletter.list')->with('warning', 'Newsletter disabled.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     *
     * @param $id
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter, $id)
    {
        // $newsletter = Newsletter::where('id', $id)->withTrashed()->first();

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        // Shows the remaining list of newsletter.
        return redirect()->route('admin.newsletter.list')->with('error', 'Newsletter deleted successfully.');
    }
}
