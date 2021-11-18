<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class AboutController extends Controller
{
    /**
     * Apply default authentication middleware for backend routes.
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $count = About::orderBy('created_at', 'desc')->count();
        if ($count > 0) {
            $listings = About::orderBy('created_at', 'desc')->first();
            $title = "about";
            $module = "About";
            return view('admin.about.edit', compact('listings', 'title', 'module'));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'right_h_1' => 'required',
            'right_h_2' => 'required',
            'right_h_3' => 'required',
            'right_h_4' => 'required',
            'right_p_1' => 'required',
            'right_p_2' => 'required',
            'right_p_3' => 'required',
            'right_p_4' => 'required',
            // 'about_image' => 'required',
        ]);

        $file1 = $request->file('about_image');

        if ($request->file('about_image')) {
            $name1 = 'about_' . time() . '.' . $file1->getClientOriginalExtension();
            $destinationPath1 = public_path('/images/aboutus');
            $file1->move($destinationPath1, $name1);
        }

        // Update data
        $about = About::find($id);

        $about->title = $request->input("title");
        $about->description = $request->input('description');
        $about->right_h_1 = $request->input('right_h_1');
        $about->right_h_2 = $request->input('right_h_2');
        $about->right_h_3 = $request->input('right_h_3');
        $about->right_h_4 = $request->input('right_h_4');
        $about->right_p_1 = $request->input('right_p_1');
        $about->right_p_2 = $request->input('right_p_2');
        $about->right_p_3 = $request->input('right_p_3');
        $about->right_p_4 = $request->input('right_p_4');
        $about->aboutcontent_image = (isset($name1)) ? $name1 : $about->aboutcontent_image;
        $about->save();

        return redirect()->route('admin.about.edit')->with('success', 'Details Updated.');
    }

    /**
     * Enable the specified contact in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $contact
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, About $contact, $id)
    {
        $contact = About::findOrFail($id);
        $contact->status = "1";
        $contact->save();
        return redirect()->route('admin.contact.list')->with('success', 'About lead enabled.');
    }

    /**
     * Disable the specified contact in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $contact
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, About $contact, $id)
    {
        $contact = About::findOrFail($id);
        $contact->status = "0";
        $contact->save();
        return redirect()->route('admin.contact.list')->with('warning', 'About lead disabled.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param  \App\Models\About  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $contact, $id)
    {
        // $contact = About::where('id', $id)->withTrashed()->first();

        $contact = About::findOrFail($id);
        $contact->delete();

        // Shows the remaining list of contacts.
        return redirect()->route('admin.contact.list')->with('error', 'About lead deleted successfully.');
    }
}
