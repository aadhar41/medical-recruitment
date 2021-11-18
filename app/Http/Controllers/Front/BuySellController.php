<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\About;
use App\Models\SocialLink;
use App\Models\JobType;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings;

class BuySellController extends Controller
{
    /**
     * Apply default authentication middleware for backend routes.
     * Set global constant and global array available for all the methods of current controller.
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->bstype = config("constants.bstype");
        $this->property_type = config("constants.property_type");
        $this->promotional_flag = config("constants.promotional_flag");
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // die("Buy and sell");
        $request->session()->forget(['jobtype', 'states', 'cities', 'suburb', 'profession', 'specialty']);
        $count = BuySell::latest()->count();
        if ($count > 0) {
            // $listings = BuySell::latest()->first();
            $listings = BuySell::active()->with("associatedImages:id,buysell_id,type,file,order,status", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng")->orderBy('order', 'asc')->get();
            $sociallinks = SocialLink::active()->first();
            $settings = Settings::orderBy("created_at", "desc")->first();
            $totalJobSeekers = User::active()->jobseeker()->latest()->count();
            $totalMedicalCenters = User::active()->medicalcenter()->latest()->count();
            $totalDoctors = User::active()->doctor()->latest()->count();
            $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
            $cities = City::active()->get(["id", "name", "postcode"]);
            $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
            $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
            $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
            return view('front.buysell', compact("listings", "states", "cities", "suburbs", "sociallinks", "listings", "settings", "jobtypes", "professions", "totalJobSeekers", "totalMedicalCenters", "totalDoctors"));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Search a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuySell  $buysell
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, BuySell $buysell)
    {
        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get(["id", "unique_code", "specialty"]);
        $sociallinks = SocialLink::active()->first();
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);

        // Pipeline implementation for searching.
        $data = BuySell::searchResult();

        $settings = Settings::orderBy("created_at", "desc")->first();
        return view('front.buysellsearch', compact("sociallinks", "professions", "specialties", "states", "cities", "suburbs", "data", "jobtypes", "settings"));
    }

    public function clearsearch(Request $request, BuySell $buysell)
    {
        $data = $request->session()->all();
        // echo "<pre>"; print_r($data); die;
        $request->session()->forget('jobtype');
        $request->session()->forget('states');
        $request->session()->forget('cities');
        $request->session()->forget('suburb');
        $request->session()->forget('profession');
        $request->session()->forget('specialty');
        $request->session()->forget('postcode');
        $request->session()->forget('min');
        $request->session()->forget('max');
        $request->session()->forget('city');
        return redirect()->route('buysell');
    }
}
