<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            eO<span><b>cambo</b></span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Fields</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#productPages" role="button" aria-expanded="false" aria-controls="productPages">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Manage Products</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="productPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">Products</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#categoryPages" role="button" aria-expanded="false" aria-controls="categoryPages">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Manage Categories</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="categoryPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">Categories</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">Transaction</li>
            <li class="nav-item">
                <a href="/reservation/index" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Reservation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
