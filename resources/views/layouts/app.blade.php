<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CosmoChoco</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Header / Navbar -->
    <header>
        <div class="container navbar-container d-flex justify-content-between align-items-center py-2">
            <!-- Logo aligned left -->
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Store Logo">
                <h1>CosmoChoco</h1>
            </div>

            <!-- Centered Search Bar -->
            <div class="flex-grow-1 mx-3" style="max-width:300px;">
                <div class="input-group">
                    <input type="text" id="search-input" class="form-control" placeholder="Search products...">
                    <button class="btn btn-outline-secondary" id="search-btn">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Links + Cart -->
            <div class="d-flex align-items-center gap-3">

                <!-- Cart Button -->
                <button id="cart-btn"
                    style="border:none; background:none; padding:0; cursor:pointer; position:relative;">
                    <i class="fa-solid fa-cart-shopping" style="font-size:1.2rem;"></i>
                    <span id="cart-count"
                        style="position:absolute; top:-5px; right:-10px; background:red; color:white; border-radius:50%; padding:2px 6px; font-size:0.7rem;">0</span>
                </button>

                <!-- Navbar Links -->
                <nav class="d-flex align-items-center gap-2">
                    <a href="{{ url('/') }}">Home</a>

                    <!-- Products Dropdown -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="{{ url('/products') }}" id="productsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="{{ url('/products?category=skincare') }}">Skincare</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/products?category=makeup') }}">Makeup</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ url('/products?category=chocolates') }}">Chocolates</a></li>
                            <li><a class="dropdown-item" href="{{ url('/products?category=perfumes') }}">Perfumes</a>
                            </li>
                        </ul>
                    </div>

                    @auth
                        <!-- User/Admin Dropdown -->
                        <div class="dropdown">
                            <a class="dropdown-toggle fw-bold" href="#" role="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->role === 'admin')
                                    Admin
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/admin/profile') }}">Edit Profile</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ url('/user/profile') }}">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/user/orders') }}">My Orders</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                                        @csrf
                                        <button class="btn btn-link p-0" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endauth
                </nav>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">

                <!-- About -->
                <div class="col-md-4 mb-4">
                    <h5>About CosmoChoco</h5>
                    <p>Delivering the finest cosmetics and chocolates right to your doorstep. Quality you can trust.</p>
                </div>

                <!-- Newsletter Subscription -->
                <div class="col-md-4 mb-4">
                    <h5>Subscribe to Our Newsletter</h5>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-warning" type="submit">Subscribe</button>
                        </div>
                        <small class="text-light">Get exclusive offers & latest updates.</small>
                    </form>
                </div>

                <!-- Contact -->
                <div class="col-md-4 mb-4">
                    <h5>Contact Us</h5>
                    <p><i class="fas fa-envelope"></i> support@cosmochoco.com</p>
                    <p><i class="fas fa-phone-alt"></i> +880 1874004733</p>
                    <div class="d-flex gap-2 mt-2">
                        <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

            </div>

            <hr class="border-light">

            <div class="text-center">
                <p class="mb-0">&copy; 2025 CosmoChoco | All Rights Reserved</p>
            </div>
        </div>
    </footer>

</body>

</html>
