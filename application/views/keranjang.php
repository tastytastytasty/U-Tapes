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
    .cart-item-empty .product-card {
        background-color: #fafafa;
    }

    .out-of-stock-overlay {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 5;
        pointer-events: none;
    }

    .out-of-stock-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(239, 68, 68, 0.92);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        letter-spacing: 0.01em;
    }

    .cart-item-empty .input-group button:disabled,
    .cart-item-empty .input-group input:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    .cart-item-empty .item-checkbox:disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    .cart-item-empty .btn-hapus-item {
        opacity: 1 !important;
        pointer-events: all !important;
        cursor: pointer !important;
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
        <div class="row">
            <div class="col-12 <?= ($this->session->userdata('logged_in') && !empty($cart)) ? 'col-lg-8' : '' ?>">
                <?php if ($this->session->userdata('logged_in')): ?>
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
                                $is_empty = ($c->stok <= 0);
                                ?>
                                <div class="col-12 mb-3 cart-item <?= $is_empty ? 'cart-empty' : '' ?>" id="cart-<?= $c->id_cart ?>">
                                    <div class="single-product product-card d-flex flex-row align-items-stretch h-100 mt-0 position-relative"
                                        style="border: 1.5px solid <?= $is_empty ? '#e5e7eb' : '#d0d0d0' ?>; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; <?= $is_empty ? 'opacity: 0.55;' : '' ?>">
                                        <?php if ($is_empty): ?>
                                            <div class="out-of-stock-overlay">
                                                <span class="out-of-stock-badge">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                                    </svg>
                                                    Produk tidak tersedia
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="product-image position-relative flex-shrink-0" style="width: 150px; height: 150px;">
                                            <a href="<?= site_url('detailproduct/' . $c->id_item) ?>" class="detail-link h-100 d-block">
                                                <img src="<?= base_url('assets/images/item/' . $c->gambar) ?>"
                                                    class="img-fluid product-img h-100" style="object-fit: cover; width: 200px; <?= $is_empty ? 'filter: grayscale(60%);' : '' ?>"
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
                                        <div class="product-info d-flex flex-column flex-grow-1" data-id-cart="<?= $c->id_cart ?>"
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
                                                    style="width: 22px; height: 22px; cursor: <?= $is_empty ? 'not-allowed' : 'pointer' ?>;"
                                                    <?= $is_empty ? 'disabled' : '' ?> <?= (!$is_empty && $c->checklist === 'Yes') ? 'checked' : '' ?>>
                                                    <label for="item-<?= $c->id_cart ?>"></label>
                                                    <button class="btn btn-sm btn-danger btn-hapus-item"
                                                        data-id-cart="<?= $c->id_cart ?>" title="Hapus item"
                                                        style="width: 30px; height: 30px; padding: 0; line-height: 1; position: relative; z-index: 10;">
                                                        <i class="lni lni-trash-can" style="font-size: 20px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <span class="text-primary small">
                                                    <?= htmlspecialchars($c->jenis_kelamin) ?> | <?= htmlspecialchars($c->usia_min) ?> - <?= htmlspecialchars($c->usia_max) ?>
                                                </span>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if (!empty($c->warna)): ?>
                                                        <span class="color-circle" style="
                                                            width: 18px; height: 18px;
                                                            border-radius: 50%;
                                                            background-color: <?= $c->kode_hex ?? '#ccc' ?>;
                                                            display: inline-block;" title="<?= htmlspecialchars($c->warna) ?>">
                                                        </span>
                                                        <small class="text-muted"><?= htmlspecialchars($c->warna) ?></small>
                                                    <?php else: ?>
                                                        <small class="text-muted">-</small>
                                                    <?php endif; ?>
                                                    <span class="text-muted">|</span>
                                                    <span class="badge bg-light text-dark border" style="font-size: 0.9rem;">
                                                        <?= htmlspecialchars($c->ukuran) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center pt-2">
                                                <div class="input-group input-group-sm" style="max-width:100px">
                                                    <button class="btn btn-outline-primary cart-qty-minus"
                                                        data-cart="<?= $c->id_cart ?>"
                                                        data-price="<?= $c->harga ?>" data-stok="<?= $c->stok ?>"
                                                        data-persen="<?= $c->persen_promo ?? 0 ?>"
                                                        data-promo="<?= $c->harga_promo ?? 0 ?>"
                                                        data-issale="<?= $c->is_sale ? 1 : 0 ?>"
                                                        type="button" <?= $is_empty ? 'disabled' : '' ?>>−
                                                    </button>
                                                    <input type="number" class="form-control cart-qty-input text-center"
                                                        id="cart-qty-<?= $c->id_cart ?>"
                                                        data-cart="<?= $c->id_cart ?>" data-price="<?= $c->harga ?>"
                                                        data-stok="<?= $c->stok ?>" data-persen="<?= $c->persen_promo ?>"
                                                        data-promo="<?= $c->harga_promo ?>" data-issale="<?= $c->is_sale ?>"
                                                        min="1" max="<?= $c->stok ?>" value="<?= $c->qty ?>"
                                                        <?= $is_empty ? 'disabled' : '' ?>>
                                                    <button class="btn btn-outline-primary cart-qty-plus"
                                                        data-cart="<?= $c->id_cart ?>"
                                                        data-price="<?= $c->harga ?>" data-stok="<?= $c->stok ?>"
                                                        data-persen="<?= $c->persen_promo ?? 0 ?>"
                                                        data-promo="<?= $c->harga_promo ?? 0 ?>"
                                                        data-issale="<?= $c->is_sale ? 1 : 0 ?>"
                                                        type="button" <?= $is_empty ? 'disabled' : '' ?>>+
                                                    </button>
                                                </div>
                                                <div class="price d-flex-md flex-column text-end">
                                                    <?php if ($c->is_sale && $harga_diskon < $harga_asli): ?>
                                                        <span class="discount-price text-muted text-decoration-line-through small me-2"
                                                            id="item-harga-asli-<?= $c->id_cart ?>">
                                                            Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                        </span>
                                                        <span class="fw-bold <?= $is_empty ? 'text-muted' : 'text-primary' ?>"
                                                            id="item-harga-diskon-<?= $c->id_cart ?>">
                                                            Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="fw-bold <?= $is_empty ? 'text-muted' : 'text-primary' ?>"
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
                        <div class="row" id="cart-empty">
                            <div class="col-12 text-center d-flex flex-column justify-content-center align-items-center" style="height:500px">
                                <i class="lni lni-sad mb-4 text-primary" style="font-size:100px;"></i>
                                <h5 class="text-muted text-primary">Keranjang belanja kosong</h5>
                            </div>
                        </div>
                    <?php endif; ?>
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
            <?php if ($this->session->userdata('logged_in') && !empty($cart)): ?>
                <div class="col-12 col-lg-4">
                    <div style="position: sticky; top: 80px;">
                        <div class="card border-0 shadow-sm rounded-3 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <input type="text" class="form-control form-control-sm search-input" placeholder="Cari produk...">
                                    <button class="btn btn-sm btn-primary">Cari</button>
                                </div>
                                <div class="form-check mb-0 d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" id="selectAll" style="width: 22px; height: 22px; cursor: pointer; margin-top: 0;">
                                    <label class="form-check-label" for="selectAll">Pilih semua</label>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm rounded-3">
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
                                    <li>
                                        <div class="button">
                                            <a href="<?= site_url('checkout') ?>" class="btn animate w-100">Checkout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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