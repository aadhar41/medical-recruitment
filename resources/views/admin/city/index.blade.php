@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')
@include('partials._select2Assests')
<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('admin.city.list') }}" class="btn btn-primary">
                    <i class="fas fa-recycle"></i>&nbsp;
                    Clear search
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City Name </label>
                        <input type="text" name="name" id="name" placeholder="City Name" class="form-control" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Post Code </label>
                        <input type="text" name="postcode" id="postcode" placeholder="Postcode" class="form-control" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>State Code </label>
                        <input type="text" name="state_code" id="state_code" placeholder="State Code" class="form-control" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control select2" placeholder="Select Status">
                            <option value="">Select Status</option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
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
                <table class="table table-striped table-bordered table-sm" id="city-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Postcode</th>
                        <th>State Code</th>
                        <th>Type</th>
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
    var oTable = $('#city-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('city.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.name = $('#name').val();
                d.postcode = $('#postcode').val();
                d.state_code = $('#state_code').val();
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'postcode',
                name: 'postcode'
            },
            {
                data: 'state_code',
                name: 'state_code'
            },
            {
                data: 'type',
                name: 'type'
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
            [0, 'asc']
        ],
        searching: false,
        // bLengthChange:false,
    });

    $('#status').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#postcode').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#state_code').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection