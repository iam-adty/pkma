@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'departments.store']) !!}

        @include('departments.fields')

    {!! Form::close() !!}
</div>
@endsection
