@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'patch']) !!}

        @include('departments.fields')

    {!! Form::close() !!}
</div>
@endsection
