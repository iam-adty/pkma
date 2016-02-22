@extends('layouts.app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">News</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('news.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($news->isEmpty())
                <div class="well text-center">No News found.</div>
            @else
                @include('news.table')
            @endif
        </div>

        @include('common.paginate', ['records' => $news])


    </div>
@endsection
