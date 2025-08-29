{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Our Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <style>
        /* Product Card */
        .product-card {
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #fff;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            transition: transform 0.3s;
        }

        .product-card img:hover {
            transform: scale(1.05);
        }

        .btn-cart {
            font-size: 1.2rem;
            color: #333;
            background: none;
            border: none;
        }

        /* Modal */
        #productModal .modal-body {
            gap: 2rem;
            display: flex;
            flex-wrap: wrap;
        }

        #productModal img {
            max-width: 100%;
            border-radius: 12px;
        }

        #productModal h3 {
            font-weight: 700;
        }

        #productModal p {
            color: #555;
        }

        #productModal input[type="number"] {
            max-width: 80px;
        }

        @media (max-width: 768px) {
            #productModal .modal-body {
                flex-direction: column;
            }

            #productModal img {
                margin-bottom: 1rem;
            }
        }
    </style>
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
                    <a href="{{ url('/products') }}">Products</a>
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

    <!-- Products -->
    <div class="container py-5">
        <h2 class="text-center mb-5">✨ Our Products ✨</h2>
        <div class="row g-4 justify-content-center" id="product-list">
            <!-- Products injected via JS -->
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="modal-body d-flex flex-wrap align-items-start">
                    <img id="modal-img" class="rounded mb-3 mb-md-0 me-md-4" style="flex:1 1 40%;" alt="">
                    <div style="flex:1 1 50%;">
                        <h3 id="modal-name"></h3>
                        <p id="modal-desc"></p>
                        <h4 class="text-primary" id="modal-price"></h4>
                        <div class="d-flex gap-2 align-items-center mt-3">
                            <input type="number" id="modal-quantity" value="1" min="1"
                                class="form-control">
                            <button class="btn btn-success" id="add-to-cart-btn">Add to Cart</button>
                            <button class="btn btn-primary" id="buy-now-btn">Buy Now</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table" id="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items injected via JS -->
                        </tbody>
                    </table>
                    <h5 class="text-end">Grand Total: $<span id="grand-total">0</span></h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" id="checkout-btn">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const products = [{
                id: 1,
                name: 'Face Cream',
                desc: 'Hydrating face cream for glowing skin.',
                price: 15.99,
                img: 'img/lipstic.jpeg'
            },
            {
                id: 2,
                name: 'Milk Chocolate',
                desc: 'Sweet and creamy chocolate delight.',
                price: 4.5,
                img: 'img/lipstic.jpeg'
            },
            {
                id: 3,
                name: 'Dark Chocolate',
                desc: 'Rich and delicious dark chocolate.',
                price: 5.5,
                img: 'img/lipstic.jpeg'
            },
            {
                id: 4,
                name: 'Lipstick',
                desc: 'High quality matte lipstick.',
                price: 12.99,
                img: 'img/lipstic.jpeg'
            },
        ];

        const cart = [];
        const productList = document.getElementById('product-list');
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));
        const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
        const modalImg = document.getElementById('modal-img');
        const modalName = document.getElementById('modal-name');
        const modalDesc = document.getElementById('modal-desc');
        const modalPrice = document.getElementById('modal-price');
        const modalQuantity = document.getElementById('modal-quantity');
        const cartCount = document.getElementById('cart-count');

        // Render products
        products.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-lg-3 col-md-4 col-sm-6';
            col.innerHTML = `
                <div class="product-card">
                    <img src="${product.img}" class="img-fluid rounded mb-3" alt="${product.name}">
                    <h5>${product.name}</h5>
                    <p class="text-muted">${product.desc}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="fw-bold text-primary">$${product.price}</span>
                        <button class="btn-cart" data-id="${product.id}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </div>
            `;
            productList.appendChild(col);
        });

        function updateCartCount() {
            const total = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = total;
        }

        function renderCart() {
            const tbody = document.querySelector('#cart-table tbody');
            tbody.innerHTML = '';
            let grandTotal = 0;
            cart.forEach(item => {
                const total = item.price * item.quantity;
                grandTotal += total;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.name}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>$${total.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm remove-btn">Remove</button></td>
                `;
                tr.querySelector('.remove-btn').addEventListener('click', () => {
                    const index = cart.findIndex(p => p.id === item.id);
                    if(index !== -1){
                        cart.splice(index, 1);
                        updateCartCount();
                        renderCart();
                    }
                });
                tbody.appendChild(tr);
            });
            document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
        }

        // Cart button click
        document.getElementById('cart-btn').addEventListener('click', () => {
            renderCart();
            cartModal.show();
        });

        // Product modal add to cart / buy now
        document.querySelectorAll('.btn-cart').forEach(btn => {
            btn.addEventListener('click', () => {
                const product = products.find(p => p.id == btn.dataset.id);
                modalImg.src = product.img;
                modalName.textContent = product.name;
                modalDesc.textContent = product.desc;
                modalPrice.textContent = '$' + product.price;
                modalQuantity.value = 1;
                productModal.show();

                document.getElementById('add-to-cart-btn').onclick = () => {
                    const quantity = parseInt(modalQuantity.value);
                    const existing = cart.find(item => item.id === product.id);
                    if (existing) {
                        existing.quantity += quantity;
                    } else {
                        cart.push({...product, quantity });
                    }
                    updateCartCount();
                    alert(`${quantity} x ${product.name} added to cart!`);
                };

                document.getElementById('buy-now-btn').onclick = () => {
                    alert(`Proceeding to buy ${modalQuantity.value} x ${product.name}`);
                };
            });
        });
    </script>
</body>

</html> --}}
