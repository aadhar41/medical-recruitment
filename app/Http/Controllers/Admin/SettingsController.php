<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $setting)
    {
        $count = Settings::latest()->count();
        if ($count > 0) {
            $listings = Settings::latest()->first();
            $title = "setting";
            $module = "Setting";
            return view('admin.setting.edit', compact('listings', 'title', 'module'));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $setting, $id)
    {
        $this->validate($request, [
            // 'main_logo' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'web' => 'required',
            'fax' => 'required',
            'whatsapp' => 'required',
            'link' => 'required',
        ]);

        $file1 = $request->file('main_logo');

        if ($request->file('main_logo')) {
            $name1 = 'main_logo_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/settings');
            $file1->move($destinationPath1, $name1);
        }

        // Update data
        $setting = Settings::find($id);

        $setting->phone = $request->input("phone");
        $setting->email = $request->input('email');
        $setting->web = $request->input('web');
        $setting->fax = $request->input('fax');
        $setting->whatsapp = $request->input('whatsapp');
        $setting->link = $request->input('link');
        $setting->main_logo = (isset($name1)) ? $name1 : $setting->main_logo;
        $setting->save();

        return redirect()->route('admin.setting.edit')->with('success', 'Details Updated.');
    }
}
