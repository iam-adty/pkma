@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => 'Brands',
    'parent' => false,
    'parent_route' => route('brands_page_path'),
    'useForm' => true
])

<section class="section onepage" id="brand">
    <div class="container-fluid">
        @foreach($brands->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $brand)
            <div class="col-sm-4">
                <a href="{{ route('brands_single_path', [$brand->slug]) }}">
                    <img src="{{ url('images/brands-all') . '/' . $brand->image }}" alt="" class="img-responsive center-block">
                </a>
                <div class="description brand__match--height">
                    <img src="{{ url('images/brands-logo-all') . '/' . $brand->logo }}" alt="" class="circle-photo-custom img-circle">
                    <h3 class="custom-heading">
                        <a href="{{ route('brands_single_path', [$brand->slug]) }}">{{ str_limit($brand->title, 45) }}</a>
                    </h3>
                    <p>{{ str_limit($brand->teaser, 200) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

        <div class="block text-center">
            <nav>
                {{ $brands->render() }}
            </nav>
        </div>
    </div>
</section>
@stop
