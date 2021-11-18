@extends('layouts.app')

@section('content')
<?php
$bstype = Config::get('constants.bstype');
$property_type = Config::get('constants.property_type');
$promotional_flag = Config::get('constants.promotional_flag');
?>
<form action="{{ route('admin.buysell.update', $listings->id) }}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    @csrf
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.buysell.list') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left"></i> &nbsp;Listing
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
                            <label for="type">TYPE (&nbsp;BUY / SELL&nbsp;) :</label>
                            <select name="type" id="type" class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                <option value="">Select Type</option>
                                @foreach($bstype as $id => $type)
                                <option value="{{ $id }}" {{ (old("type", $listings->type) == $id ? "selected":"") }}> {{ ucwords($type) }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('type'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('type') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="property_type">PROPERTY TYPE :</label>
                            <select name="property_type" id="property_type" class="form-control select2 {{ $errors->has('property_type') ? 'is-invalid' : '' }}">
                                <option value="">Select Property Type</option>
                                @foreach($property_type as $id => $type)
                                <option value="{{ $id }}" {{ (old("property_type",$listings->property_type) == $id ? "selected":"") }}>{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('property_type'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('property_type') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="promotional_flag">PROMOTIONAL FLAG :</label>
                            <select name="promotional_flag" id="promotional_flag" class="form-control select2 {{ $errors->has('promotional_flag') ? 'is-invalid' : '' }}">
                                <option value="">Select Promotional Flag</option>
                                @foreach($promotional_flag as $id => $type)
                                <option value="{{ $id }}" {{ (old("promotional_flag", $listings->promotional_flag) == $id ? "selected":"") }}>{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('promotional_flag'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('promotional_flag') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">STATES :</label>
                            <select name="state" id="state" class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}">
                                <option value="">Select States</option>
                                @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ (old("state", $listings->state_id) == $state->id ? "selected":"") }}>{{ ucwords($state->name) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('state') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="state_id" id="state_id" value="<?php echo $listings->state_id; ?>" />
                    <input type="hidden" name="city_id" id="city_id" value="<?php echo $listings->city_id; ?>" />
                    <input type="hidden" name="suburb_id" id="suburb_id" value="<?php echo $listings->suburb_id; ?>" />

                    <div id="city_div" class="col-md-4">
                        <div class="form-group">
                            <label for="city">Cities :</label>
                            <select name="city" id="city" class="form-control select2">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>

                    <div id="suburb_div" class="col-md-4">
                        <div class="form-group">
                            <label for="suburb">Suburbs :</label>
                            <select name="suburb" id="suburb" class="form-control select2">
                                <option value="">Select Suburb</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">PRICE :</label>
                            <input type="text" name="price" value="{{ old('price', $listings->price) }}" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Price" autocomplete="off" />
                            @if($errors->has('price'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">TITLE :</label>
                            <input type="text" name="title" value="{{ old('title',$listings->title) }}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Title" autocomplete="off" />
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="number">NUMBER :</label>
                            <input type="text" name="number" value="{{ old('number',$listings->number) }}" id="number" class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" placeholder="Number" autocomplete="off" />
                            @if($errors->has('number'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('number') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">E-MAIL :</label>
                            <input type="text" name="email" value="{{ old('email',$listings->email) }}" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="E-Mail" autocomplete="off" />
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">IMAGES :</label>
                            <input type="file" name="images[]" id="image" class="form-control" multiple />
                            <br />
                            @if($errors->has('image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('image') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="order">ORDER :</label>
                            <input type="text" name="order" value="{{ old('order',$listings->order) }}" id="order" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" placeholder="Order" autocomplete="off" />
                            @if($errors->has('order'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('order') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description-text">DESCRIPTION :</label>
                            <textarea name="description" id="description-text" rows="10" class="ckeditor form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Description">{{ old('description', $listings->description) }}</textarea>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <dl class="row">
                            @foreach($listings->associatedImages as $key => $val)
                            <dt class="col-sm-3 bg-light text-muted text-center text-uppercase color-palette p-2">Image - {{ $key+1 }}</dt>
                            <dd class="col-sm-3 text-muted pt-2 justify-content-center">
                                <?php if (str_contains($val->file, 'unsplash') || str_contains($val->file, 'lorempixel') || str_contains($val->file, 'placeholder') || str_contains($val->file, 'robohash')) { ?>
                                    <img src="{{$val->file}}" class="img-fluid" alt="Image" style="height:100px;" />
                                <?php } else { ?>
                                    <img src="{{$listings->imageurl().$val->file}}" class="img-fluid img-thumbnail mb-2" alt="Image" style="height:100px;" />
                                    <input type="text" name="<?php echo $val->id; ?>_order_image" value="{{ old('$val->id_order_image',$val->order) }}" id="<?php echo $val->id; ?>_order_image" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" placeholder="Order" autocomplete="off" />
                                <?php } ?>
                            </dd>
                            @endforeach
                        </dl>
                    </div>


                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="far fa-hand-point-up"></i>&nbsp;&nbsp;Update</button>
            </div>

        </div>

    </section>
</form>

<script>
    $(document).ready(function() {
        var states_id = $("#state").val();
        var city_id = $("#city").val();
        var suburb_id = $("#suburb").val();
        editgetcities(states_id, city_id, suburb_id);
        editgetasuburbs(states_id, city_id, suburb_id);

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

        function editgetcities(state_id, city_id, suburb_id) {
            $.ajax({
                url: "{!! route('editgetcities') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
                    city_id: city_id,
                    suburb_id: suburb_id,
                    label: 1,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'html',
                success: function(result) {
                    $("#city_div").html(result);
                }
            });
        }

        function editgetasuburbs(state_id, city_id, suburb_id) {
            $.ajax({
                url: "{!! route('editgetasuburbs') !!}",
                type: "POST",
                data: {
                    state_id: state_id,
                    city_id: city_id,
                    suburb_id: suburb_id,
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