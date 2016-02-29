<section id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                @if($parent)
                <h1 class="breadcrumb__header">{{ $parent }}</h1>
                @else
                <h1 class="breadcrumb__header">{{ $title }}</h1>
                @endif()
            </div>
            @if($useForm)
            <div class="col-sm-5">
                <form action="{{ Route::getCurrentRoute()->getPath() }}" method="GET" class="breadcrumb__form form-inline text-right" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="sort">label</label>
                        {!! Form::select('sort', [
                            '' => 'Filter',
                            'newest' => 'Sort by newest',
                            'oldest' => 'Sort by oldest'
                        ], Request::get('sort'), ['class' => 'form-control', 'id' => 'input']) !!}
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="query">label</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="" placeholder="Search" name="query" value="{{ Request::get('query') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default breadcrumb__button" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
            @if($parent)
            <li>
                <a href="{{ $parent_route }}">{{ $parent }}</a>
            </li>
            <li class="active">
                {{ $title }}
            </li>
            @else
            <li class="active">
                {{ $title }}
            </li>
            @endif
        </ol>
    </div>
</section>