@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => $blog_item->title,
    'parent' => 'Blogs',
    'parent_route' => route('blogs_page_path'),
    'useForm' => false
])

<section class="section onepage" id="blogsSingle">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="header-container">
                    <img src="{{ url('images/news-single') . '/' . $blog_item->image }}" alt="" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-center">
                <div class="title-container" id="blog">
                    <h1 class="custom-heading">{{ $blog_item->title }}</h1>
                    <div class="text-identifier">
                        <h4 class="ellipsis">
                            <a href="{{ route('alumni_single_path', [$blog_item->user->slug]) }}">
                                {{ $blog_item->user->name }}
                            </a>
                        </h4>
                        <small>
                            <time datetime="{{ $blog_item->updated_at }}" pubdate="">{{ dateHuman($blog_item->updated_at) }}</time>
                        </small>
                    </div>
                    <p>
                        {{ $blog_item->body }}
                    </p>
                </div>
            </div>
        </div>

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
                                    <img src="{{ url('images/alumni-all-large') . '/' . $blog_item->user->photo }}" alt="" class="img-responsive center-block img-circle">
                                </div>
                                <div class="col-sm-8">
                                    <ul class="list-unstyled ">
                                        <li class="ellipsis"><strong>{{ $blog_item->user->name }}</strong></li>
                                        <li class="ellipsis"><strong>Angkatan</strong> : {{ $blog_item->user->start_year }}</li>
                                        <li class="ellipsis"><strong>Jurusan</strong> : {{ $blog_item->user->department->name }}</li>
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

        @if(count($blogs) > 0)
        <section class="promo row">
            <div class="col-xs-10 col-center">
                <h2 class="custom-heading">Other blogs</h2>
                <div class="row">
                    @foreach($blogs as $blog_item_bottom)
                    <div class="col-sm-4">
                        <img src="{{ url('images/blogs-all') . '/' . $blog_item_bottom->image }}" alt="" class="img-responsive center-block">
                        <h4 class="custom-heading">
                            <a href="{{ route('blogs_single_path', [$blog_item_bottom->slug]) }}">{{ str_limit($blog_item_bottom->title, 45) }}</a>
                        </h4>
                        <small>
                            <time datetime="{{ $blog_item_bottom->updated_at }}" pubdate="">{{ dateHuman($blog_item_bottom->updated_at) }}</time>
                        </small>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <section class="section mt2" id="subscribe">
            <h2>Subscribe Newsletter</h2>
            <div class="container">
                <form action="#" method="POST" class="form-horizontal" role="form">
                    <div class="col-sm-9 col-center">
                        <div class="form-group">
                            <input type="text" name="email" id="inputEmail" class="form-control input-lg form__big--rounded" value="" required="required" pattern="" title="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="block text-center">
                            <button type="submit" class="btn btn-lg btn-outline--pink">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
</section>
@stop
