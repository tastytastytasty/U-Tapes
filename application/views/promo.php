<style>
    .product-image {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 100%;
        overflow: hidden;
        border-radius: 6px;
        background: #f8f9fa;
    }

    .product-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 6px;
    }

    .product-actions .action-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-actions .action-btn i {
        font-size: 16px;
    }

    .product-actions .action-btn:hover {
        transform: scale(1.1);
    }

    .product-actions {
        opacity: 0;
        transition: 0.3s;
        z-index: 3;
    }

    .product-image:hover .product-actions {
        opacity: 1;
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

    .product-actions button:hover {
        transform: scale(1.1);
    }

    .product-actions.in-wishlist {
        opacity: 1;
    }

    .product-actions.not-in-wishlist {
        opacity: 0;
    }

    .product-image:hover .product-actions.not-in-wishlist {
        opacity: 1;
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
        font-size: 35px;
        font-weight: 700;
        color: red;
        letter-spacing: 3px;
        z-index: 5;
    }

    .color-out .color-circle {
        opacity: 0.45;
        position: relative;
        outline: 2px solid #ccc;
        outline-offset: 2px;
    }

    .color-out .color-circle::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 140%;
        height: 2px;
        background: #aaa;
        transform: translate(-50%, -50%) rotate(-45deg);
        pointer-events: none;
        border-radius: 2px;
    }

    .color-out {
        cursor: not-allowed !important;
    }

    .color-radio input {
        display: none;
    }

    .color-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 2px solid #000000;
        cursor: pointer;
        display: inline-block;
    }

    .color-radio input:checked+.color-circle {
        border: 3px solid #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, .3);
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .col-6 {
            padding: 6px !important;
            margin: 0 !important;
        }

        .single-product {
            padding: 4px !important;
            border-radius: 6px;
        }

        .product-image img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 6px;
        }

        .product-actions .btn {
            padding: 2px 4px;
            font-size: 10px;
        }

        .product-actions i {
            font-size: 12px;
        }

        .new-tag,
        .sale-tag {
            margin-top: 0px !important;
            font-size: 9px !important;
            padding: 2px 4px !important;
            border-radius: 4px !important;
        }

        .product-info {
            padding: 4px !important;
        }

        .product-info .category {
            font-size: 10px;
            line-height: 1.1;
        }

        .product-info .title {
            font-size: 12px;
            line-height: 1.2;
            margin: 2px 0;
        }

        .product-info .title a {
            font-size: 12px;
        }

        .price {
            margin-bottom: auto;
        }

        .price span {
            font-size: 11px;
        }

        .discount-price {
            font-size: 10px;
        }

        .text-danger {
            font-size: 10px;
        }
    }
</style>
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Promo</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                    <li>Promo</li>
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
            <div class="form-check mb-0 d-flex justify-content-inline gap-2 align-items-center">
                <label class="fw-bold text-primary">Urut Berdasarkan</label>
                <select class="form-control" style="max-width: 140px; margin: 0 auto;">
                    <option selected>Semua</option>
                    <option>Terbaru</option>
                    <option>Terlama</option>
                    <option>Harga Tertinggi</option>
                    <option>Harga Terendah</option>
                </select>
            </div>
        </div>
        <?php if (!empty($promos)): ?>
            <div class="row" id="promo-container">
                <?php foreach ($promos as $p): ?>
                    <?php
                    $harga_asli = $p->harga_termurah;
                    $harga_diskon = $harga_asli;
                    if ($p->persen_promo > 0) {
                        $harga_diskon = $harga_asli - ($harga_asli * $p->persen_promo / 100);
                    } elseif ($p->harga_promo > 0) {
                        $harga_diskon = $harga_asli - $p->harga_promo;
                    }
                    $out_of_stock = $p->total_stok <= 0;
                    ?>
                    <div class="col-lg-2 col-md-6 col-6 mb-4 promo-item" id="promo-<?= $p->id_item ?>">
                        <div class="single-product product-card p-3 mb-3 h-100 mt-0">
                            <div class="product-image position-relative">
                                <a href="<?= site_url('detailproduct/' . $p->id_item) ?>" class="detail-link">
                                    <?php if ($out_of_stock): ?>
                                        <div class="stok-overlay">Stok Tidak <br> Tersedia</div>
                                    <?php endif; ?>
                                    <img src="<?= base_url('assets/images/item/' . $p->gambar_item) ?>"
                                        alt="<?= $p->nama_item ?>" class="img-fluid product-img">
                                    <div class="badge-wrapper badge-desktop">
                                        <?php if ($p->is_new): ?>
                                            <span class="new-tag">Baru</span>
                                        <?php endif; ?>
                                        <?php if ($p->persen_promo > 0): ?>
                                            <span class="sale-tag">-<?= $p->persen_promo ?>%</span>
                                        <?php elseif ($p->harga_promo > 0): ?>
                                            <span class="sale-tag">-Rp <?= number_format($p->harga_promo, 0, ',', '.') ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                            <div class="badge-wrapper badge-mobile mt-1">
                                <?php if ($p->is_new): ?>
                                    <span class="new-tag">Baru</span>
                                <?php endif; ?>
                                <?php if ($p->persen_promo > 0): ?>
                                    <span class="sale-tag">-<?= $p->persen_promo ?>%</span>
                                <?php elseif ($p->harga_promo > 0): ?>
                                    <span class="sale-tag">-Rp <?= number_format($p->harga_promo, 0, ',', '.') ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="product-info d-flex flex-column flex-grow-1">
                                <span class="category <?= $out_of_stock ? 'text-secondary' : 'text-primary' ?>">
                                    <?= $p->nama_kategori ?> | <?= $p->merk ?>
                                </span>
                                <h4 class="title">
                                    <a href="<?= site_url('detailproduct/' . $p->id_item) ?>"
                                        class="<?= $out_of_stock ? 'text-secondary' : '' ?>">
                                        <?= $p->nama_item ?>
                                    </a>
                                </h4>
                                <span class="<?= $out_of_stock ? 'text-secondary' : 'text-primary' ?> mt-2">
                                    Usia : <?= $p->usia_min ?> - <?= $p->usia_max ?>
                                </span>
                                <div class="color-wrapper d-flex gap-2 flex-wrap mt-3">
                                    <?php if (!empty($p->warna)): ?>
                                        <?php foreach ($p->warna as $index => $warna_item): ?>
                                            <label class="color-radio d-flex align-items-center m-0
                                        <?= (!$out_of_stock && $warna_item->total_stok <= 0) ? 'color-out' : '' ?>"
                                                style="cursor:pointer;">
                                                <input type="radio" name="warna_<?= $p->id_item ?>" value="<?= $warna_item->warna ?>"
                                                    data-image="<?= base_url('assets/images/item/' . $warna_item->gambar) ?>"
                                                    <?= $index === 0 ? 'checked' : '' ?> style="display:none;">
                                                <span class="color-circle mb-1 me-2" style="
                                            width:30px;
                                            height:30px;
                                            border-radius:50%;
                                            background-color:<?= $warna_item->kode_hex ?>;">
                                                </span>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-muted small">Warna tidak tersedia</p>
                                    <?php endif; ?>
                                </div>
                                <div class="price d-flex justify-content-start mt-0">
                                    <div class="price d-flex flex-column">
                                        <?php if ($harga_diskon < $harga_asli): ?>
                                            <div class="d-flex-md gap-1">
                                                <span class="<?= $out_of_stock ? 'text-secondary' : '' ?>">
                                                    Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                </span>
                                                <span class="discount-price text-muted text-decoration-line-through">
                                                    Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="<?= $out_of_stock ? 'text-secondary' : '' ?>">
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
            <div class="row" id="promo-empty">
                <div class="col-12 text-center d-flex flex-column justify-content-center align-items-center"
                    style="height:500px">
                    <i class="lni lni-tag mb-3" style="font-size:100px;"></i>
                    <h5 class="text-muted">Tidak ada produk promo saat ini</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    document.addEventListener('change', function (e) {
        if (!e.target.matches('input[type="radio"][name^="warna_"]')) return;
        const radio = e.target;
        const card = radio.closest('.product-card');
        if (!card) return;
        const img = card.querySelector('.product-img');
        const link = card.querySelector('.detail-link');
        if (!img || !link) return;
        const newImg = radio.dataset.image;
        const warnaVal = radio.value;
        if (newImg) img.src = newImg;
        card.dataset.selectedColor = warnaVal;
        const baseUrl = link.getAttribute('href').split('?')[0];
        link.setAttribute('href', baseUrl + '?warna=' + encodeURIComponent(warnaVal));
    });
</script>