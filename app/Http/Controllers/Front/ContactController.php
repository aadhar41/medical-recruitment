<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use App\Models\SocialLink;
use App\Models\JobType;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Settings;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget(['jobtype', 'states', 'cities', 'suburb', 'profession', 'specialty']);
        $sociallinks = SocialLink::active()->first();
        $settings = Settings::orderBy("created_at", "desc")->first();
        $professions = Profession::active()->orderBy('profession', 'asc')->get(["id", "unique_code", "profession"]);
        $jobtypes = JobType::active()->latest()->get(["id", "unique_id", "jobtype"]);
        return view('front.contactus', compact("sociallinks", "settings", "professions", "jobtypes"));
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
                'name' => 'required|max:100',
                'email' => 'required|unique:contacts|max:100',
                'subject' => 'required|max:250',
                'number' => 'required|unique:contacts|digits_between:6,20|numeric',
                'message' => 'max:500',
            ]
        );

        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->number = $request->input('number');
        $contact->message = $request->input('message');
        $contact->save();

        return redirect()->route('contactus')->with('success', 'Your quote has been submitted successfully, wait for the response.');
    }
}
