@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($brand, ['route' => ['brands.update', $brand->id], 'method' => 'patch']) !!}

        @include('brands.fields')

    {!! Form::close() !!}
</div>
@endsection
