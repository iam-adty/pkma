@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => 'News',
    'parent' => false,
    'parent_route' => route('news_page_path'),
    'useForm' => true
])

<section class="section onepage" id="news">
    <div class="container-fluid">

        @foreach($news as $key => $news_item)
        <article class="row news__article">
            <div class="news__match--height {{ isEven($key, 'col-sm-push-6') }} col-sm-6 news__article--image" style="background-image: url({{ url('images/news-all') . '/' . $news_item->image }});">
            </div>
            <div class="news__match--height {{ isEven($key, 'col-sm-pull-6') }} col-sm-6 news__article--content">
                <h3 class="custom-heading">
                    <a href="{{ route('news_single_path', [$news_item->slug]) }}">{{ $news_item->title }}</a>
                </h3>
                <small>
                    <time datetime="{{ $news_item->updated_at }}" pubdate="">{{ dateHuman($news_item->updated_at) }}</time>
                </small>
                <p>{{ $news_item->teaser }}</p>
                <a href="{{ route('news_single_path', [$news_item->slug]) }}">Read More</a>
            </div>
        </article>
        @endforeach

        <div class="block text-center">
            <nav>
                {{ $news->render() }}
            </nav>
        </div>
    </div>
</section>
@stop
