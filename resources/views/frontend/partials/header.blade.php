<div class="container-fluid">
    <div class="row py-3 border-bottom">

        <div class="col-sm-4 col-lg-3 text-center text-sm-start">
            <div class="main-logo">
                <a href="{{ route('frontend.index') }}">
                    <img src="{{ asset('front_assets') }}/images/logo.png" alt="logo" class="img-fluid">
                </a>
            </div>
        </div>

        <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
            <div class="search-bar row bg-light p-2 my-2 rounded-4">
                <div class="col-md-4 d-none d-md-block">
                    <select class="form-select border-0 bg-transparent">
                        <option>All Categories</option>
                        <option>Groceries</option>
                        <option>Drinks</option>
                        <option>Chocolates</option>
                    </select>
                </div>
                <div class="col-11 col-md-7">
                    <form id="search-form" class="text-center" action="index.html" method="post">
                        <input type="text" class="form-control border-0 bg-transparent"
                            placeholder="Search for more than 20,000 products" />
                    </form>
                </div>
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
            <!-- Support Box -->
            <div class="support-box text-end d-none d-xl-block">
                <span class="fs-6 text-muted">For Support?</span>
                <h5 class="mb-0">+980-34984089</h5>
            </div>

            @auth
<!-- Authenticated User -->
<ul class="d-flex justify-content-end list-unstyled m-0">
    <li>
        <div class="dropdown">
            <a href="#" class="rounded-circle bg-light p-2 mx-1" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="#user"></use>
                </svg>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('frontend.order') }}">View Orders</a></li>
                <li><a class="dropdown-item" href="#">Profile Details</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                @if(auth()->user()->hasRole('admin'))
                    <li><a class="dropdown-item" href="{{ route('home') }}">Go to Dashboard</a></li>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li>
                        <button type="submit" class="dropdown-item w-100 text-start border-0 bg-transparent">Logout</button>
                    </li>
                </form>
            </ul>
        </div>
    </li>
    <li>
        <a href="#" class="rounded-circle bg-light p-2 mx-1">
            <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#heart"></use>
            </svg>
        </a>
    </li>
    <li class="d-lg-none">
        <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
            <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#cart"></use>
            </svg>
        </a>
    </li>
    <li class="d-lg-none">
        <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
            <svg width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="#search"></use>
            </svg>
        </a>
    </li>
</ul>

<div class="cart text-end d-none d-lg-block dropdown">
    <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
        <span class="fs-6 text-muted dropdown-toggle">Your Cart</span>
        <span class="cart-total fs-5 fw-bold">${{ number_format(array_sum(array_map(function($item) {
            return ($item['price'] ?? $item->price) * ($item['quantity'] ?? $item->quantity);
        }, $cartItems->toArray())), 2) }}</span>
    </button>
</div>
@else
<!-- Guest User -->
<ul class="d-flex justify-content-end list-unstyled m-0">
    <li>
        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3 py-2 mx-1 text-white">
            Login
        </a>
    </li>
    <li>
        <a href="{{ route('register') }}" class="btn btn-secondary rounded-pill px-3 py-2 mx-1 text-white">
            Register
        </a>
    </li>
</ul>

@endauth

        </div>


    </div>
</div>
<div class="container-fluid">
    <div class="row py-3">
        <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
            <nav class="main-menu d-flex navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header justify-content-center">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">

                        <select class="filter-categories border-0 mb-0 me-5">
                            <option>Shop by Departments</option>
                            <option>Groceries</option>
                            <option>Drinks</option>
                            <option>Chocolates</option>
                        </select>

                        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                            <li class="nav-item active">
                                <a href="#women" class="nav-link">Women</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#men" class="nav-link">Men</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kids" class="nav-link">Kids</a>
                            </li>
                            <li class="nav-item">
                                <a href="#accessories" class="nav-link">Accessories</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" id="pages"
                                    data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu" aria-labelledby="pages">
                                    <li><a href="index.html" class="dropdown-item">About Us </a></li>
                                    <li><a href="index.html" class="dropdown-item">Shop </a></li>
                                    <li><a href="index.html" class="dropdown-item">Single Product </a></li>
                                    <li><a href="index.html" class="dropdown-item">Cart </a></li>
                                    <li><a href="index.html" class="dropdown-item">Checkout </a></li>
                                    <li><a href="index.html" class="dropdown-item">Blog </a></li>
                                    <li><a href="index.html" class="dropdown-item">Single Post </a></li>
                                    <li><a href="index.html" class="dropdown-item">Styles </a></li>
                                    <li><a href="index.html" class="dropdown-item">Contact </a></li>
                                    <li><a href="index.html" class="dropdown-item">Thank You </a></li>
                                    <li><a href="index.html" class="dropdown-item">My Account </a></li>
                                    <li><a href="index.html" class="dropdown-item">404 Error </a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#brand" class="nav-link">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="#sale" class="nav-link">Sale</a>
                            </li>
                            <li class="nav-item">
                                <a href="#blog" class="nav-link">Blog</a>
                            </li>
                        </ul>

                    </div>

                </div>
        </div>
    </div>
</div>
