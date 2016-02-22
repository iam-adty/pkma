@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'sliders.store']) !!}

        @include('sliders.fields')

    {!! Form::close() !!}
</div>
@endsection
