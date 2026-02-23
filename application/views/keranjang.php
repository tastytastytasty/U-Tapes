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

    .color-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 2px solid #000000;
        cursor: pointer;
        display: inline-block;
    }

    .new-tag,
    .sale-tag {
        position: static !important;
        background: #0d6efd;
        color: #fff;
    }

    .sale-tag {
        background: #dc3545;
    }

    .badge-wrapper span {
        display: inline-block;
        margin-right: 6px;
        font-size: 12px;
        padding: 3px 8px;
    }

    .badge-desktop {
        position: absolute;
        top: 10px;
        left: 10px;
    }

    .badge-mobile {
        display: none;
    }

    .stok-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.6);
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: 700;
        color: red;
        letter-spacing: 3px;
        z-index: 5;
    }

    .color-radio input {
        display: none;
    }

    .color-out {
        position: relative;
    }

    .color-out::after {
        content: "";
        position: absolute;
        top: 40%;
        left: -5px;
        width: 110%;
        height: 5px;
        background: #ff0019;
        transform: rotate(-35deg);
        pointer-events: none;
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
                    <input class="form-check-input me-2" type="checkbox" id="selectAll" style="width: 22px; height: 22px; cursor: pointer;">
                    <label class="form-check-label" for="selectAll"> Pilih semua </label>
                </div>
            </div>
            <?php if (!empty($cart)): ?>
                <div class="row" id="cart-items-wrapper">
                    <?php
                    $total_harga_asli = 0;
                    $total_potongan = 0;
                    $total_akhir = 0;
                    foreach ($cart as $index => $c):
                        $harga_asli = $c->harga * $c->qty;
                        $harga_diskon = $harga_asli;
                        if ($c->is_sale) {
                            if ($c->persen_promo > 0) {
                                $harga_diskon = $harga_asli - ($harga_asli * $c->persen_promo / 100);
                            } elseif ($c->harga_promo > 0) {
                                $harga_diskon = $harga_asli - ($c->harga_promo * $c->qty);
                            }
                        }
                        $total_harga_asli += $harga_asli;
                        $subtotal = $harga_diskon;
                        $total_akhir += $subtotal;
                        $total_potongan = $total_harga_asli - $total_akhir;
                        ?>
                        <div class="col-6 mb-3">
                            <div class="single-product product-card d-flex flex-row align-items-stretch h-100 mt-0"
                                style="border: 1.5px solid #d0d0d0; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden;">

                                <div class="product-image position-relative flex-shrink-0" style="width: 200px; min-height: 200px;">
                                    <a href="<?= site_url('detailproduct/' . $c->id_item) ?>" class="detail-link h-100 d-block">
                                        <img src="<?= base_url('assets/images/item/' . $c->gambar) ?>"
                                            class="img-fluid product-img h-100" style="object-fit: cover; width: 200px;"
                                            alt="<?= htmlspecialchars($c->nama_item) ?>"
                                            onerror="if(!this.dataset.errored){this.dataset.errored=1;this.src='<?= base_url('assets/images/no-image.jpg') ?>';}">

                                        <div class="badge-wrapper badge-desktop">
                                            <?php if ($c->is_new ?? false): ?>
                                                <span class="new-tag">Baru</span>
                                            <?php endif; ?>
                                            <?php if ($c->is_sale): ?>
                                                <?php if ($c->persen_promo > 0): ?>
                                                    <span class="sale-tag">-<?= $c->persen_promo ?>%</span>
                                                <?php elseif ($c->harga_promo > 0): ?>
                                                    <span class="sale-tag">-Rp <?= number_format($c->harga_promo, 0, ',', '.') ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>

                                <div class="product-info d-flex flex-column flex-grow-1 p-4" data-id-cart="<?= $c->id_cart ?>"
                                    data-price="<?= $subtotal ?>">

                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="category text-primary small">
                                                <?= htmlspecialchars($c->nama_kategori) ?> | <?= htmlspecialchars($c->merk) ?>
                                            </span>
                                            <h4 class="title mb-1" style="font-size: 1.1rem;">
                                                <a href="<?= site_url('detailproduct/' . $c->id_item) ?>">
                                                    <?= htmlspecialchars($c->nama_item) ?>
                                                </a>
                                            </h4>
                                        </div>

                                        <div class="ms-2 flex-shrink-0 d-flex align-items-center gap-1">
                                            <input type="checkbox" class="item-checkbox form-check-input mt-0"
                                                id="item-<?= $c->id_cart ?>" data-id-cart="<?= $c->id_cart ?>"
                                                data-price="<?= $subtotal ?>" data-debug-price="<?= $subtotal ?>"
                                                style="width: 22px; height: 22px; cursor: pointer;">
                                            <label for="item-<?= $c->id_cart ?>"></label>

                                            <button class="btn btn-sm btn-none btn-hapus-item"
                                                data-id-cart="<?= $c->id_cart ?>" title="Hapus item"
                                                style="width: 30px; height: 30px; padding: 0; line-height: 1;">
                                                <span class="text-danger" style="font-size: 20px; font-weight: bold;">&times;</span>
                                            </button>
                                        </div>
                                    </div>

                                    <span class="text-primary small">
                                        <?= htmlspecialchars($c->jenis_kelamin) ?> | <?= htmlspecialchars($c->usia_min) ?> -
                                        <?= htmlspecialchars($c->usia_max) ?>
                                    </span>

                                    <div class="color-wrapper d-flex gap-2 flex-wrap align-items-center mt-2">
                                        <?php if (!empty($c->warna)): ?>
                                            <span class="color-circle" style="
                                    width: 22px; height: 22px;
                                    border-radius: 50%;
                                    background-color: <?= $c->kode_hex ?? '#ccc' ?>;
                                    display: inline-block;" title="<?= htmlspecialchars($c->warna) ?>">
                                            </span>
                                            <small class="text-muted"><?= htmlspecialchars($c->warna) ?></small>
                                        <?php else: ?>
                                            <small class="text-muted">Warna tidak tersedia</small>
                                        <?php endif; ?>
                                        <span class="text-muted">|</span>
                                        <span class="badge bg-light text-dark border fs-6">
                                            <?= htmlspecialchars($c->ukuran) ?>
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                                        <div class="input-group input-group-sm" style="max-width:100px">
                                            <button class="btn btn-outline-primary cart-qty-minus" data-cart="<?= $c->id_cart ?>"
                                                data-price="<?= $c->harga ?>" data-stok="<?= $c->stok ?>" data-persen="<?= $c->persen_promo ?? 0 ?>"
                                                data-promo="<?= $c->harga_promo ?? 0 ?>" data-issale="<?= $c->is_sale ? 1 : 0 ?>" type="button">−
                                            </button>
                                            <input type="number" class="form-control cart-qty-input text-center" id="cart-qty-<?= $c->id_cart ?>"
                                            data-cart="<?= $c->id_cart ?>" data-price="<?= $c->harga ?>" data-stok="<?= $c->stok ?>" data-persen="<?= $c->persen_promo ?>"
                                            data-promo="<?= $c->harga_promo ?>" data-issale="<?= $c->is_sale ?>" min="1" max="<?= $c->stok ?>" value="<?= $c->qty ?>">
                                            <button class="btn btn-outline-primary cart-qty-plus" data-cart="<?= $c->id_cart ?>"
                                                data-price="<?= $c->harga ?>" data-stok="<?= $c->stok ?>" data-persen="<?= $c->persen_promo ?? 0 ?>"
                                                data-promo="<?= $c->harga_promo ?? 0 ?>" data-issale="<?= $c->is_sale ? 1 : 0 ?>" type="button">+
                                            </button>
                                        </div>
                                        <div class="price d-flex-md flex-column text-end">
                                            <?php if ($c->is_sale && $harga_diskon < $harga_asli): ?>
                                                <span class="discount-price text-muted text-decoration-line-through small me-2"
                                                    id="item-harga-asli-<?= $c->id_cart ?>">
                                                    Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                </span>
                                                <span class="fw-bold text-primary"
                                                    id="item-harga-diskon-<?= $c->id_cart ?>">
                                                    Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="fw-bold text-primary"
                                                    id="item-harga-asli-<?= $c->id_cart ?>">
                                                    Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    ⚠️ Keranjang kosong. <a href="<?= site_url('keranjang') ?>">Kembali ke keranjang</a>
                </div>
            <?php endif; ?>
            <div class="col-lg-4 col-md-6 col-12 ms-auto mt-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Total harga barang</span>
                                <span class="text-primary" id="summary-harga-asli">Rp <?= number_format($total_harga_asli, 0, ',', '.') ?></span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Potongan</span>
                                <span class="text-primary" id="summary-potongan">
                                    <?= $total_potongan > 0 ? '- Rp ' . number_format($total_potongan, 0, ',', '.') : '-' ?>
                                </span>
                            </li>
                            <hr>
                            <li class="d-flex justify-content-between mb-2">
                                <span class="fw-bold text-dark">Total Akhir</span>
                                <span class="fw-bold text-primary" id="summary-total-akhir">Rp <?= number_format($total_akhir, 0, ',', '.') ?></span>
                            </li>
                            <li> <div class="button">
                                <a href="<?= site_url('checkout') ?>" class="btn animate w-100">Checkout</a>
                            </div> </li>
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