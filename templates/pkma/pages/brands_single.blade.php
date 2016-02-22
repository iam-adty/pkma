@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => $brand->title,
    'parent' => 'Brands',
    'parent_route' => route('brands_page_path'),
    'useForm' => false
])

<section class="section onepage" id="brandsSingle">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="header-container">
                    <img src="{{ url('images/brands-single') . '/' . $brand->image }}" alt="" class="img-responsive">
                    <img src="{{ url('images/brands-logo-single') . '/' . $brand->logo }}" alt="" class="circle-photo-relative img-circle center-block">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-center">
                <div class="title-container">
                    <h1 class="custom-heading text-center">{{ $brand->title }}</h1>
                    <h2 class="custom-heading no-ornament text-center">
                        <a href="{{ route('alumni_single_path', [$brand->user->slug]) }}">
                            {{ $brand->user->name }}
                        </a>
                    </h2>
                    <p>
                        {{ $brand->body }}
                    </p>
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
        <div class="block text-center">
            <nav>
                {{-- $galleries->render() --}}
            </nav>
        </div>
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
    </div>
</section>
<section class="container-fluid interested text-center">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="interested__text">
                Are you interested?
            </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-outline btn-outline--white" id="interested__btn">Yes</a>
        </div>
    </div>
</section>
<div id="hidden-container" class="hidden">
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-center text-center">
                    <h2>Contact Us</h2>
                    <div class="contact__information row">
                        <div class="col-sm-4">
                            <i class="glyphicon glyphicon-map-marker tosca"></i>
                        </div>
                        <div class="col-sm-8 text-left">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Jl. Alamat</p>
                                    <p>Malang, Jawa Timur</p>
                                    <p>Indonesia</p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Email : hello@email.com</p>
                                    <p>Telepon : +62 341 464318</p>
                                    <p>Faksimile : +62 341 464318</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat nobis explicabo aut eius, illo fugit, necessitatibus quod. Ullam eum consectetur obcaecati, fugit, sint consequuntur consequatur reiciendis quod, sunt iusto vitae.</p>

                    <!-- Button navigation -->
                    <ul class="btn-group btn-group-justified list-unstyled btn-group-m1" role="group" aria-label="...">
                        <li class="btn-group" role="group">
                            <a href="#maps" aria-controls="maps" role="tab" data-toggle="tab" class="btn btn-outline--tosca">
                                <i class="hidden-md hidden-lg glyphicon glyphicon-map-marker"></i>
                                <span class="hidden-xs hidden-sm">Maps</span>
                            </a>
                        </li>
                        <li class="btn-group" role="group">
                            <a href="http://arianraptor.com" target="_blank" class="btn btn-outline--tosca">
                                <i class="hidden-md hidden-lg glyphicon glyphicon-envelope"></i>
                                <span class="hidden-xs hidden-sm">Go to website</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-left">
                        <div role="tabpanel" class="tab-pane" id="maps">
                            <div class="text-center">
                                <h4>Maps</h4>
                                <iframe id="map-canvas" width="100%" frameborder="0" style="border:0"src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCohjAtjotCdhEPB7-5i_m-CzDzg07vH8M&q=Universitas+Muhammadiyah+Malang" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="share text-center">
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_sharing_toolbox"></div>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56b19c7887e81a37" async="async"></script>
    </section>
    <section class="section onepage">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-center">
                    <div class="alumnus__information">
                        <h3>About Alumnus</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ url('images/alumni-all-large') . '/' . $brand->user->photo }}" alt="" class="img-responsive center-block img-circle">
                            </div>
                            <div class="col-sm-8">
                                <ul class="list-unstyled ">
                                    <li class="ellipsis"><strong>{{ $brand->user->name }}</strong></li>
                                    <li class="ellipsis"><strong>Angkatan</strong> : {{ $brand->user->start_year }}</li>
                                    <li class="ellipsis"><strong>Jurusan</strong> : {{ $brand->user->department->name }}</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui voluptate architecto suscipit. Voluptate ipsam dolor vel, ex, dolores maiores modi fugiat doloremque saepe reiciendis non? Fuga odio ipsa expedita accusamus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores quisquam eos possimus repellat beatae maxime aspernatur consectetur, distinctio reiciendis dolorem earum non dolor inventore, assumenda, itaque ab. Vel, nostrum, similique.</p>
                            </div>
                        </div>
                        <a href="{{ route('alumni_page_path') }}" class="btn btn-outline--gray">See All Alumni</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
