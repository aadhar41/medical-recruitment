@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        @include('partials._messages')

        <!-- Small boxes (Stat box) -->
        @include('partials._adminStats')

    </div><!-- /.container-fluid -->

</section>
<!-- /.content -->
@endsection