<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use App\Models\Job;
use App\Models\JobType;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\User;
use App\Models\JobCategory;
use App\Models\Contact;
use App\Models\JobApplication;
use App\Models\Newsletter;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cities = City::active()->count();
        $states = State::active()->count();
        $suburbs = Suburb::active()->count();
        $jobtypes = JobType::active()->count();
        $professions = Profession::active()->count();
        $specialty = Specialty::active()->count();
        $jobcategories = JobCategory::active()->count();
        $jobs = Job::active()->count();
        $contacts = Contact::active()->count();
        $jobapplications = JobApplication::active()->count();
        $newsletters = Newsletter::active()->count();
        $buysells = BuySell::active()->count();
        $user = Auth::user();

        if ($user->role == 1) {
            $title = "dashboard";
            $module = "dashboard";
            return view('admin.home', compact("buysells", "cities", "states", "suburbs", "newsletters", "jobtypes", "title", "module", "professions", "specialty", "jobcategories", "jobs", "contacts", "jobapplications"));
        } else {
            $title = "dashboard";
            $module = "jobseeker dashboard";
            return view('admin.jobseeker', compact("buysells", "cities", "states", "suburbs", "newsletters", "jobtypes", "title", "module", "professions", "specialty", "jobcategories", "jobs", "contacts"));
        }
    }
}
