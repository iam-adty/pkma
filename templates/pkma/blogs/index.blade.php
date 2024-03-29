@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Blogs</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('blogs.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($blogs->isEmpty())
                <div class="well text-center">No Blogs found.</div>
            @else
                @include('blogs.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $blogs])


    </div>
@endsection
