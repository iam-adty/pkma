@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => $alumnus->name,
    'parent' => 'Alumni',
    'parent_route' => route('alumni_page_path'),
    'useForm' => false
])

<section class="section onepage" id="alumni">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{ url('images/alumni-single') . '/' . $alumnus->photo }}" alt="" class="img-responsive center-block">
            </div>
            <div class="col-sm-8">
                <ul class="list-unstyled alumni__info--bigger">
                    <li class="ellipsis"><strong>{{ $alumnus->name }}</strong></li>
                    <li class="ellipsis"><strong>Angkatan</strong> : {{ $alumnus->start_year }}</li>
                    <li class="ellipsis"><strong>Jurusan</strong> : {{ $alumnus->department->name }}</li>
                    <li class="ellipsis">
                        <strong>Pemilik</strong> :
                        {{ $alumnus->brand->last() ? $alumnus->brand->last()->title : '-' }}
                    </li>
                </ul>
                <p>{{ $alumnus->description }}</p>
            </div>
        </div>
        @if($alumnus->brand->last())
        <div class="row alumnisingle__brand">
            <div class="col-sm-8 col-center">
                <div class="row alumnisingle__brand--header">
                    <div class="col-xs-3">
                        <img src="{{ url('images/brands-logo-all') . '/' . $alumnus->brand->last()->logo }}" alt="" class="img-responsive img-circle center-block border-circle">
                    </div>
                    <div class="col-xs-9">
                        <h4>Owner of</h4>
                        <h3>{{ $alumnus->brand->last()->title }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p>{{ $alumnus->brand->last()->body }}</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="gallery row">
            <div class="col-xs-12">
                <h2 class="custom-heading">Gallery</h2>
                <div class="row">
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_1.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_1.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_2.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_2.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_3.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_3.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_4.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_4.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_5.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_5.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a class="image-popup-vertical-fit" href="{{ url('images') . '/' . 'dummy-images/brand_1.jpg' }}">
                            <img src="{{ url('images/brands-all') . '/' . 'dummy-images/brand_1.jpg' }}" alt="" class="img-responsive center-block">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="promo row">
            <div class="col-xs-10 col-center">
                <h2 class="custom-heading">Blogs</h2>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-sm-4">
                        <img src="{{ url('images/blogs-all') . '/' . $blog->image }}" alt="" class="img-responsive center-block">
                        <h4 class="custom-heading">
                            <a href="{{ route('blogs_single_path', [$blog->slug]) }}">{{ str_limit($blog->title, 45) }}</a>
                        </h4>
                        <small>
                            <time datetime="{{ $blog->updated_at }}" pubdate="">{{ dateHuman($blog->updated_at) }}</time>
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </div>
</section>
@stop
