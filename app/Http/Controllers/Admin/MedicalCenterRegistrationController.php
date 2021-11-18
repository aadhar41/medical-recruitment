<?php

namespace App\Http\Controllers\Admin;

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
     *  Apply default authentication middleware for backend routes.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalCenterRegistration  $medicalcenterregistration
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalCenterRegistration $medicalcenterregistration)
    {
        $title = "profile";
        $module = "profile";
        $id = auth()->user()->id;
        $user = User::where("id", $id)->with("profile", "profile.statedetails", "profile.citydetails", "profile.suburbdetails")->first();
        // $user = User::with("profile", "profile.statedetails", "profile.citydetails", "profile.suburbdetails")->findOrFail($id);
        return view('admin.medicalcenterprofile.edit', compact('title', 'module', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalCenterRegistration  $medicalcenterregistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalCenterRegistration $medicalcenterregistration, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
            'fax' => 'max:100',
            'image' => 'mimes:jpeg,jpg,png',
            'mobile' => 'required|max:100',
            'address' => 'max:500',
        ]);

        // Update data
        $user = User::find($id);
        $user->name = $request->input("name");
        $user->save();

        $file1 = $request->file('image');

        if ($request->file('image')) {
            $name1 = $user->id . '_' . 'user_' .  time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/medical_centers/' . $user->id);
            $file1->move($destinationPath1, $name1);
        }

        $count = MedicalCenterRegistration::where("user_id", $id)->count();

        if ($count > 0) {
            $medicalCenterRegistration = MedicalCenterRegistration::where("user_id", $id)->first();

            if (isset($medicalCenterRegistration->image) && ($medicalCenterRegistration->image != NULL)) {
                $unlinkpath = public_path('/images/medical_centers/' . $user->id . '/' . $medicalCenterRegistration->image);
                unlink($unlinkpath);
                // $image = (isset($name1)) ? $name1 : $medicalCenterRegistration->image;
            }
            $image = (isset($name1)) ? $name1 : $medicalCenterRegistration->image;
            $medicalCenterRegistration->fax = $request->input("fax");
            $medicalCenterRegistration->mobile = $request->input("mobile");
            $medicalCenterRegistration->address = $request->input("address");
            $medicalCenterRegistration->image = $image;
            $medicalCenterRegistration->save();
        } else {
            $medicalCenterRegistration = new MedicalCenterRegistration;
            $medicalCenterRegistration->fax = $request->input("fax");
            $medicalCenterRegistration->mobile = $request->input("mobile");
            $medicalCenterRegistration->address = $request->input("address");
            $medicalCenterRegistration->image = (isset($name1)) ? $name1 : $medicalCenterRegistration->image;
            $medicalCenterRegistration->user_id = Auth::user()->id;
            $medicalCenterRegistration->save();

            $str = "MDCNTR";
            $uid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $medicalCenterRegistration->id;

            $medicalCenterRegistration->unique_code = $uid;
            $medicalCenterRegistration->save();
        }

        return redirect()->route('admin.medicalcenterprofile.edit')->with('success', 'Profile Updated.');
    }
}
