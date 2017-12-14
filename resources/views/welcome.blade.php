<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/full-slider.css" rel="stylesheet">

</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">link hauler</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ route('social.login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            @endauth
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($links as $link)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $link->id }}" class="active"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach ($links as $key => $link)
                @if ( $key == 0)

                    <div class="carousel-item active" style="background-image: url('https://picsum.photos/1080/1900/?image=0')">
                        <a href="{{ $link->url }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>
                                    <img src="https://www.google.com/s2/favicons?domain={{ $link->url }}"> {{ $link->title }}
                                </h3>
                                <p>{{  $link->description }}</p>
                            </div>
                        </a>
                    </div>
                @else

                    <div class="carousel-item" style="background-image: url('https://picsum.photos/1080/1900/?image={{ $link->id }}')">
                        <a href="{{ $link->url }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>
                                    <img src="https://www.google.com/s2/favicons?domain={{ $link->url }}"> {{ $link->title }}
                                </h3>
                                <p>{{  $link->description }}</p>
                            </div>
                        </a>
                    </div>

                @endif
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- Page Content -->
<section class="py-5">
    <div class="container">
        This website features up to 10 links at a time. Feel to register for free in order to add your own link(s) to the showcase.
    </div>
</section>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Paul Kronabethleitner 2017</p>
    </div>
    <!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
