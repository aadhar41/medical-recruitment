<?php

namespace App\Http\Controllers\Front;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Newsletter $newsletter)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50|unique:newsletters',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->with('error', 'Newsletter already subscribed.')->with('application', 'With errors.')->withErrors($validator)->withInput();
        }

        $newsletter = new Newsletter;
        $newsletter->email = ($request->input('email'));
        $newsletter->save();

        $str = "NWSLTR";
        $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $newsletter->id;

        $newsletter->unique_code = $uid;
        $newsletter->save();

        return redirect()->route('home')->with('success', 'Subscription added successfully.');
    }
}
