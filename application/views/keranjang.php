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
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                    <li>Keranjang</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<div class="shopping-cart section py-5">
    <div class="container-fluid px-4">
        <?php if ($this->session->userdata('logged_in')): ?>
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
                            <th style="width: 30px;"></th>
                            <th style="width: 200px;">Produk</th>
                            <th class="text-center" style="width: 200px;"></th>
                            <th class="text-center" style="width: 130px;">Merk</th>
                            <th class="text-center" style="width: 130px;">Kategori</th>
                            <th class="text-center" style="width: 60px;">Gender</th>
                            <th class="text-center" style="width: 130px;">Warna</th>
                            <th class="text-center" style="width: 60px;">Ukuran</th>
                            <th class="text-center" style="width: 130px;">Harga Produk</th>
                            <th class="text-center" style="width: 130px;">Jumlah</th>
                            <th class="text-center" style="width: 130px;">Potongan</th>
                            <th class="text-center" style="width: 130px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_awal = 0;
                        foreach ($cart as $index => $c):
                            $total_awal += ($c->harga * $c->qty);
                            ?>
                            <tr>
                                <td class="text-center text-muted"><?= $index + 1 ?></td>
                                <td>
                                    <input type="checkbox" class="form-check-input mt-0">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-none">
                                        <span class="text-danger fw-bold">X</span>
                                    </button>
                                </td>
                                <td>
                                    <a href="<?= site_url('detailproduct') ?>">
                                        <img src="<?= base_url('assets/images/item/' . $c->gambar) ?>"
                                            style="width: 150px; height: 150px; object-fit: cover;" alt="Produk">
                                    </a>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">
                                        <?= $c->nama_item ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span><?= $c->merk ?></span>
                                </td>
                                <td class="text-center">
                                    <span><?= $c->nama_kategori ?></span>
                                </td>
                                <td class="text-center">
                                    <span><?= $c->jenis_kelamin ?></span>
                                </td>
                                <td class="text-center">
                                    <span><?= $c->warna ?></span>
                                </td>
                                <td class="text-center">
                                    <span><?= $c->ukuran ?></span>
                                </td>
                                <td class="text-center fw-bold">
                                    <span>Rp <?= number_format($c->harga, 0, ',', '.') ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="input-group input-group-sm justify-content-center"
                                        style="max-width: 120px; margin: 0 auto;">
                                        <button class="btn btn-outline-primary qty-minus" type="button">−</button>

                                        <input type="number" class="form-control text-center qty-input" min="1"
                                            value="<?= $c->qty ?>" max="<?=$c->stok?>">

                                        <button class="btn btn-outline-primary qty-plus" type="button">+</button>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span>-</span>
                                </td>
                                <td class="text-center fw-bold text-primary">
                                    Rp <?= number_format($c->total, 0, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-6 col-12 ms-auto mt-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Total harga barang</span>
                                <span class="text-primary">Rp <?= number_format($total_awal, 0, ',', '.') ?></span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Potongan</span>
                                <span class="text-primary">-</span>
                            </li>
                            <hr>
                            <li class="d-flex justify-content-between">
                                <span class="fw-bold text-dark">Total Akhir</span>
                                <span class="fw-bold text-primary">Rp <?= number_format($total_awal, 0, ',', '.') ?></span>
                            </li>
                            <li class="d-flex justify-content-end">
                                <a href="<?= site_url('checkout') ?>" class="btn btn-primary w-50 mt-3">Checkout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-lg-12 col-12">
                <div class="row justify-content-center align-items-center" style="height: 500px;">
                    <div class="col-12 text-center">
                        <h5 class="mb-3 text-muted">
                            <i class="lni lni-lock me-1"></i>
                            Masuk dulu untuk melihat keranjang
                        </h5>
                        <a href="<?= site_url('login') ?>" class="btn btn-primary">
                            Masuk Sekarang
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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