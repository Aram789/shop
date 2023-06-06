<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    {{--    font-awesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    bootstrap@5.2.3--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- Aos--}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{--    Css--}}
    <link rel="stylesheet" href="{{asset('css/Light/app.css')}}">

    <!-- Scripts -->
    {{--Aos--}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{--    bootstrap@5.2.3--}}
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    {{--    jquery-3.7.0.--}}
    <script src="{{asset('js/jQuery.js')}}"></script>
    {{--    app.js--}}
    <script src="{{asset('js/Light/app.js')}}"></script>
</head>
<body>
<div class="loader">
    <div class="loader_container">
        <div class="lds-dual-ring"></div>
    </div>
</div>

<div id="app">
    <!-- Navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
            <div class="container"><a href="{{route('home')}}"
                                      class="navbar-brand text-uppercase font-weight-bold">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-between">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="{{route('home')}}"
                                                       class="nav-link text-uppercase font-weight-bold">Home
                                <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a href="{{route('about.light')}}"
                                                class="nav-link text-uppercase font-weight-bold">About</a></li>
                        <li class="nav-item"><a href="{{route('home')}}"
                                                class="nav-link text-uppercase font-weight-bold">Product</a>
                        </li>
                        <li class="nav-item"><a href="{{route('contact.light')}}"
                                                class="nav-link text-uppercase font-weight-bold">Contact</a>
                        </li>
                    </ul>
                    {{--  User--}}
                    <div class="d-flex">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn sign_in d-flex justify-content-center align-items-center"
                                       href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                    </a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown">
                                <button class="btn user_icon_container" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <strong>
                                        <svg fill="silver" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                             height="20px" width="20px">
                                            <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                            <path
                                                d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/>
                                        </svg>
                                    </strong>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="">{{ Auth::user()->name }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('favorites.light')}}">Favorites
                                            <span class="countFavorite">({{count($favorites?? [])}})</span>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                            {{--  Basket--}}
                            <a href="{{route('basket.light')}}">
                                <div
                                    class="btn position-relative d-flex align-items-center justify-content-center header_basket">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff"
                                         class="bi bi-basket" viewBox="0 0 16 16">
                                        <path
                                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <span class="basket_count text-white"> {{count($basketProducts ?? [])}}</span>
                                </div>
                            </a>

                        @endguest
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <main style="padding-top: 90px;">
        @yield('content')
        <a href="tel:{{env('ADMIN_TEL')}}" class="mobil_call_but align-items-center justify-content-center d-flex bg-white">
            <i class="fa-solid fa-phone fs-4"></i>
        </a>
    </main>
    <div class="footer-basic">
        <footer>
            <div class="social d-flex justify-content-center">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
            </div>
            <p class="copyright">Company Name © 2023</p>
        </footer>
    </div>
</div>
</body>
</html>
<script type="module">
    {{--window.basketCount = $('.basket_count');--}}
        {{--window.filterRoute = '{!! route('filters') !!}';--}}
        window.addTofavorites = '{!! route('favorites.light.add') !!}';
    window.removeFromfavorites = '{!! route('favorites.light.remove') !!}';
    window.basketAdd = '{!! route('basket.light.add') !!}';
    {{--window.basketQuantityMinus = '{!! route('basket.quantity_minus') !!}';--}}
        window.basketRemove = '{!! route('basket.light.remove') !!}';
    {{--window.order = '{!! route('order.index') !!}';--}}

</script>
