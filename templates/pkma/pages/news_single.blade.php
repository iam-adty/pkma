@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => $news_item->title,
    'parent' => 'News',
    'parent_route' => route('news_page_path'),
    'useForm' => false
])

<section class="section onepage" id="newsSingle">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="header-container">
                    <img src="{{ url('images/news-single') . '/' . $news_item->image }}" alt="" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-center">
                <div class="title-container" id="blog">
                    <h1 class="custom-heading">{{ $news_item->title }}</h1>
                    <div class="text-identifier">
                        <h4 class="ellipsis">
                            <a href="#">Administrator</a>
                        </h4>
                        <small>
                            <time datetime="{{ $news_item->updated_at }}" pubdate="">{{ dateHuman($news_item->updated_at) }}</time>
                        </small>
                    </div>
                    <p>
                        {{ $news_item->body }}
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

        @if(count($news) > 0)
        <section class="promo row">
            <div class="col-xs-10 col-center">
                <h2 class="custom-heading">Other News</h2>
                <div class="row">
                    @foreach($news as $news_item_bottom)
                    <div class="col-sm-4">
                        <img src="{{ url('images/news-all') . '/' . $news_item_bottom->image }}" alt="" class="img-responsive center-block">
                        <h4 class="custom-heading">
                            <a href="{{ route('news_single_path', [$news_item_bottom->slug]) }}">{{ str_limit($news_item_bottom->title, 45) }}</a>
                        </h4>
                        <small>
                            <time datetime="{{ $news_item_bottom->updated_at }}" pubdate="">{{ dateHuman($news_item_bottom->updated_at) }}</time>
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
