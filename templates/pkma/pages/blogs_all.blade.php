@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => 'Blogs',
    'parent' => false,
    'parent_route' => route('blogs_page_path'),
    'useForm' => true
])

<section class="section onepage" id="blog">
    <div class="container-fluid">

        @foreach($blogs->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $blog)
            <article class="col-sm-4 blog__article">
                <img src="{{ url('images/blogs-all') . '/' . $blog->image }}" alt="" class="img-responsive center-block">
                <div class="blog__match--height">
                    <img src="{{ url('images/alumni-all') . '/' . $blog->user->photo }}" alt="" class="circle-photo img-circle">
                    <h3 class="custom-heading">
                        <a href="{{ route('blogs_single_path', [$blog->slug]) }}">{{ str_limit($blog->title, 45) }}</a>
                    </h3>
                    <div class="text-identifier ellipsis">
                        <h4 class="ellipsis">
                            <a href="{{ route('alumni_single_path', [$blog->user->slug]) }}">
                                {{ $blog->user->name }}
                            </a>
                        </h4>
                        <small>
                            <time datetime="{{ $blog->updated_at }}" pubdate="">{{ dateHuman($blog->updated_at) }}</time>
                        </small>
                    </div>
                    <p>{{ str_limit($blog->teaser, 430) }}</p>
                    <a href="{{ route('blogs_single_path', [$blog->slug]) }}">Read More</a>
                </div>
            </article>
            @endforeach
        </div>
        @endforeach

        <div class="block text-center">
            <nav>
                {{ $blogs->render() }}
            </nav>
        </div>
    </div>
</section>
@stop
