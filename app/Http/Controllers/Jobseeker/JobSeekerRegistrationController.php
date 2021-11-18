<?php

namespace App\Http\Controllers\Jobseeker;

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(JobSeekerRegistration $jobSeekerRegistration)
    {
        $title = "profile";
        $module = "profile";
        $id = auth()->user()->id;
        $professions = Profession::active()->orderBy('profession', 'asc')->get();
        $specialties = Specialty::active()->orderBy('specialty', 'asc')->get();
        $user = User::where("id", $id)->with("jobseekerprofile", "jobseekerprofile.professiondetails", "jobseekerprofile.specialitydetails", "jobseekerprofile.statedetails", "jobseekerprofile.citydetails", "jobseekerprofile.suburbdetails")->first();
        return view('jobseeker.profile.edit', compact('title', 'module', 'user', 'professions', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobSeekerRegistration  $jobSeekerRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobSeekerRegistration $jobSeekerRegistration, $id)
    {

        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png',
            'cv' => 'mimes:pdf,docx,doc',
            'mobile' => 'min:6|max:20',
        ]);


        // Update data
        $user = User::find($id);
        $user->name = $request->input("name");
        $user->save();

        $file1 = $request->file('image');

        if ($request->file('image')) {
            $name1 = $user->id . '_' . 'user_' .  time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/jobseeker/' . $user->id);
            $file1->move($destinationPath1, $name1);
        }

        $file2 = $request->file('cv');

        if ($request->file('cv')) {
            $name2 = $user->id . '_' . 'user_' .  time() . '.' . $file2->getClientOriginalExtension();
            $destinationPath2 = public_path('/images/jobseeker/' . $user->id);
            $file2->move($destinationPath2, $name2);
        }

        $count = JobSeekerRegistration::where("user_id", $id)->count();

        if ($count > 0) {
            $jobSeekerRegistration = JobSeekerRegistration::where("user_id", $id)->first();

            $image = (isset($name1)) ? $name1 : $jobSeekerRegistration->image;
            $cv = (isset($name2)) ? $name2 : $jobSeekerRegistration->cv;
            $jobSeekerRegistration->profession = $request->input("profession");
            $jobSeekerRegistration->specialty = $request->input("specialty");
            $jobSeekerRegistration->mobile = $request->input("mobile");
            $jobSeekerRegistration->image = $image;
            $jobSeekerRegistration->cv = $cv;
            $jobSeekerRegistration->save();
        } else {
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
            $jobSeekerRegistration->image = (isset($name2)) ? $name2 : $jobSeekerRegistration->image;
            $jobSeekerRegistration->save();

            $str = "JBSKRG";
            $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $jobSeekerRegistration->id;

            $jobSeekerRegistration->unique_code = $uid;
            $jobSeekerRegistration->save();
        }

        return redirect()->route('jobseekerprofile.edit')->with('success', 'Profile Updated.');
    }
}
