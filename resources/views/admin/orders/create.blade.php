<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kopi PPKDJ Jakarta Pusat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f5f6f8;
            font-family: Arial, Helvetica, sans-serif;
        }

        .category-btn {
            background-color: white;
            color: #7A9E5B;
            border: 1px solid #7A9E5B;
        }

        .category-btn.active {
            background-color: #7A9E5B;
            color: white;
        }

        .category-btn:hover {
            background-color: #7A9E5B;
            color: white;
            border-color: #7A9E5B;
        }

        .payment-card {
            border: 2px solid transparent;
            border-radius: 15px;
            transition: 0.2s;
            overflow: hidden;
        }

        .payment-card.selected-cash {
            background-color: #198754 !important;
            color: white !important;
        }

        .payment-card.selected-midtrans {
            background-color: #0d6efd !important;
            color: white !important
        }

        .product-card {
            border: none;
            border-radius: 15px;
            transition: 0.2s;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 80px 20px rgba (0, 0, 0, 0.10);
        }

        .product-image {
            height: 130px;
            display: flex;
            /* align-items: center; */
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product.item {
            cursor: pointer;
        }

        .price {
            color: #6f4e37;
            font-weight: bold;
        }

        .cart-box {
            position: sticky;
            top: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            cart-item: last-child;
            border-bottom: none;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            border-radius: 50%;
        }

        .total-price {
            font-size: 25px;
            font-weight: bold;
            color: #6f4e37;
        }

        .payment-btn {
            border-radius: 10px;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    <script type="text/javascript"
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>



</head>

<body>
    <div class="container-fluid">
        <main class="col-lg-12 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Point of Sales</h3>
                    <p class="text-muted">POS - Toko Kopi PPKD Jakarta Pusat</p>
                </div>
                <button type="button" class="btn btn-dark" onclick="clearCart()">Empty Cart</button>
            </div>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-primary text-white rounded p-3">
                                    🛒
                                </div>
                            </div>

                            <div>
                                <small class="text-muted">Today Transaction</small>
                                <h4 class="mb-0 fw-bold" id="todayTransaction">Rp 0</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-success text-white rounded p-3">
                                    💰
                                </div>
                            </div>

                            <div>
                                <small class="text-muted">Today Income</small>
                                <h4 class="mb-0 fw-bold" id="todayIncome">Rp 0</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-warning text-white rounded p-3">
                                    📦
                                </div>
                            </div>

                            <div>
                                <small class="text-muted">Total Sold Today</small>
                                <h4 class="mb-0 fw-bold" id="todayProduct">Rp 0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class=col-md-7>
                                    <h5 class="fw-bold">Select Product</h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="searchProduct" class="form-control"
                                        onkeyup="searchProduct()" placeholder="Search Product...">
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-sm me-1 category-btn" onclick="filterCategory('all', this)"
                                        data-category="all">
                                        Semua</button>
                                    @foreach ($categories as $category)
                                        <button class="btn btn-sm me-1 category-btn"
                                            onclick="filterCategory('{{ $category->id }}', this)"
                                            data-category="{{ $category->id }}">

                                            {{ $category->name ?? '' }}</button>
                                    @endforeach

                                </div>

                                <div class="row g-3 d-flex" id="productList">
                                    @foreach ($products as $product)
                                        <div class="col-md-4 col-sm-6 product-item {{ $product->stock < 1 ? 'opacity-50' : '' }}"
                                            data-category="{{ $product->category_id }}" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-stock="{{ $product->stock }}"
                                            onclick="addToCart({{ $product->id }})">
                                            <div class="card product-card shadow h-100">
                                                <div class="product-image"><img
                                                        src="{{ asset('storage/' . $product->photo) }}" alt="">
                                                </div>
                                                <div class="card-body">
                                                    <span
                                                        class="badge bg-light text-dark mb-2">{{ $product->category->name }}</span>
                                                    <h6 class="fw-bold">{{ $product->name ?? '' }}</h6>
                                                    <span class="price">Rp
                                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                                    <small class="d-block text-muted">Stok:
                                                        {{ $product->stock }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow cart-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div> <i class="bi bi-cart4" style="fw-bold"></i>Cart</div>
                                <span class="badge bg-dark" id="cartCount">0</span>
                            </div>
                            <div class="mb-3" id="cartItems">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-cart4"></i>
                                    <p>Empty Cart</p>
                                </div>
                            </div>

                            {{-- subtotal --}}
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sub Total</span>
                                <strong id="subtotal">Rp.0</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Pajak (11%)</span>
                                <strong id="tax">Rp.0</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold total-price">Total</span>
                                <span class= "fw-bold total-price" id="total">Rp.0</span>
                            </div>

                            <button type="button" class="btn btn-success w-100 py-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Payment</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow border-0">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="paymentModalLabel">Konfirmasi
                        Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="paymentForm" onsubmit="event.preventDefault();">
                        <!-- Input Nama Pemesan -->
                        <div class="mb-3">
                            <label for="customerName" class="form-label fw-bold">Nama
                                Pemesan</label>
                            <input type="text" class="form-control" id="customer_name"
                                placeholder="Masukkan nama pemesan...">
                        </div>

                        <!-- Ringkasan Total Tagihan -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded mb-4">
                            <span class="fw-bold text-secondary">Total Pembayaran:</span>
                            <span class="fw-bold text-success fs-4" id="total_payment">Rp0</span>
                        </div>

                        <div class="mb-3">
                            <label for="cash_paid" class="form-label fw-bold">Uang dibayar</label>
                            <input type="number" class="form-control" id="cash_paid" placeholder="" min="0"
                                oninput="calculateChange()">
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded mb-4">
                            <span class="fw-bold text-danger">Kembalian:</span>
                            <span class="fw-bold text-danger fs-4" id="change_money">Rp. 0</span>
                        </div>

                        <!-- Pilihan Metode Pembayaran -->
                        <label class="form-label fw-bold">Pilih Metode Pembayaran</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cash-option" class="w-100 cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash"
                                        class="d-none payment-option" id="cash-option">
                                    <div class="payment-card p-4 shadow-sm border text-center h-100">
                                        <i class="bi bi-cash-stack fs-1"></i>
                                        <h4 class="fw-bold mb-2">Tunai</h4>
                                        <p class="text-small">Bayar langsung</p>
                                    </div>
                                </label>
                            </div>

                            <div class="col-md-6">
                                <label for="midtrans-option" class="w-100 cursor-pointer">
                                    <input type="radio" name="payment_method" value="midtrans"
                                        class="d-none payment-option" id="midtrans-option">
                                    <div class="payment-card p-4 shadow-sm border text-center h-100">
                                        <i class="bi bi-qr-code fs-1"></i>
                                        <h4 class="fw-bold mb-2">Non Tunai</h4>
                                        <p class="text-small">Bayar via QR/Card</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-4"> <button type="button" class="btn btn-secondary w-50"
                                data-bs-dismiss="modal"> Cancel </button>

                            <button type="button" class="btn btn-success w-50" onclick="processPayment()">
                                Pay Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function filterCategory(categoryId, button) {
            console.log('Category:', categoryId);
            console.log('Button:', button);
            // selectorAll = array
            const products = document.querySelectorAll('.product-item');
            products.forEach(function(product) {
                console.log(product);
                {
                    const categoryName = product.dataset.category;
                    // jika user click category bernama all, muncul category all
                    // jika user click category snack, dia bakal muncul yang snack doang
                    if (categoryId === 'all' || categoryName === String(categoryId)) {
                        product.style.display = "";
                    } else {
                        product.style.display = 'none';
                    }

                }
            });
            document.querySelectorAll('.category-btn').forEach(function(btn) {
                // ketika user pindah kursor
                btn.classList.remove('active');
            });
            // ketika user milih kategori
            button.classList.add('active');
        }

        let cart = [];

        function addToCart(productId) {

            const product = document.querySelector(`.product-item[data-id="${productId}"]`);
            if (!product) {
                alert('Product no found');
                return;
            }

            const productName = product.dataset.name;
            const productPrice = Number(product.dataset.price);
            const productStock = Number(product.dataset.stock);

            const existingItem = cart.find(function(item) {
                return Number(item.id) === Number(productId);
            })

            if (existingItem) {
                if (existingItem.qty >= productStock) {
                    alert('Stok produk tidak mencukupi.');
                    return;
                }
                existingItem.qty++;
            } else {
                if (productStock < 1) {
                    alert('Produk sedang habis.');
                    return;
                }
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    qty: 1,
                    stock: productStock,
                })
            }

            displayCart();
            console.log(cart);
        }

        function displayCart() {
            const cartItems = document.getElementById('cartItems')

            //ini kalo cart nya kosong
            cartItems.innerHTML = "";
            if (cart.length === 0) {
                cartItems.innerHTML = `
                <div class="text-center text-muted py-5">
                    <i class="bi bi-cart4"></i>
                    <p>Empty Cart</p>
                </div>
                `;
            }

            //ini kalo cart nya ada isinya
            cart.forEach(function(item) {
                cartItems.innerHTML +=
                    `<div class="cart-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>${item.name}</strong>
                            <div class="small text-muted">Rp ${formatRupiah(item.price)}</div>
                        </div>
                            <strong>Rp ${formatRupiah(item.price * item.qty)}</strong>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <button onclick="decreaseItem(${item.id})" type="button" class="btn btn-outline-secondary quantity-btn">-</button> 
                            <span class="mx-2"> ${item.qty} </span>
                            <button onclick="increaseItem(${item.id})" type="button" class="btn btn-outline-secondary quantity-btn">+</button>
                            <button onclick="removeItem(${item.id})" type="button" class="btn btn-outline-danger ms-auto"><i class="bi bi-trash"></i></button> 
                        </div>
                    </div> `
            })

            calculateCart();
        }

        function removeItem(productId) {
            cart = cart.filter(function(item) {
                return Number(item.id) !== Number(productId);

            });

            displayCart();
        }

        function decreaseItem(productId) {
            const item = cart.find(function(item) {
                return Number(item.id) === Number(productId);
            });



            item.qty--;
            if (item.qty <= 0) {
                removeItem(productId);
                return;
            }

            displayCart();
        }

        function increaseItem(productId) {
            const item = cart.find(function(item) {
                return Number(item.id) === Number(productId);
            });

            if (item.qty >= item.stock) {
                alert('Stok produk tidak mencukupi.');
                return;
            }

            item.qty++;
            displayCart();
        }

        function clearCart() {
            cart = [];
            displayCart();
        }

        function calculateCart() {
            let subtotal = 0;
            let itemCount = 0;

            cart.forEach(function(item) {
                subtotal += Number(item.price) * Number(item.qty);
                itemCount += Number(item.qty);

            });
            document.getElementById('cartCount').innerText = `${itemCount}`

            const total = Math.round(subtotal * 1.11);
            const tax = total - subtotal;
            document.getElementById('subtotal').innerText = `Rp ${formatRupiah(subtotal)}`
            document.getElementById('tax').innerText = `Rp ${formatRupiah(tax)}`
            document.getElementById('total').innerText = `Rp ${formatRupiah(total)}`
            document.getElementById('total_payment').innerText = `Rp ${formatRupiah(total)}`
        }

        function calculateChange() {
            const totalText = document.getElementById('total_payment').innerText;

            const total = Number(
                totalText.replace(/\D/g, '')
            );

            const cashPaid = Number(
                document.getElementById('cash_paid').value) || 0;

            const change = cashPaid - total;

            document.getElementById('change_money').innerText = `Rp ${formatRupiah(change > 0 ? change : 0)}`;

            return {
                changeMoney: change > 0 ? change : 0,
                cashPaid: cashPaid,
                total: total
            };

        }




        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number)
        }


        function searchProduct() {
            const search = document.getElementById('searchProduct').value.toLowerCase().trim();
            const products = document.querySelectorAll('.product-item');

            products.forEach(function(product) {
                const productName = product.dataset.name.toLowerCase();

                // jika product name di dalam tabel nilainya sama pada saat user input
                if (productName.includes(search)) {
                    product.style.display = "";
                } else {
                    product.style.display = "none";
                }
            })

        }

        async function processPayment() {
            if (cart.length === 0) {
                alert('Keranjang kosong! Tambahkan item');
                return;
            }

            const selectedPayment = document.querySelector(
                'input[name="payment_method"]:checked'
            );

            const paymentMethod = selectedPayment ?
                selectedPayment.value :
                'cash';

            const customerName =
                document.getElementById('customer_name').value || 'Unknown';

            if (!selectedPayment) {
                return;
            }

            const resultChange = calculateChange();
            const changeMoney = resultChange.changeMoney;

            try {
                const response = await fetch("{{ route('admin.orders.store') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(`meta[name="csrf-token"]`).getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        items: cart.map(function(item) {
                            return {
                                id: item.id,
                                qty: item.qty
                            }
                        }),
                        payment_method: paymentMethod,
                        customer_name: customerName,
                    })
                })

                const result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(result.message || 'Transaksi gagal disimpan.');
                }

                if (result.payment_method === 'midtrans') {
                    if (!window.snap || !result.snap_token) {
                        throw new Error('Pembayaran Midtrans belum siap.');
                    }

                    window.snap.pay(result.snap_token, {
                        onSuccess: function() {
                            alert('Pembayaran berhasil.');
                        },
                        onPending: function() {
                            alert('Menunggu pembayaran.');
                        },
                        onError: function() {
                            alert('Pembayaran gagal.');
                        },
                        onClose: function() {
                            alert('Pembayaran ditutup sebelum selesai.');
                        }
                    });
                } else {
                    await loadDashboardData();
                    alert(`Transaction ${result.order_id} successfully saved.`);
                }

                cart = [];
                displayCart();
                bootstrap.Modal.getInstance(document.getElementById('exampleModal'))?.hide();

            } catch (error) {
                alert(error.message || 'Transaksi gagal disimpan.');
            }
        }

        displayCart();
        loadDashboardData();

        document.querySelectorAll('.payment-option').forEach(radio => {
            radio.addEventListener('click', function() {
                // 1. Reset semua kartu ke tampilan awal
                document.querySelectorAll('.payment-card').forEach(card => {
                    card.classList.remove('border-success', 'border-primary', 'bg-light', 'shadow',
                        'border-2', 'selected-cash', 'selected-midtrans');
                });

                // 2. Jika radio yang sama diklik lagi, yang satu bakal mati
                const activeCard = this.closest('label').querySelector('.payment-card');

                // 3. Tambahkan efek highlight sesuai pilihan
                if (this.value === 'cash') {
                    activeCard.classList.add('selected-cash');
                } else if (this.value === 'midtrans') {
                    activeCard.classList.add('selected-midtrans');
                }
            });

        });

        async function loadDashboardData() {
            try {
                const response = await fetch("{{ route('admin.dashboard.data') }}");

                if (!response.ok) {
                    throw new Error('Gagal mengambil data dashboard');
                }

                const data = await response.json();

                document.getElementById('todayTransaction').textContent =
                    data.today_transaction;

                document.getElementById('todayIncome').textContent =
                    'Rp ' + Number(data.today_income).toLocaleString('id-ID');

                document.getElementById('todayProduct').textContent =
                    data.today_product;

            } catch (error) {
                console.error('Dashboard error:', error);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
