@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Sliders</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('sliders.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($sliders->isEmpty())
                <div class="well text-center">No Sliders found.</div>
            @else
                @include('sliders.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $sliders])


    </div>
@endsection
