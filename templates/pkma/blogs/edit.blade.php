@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($blog, ['route' => ['blogs.update', $blog->id], 'method' => 'patch']) !!}

        @include('blogs.fields')

    {!! Form::close() !!}
</div>
@endsection
