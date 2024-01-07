@php
    $currentPath = request()->path();
    $userCekLog = Session::get('userLoggedIn');
@endphp
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="/"><img src="{{ asset('img/logo-full.png') }}" width="150px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ ($currentPath == '/') ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item {{ (Str::contains($currentPath, 'products')) ? 'active' : '' }} submenu dropdown">
                            <a href="/products" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href=" {{url('/products')}} ">All Products</a></li>
                                <li class="nav-item"><a class="nav-link" href=" {{url('/products/new-arrival')}} ">New Arrival</a></li>
                                <li class="nav-item"><a class="nav-link" href=" {{url('/products/best-seller')}} ">Best Seller</a></li>
                                <li class="nav-item"><a class="nav-link" href=" {{ route('flashsale') }} ">Flash Sale</a></li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item {{ ($currentPath == '/contact') ? 'active' : '' }}">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="/cart" class="cart"><span class="ti-bag"></span></a>
                        </li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                        @if ($userCekLog == null)
                        <li class="nav-item">
                            <a href="/login" class="enter"><span class="lnr lnr-enter"></span></a>
                        </li>
                        @endif
                    </ul>
                    @if ($userCekLog != null)
                    <ul class="nav navbar-nav menu_nav ml-4">
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="lnr lnr-user" id="profile"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" style="margin-left: -9rem">
                                <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="/orders">Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('user-logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between" action="/search" method="post">
                <input type="text" class="form-control" id="search_input" name="search" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
