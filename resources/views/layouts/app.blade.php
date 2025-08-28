<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetics & Chocolate Store</title>
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
                        <a href="{{ url('/my-orders') }}">My Orders</a>
                        <form style="display:inline;" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-logout btn btn-link p-0">Logout</button>
                        </form>
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
    <footer>
        <p>&copy; 2025 Cosmetics & Chocolate Store | All Rights Reserved</p>
    </footer>
</body>

</html>
