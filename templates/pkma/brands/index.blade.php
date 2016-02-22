@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Brands</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('brands.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($brands->isEmpty())
                <div class="well text-center">No Brands found.</div>
            @else
                @include('brands.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $brands])


    </div>
@endsection
