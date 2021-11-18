<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\MedicalCenterRegistration;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Mail;
use Session;

class MedicalCenterRegistrationController extends Controller
{
    /**
     * Display the registration form for medical center.
     *
     * @return \Illuminate\Http\Response
     */
    public function register_form()
    {
        $states = State::active()->get();
        return view('front.medicalcenter-register', compact("states"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $base_url =  url('/');
        $title_page = 'Medical Center Register';

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'fullname' => 'required',
                'email' => 'required|email:rfc,dns|max:50|unique:users,email',
                'mobile' => 'required|min:6|max:20',
                'postcode' => 'required',
                'file' => 'mimes:pdf,docx,doc',
                'password' => 'required|confirmed|min:6',
            ]);

            $user = new User;
            $user->name = $request->input('fullname');
            $user->email = $request->input('email');
            $password = Hash::make($request->input('password'));    // creating password hash / encryption.
            $user->password = $password;
            $user->role = "3";
            $user->save();

            $file1 = $request->file('file');

            if ($request->file('file')) {
                $name1 = $user->id . '_' . 'user_' .  time() . '.' . $file1->getClientOriginalExtension();
                $destinationPath1 = public_path('/images/medical_centers/' . $user->id);
                $file1->move($destinationPath1, $name1);
            }

            $medicalCenterRegistration = new MedicalCenterRegistration;
            $medicalCenterRegistration->user_id = $user->id;
            $medicalCenterRegistration->mobile = $request->input('mobile');
            $medicalCenterRegistration->state = $request->input('state');
            $medicalCenterRegistration->city = $request->input('city');
            $medicalCenterRegistration->suburb = $request->input('suburb');
            $medicalCenterRegistration->postcode = $request->input('postcode');
            $hash = md5($request->input('email')) . time();
            $medicalCenterRegistration->token = $hash;
            $medicalCenterRegistration->attachment = (isset($name1)) ? $name1 : $medicalCenterRegistration->file;
            $medicalCenterRegistration->save();

            ##### email send #####

            // $from_mail = 'oliver7415@googlemail.com';
            // $site_title = 'MSRA';
            // $site_title = env("APP_NAME", "MSRA");
            // $from_mail = env("FROM_EMAIL", "enquiries@msra.com.au");

            // // Send email
            // $sdata = [];
            // $sdata['name'] = $request->input('fullname');
            // $sdata['token'] = $hash;    // hash will be send in the url.
            // $sdata['base_url'] = $base_url;
            // $email = $request->input('email');

            // Mail::send('email.placeregistermail', ['data' => $sdata], function ($m) use ($data, $from_mail, $site_title, $email) {
            //     $m->from($from_mail, $site_title);
            //     $m->to($email, 'Name of Reciever')->subject('Email verification.');
            // });

            ##### email send. ends #####

            return redirect('login')->with('success', 'Registeration successfull! You can login now.');
        }

        return redirect('login');
    }
}
