@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($slider, ['route' => ['sliders.update', $slider->id], 'method' => 'patch']) !!}

        @include('sliders.fields')

    {!! Form::close() !!}
</div>
@endsection
