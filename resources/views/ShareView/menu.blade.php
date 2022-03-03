<nav class="navbar navbar-expand-lg">
    <div class="container position-relative">
        <a class="navbar-brand p-0" href="{{ route('index') }}">
            <img src="{{ (isset($getLogoAndPath) ? $getLogoAndPath : '') }}" width="300" alt=" ">
        </a> <!-- Logo -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> <!-- navbar toggler -->

        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="@yield('activePageIndex')" href="{{ route('index') }}"> <i class="fa fa-home" style="font-size:25px;"></i> </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="@yield('activePageAbout')">About us</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('about') }}">Cheltrad Education</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="@yield('activePageServices')">Services</a>
                    <ul class="sub-menu">
                        @if(isset($allProduct))
                            @foreach ($allProduct as $item)
                                <li><a href="{{ route($item->product_code) }}">{{ $item->product_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#">Resources</a>
                    <ul class="sub-menu">
                        <li><a href="#">Free Downloads</a></li>
                        <li><a href="#">Video Tutorials</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}">contact us</a>
                </li>
                @if(!Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('login') }}">My Account</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('home') }}" title="My account" class="btn-sm btn btn-outline-info">
                            <small>Hi, {{ substr(Auth::user()->name, 0, 6) }}</small>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-outline-secondary btn-sm" title="Logout"><i class="fa fa-sign-out x2"></i></a>
                    </li>
                    @if(isset($cartCounter))
                    <li class="nav-item">
                        <a href="{{ route('viewCart') }}">
                            <span class="fa fa-shopping-cart text-danger fa-2x">
                                <sup class="bg-danger text-white rounded-circle p-1" style="font-size: 14px;"> {{ isset($cartCounter) ? ($cartCounter) : 0 }} </sup>
                            </span>
                        </a>
                    </li>
                    @endif
                @endif
            </ul>
        </div> <!-- navbar collapse -->
        <!--<div class="navbar-btn d-none d-sm-block">
            <a href="#" class="main-btn">Donate for Child</a>
        </div>--> <!-- navbar-btn -->
    </div> <!-- container -->
</nav> <!-- navbar -->
