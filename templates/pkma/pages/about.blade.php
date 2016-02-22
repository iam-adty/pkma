@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => 'About Us',
    'parent' => false,
    'parent_route' => route('about_page_path'),
    'useForm' => false
])

<section class="section onepage" id="about">

</section>
@stop
