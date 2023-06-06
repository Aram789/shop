<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{--    font-awesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    bootstrap@5.2.3--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{--  noUiSlider  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.css"
          integrity="sha512-MKxcSu/LDtbIYHBNAWUQwfB3iVoG9xeMCm32QV5hZ/9lFaQZJVaXfz9aFa0IZExWzCpm7OWvp9zq9gVip/nLMg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    Css--}}
    <link rel="stylesheet" href="{{asset('css/Dark/app.css')}}">


    <!-- Scripts -->

    {{--    jquery-3.7.0.--}}
    <script src="{{asset('js/jQuery.js')}}"></script>
    <script src="//code.jivo.ru/widget/Kx2acLBOIv" async></script>
    {{--  noUiSlider  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"
            integrity="sha512-UOJe4paV6hYWBnS0c9GnIRH8PLm2nFK22uhfAvsTIqd3uwnWsVri1OPn5fJYdLtGY3wB11LGHJ4yPU1WFJeBYQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--    bootstrap@5.2.3--}}
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    {{--    app.js--}}
    <script src="{{asset('js/Dark/app.js')}}"></script>
</head>
<body>
<div class="loader">
    <div class="loader_container">
        <div class="lds-dual-ring"></div>
    </div>
</div>
@if(\Illuminate\Support\Facades\Auth::check())

    <div class="modal fade" id="small_basket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Ваша корзина</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body small-basket">
                    @component('Dark.components.small-basket', ['basket' => $basketProducts])@endcomponent
                </div>
            </div>
        </div>
    </div>
@endif


<div id="app">
    <header>
        <div class="container">
            {{--            header--}}
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('home')}}">Shop</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between gap-2" id="navbarTogglerDemo02">
                        <section class="pages">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ url('/') }}">Products</a>
                                </li>
                            </ul>
                        </section>
                        <section class="search py-1">
                            <form>
                                <input class="form-control" type="search" placeholder="Search"
                                       aria-label="Search">
                            </form>
                        </section>
                        <section class="d-flex">
                            {{--  Basket--}}
                            <div
                                class="btn btn-outline-danger position-relative d-flex align-items-center justify-content-center header_basket"
                                data-bs-toggle="modal" data-bs-target="#small_basket">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-basket" viewBox="0 0 16 16">
                                    <path
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                <span class="basket_count"> {{count($basketProducts ?? [])}}</span>
                            </div>
                            {{--  Favorites--}}
                            <a class="nav-link mx-2" href="{{route('favorites')}}">
                                <div
                                    class="header_favorite btn btn-outline-warning d-flex align-items-center justify-content-center">
                                    <svg fill="silver" height="20px" width="20px" version="1.1" id="Layer_1"
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         viewBox="0 0 501.28 501.28" xml:space="preserve">
                                            <g>
                                                <polygon
                                                    points="501.28,194.37 335.26,159.33 250.64,12.27 250.64,419.77 405.54,489.01 387.56,320.29 	"></polygon>
                                                <polygon
                                                    points="166.02,159.33 0,194.37 113.72,320.29 95.74,489.01 250.64,419.77 250.64,12.27 	"></polygon>
                                            </g>
                                    </svg>
                                </div>
                            </a>
                            {{--  User--}}
                            <div class="d-flex">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-outline-danger sign_in d-flex justify-content-center align-items-center"
                                               href="{{ route('login') }}">
                                                <i class="fa-solid fa-right-to-bracket"></i>
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle user_icon_container" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
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
                                                <a class="dropdown-item" href="{{route('order.history')}}">History</a>
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
                                @endguest
                            </div>
                        </section>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main style="padding-top: 90px;">
        @yield('content')
        <a href="tel:{{env('ADMIN_TEL')}}" class="mobil_call_but align-items-center justify-content-center d-flex bg-white">
            <i class="fa-solid fa-phone fs-4"></i>
        </a>
    </main>
    <footer class="py-3 my-4">
        <div class="container">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="{{route('home')}}" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">© 2023 Company, Inc</p>
        </div>
    </footer>
</div>
</body>
</html>
<script type="module">
    window.basketCount = $('.basket_count');
    window.filterRoute = '{!! route('filters') !!}';
    window.addTofavorites = '{!! route('favorites.add') !!}';
    window.removeFromfavorites = '{!! route('favorites.remove') !!}';
    window.basketAdd = '{!! route('basket.add') !!}';
    window.basketQuantityMinus = '{!! route('basket.quantity_minus') !!}';
    window.basketRemove = '{!! route('basket.remove') !!}';
    window.order = '{!! route('order.index') !!}';

</script>
