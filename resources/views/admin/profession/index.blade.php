@extends('layouts.app')

@section('content')

@include('partials._datatableAssets')
@include('partials._select2Assests')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if (( Auth::user()->role == "1"))
                <a href="{{ route('admin.profession.create') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                    Add Record
                </a>
                @endif
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.profession.list') }}" class="btn btn-primary">
                    <i class="fas fa-recycle"></i>&nbsp;
                    Clear Search
                </a>
                &nbsp;
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
                        <label>Profession </label>
                        <input type="text" name="profession" id="profession" placeholder="Profession" class="form-control" autocomplete="off" />
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
                <table class="table table-striped table-bordered table-sm" id="services-table">
                    <thead>
                        <th>S.No</th>
                        <th>Profession</th>
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
            url: "{!! route('profession.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.profession = $('#profession').val();
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'profession',
                name: 'profession'
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
    $('#profession').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection