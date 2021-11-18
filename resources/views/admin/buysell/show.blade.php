@extends('layouts.app')

@section('content')

<section class="content">
    <div class="card ">
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
            <div class="text-muted justify-content-center d-flex pb-3 mb-2 pt-3 bg-light css-label-badge">
                <h3 class=""><strong>BUY / SELL ( PROPERTY ) DETAILS</strong></h3>
            </div>
            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Code</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->unique_code !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Posted By</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->createdBy->name !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Type</dt>
                <dd class="col-sm-8">
                    {!! $bstype[$buysell->type] !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Property Type</dt>
                <dd class="col-sm-8">
                    {!! $property_type[$buysell->property_type] !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Promotional Flag</dt>
                <dd class="col-sm-8 text-muted">{!! $promotional_flag[$buysell->promotional_flag] !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">State</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->associatedState->name !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">City</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->associatedCity->name !!}</dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Suburb</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->associatedSuburb->suburb !!}</dd>
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>MORE DETAILS</strong>
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

            <dl class="row">
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Price</dt>
                <dd class="col-sm-8 text-muted">$ {!! $buysell->price !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Title</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->title !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Description</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->description !!} </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Number</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->number !!}</dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Email</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->email !!} </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Rating</dt>
                <dd class="col-sm-8 text-muted">{!! $buysell->rating !!} </dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Order</dt>
                <dd class="col-sm-8 text-muted">
                    {!! $buysell->order !!}
                </dd>
                <dd class="col-sm-8 offset-sm-4"></dd>
                <dt class="col-sm-4 bg-light text-muted color-palette p-2">Entry Created</dt>
                <dd class="col-sm-8 text-muted"> {!! $buysell->created_at !!} </dd>

            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

    <div class="card ">
        <div class="card-header">
            <h3 class="card-title text-muted pt-2">
                <strong>IMAGES</strong>
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

            <dl class="row">
                @foreach($buysell->associatedImages as $key => $val)
                <dd class="col-sm-4 text-muted pt-2 ">
                    <span class="css-label-badge text-uppercase">Image - {{ $key+1 }}</span>
                    <?php if (str_contains($val->file, 'unsplash') || str_contains($val->file, 'lorempixel') || str_contains($val->file, 'placeholder') || str_contains($val->file, 'robohash')) { ?>
                        <img src="{{$val->file}}" class="img-fluid" alt="Image" style="height:100px;" />
                    <?php } else { ?>
                        <img src="{{$buysell->imageurl().$val->file}}" class="img-fluid img-thumbnail" alt="Image" style="height:250px;" />
                    <?php } ?>
                </dd>
                @endforeach
            </dl>
        </div>

        <div class="card-footer">
            &nbsp;
        </div>

    </div>

</section>

@endsection