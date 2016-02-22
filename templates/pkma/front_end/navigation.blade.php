<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home_page_path') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="" class="img-responsive">
                </a>
            </div>
            <div id="myNavbar" class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ hybridRoute('home_page_path', '#home') }}">Home</a>
                    </li>
                    <li class="{{ areActiveRoutes(['about_page_path']) }}">
                        <a href="{{ route('about_page_path') }}">About Us</a>
                    </li>
                    <li class="{{ areActiveRoutes(['news_page_path', 'news_single_path']) }}">
                        <a href="{{ route('news_page_path') }}">News</a>
                    </li>
                    <li class="{{ areActiveRoutes(['blogs_page_path', 'blogs_single_path', 'alumni_page_path']) }}">
                        <a href="{{ route('blogs_page_path') }}">Blogs</a>
                    </li>
                    <li class="{{ areActiveRoutes(['brands_page_path', 'brands_single_path']) }}">
                        <a href="{{ route('brands_page_path') }}">Brands</a>
                    </li>
                    <li>
                        <a href="{{ hybridRoute('home_page_path', '#job-board') }}">Jobs</a>
                    </li>
                    <li>
                        <a href="{{ hybridRoute('home_page_path', '#contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
