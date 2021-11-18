@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if (( Auth::user()->role == "1"))
                <a href="{{ route('admin.jobtype.create') }}" class="btn btn-primary">
                    <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                    Add JobType
                </a>
                @endif
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
            <div class="row" style="margin-bottom:10px;">
                <div class="col-lg-12 text-muted">
                    <div class="col-lg-4">
                        <h3>FILTERS</h3>
                    </div>
                </div>

            </div>

            <div class="row col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>JobType </label>
                        <input type="text" name="jobtype" id="jobtype" placeholder="Job Type" class="form-control" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" placeholder="Select Status">
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
            url: "{!! route('jobtype.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.jobtype = $('#jobtype').val();
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
    $('#jobtype').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection