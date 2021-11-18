<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = "contact lists";
        $module = "contact";
        $data = Contact::active()->latest()->get();
        return view('admin.contact.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Contact::query())->make(true);

        $contactdata = Contact::select('contacts.id', 'contacts.name', 'contacts.email', 'contacts.subject', 'contacts.number', 'contacts.message', 'contacts.status', 'contacts.created_at', 'contacts.updated_at');
        return Datatables::of($contactdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('contacts.name', 'like', "%{$request->get('name')}%");
                    });
                }

                if ($request->has('number') && $request->get('number') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('contacts.number', 'like', "%{$request->get('number')}%");
                    });
                }

                if ($request->has('email') && $request->get('email') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('contacts.email', 'like', "%{$request->get('email')}%");
                    });
                }
            })
            ->addColumn('name', function ($contactdata) {
                return $name = (isset($contactdata->name)) ? ucwords($contactdata->name) : "";
            })
            ->addColumn('email', function ($contactdata) {
                return $email = (isset($contactdata->email)) ? ucwords($contactdata->email) : "";
            })
            ->addColumn('subject', function ($contactdata) {
                return $subject = (isset($contactdata->subject)) ? ucwords($contactdata->subject) : "";
            })
            ->addColumn('number', function ($contactdata) {
                return $number = (isset($contactdata->number)) ? ucwords($contactdata->number) : "";
            })
            ->addColumn('message', function ($contactdata) {
                return $message = (isset($contactdata->message)) ? ucwords($contactdata->message) : "";
            })
            ->addColumn('created_at', function ($contactdata) {
                return $created_at = (isset($contactdata->created_at)) ? date("F j, Y, g:i a", strtotime($contactdata->created_at)) : "";
            })
            ->addColumn('status', function ($contactdata) {
                return $status = (isset($contactdata->status) && ($contactdata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($contactdata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('contact.delete', $contactdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the contact?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.contact.enable', $contactdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.contact.disable', $contactdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                if (Gate::allows('isAdmin')) {
                    $final = ($contactdata->status == 1) ? $link . $inactivelink : $link . $activelink;
                } else {
                    $final = '
                        <span class="bg-warning p-1">
                            You are not an admin.
                        </span>
                    ';
                }

                return $final;
            })
            ->make(true);
    }

    /**
     * Enable the specified contact in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Contact $contact, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = "1";
        $contact->save();
        return redirect()->route('admin.contact.list')->with('success', 'Contact lead enabled.');
    }

    /**
     * Disable the specified contact in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Contact $contact, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = "0";
        $contact->save();
        return redirect()->route('admin.contact.list')->with('warning', 'Contact lead disabled.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, $id)
    {
        // $contact = Contact::where('id', $id)->withTrashed()->first();

        $contact = Contact::findOrFail($id);
        $contact->delete();

        // Shows the remaining list of contacts.
        return redirect()->route('admin.contact.list')->with('error', 'Contact lead deleted successfully.');
    }
}
