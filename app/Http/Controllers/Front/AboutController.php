<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\About;
use App\Models\SocialLink;
use App\Models\JobType;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings;

class AboutController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget(['jobtype', 'states', 'cities', 'suburb', 'profession', 'specialty']);
        $count = About::latest()->count();
        if ($count > 0) {
            $listings = About::latest()->first();
            $sociallinks = SocialLink::active()->first();
            $settings = Settings::latest()->first();
            $professions = Profession::active()->orderBy('profession', 'asc')->get();
            $jobtypes = JobType::active()->latest()->get();
            $totalJobSeekers = User::active()->jobseeker()->latest()->count();
            $totalMedicalCenters = User::active()->medicalcenter()->latest()->count();
            $totalDoctors = User::active()->doctor()->latest()->count();
            return view('front.aboutus', compact("sociallinks", "listings", "settings", "jobtypes", "professions", "totalJobSeekers", "totalMedicalCenters", "totalDoctors"));
        } else {
            abort(404, 'No record found');
        }
    }
}
