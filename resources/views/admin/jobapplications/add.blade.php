@extends('layouts.app')

@section('content')

<form action="{{ route('admin.job.store') }}" method="POST" enctype="multipart/form-data">
    {{ method_field('POST') }}
    @csrf
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.job.list') }}" class="btn btn-primary">
                        <i class="right fas fa-angle-left fa-lg"></i>&nbsp;
                        Jobs Listing
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="job_type">Job Type :</label>
                            <select name="job_type" id="job_type" class="form-control {{ $errors->has('job_type') ? 'is-invalid' : '' }}">
                                <option value="">Select Job Type</option>
                                @foreach($jobtypes as $jobtype)
                                <option value="{{ $jobtype->id }}" {{ (old("job_type") == $jobtype->id ? "selected":"") }}>{{ ucwords($jobtype->jobtype) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_type'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('job_type') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="job_category">Job Category :</label>
                            <select name="job_category" id="job_category" class="form-control {{ $errors->has('job_category') ? 'is-invalid' : '' }}">
                                <option value="">Select Job Category</option>
                                @foreach($jobcategories as $jobcategory)
                                <option value="{{ $jobcategory->id }}" {{ (old("job_category") == $jobcategory->id ? "selected":"") }}>{{ ucwords($jobcategory->name) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_category'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('job_category') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="medical_center">Medical Centers :</label>
                            <select name="medical_center" id="medical_center" class="form-control {{ $errors->has('medical_center') ? 'is-invalid' : '' }}">
                                <option value="">Select Medical Center</option>
                                @foreach($medicalcenters as $center)
                                <option value="{{ $center->id }}" {{ (old("medical_center") == $center->id ? "selected":"") }}>{{ ucwords($center->name) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('medical_center'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('medical_center') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="profession">Profession :</label>
                            <select name="profession" id="profession" class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}">
                                <option value="">Select Profession</option>
                                @foreach($professions as $profession)
                                <option value="{{ $profession->id }}" {{ (old("profession") == $profession->id ? "selected":"") }}>{{ ucwords($profession->profession) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('profession'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('profession') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="speciality">Speciality :</label>
                            <select name="speciality" id="speciality" class="form-control {{ $errors->has('speciality') ? 'is-invalid' : '' }}">
                                <option value="">Select Speciality</option>
                                @foreach($specialities as $speciality)
                                <option value="{{ $speciality->id }}" {{ (old("speciality") == $speciality->id ? "selected":"") }}>{{ ucwords($speciality->specialty) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('speciality'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('speciality') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">States :</label>
                            <select name="state" id="state" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}">
                                <option value="">Select States</option>
                                @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ (old("state") == $state->id ? "selected":"") }}>{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('state') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div id="city_div" class="col-md-4">
                        <div class="form-group">
                            <label for="city">Cities :</label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>

                    <div id="suburb_div" class="col-md-4">
                        <div class="form-group">
                            <label for="suburb">Suburbs :</label>
                            <select name="suburb" id="suburb" class="form-control">
                                <option value="">Select Suburb</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rate">Rate :</label>
                            <input type="text" name="rate" value="{{ old('rate') }}" id="rate" class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" placeholder="Rate" autocomplete="off" />
                            @if($errors->has('rate'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('rate') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="work_days">Work Days :</label>
                            <input type="text" name="work_days" value="{{ old('work_days') }}" id="work_days" class="form-control {{ $errors->has('work_days') ? 'is-invalid' : '' }}" placeholder="Work Days" autocomplete="off" />
                            @if($errors->has('work_days'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('work_days') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">Title :</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title" autocomplete="off" />
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date :</label>
                            <div class='input-group date'>
                                <input type="text" name="from_date" class="form-control" id="datepicker1" placeholder="YYYY-MM-DD" value="{{ old('from_date') }}">
                                @if($errors->has('from_date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('from_date') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>To Date : </label>
                            <div class='input-group date'>
                                <input type="text" name="to_date" class="form-control" id="datepicker2" placeholder="YYYY-MM-DD" value="{{ old('to_date') }}">
                                @if($errors->has('to_date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('to_date') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>

        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">

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
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <textarea name="address" id="address" rows="3" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Address">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea name="description" id="description" rows="3" class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="practice_offer">Practices Offer :</label>
                            <textarea name="practice_offer" id="practice_offer" rows="3" class="form-control ckeditor {{ $errors->has('practice_offer') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('practice_offer') }}</textarea>
                            @if($errors->has('practice_offer'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('practice_offer') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="essential_criteria">Essential Criteria :</label>
                            <textarea name="essential_criteria" id="essential_criteria" rows="3" class="form-control ckeditor {{ $errors->has('essential_criteria') ? 'is-invalid' : '' }}" placeholder="Essential Criteria">{{ old('essential_criteria') }}</textarea>
                            @if($errors->has('essential_criteria'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('essential_criteria') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </section>
</form>


<script>
    $(document).ready(function() {
        var states_id = $("#state").val();

        $('#state').on('change', function() {
            var state_id = this.value;
            getcities(state_id);
            getasuburbs(state_id);
        });

        function getcities(state_id) {
            $.ajax({
                url: "{!! route('getcities') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
                    label: 1,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'html',
                success: function(result) {
                    $("#city_div").html(result);
                }
            });
        }

        function getasuburbs(state_id) {
            $.ajax({
                url: "{!! route('getasuburbs') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
                    label: 1,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'html',
                success: function(result) {
                    $("#suburb_div").html(result);
                }
            });
        }

    });

    $(function() {
        $("#datepicker1").datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "+0:+5",
        });
    });

    $(function() {
        $("#datepicker2").datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "+0:+5",
        });
    });
</script>
@include('partials._ckeditor')
@endsection