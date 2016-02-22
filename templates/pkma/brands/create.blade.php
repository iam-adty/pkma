@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'brands.store']) !!}

        @include('brands.fields')

    {!! Form::close() !!}
</div>
@endsection
