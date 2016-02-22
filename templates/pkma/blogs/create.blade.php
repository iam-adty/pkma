@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'blogs.store']) !!}

        @include('blogs.fields')

    {!! Form::close() !!}
</div>
@endsection
