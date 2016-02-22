@extends('front_end.master')

@section('content')

@include('front_end.breadcrumb', [
    'title' => 'Alumni',
    'parent' => false,
    'parent_route' => route('alumni_page_path'),
    'useForm' => true
])

<section class="section onepage" id="alumni">
    <div class="container">

        @foreach($alumni->chunk(2) as $key => $chunk)
        <div class="row no-gutter alumni__row">
            @foreach($chunk as $alumnus)
                @if((($key) % 2) == 0)
                <div class="col-sm-3 alumnus__photo">
                    <img src="{{ url('images/alumni-all-large') . '/' . $alumnus->photo }}" alt="" class="img-responsive center-block">
                </div>
                <div class="col-sm-3 alumnus__info">
                    <div class="alumnus__info--container">
                        <ul class="list-unstyled ">
                            <li class="ellipsis"><span>{{ $alumnus->name }}</span></li>
                            <li class="ellipsis"><span>Angkatan</span> : {{ $alumnus->start_year }}</li>
                            <li class="ellipsis"><span>Jurusan</span> : {{ $alumnus->department->name }}</li>
                            <li class="ellipsis">
                                <span>Pemilik</span> :
                                {{ $alumnus->brand->last() ? $alumnus->brand->last()->title : '-' }}
                            </li>
                        </ul>
                        <a href="{{ route('alumni_single_path', [$alumnus->slug]) }}">Detail</a>
                    </div>
                </div>
                @else
                <div class="col-sm-3 alumnus__photo col-sm-push-3">
                    <img src="{{ url('images/alumni-all-large') . '/' . $alumnus->photo }}" alt="" class="img-responsive center-block">
                </div>
                <div class="col-sm-3 alumnus__info col-sm-pull-3">
                    <div class="alumnus__info--container">
                        <ul class="list-unstyled ">
                            <li class="ellipsis"><span>{{ $alumnus->name }}</span></li>
                            <li class="ellipsis"><span>Angkatan</span> {{ $alumnus->start_year }}</li>
                            <li class="ellipsis"><span>Jurusan</span> {{ $alumnus->department->name }}</li>
                            <li class="ellipsis">
                                <span>Pemilik</span>
                                {{ $alumnus->brand->last() ? $alumnus->brand->last()->title : '-' }}
                            </li>
                        </ul>
                        <a href="{{ route('alumni_single_path', [$alumnus->slug]) }}">Detail</a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        @endforeach

        <div class="block text-center">
            <nav>
                {{ $alumni->render() }}
            </nav>
        </div>
    </div>
</section>
@stop
