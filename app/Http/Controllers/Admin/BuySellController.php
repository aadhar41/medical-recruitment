<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\About;
use App\Models\SocialLink;
use App\Models\JobType;
use App\Models\Profession;
use App\Models\BuySell;
use App\Models\BuySellMedia;
use App\Models\State;
use App\Models\City;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBuySellRequest;
use App\Http\Requests\UpdateBuySellRequest;
use Illuminate\Support\Facades\DB;

class BuySellController extends Controller
{
    /**
     * Apply default authentication middleware for backend routes.
     * Set the global constants and global arrays available for all methods in the controller.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuySell  $buySell
     * @return void
     */
    public function __construct(Request $request, BuySell $buySell)
    {
        $this->bstype = config("constants.bstype");
        $this->property_type = config("constants.property_type");
        $this->promotional_flag = config("constants.promotional_flag");
    }

    /**
     * Display a listing of the resource.
     * @param  \App\Models\BuySell  $buySell
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request, BuySell $buySell)
    {
        $request->session()->forget(['jobtype', 'states', 'cities', 'suburb', 'profession', 'specialty']);
        $bstype = $this->bstype;
        $property_type = $this->property_type;
        $promotional_flag = $this->promotional_flag;
        $title = "buy sell listing";
        $module = "buysell";

        $count = BuySell::latest()->count();
        if ($count > 0) {
            $buysellrecords = BuySell::active()->with("associatedImages")->orderBy('order', 'asc')->get();
            $users = User::active()->latest()->get();
            $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
            $cities = City::active()->get(["id", "name", "postcode"]);
            $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
            return view('admin.buysell.index', compact("title", "module", "users", "states", "cities", "suburbs", "buysellrecords", "promotional_flag", "property_type"));
        } else {
            abort(404, 'No record found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $buyselldata = BuySell::select('buy_sells.id', 'buy_sells.unique_code', 'buy_sells.user_id', 'buy_sells.type', 'buy_sells.property_type', 'buy_sells.promotional_flag', 'buy_sells.state_id', 'buy_sells.city_id', 'buy_sells.suburb_id', 'buy_sells.price', 'buy_sells.title', 'buy_sells.slug', 'buy_sells.description', 'buy_sells.number', 'buy_sells.email', 'buy_sells.rating', 'buy_sells.order', 'buy_sells.status', 'buy_sells.created_at', 'buy_sells.updated_at')->with("associatedImages:id,buysell_id,type,file,order,status")->get();

        $title = "buysell create";
        $description = "buysell";
        $module = "buysell";
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        return view('admin.buysell.add', compact("title", "description", "states", "module"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\BuySell  $buySell
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBuySellRequest $request, BuySell $buySell)
    {
        if ($request->file('images')) {
            if (count($request->file('images')) > 3) {
                return redirect()->route('admin.buysell.create')->with('error', 'Maximum 3 images allowed.');
            }
        }

        DB::beginTransaction();

        try {
            $request->merge([
                "user_id" => Auth::user()->id,
                "state_id" => $request->input('state'),
                "city_id" => $request->input('city'),
                "suburb_id" => $request->input('suburb')
            ]);
            $validated = $request->validated();
            $input = $request->all();
            $buySell = BuySell::create($input);

            foreach ($request->file('images') as $key => $value) {
                $nam = ($request->input('state')) . "_" . ($request->input('city'));
                $name = $key . '_' . $nam . '_image_' . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path('/images/buysell');
                $value->move($destinationPath, $name);

                // Insert Image into Buy media.
                $buySellMedia = new BuySellMedia;
                $buySellMedia->file = (isset($name)) ? $name : "default.png";
                $buySellMedia->type = "1";
                $buySellMedia->user_id = Auth::user()->id;
                $buySellMedia->buysell_id = $buySell->id;
                $buySellMedia->save();
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return redirect()->route('admin.buysell.create')->with('success', 'Property added successfully.');
    }

    /**
     * Process datatables ajax request.
     * @param  \App\Models\BuySell  $buySell
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request, BuySell $buySell)
    {
        // return Datatables::of(City::query())->make(true);

        $buyselldata = BuySell::select('buy_sells.id', 'buy_sells.unique_code', 'buy_sells.user_id', 'buy_sells.type', 'buy_sells.property_type', 'buy_sells.promotional_flag', 'buy_sells.state_id', 'buy_sells.city_id', 'buy_sells.suburb_id', 'buy_sells.price', 'buy_sells.title', 'buy_sells.slug', 'buy_sells.description', 'buy_sells.number', 'buy_sells.email', 'buy_sells.rating', 'buy_sells.order', 'buy_sells.status', 'buy_sells.created_at', 'buy_sells.updated_at')->with("associatedImages");

        return Datatables::of($buyselldata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('state') && $request->get('state') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.state_id', '=', $request->get('state'));
                    });
                }

                if ($request->has('city') && $request->get('city') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.city_id', '=', $request->get('city'));
                    });
                }

                if ($request->has('suburb') && $request->get('suburb') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.suburb_id', '=', $request->get('suburb'));
                    });
                }

                if ($request->has('promotional_flag') && $request->get('promotional_flag') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.promotional_flag', '=', $request->get('promotional_flag'));
                    });
                }

                if ($request->has('property_type') && $request->get('property_type') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.property_type', '=', $request->get('property_type'));
                    });
                }

                if ($request->has('title') && $request->get('title') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('buy_sells.title', 'like', "%{$request->get('title')}%");
                    });
                }
            })
            ->addColumn('title', function ($buyselldata) {
                return $title = (isset($buyselldata->title)) ? ucwords($buyselldata->title) : "";
            })
            ->addColumn('price', function ($buyselldata) {
                return $price = (isset($buyselldata->price)) ? ucwords($buyselldata->price) : "";
            })
            ->addColumn('number', function ($buyselldata) {
                return $number = (isset($buyselldata->number)) ? ucwords($buyselldata->number) : "";
            })
            ->addColumn('email', function ($buyselldata) {
                return $email = (isset($buyselldata->email)) ? ucwords($buyselldata->email) : "";
            })
            ->addColumn('rating', function ($buyselldata) {
                return $rating = (isset($buyselldata->rating)) ? ucwords($buyselldata->rating) : "";
            })
            ->addColumn('order', function ($buyselldata) {
                return $order = (isset($buyselldata->order)) ? ucwords($buyselldata->order) : "";
            })
            ->addColumn('created_at', function ($buyselldata) {
                return $created_at = (isset($buyselldata->created_at)) ? date("F j, Y, g:i a", strtotime($buyselldata->created_at)) : "";
            })
            ->addColumn('status', function ($buyselldata) {
                return $status = (isset($buyselldata->status) && ($buyselldata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($buyselldata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('buysell.delete', $buyselldata->id) . '" class="btn btn-sm btn-danger" title="Trash" onclick="return confirm(\'Do you really want to trash the record?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.buysell.enable', $buyselldata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.buysell.disable', $buyselldata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $detailslink = '
                    <div class="btn-group">
                        <a href="' . route('admin.buysell.show', $buyselldata->id) . '" class="btn btn-sm btn-primary" title="View Details" ><i class="fas fa-eye"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.buysell.edit', $buyselldata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                if (Gate::allows('isAdmin')) {
                    $final = ($buyselldata->status == 1) ? $editlink . $link . $inactivelink . $detailslink : $editlink . $link . $activelink . $detailslink;
                } else {
                    $final = '
                        <span class="bg-warning p-1">
                            You are not an admin.
                        </span>
                    ';
                }

                // $link = '<a href="' . route('jobtype.delete', $statedata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Enable the specified buySell in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuySell  $buySell
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, BuySell $buySell, $id)
    {
        $buysell = BuySell::findOrFail($id);
        $buysell->status = "1";
        $buysell->save();
        return redirect()->route('admin.buysell.list')->with('success', 'Buysell service enabled.');
    }

    /**
     * Disable the specified buySell in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuySell $buySell
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, BuySell $buySell, $id)
    {
        $buysell = BuySell::findOrFail($id);
        $buysell->status = "0";
        $buysell->save();
        return redirect()->route('admin.buysell.list')->with('warning', 'Buysell service disabled.');
    }



    /**
     * Display the specified resource.
     * 
     * @param $id
     * @param  \App\Models\BuySell  $buysell
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BuySell $buysell)
    {
        $title = "Buy / Sell Details";
        $module = "buysell";
        $bstype = $this->bstype;
        $property_type = $this->property_type;
        $promotional_flag = $this->promotional_flag;
        $buysell = BuySell::with("associatedImages:id,buysell_id,file,type,order,status", "associatedState:id,name,iso2,latitude,longitude", "associatedCity:id,name,latitude,longitude", "associatedSuburb:id,suburb,lat,lng", "createdBy:id,name,email,role")->orderBy("order", "asc")->findOrFail($buysell->id);
        return view('admin.buysell.show', compact('title', 'module', 'buysell', "bstype", "property_type", "promotional_flag"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @param  \App\Models\BuySell $buysell
     * @return \Illuminate\Http\Response
     */
    public function edit(BuySell $buysell)
    {
        $listings = BuySell::with("associatedImages:id,buysell_id,file,type,order,status")->findOrFail($buysell->id);
        $states = State::active()->get(["id", "name", "iso2", "latitude", "longitude"]);
        $cities = City::active()->get(["id", "name", "postcode"]);
        $suburbs = Suburb::active()->get(["id", "suburb", "postcode"]);
        $title = "buysell";
        $module = "buysell";
        return view('admin.buysell.edit', compact('states', 'cities', 'suburbs', 'listings', 'title', 'module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuySell $buysell
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBuySellRequest $request, BuySell $buysell)
    {
        if ($request->file('images')) {
            if (count($request->file('images')) > 3) {
                return redirect()->route('admin.buysell.create')->with('error', 'Maximum 3 images allowed.');
            }
        }

        $request->merge([
            "user_id" => Auth::user()->id,
            "state_id" => $request->input('state_id'),
            "city_id" => $request->input('city_id'),
            "suburb_id" => $request->input('suburb_id')
        ]);
        $validated = $request->validated();
        $input = $request->all();
        $buySell = $buysell->update($input);

        if (!empty($request->file('images'))) {
            $buySellMediaCount = BuySellMedia::where("buysell_id", $buysell->id)->count();
            if ($buySellMediaCount > 0) {
                // If Has Image Then Replace.
                $buySellMedia = BuySellMedia::where("buysell_id", $buysell->id)->get();
                foreach ($buySellMedia as $key => $val) {
                    $buySellMedia = BuySellMedia::where("buysell_id", $val->buysell_id)->first();
                    $buySellMedia->delete();
                }
            }

            foreach ($request->file('images') as $key => $value) {
                $nam = ($request->input('state')) . "_" . ($request->input('city'));
                $name = $key . $buySell->id . '_' . $nam . '_image_' . time() . '.' . $value->getClientOriginalExtension();
                $destinationPath = public_path('/images/buysell');
                $value->move($destinationPath, $name);

                // Insert Image into Buy media.
                $buySellMedia = new BuySellMedia;
                $buySellMedia->file = (isset($name)) ? $name : "default.png";
                $buySellMedia->type = "1";
                $buySellMedia->user_id = Auth::user()->id;
                $buySellMedia->buysell_id = $buySell->id;
                $buySellMedia->save();

                $str = "BYSLMD";
                $ubid = str_pad($str, 10, "0", STR_PAD_RIGHT) . $buySellMedia->id;

                $buySellMedia->unique_code = $ubid;
                $buySellMedia->save();
            }
        } else {
            // If Not Then Reorder
            $buySellMedia = BuySellMedia::where("buysell_id", $buysell->id)->get();
            foreach ($buySellMedia as $key => $val) {
                $buySellMedia = BuySellMedia::where("id", $val->id)->first();
                $buySellMedia->order = $request->input($val->id . "_order_image");
                $buySellMedia->save();
            }
        }

        return redirect()->route('admin.buysell.list')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage ( Soft Delete ).
     * @param $id
     * @param  \App\Models\BuySell $buySell
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuySell $buySell, $id)
    {
        // $buySell = BuySell::where('id', $id)->withTrashed()->first();

        $buySell = BuySell::findOrFail($id);
        $buySell->delete();

        // Shows the remaining list of buySell.
        return redirect()->route('admin.buysell.list')->with('error', 'Buysell service removed successfully.');
    }
}
