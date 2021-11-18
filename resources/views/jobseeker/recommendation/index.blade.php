@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')

@include('partials._select2Assests')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if (( Auth::user()->role == "2"))
                <a href="{{ route('admin.recommendation.create') }}" class="btn btn-primary">
                    <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                    Create Job
                </a>
                @endif
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.recommendation.list') }}" class="btn btn-primary">
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
            <div class="row" style="margin-bottom:10px;">
                <div class="col-lg-12 text-muted">
                    <div class="col-lg-4">
                        <h3>FILTERS</h3>
                    </div>
                </div>

            </div>

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
                        <label>Job Category</label>
                        <select name="jobcategory" id="jobcategory" class="form-control select2" placeholder="Select Job Category">
                            <option value="">Select Job Category</option>
                            @foreach($jobcategories as $jobcategory)
                            <option value="{{ $jobcategory->id }}">{{ ucwords($jobcategory->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Medical Center</label>
                        <select name="medicalcenter" id="medicalcenter" class="form-control select2" placeholder="Select Medical Center">
                            <option value="">Select Medical Center</option>
                            @foreach($medicalcenters as $medicalcenter)
                            <option value="{{ $medicalcenter->id }}">{{ ucwords($medicalcenter->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Profession</label>
                        <select name="profession" id="profession" class="form-control select2" placeholder="Select Profession">
                            <option value="">Select Profession</option>
                            @foreach($professions as $profession)
                            <option value="{{ $profession->id }}">{{ ucwords($profession->profession) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Speciality</label>
                        <select name="speciality" id="speciality" class="form-control select2" placeholder="Select Speciality">
                            <option value="">Select Speciality</option>
                            @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ ucwords($speciality->specialty) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>State</label>
                        <select name="state" id="state" class="form-control select2" placeholder="Select State">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ ucwords($state->name) }}</option>
                            @endforeach
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

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="services-table">
                    <thead>
                        <th>S.No</th>
                        <th>Job Type</th>
                        <th>Job Category</th>
                        <th>Medical Center</th>
                        <th>Profession</th>
                        <th>Speciality</th>
                        <th>State</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<?php /* ?>
</form>
<?php */ ?>

<script>
    var oTable = $('#services-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('job.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.jobtype = $('#jobtype').val();
                d.jobcategory = $('#jobcategory').val();
                d.medicalcenter = $('#medicalcenter').val();
                d.profession = $('#profession').val();
                d.speciality = $('#speciality').val();
                d.state = $('#state').val();
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
                data: 'jobcategory',
                name: 'jobcategory'
            },
            {
                data: 'medicalcenter',
                name: 'medicalcenter'
            },
            {
                data: 'profession',
                name: 'profession'
            },
            {
                data: 'speciality',
                name: 'speciality'
            },
            {
                data: 'state',
                name: 'state'
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
    $('#jobcategory').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#medicalcenter').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#profession').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#speciality').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#state').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection