<!-- HEADER AREA START (header-3) -->
<header class="ltn__header-area ltn__header-3 section-bg-6">
    <!-- ltn__header-top-area start -->
    <div class="ltn__header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="ltn__top-bar-menu">
                        <ul>
                            <li>
                                <a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you">
                                    <i class="icon-mail"></i> info@blri-ecom.com
                                </a>
                            </li>
                            <li>
                                <a href="locations.html"><i class="icon-placeholder"></i> Sever, Dhaka</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="top-bar-right text-right">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li>
                                    <!-- ltn__language-menu -->
                                    <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                        <ul>
                                            <li style="font-size: 14px">
                                                @auth
                                                    <p>{{ user()->name }}</p>
                                                @endauth
                                                @guest
                                                    <a href="javascript:;" data-toggle="modal"
                                                        data-target="#loginModal">Sign in</a>
                                                @endguest

                                            </li>
                                            {{-- <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                <ul>
                                                    <li><a href="#">Arabic</a></li>
                                                    <li><a href="#">Bengali</a></li>
                                                    <li><a href="#">Chinese</a></li>
                                                    <li><a href="#">English</a></li>
                                                    <li><a href="#">French</a></li>
                                                    <li><a href="#">Hindi</a></li>
                                                </ul>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <!-- ltn__social-media -->
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                            </li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                            </li>

                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-top-area end -->
    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="site-logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('frontend/img/logo.png') }}"
                                alt="Logo"></a>
                    </div>
                </div>
                <div class="col header-contact-serarch-column d-none d-lg-block">
                    <div class="header-contact-search">
                        <!-- header-feature-item -->
                        <div class="header-feature-item">
                            <div class="header-feature-icon">
                                <i class="icon-call"></i>
                            </div>
                            <div class="header-feature-info">
                                <h6>Phone</h6>
                                <p><a href="tel:0123456789">+0123-456-789</a></p>
                            </div>
                        </div>
                        <!-- header-search-2 -->
                        <div class="header-search-2">
                            <form id="#123" method="get" action="#">
                                <input type="text" name="search" value="" placeholder="Search here..." />
                                <button type="submit">
                                    <span><i class="icon-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- header-options -->
                    <div class="ltn__header-options">
                        <ul>
                            <li class="d-none">
                                <!-- ltn__currency-menu -->
                                <div class="ltn__drop-menu ltn__currency-menu">
                                    <ul>
                                        <li><a href="#" class="dropdown-toggle"><span
                                                    class="active-currency">USD</span></a>
                                            <ul>
                                                <li><a href="login.html">USD - US Dollar</a></li>
                                                <li><a href="wishlist.html">CAD - Canada Dollar</a></li>
                                                <li><a href="register.html">EUR - Euro</a></li>
                                                <li><a href="account.html">GBP - British Pound</a></li>
                                                <li><a href="wishlist.html">INR - Indian Rupee</a></li>
                                                <li><a href="wishlist.html">BDT - Bangladesh Taka</a></li>
                                                <li><a href="wishlist.html">JPY - Japan Yen</a></li>
                                                <li><a href="wishlist.html">AUD - Australian Dollar</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="d-lg-none">
                                <!-- header-search-1 -->
                                <div class="header-search-wrap">
                                    <div class="header-search-1">
                                        <div class="search-icon">
                                            <i class="icon-search  for-search-show"></i>
                                            <i class="icon-cancel  for-search-close"></i>
                                        </div>
                                    </div>
                                    <div class="header-search-1-form">
                                        <form id="#" method="get" action="#">
                                            <input type="text" name="search" value=""
                                                placeholder="Search here..." />
                                            <button type="submit">
                                                <span><i class="icon-search"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="d-none---">
                                <!-- user-menu -->
                                <div class="ltn__drop-menu user-menu">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i></a>
                                            <ul>
                                                @guest
                                                    <li><a href="javascript:;" data-toggle="modal"
                                                            data-target="#loginModal">Sign in</a></li>
                                                    <li><a href="{{ route('frontend.registerView') }}">Register</a></li>
                                                @endguest

                                                <li><a href="account.html">My Account</a></li>
                                                <li><a href="{{ route('frontend.wishlist.index') }}">Wishlist</a></li>
                                                @auth
                                                    <li><a href="{{ route('frontend.logout') }}">Logout</a></li>
                                                @endauth
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <!-- mini-cart 2 -->
                                <div class="mini-cart-icon mini-cart-icon-2">
                                    <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle" id="cart">
                                        <span class="mini-cart-icon">
                                            <i class="icon-shopping-cart"></i>
                                            <sup>0</sup>
                                        </span>
                                        <h6><span>Your Cart</span> <span class="ltn__secondary-color">&#2547; 0</span>
                                        </h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ltn__header-middle-area end -->
    <!-- header-bottom-area start -->
    <div
        class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg--- section-bg-1 menu-color-white--- d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col header-menu-column justify-content-center">
                    <div class="sticky-logo">
                        <div class="site-logo">
                            <a href="index.html"><img src="{{ asset('frontend/img/logo.png') }}" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="header-menu header-menu-2">
                        <nav>
                            <div class="ltn__main-menu">
                                <ul>
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                    <li class="menu-icon"><a href="#">Products</a>
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li><a href="{{ route('productByCat', $category->id) }}">{{ $category->name }}
                                                        @if ($category->subCategories->count() > 0)
                                                            <span class="float-right">
                                                                <i class="fa-solid fa-chevron-right"></i>
                                                            </span>
                                                        @endif
                                                    </a>
                                                    @if ($category->subCategories->count() > 0)
                                                        <ul>
                                                            @foreach ($category->subCategories as $subCategory)
                                                                <li><a href="{{ route('productBySubCat', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-bottom-area end -->
</header>
<!-- HEADER AREA END -->
<!-- Utilize Cart Menu Start -->
<div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
    <div class="ltn__utilize-menu-inner ltn__scrollbar">
        <div class="ltn__utilize-menu-head">
            <span class="ltn__utilize-menu-title">Cart</span>
            <button class="ltn__utilize-close">??</button>
        </div>
        <div id="cartMenu"></div>

    </div>
</div>
<!-- Utilize Cart Menu End -->
