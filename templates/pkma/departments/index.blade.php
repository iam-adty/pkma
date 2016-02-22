@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Departments</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('departments.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($departments->isEmpty())
                <div class="well text-center">No Departments found.</div>
            @else
                @include('departments.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $departments])


    </div>
@endsection
