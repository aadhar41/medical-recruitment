<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\JobSeekerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Mail;
use Session;

class JobSeekerRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::active()->orderBy('profession', 'asc')->get();
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get();
        return view('front.register', compact("professions", "specialties"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $base_url =  url('/');
        $title_page = 'Register';

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'fullname' => 'required',
                'gender' => 'required',
                'email' => 'required|email:rfc,dns|max:50|unique:users,email',
                'profession' => 'required',
                'specialty' => 'required',
                'mobile' => 'required|min:6|max:20',
                'postcode' => 'required',
                'file' => 'required|mimes:pdf,docx,doc',
                'password' => 'required|confirmed|min:6',
            ]);

            $user = new User;
            $user->name = $request->input('fullname');
            $user->email = $request->input('email');
            $password = Hash::make($request->input('password'));    // creating password hash / encryption.
            $user->password = $password;
            $user->role = "2";
            $user->save();

            $file1 = $request->file('file');

            if ($request->file('file')) {
                $name1 = $user->id . '_' . 'user_' .  time() . '.' . $file1->getClientOriginalExtension();
                $destinationPath1 = public_path('/images/jobseeker/' . $user->id);
                $file1->move($destinationPath1, $name1);
            }

            $jobSeekerRegistration = new JobSeekerRegistration;
            $jobSeekerRegistration->user_id = $user->id;
            $jobSeekerRegistration->gender = $request->input('gender');
            $jobSeekerRegistration->mobile = $request->input('mobile');
            $jobSeekerRegistration->profession = $request->input('profession');
            $jobSeekerRegistration->specialty = $request->input('specialty');
            $jobSeekerRegistration->postcode = $request->input('postcode');
            $hash = md5($request->input('email')) . time();
            $jobSeekerRegistration->token = $hash;
            $jobSeekerRegistration->cv = (isset($name1)) ? $name1 : $jobSeekerRegistration->file;
            $jobSeekerRegistration->save();

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
