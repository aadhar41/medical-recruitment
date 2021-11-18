<?php

namespace App\Http\Controllers\Front;

use App\Models\Front;
use App\Models\State;
use App\Models\JobType;
use App\Models\Profession;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\SocialLink;
use App\Models\Settings;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget(['jobtype', 'states', 'cities', 'suburb', 'profession', 'specialty', 'postcode', 'min', 'max', 'city']);
        $states = State::active()->orderBy('name', 'asc')->get(["id", "name", "iso2", "latitude", "longitude"]);
        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->skip(0)->take(7)->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $settings = Settings::orderBy("created_at", "desc")->first();
        return view('front.home', compact("jobtypes", "states", "sociallinks", "professions", "settings", "specialties"));
    }
}
