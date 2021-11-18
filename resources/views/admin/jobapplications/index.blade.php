@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')

@include('partials._select2Assests')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                &nbsp;
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.jobapplication.list') }}" class="btn btn-primary">
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
                        <label>Job Type</label>
                        <select name="jobtype" id="jobtype" class="form-control select2" placeholder="Select Job Type">
                            <option value="">Select Jobtype</option>
                            @foreach($jobtypes as $jobtype)
                            <option value="{{ $jobtype->id }}">{{ ucwords($jobtype->jobtype) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Application Type</label>
                        <select name="jobapplication" id="jobapplication" class="form-control select2" placeholder="Select Application Type">
                            <option value="">Select Application Type</option>
                            <option value="1">Quick Application</option>
                            <option value="2">Detail Application</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-3">
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
                <table class="table table-striped table-bordered table-sm" id="jobapplication-table">
                    <thead>
                        <th>S.No</th>
                        <th>Job Type</th>
                        <th>Email</th>
                        <th>C.V.</th>
                        <th>Quick Apply</th>
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
    var oTable = $('#jobapplication-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('jobapplication.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.jobtype = $('#jobtype').val();
                d.jobapplication = $('#jobapplication').val();
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'jobtype',
                name: 'jobtype'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'cv',
                name: 'cv',
                render: function(data, type, full, meta) {
                    if (data) {
                        return '<i class="fas fa-file-download"></i>';
                    }
                },
                render: function(data, type, full, meta) {
                    if (data) {
                        return `<a href="{{ url('/images/cvs/${data}') }}" download>
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-1x fa-lg" style="color:rgb(100, 100, 100);"></i>
                            <i class="fas fa-file-download fa-stack-1x fa-inverse" ></i>
                            </span>
                        </a>`;
                    } else {
                        return 'No C.V.';
                    }
                }
            },
            {
                data: 'quickapply',
                name: 'quickapply',
                render: function(data, type, full, meta) {
                    if (data == 'YES') {
                        return "<span class='right badge badge-success p-1'>" + data + "</span>";
                    } else {
                        return "<span class='right badge badge-danger p-1'>" + data + "</span>";
                    }
                }
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
    $('#jobtype').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#jobapplication').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection