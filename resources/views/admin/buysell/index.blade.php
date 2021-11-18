@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')

@include('partials._select2Assests')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if (( Auth::user()->role == "1"))
                <a href="{{ route('admin.buysell.create') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                    Create Record
                </a>
                @endif
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.buysell.list') }}" class="btn btn-primary">
                    <i class="fas fa-recycle"></i>&nbsp;
                    Clear Search
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row col-md-12">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>STATE</label>
                        <select name="state" id="state" class="form-control select2" placeholder="Select state">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>CITY</label>
                        <select name="city" id="city" class="form-control select2" placeholder="Select City">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ ucwords($city->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>SUBURB</label>
                        <select name="suburb" id="suburb" class="form-control select2" placeholder="Select Suburb">
                            <option value="">Select Suburb</option>
                            @foreach($suburbs as $val)
                            <option value="{{ $val->id }}">{{ ucwords($val->suburb) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>PROMOTIONAL FLAG</label>
                        <select name="promotional_flag" id="promotional_flag" class="form-control select2" placeholder="Select Promotional Flag">
                            <option value="">Select Promotional Flag</option>
                            @foreach($promotional_flag as $id => $flag)
                            <option value="{{ $id }}">{{ ucwords($flag) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>PROPERTY TYPE</label>
                        <select name="property_type" id="property_type" class="form-control select2" placeholder="Select Profession">
                            <option value="">Select Property Type</option>
                            @foreach($property_type as $key => $type)
                            <option value="{{ $key }}">{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>STATUS</label>
                        <select name="status" id="status" class="form-control select2" placeholder="Select Status">
                            <option value="">Select Status</option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>TITLE </label>
                        <input type="text" name="title" id="title" placeholder="TITLE" class="form-control" autocomplete="off" />
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <b>Listing</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="buysell-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Number</th>
                        <th>E-Mail</th>
                        <th>Rating</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>


<script>
    var oTable = $('#buysell-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('buysell.datatables') !!}",
            data: function(d) {
                d.title = $('#title').val();
                d.status = $('#status').val();
                d.state = $('#state').val();
                d.city = $('#city').val();
                d.suburb = $('#suburb').val();
                d.promotional_flag = $('#promotional_flag').val();
                d.property_type = $('#property_type').val();
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'number',
                name: 'number'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'rating',
                name: 'rating'
            },
            {
                data: 'order',
                name: 'order'
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    if (data == 'Enabled') {
                        return "<span class='right badge badge-success p-1'>" + data + "</span>";
                    } else {
                        return "<span class='right badge badge-danger p-1'>" + data + "</span>";
                    }
                }
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [
            [0, 'desc']
        ],
        searching: false,
        // bLengthChange:false,
    });

    $('#status').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#state').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#city').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#suburb').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#promotional_flag').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#property_type').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#title').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection