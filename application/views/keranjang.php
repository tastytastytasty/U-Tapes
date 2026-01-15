<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    .qty-minus,
    .qty-plus {
        width: 32px;
        padding: 0;
    }
</style>
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Keranjang</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Homepage</a></li>
                    <li>Keranjang</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<div class="shopping-cart section py-5">
    <div class="container-fluid px-4">
        <div class="product-grid-topbar d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-2">
                <input type="text" class="form-control form-control-sm search-input" placeholder="Cari produk...">
                <button class="btn btn-sm btn-primary">Cari</button>
            </div>
            <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">
                    Pilih semua
                </label>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="border-bottom">
                    <tr class="text-muted fw-semibold">
                        <th style="width: 30px;">No</th>
                        <th style="width: 30px;"></th>
                        <th style="width: 150px;">Produk</th>
                        <th style="width: 180px;"></th>
                        <th class="text-center" style="width: 120px;">Merk</th>
                        <th class="text-center" style="width: 120px;">Kategori</th>
                        <th class="text-center" style="width: 100px;">Sex</th>
                        <th class="text-center" style="width: 120px;">Warna</th>
                        <th class="text-center" style="width: 60px;">Ukuran</th>
                        <th class="text-center" style="width: 160px;">Harga Produk</th>
                        <th class="text-center" style="width: 200px;">Jumlah</th>
                        <th class="text-center" style="width: 100px;">Potongan</th>
                        <th class="text-center" style="width: 160px;">Subtotal</th>
                        <th class="text-center" style="width: 30px;"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center text-muted">1.</td>
                        <td>
                            <input type="checkbox" class="form-check-input mt-0">
                        </td>
                        <td>
                            <a href="<?= site_url('detailproduct') ?>">
                                <img src="<?= base_url('assets/images/header/cart-items/item1.jpg') ?>"
                                    style="width: 150px; height: 150px; object-fit: cover;" alt="Produk">
                            </a>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark">
                                Nama Produk
                            </span>
                        </td>
                        <td class="text-center">
                            <span>Adidas</span>
                        </td>
                        <td class="text-center">
                            <span>Kasual</span>
                        </td>
                        <td class="text-center">
                            <span>Pria</span>
                        </td>
                        <td class="text-center">
                            <span>Hitam</span>
                        </td>
                        <td class="text-center">
                            <span>L</span>
                        </td>
                        <td class="text-center fw-bold">
                            <span>Rp. 10.000</span>
                        </td>
                        <td class="text-center">
                            <div class="input-group input-group-sm justify-content-center"
                                style="max-width: 120px; margin: 0 auto;">
                                <button class="btn btn-outline-secondary qty-minus" type="button">−</button>

                                <input type="number" class="form-control text-center qty-input" min="1" value="1">

                                <button class="btn btn-outline-secondary qty-plus" type="button">+</button>
                            </div>
                        </td>
                        <td class="text-center">
                            <span>-</span>
                        </td>
                        <td class="text-center fw-bold text-primary">
                            Rp. 10.000
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 col-md-6 col-12 ms-auto mt-4">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-dark">Total harga barang</span>
                            <span class="text-primary">Rp. 10.000</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-dark">Potongan</span>
                            <span class="text-primary">-</span>
                        </li>
                        <hr>
                        <li class="d-flex justify-content-between">
                            <span class="fw-bold text-dark">Total Akhir</span>
                            <span class="fw-bold text-primary">Rp. 11.000</span>
                        </li>
                        <li class="d-flex justify-content-end">
                            <a href="<?= site_url('checkout') ?>" class="btn btn-primary w-50 mt-3">Checkout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('qty-plus')) {
            const input = e.target.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }

        if (e.target.classList.contains('qty-minus')) {
            const input = e.target.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    });
</script>