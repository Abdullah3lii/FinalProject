<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://www.tvtc.gov.sa/css/rayat.css"> -->

</head>


<body>
    <div id="app">



        <!-- Navigation -->
        <div class="navigation-wrap bg-light start-header border shadow sticky-top start-style">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light ">
                            <a class="navbar-brand" href="https://www.tvtc.gov.sa/" target="_blank"><img src="/images/tvtclogo1.jpg" alt="" /></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                    @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @endif

                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endguest
                                </ul>
                                <ul class="navbar-nav ml-auto py-4 py-md-0">
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4"><a class="nav-link" href="https://ugate.tvtc.gov.sa/AFrontGate/">البوابة الإلكترونية للقبول
                                        </a></li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4"><a class="nav-link" href="https://tvtc.gov.sa/pdf/TVTC-at-a-Glance-AR.pdf">تعرف علينا </a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide Show -->
        <!-- <section>
            <img class="mySlides" src="/images/G20.jpg" style="width:100%;  height:758px;">
            <img class="mySlides" src="/images/25.png" style="width:100%; height:758px;">
            <img class="mySlides" src="/images/31.png" style="width:100%; height:758px;">
        </section> -->

        <main class="py-4" style="text-align: right !important" dir="rtl">
            @yield('content')
        </main>


        <footer class="justify-content-end" dir="rtl">

            <div class="card bg-dark text-white">
                <img src="/images/background.jpg" style="height: 250px;" class="card-img" alt="...">
                <div class="card-img-overlay">

                    <div class="">

                        <p class="footer-copy-rights text-center">
                            © جميع الحقوق محفوظة - المؤسسة العامة للتدريب التقني والمهني 2020 ( TVTC )
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>



    <!-- <script>
        // Automatic Slideshow - change image every 3 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }
    </script> -->
</body>


</html>