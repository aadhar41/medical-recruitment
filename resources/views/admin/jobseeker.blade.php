@extends('layouts.app')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('partials._messages')

        <!-- Small boxes (Stat box) -->
        @include('partials._adminStats')
    </div>

</section>

@endsection