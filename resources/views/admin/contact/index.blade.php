@extends('layouts.app')

@section('content')
@include('partials._datatableAssets')
@include('partials._select2Assests')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.contact.list') }}" class="btn btn-primary">
                    <i class="fas fa-recycle"></i>&nbsp;
                    Clear Search
                </a>
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
            <div class="row col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number </label>
                        <input type="text" name="number" id="number" placeholder="Number" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email </label>
                        <input type="text" name="email" id="email" placeholder="E-mail" class="form-control" autocomplete="off" />
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
                <table class="table table-striped table-bordered table-sm" id="contact-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>E-Mail</th>
                        <th>Subject</th>
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
    var oTable = $('#contact-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('contact.datatables') !!}",
            data: function(d) {
                d.name = $('#name').val();
                d.number = $('#number').val();
                d.email = $('#email').val();
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
                data: 'number',
                name: 'number'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'subject',
                name: 'subject'
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

    $('#name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#number').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#email').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection