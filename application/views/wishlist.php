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
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        color: red;
        letter-spacing: 3px;
        z-index: 2;
        text-transform: uppercase;
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
                    <h1 class="page-title">Wishlist</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                    <li>Wishlist</li>
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
            <?php if (!empty($wishlist)): ?>
                <div class="row" id="wishlist-container">
                    <?php foreach ($wishlist as $w): ?>
                        <div class="col-lg-2 col-md-6 col-6 mb-4 wishlist-item" id="wishlist-<?= $w->id_wishlist ?>">
                            <div class="single-product product-card p-3 mb-3 h-100 mt-0" data-selected-color="">
                                <div class="product-image position-relative">
                                    <a href="<?= site_url('detailproduct/' . $w->id_item) ?>" class="detail-link">
                                        <?php if ($w->total_stok <= 0): ?>
                                            <div class="stok-overlay">HABIS</div>
                                        <?php endif; ?>
                                        <img
                                            src="<?= base_url('assets/images/item/' . $w->gambar_item) ?>" alt="<?= $w->nama_item ?>"
                                            class="img-fluid product-img">
                                        <div class="product-actions position-absolute top-0 end-0 m-2 d-flex gap-1">
                                            <button class="btn btn-sm btn-danger btn-wishlist" data-page="wishlist"
                                                data-wishlist="<?= $w->id_wishlist ?>">
                                                <i class="lni lni-heart-filled"></i>
                                            </button>
                                        </div>
                                        <div class="badge-wrapper badge-desktop">
                                            <?php if ($w->is_new): ?>
                                                <span class="new-tag">Baru</span>
                                            <?php endif; ?>
                                            <?php if ($w->is_sale): ?>
                                                <?php if ($w->persen_promo > 0): ?>
                                                    <span class="sale-tag">-<?= $w->persen_promo ?>%</span>
                                                <?php elseif ($w->harga_promo > 0): ?>
                                                    <span class="sale-tag">-Rp <?= number_format($w->harga_promo, 0, ',', '.') ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="badge-wrapper badge-mobile mt-1">
                                    <?php if ($w->is_new): ?>
                                        <span class="new-tag">Baru</span>
                                    <?php endif; ?>
                                    <?php if ($w->is_sale): ?>
                                        <?php if ($w->persen_promo > 0): ?>
                                            <span class="sale-tag">-<?= $w->persen_promo ?>%</span>
                                        <?php elseif ($w->harga_promo > 0): ?>
                                            <span class="sale-tag">-Rp <?= number_format($w->harga_promo, 0, ',', '.') ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="product-info d-flex flex-column flex-grow-1">
                                    <?php if ($w->total_stok <= 0): ?>
                                        <span class="category text-secondary"><?= $w->nama_kategori ?> | <?= $w->merk ?></span>
                                        <h4 class="title">
                                            <a href="<?= site_url('detailproduct/' . $w->id_item) ?>" class="text-secondary">
                                                <?= $w->nama_item ?>
                                            </a>
                                        </h4>
                                        <div class="color-wrapper d-flex gap-2 flex-wrap mt-4">
                                            <?php if (!empty($w->warna)): ?>
                                                <?php foreach ($w->warna as $index => $warna_item): ?>
                                                    <label class="color-radio" style="cursor:pointer;">
                                                        <input type="radio" 
                                                            name="warna_<?= $w->id_item ?>" 
                                                            value="<?= $warna_item->warna ?>"
                                                            data-image="<?= base_url('assets/images/item/' . $warna_item->gambar) ?>"
                                                            <?= $index === 0 ? 'checked' : '' ?>
                                                            style="display:none;">
                                                        <span class="color-circle" 
                                                            style="width:30px; height:30px; border-radius:50%; 
                                                                    background-color:<?= $warna_item->kode_hex ?>;">
                                                        </span>
                                                    </label>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <p class="text-muted small">Warna tidak tersedia</p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="price d-flex justify-content-start mt-0">
                                            <?php
                                            $harga_asli = $w->harga_termurah;
                                            $harga_diskon = $harga_asli;
                                            if ($w->is_sale) {
                                                if ($w->persen_promo > 0) {
                                                    $harga_diskon = $harga_asli - ($harga_asli * $w->persen_promo / 100);
                                                } elseif ($w->harga_promo > 0) {
                                                    $harga_diskon = $harga_asli - $w->harga_promo;
                                                }
                                            }
                                            ?>
                                            <div class="price d-flex flex-column">
                                                <?php if ($w->is_sale && $harga_diskon < $harga_asli): ?>
                                                    <div class="d-flex-md gap-1">
                                                        <span class="text-secondary">
                                                            Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                        </span>
                                                        <span class="discount-price text-muted text-decoration-line-through">
                                                            Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                        </span>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-secondary">
                                                        Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="category text-primary"><?= $w->nama_kategori ?> | <?= $w->merk ?></span>
                                        <h4 class="title">
                                            <a href="<?= site_url('detailproduct/' . $w->id_item) ?>">
                                                <?= $w->nama_item ?>
                                            </a>
                                        </h4>
                                        <div class="color-wrapper d-flex gap-2 flex-wrap mt-4">
                                            <?php if (!empty($w->warna)): ?>
                                                <?php foreach ($w->warna as $index => $warna_item): ?>
                                                    <label class="color-radio" style="cursor:pointer;">
                                                        <input type="radio" 
                                                            name="warna_<?= $w->id_item ?>" 
                                                            value="<?= $warna_item->warna ?>"
                                                            data-image="<?= base_url('assets/images/item/' . $warna_item->gambar) ?>"
                                                            <?= $index === 0 ? 'checked' : '' ?>
                                                            style="display:none;">
                                                        <span class="color-circle" 
                                                            style="width:30px; height:30px; border-radius:50%; 
                                                                    background-color:<?= $warna_item->kode_hex ?>;">
                                                        </span>
                                                    </label>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <p class="text-muted small">Warna tidak tersedia</p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="price d-flex justify-content-start mt-0">
                                            <?php
                                            $harga_asli = $w->harga_termurah;
                                            $harga_diskon = $harga_asli;
                                            if ($w->is_sale) {
                                                if ($w->persen_promo > 0) {
                                                    $harga_diskon = $harga_asli - ($harga_asli * $w->persen_promo / 100);
                                                } elseif ($w->harga_promo > 0) {
                                                    $harga_diskon = $harga_asli - $w->harga_promo;
                                                }
                                            }
                                            ?>
                                            <div class="price d-flex flex-column">
                                                <?php if ($w->is_sale && $harga_diskon < $harga_asli): ?>
                                                    <div class="d-flex-md gap-1">
                                                        <span>
                                                            Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                        </span>
                                                        <span class="discount-price text-muted text-decoration-line-through">
                                                            Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                        </span>
                                                    </div>
                                                <?php else: ?>
                                                    <span>
                                                        Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row d-none" id="wishlist-empty">
                    <div class="col-12 text-center d-flex flex-column justify-content-center align-items-center"
                        style="height:500px">
                        <i class="lni lni-heart mb-3" style="font-size:100px;"></i>
                        <h5 class="text-muted">Wishlist kamu kosong</h5>
                    </div>
                </div>
            <?php else: ?>
                <div class="row" id="wishlist-empty">
                    <div class="col-12 text-center d-flex flex-column justify-content-center align-items-center"
                        style="height:500px">
                        <i class="lni lni-heart mb-3" style="font-size:100px;"></i>
                        <h5 class="text-muted">Wishlist kamu kosong</h5>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="col-lg-12 col-12">
                <div class="row justify-content-center align-items-center" style="height: 500px;">
                    <div class="col-12 text-center">
                        <h5 class="mb-3 text-muted">
                            <i class="lni lni-lock me-1"></i>
                            Login dulu untuk melihat wishlist
                        </h5>
                        <a href="<?= site_url('login') ?>" class="btn btn-primary">
                            Login Sekarang
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
document.addEventListener('change', function (e) {
    if (!e.target.matches('input[type="radio"][name^="warna_"]')) return;
    const radio = e.target;
    const card  = radio.closest('.product-card');
    if (!card) return;
    const img = card.querySelector('.product-img');
    const link = card.querySelector('.detail-link');
    if (!img || !link) return;
    const newImg   = radio.dataset.image;
    const warnaVal = radio.value;
    if (newImg) img.src = newImg;
    card.dataset.selectedColor = warnaVal;
    const baseUrl = link.getAttribute('href').split('?')[0];
    link.setAttribute('href', baseUrl + '?warna=' + encodeURIComponent(warnaVal));
});
</script>