<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Our Viva Store</title>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400|Lato:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    @yield('styles')
</head>
<body id="home">
    @include('front_end.navigation')
    @yield('content')
    @include('front_end.footer')

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('js/vendor/jquery/jquery.js') }}"><\/script>')</script>
    @yield('scripts')
    <script src="{{ elixir('js/app.js') }}"></script>
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
</body>
</html>
