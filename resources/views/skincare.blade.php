@extends('layouts.app')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/home.css') }}" rel="stylesheet">



<!-- ===== Skincare Products ===== -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">✨ Skincare Products ✨</h2>
        <div class="row g-4" id="skincare-list">
            <!-- Skincare products injected via JS -->
        </div>
    </div>
</section>

<!-- ===== Product Modal ===== -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-body d-flex flex-wrap align-items-start">
                <img id="modal-img" class="rounded mb-3 mb-md-0 me-md-4" style="flex:1 1 40%;" alt="">
                <div style="flex:1 1 50%;">
                    <h3 id="modal-name"></h3>
                    <p id="modal-desc"></p>
                    <h4 class="text-primary" id="modal-price"></h4>
                    <div class="mt-3">
                        <input type="number" id="modal-quantity" value="1" min="1" class="form-control mb-2" style="max-width:120px;">

                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-success btn-lg w-100" id="add-to-cart-btn">Add to Cart</button>
                            <button class="btn btn-primary btn-lg w-100" id="buy-now-btn">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== Cart Modal ===== -->
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


<!-- ===== Scripts ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const skincareProducts = [
        { id: 101, name: 'Hydrating Face Cream', desc: 'Moisturizes and refreshes skin.', price: 19.99, img: '/img/facecream.jpeg' },
        { id: 102, name: 'Aloe Vera Gel', desc: 'Soothes and repairs skin naturally.', price: 12.50, img: '/img/aloevera.jpeg' },
        { id: 103, name: 'Vitamin C Serum', desc: 'Brightens and evens skin tone.', price: 24.99, img: '/img/serum.jpeg' },
        { id: 104, name: 'Sunscreen SPF 50', desc: 'Protects skin from harmful UV rays.', price: 15.00, img: '/img/sunscreen.jpeg' }
    ];

    const cart = [];
    const skincareList = document.getElementById('skincare-list');
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
    const modalImg = document.getElementById('modal-img');
    const modalName = document.getElementById('modal-name');
    const modalDesc = document.getElementById('modal-desc');
    const modalPrice = document.getElementById('modal-price');
    const modalQuantity = document.getElementById('modal-quantity');
    const cartCount = document.getElementById('cart-count');

    // Render skincare products
    function renderProducts(list, container) {
        container.innerHTML = '';
        list.forEach(product => {
            const col = document.createElement('div');
            col.className = 'col-lg-3 col-md-4 col-sm-6';
            col.innerHTML = `
                <div class="card h-100 shadow-sm">
                    <img src="${product.img}" class="card-img-top" alt="${product.name}">
                    <div class="card-body text-center">
                        <h5>${product.name}</h5>
                        <p class="text-muted small">${product.desc}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-primary">$${product.price}</span>
                            <button class="btn btn-sm btn-success btn-cart" data-id="${product.id}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(col);
        });
    }

    renderProducts(skincareProducts, skincareList);

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

    // Open cart
    document.getElementById('cart-btn').addEventListener('click', () => {
        renderCart();
        cartModal.show();
    });

    // Product modal
    document.addEventListener('click', (e) => {
        if(e.target.closest('.btn-cart')){
            const id = e.target.closest('.btn-cart').dataset.id;
            const product = skincareProducts.find(p => p.id == id);

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
        }
    });
</script>
@endsection
