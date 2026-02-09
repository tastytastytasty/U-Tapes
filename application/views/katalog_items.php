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

    .product-actions {
        transition: opacity 0.3s ease, transform 0.2s ease;
        z-index: 10;
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
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        color: red;
        letter-spacing: 3px;
        z-index: 10;
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
<?php if (empty($items)): ?>
    <div class="col-12 text-center">
        <i class="lni lni-search-alt fs-1 text-primary mb-3"></i>
        <h5 class="text-primary">Produk tidak ditemukan</h5>
        <p class="text-primary mb-0">
            Coba ubah kata kunci atau filter yang digunakan
        </p>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="single-product product-card d-flex flex-column h-100 mt-0" data-selected-color="">
                    <div class="product-image position-relative">
                        <a href="<?= site_url('detailproduct/' . $item->id_item) ?>" class="detail-link">
                            <?php if ($item->total_stok <= 0): ?>
                                <div class="stok-overlay">HABIS</div>
                            <?php endif; ?>
                            <img src="<?= base_url('assets/images/item/' . $item->gambar_item) ?>" class="img-fluid product-img"
                                alt="<?= $item->nama_item ?>">
                            <div class="product-actions position-absolute top-0 end-0 m-2 d-flex gap-1
                                <?= $item->in_wishlist ? 'in-wishlist' : 'not-in-wishlist' ?>">
                                <button class="btn btn-sm btn-danger btn-wishlist" data-page="catalog"
                                    data-id="<?= $item->id_item ?>"
                                    data-login="<?= $this->session->userdata('logged_in') ? 1 : 0 ?>">
                                    <i class="lni <?= $item->in_wishlist ? 'lni-heart-filled' : 'lni-heart' ?>"></i>
                                </button>
                            </div>
                            <div class="badge-wrapper badge-desktop">
                                <?php if ($item->is_new): ?>
                                    <span class="new-tag">Baru</span>
                                <?php endif; ?>
                                <?php if ($item->is_sale): ?>
                                    <?php if ($item->persen_promo > 0): ?>
                                        <span class="sale-tag">-<?= $item->persen_promo ?>%</span>
                                    <?php elseif ($item->harga_promo > 0): ?>
                                        <span class="sale-tag">-Rp <?= number_format($item->harga_promo, 0, ',', '.') ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                    <div class="badge-wrapper badge-mobile mt-1">
                        <?php if ($item->is_new): ?>
                            <span class="new-tag">Baru</span>
                        <?php endif; ?>
                        <?php if ($item->is_sale): ?>
                            <?php if ($item->persen_promo > 0): ?>
                                <span class="sale-tag">-<?= $item->persen_promo ?>%</span>
                            <?php elseif ($item->harga_promo > 0): ?>
                                <span class="sale-tag">-Rp <?= number_format($item->harga_promo, 0, ',', '.') ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="product-info d-flex flex-column flex-grow-1">
                        <?php if ($item->total_stok <= 0): ?>
                            <span class="category text-secondary"><?= $item->nama_kategori ?> | <?= $item->merk ?></span>
                            <h4 class="title">
                                <a href="<?= site_url('detailproduct/' . $item->id_item) ?>" class="text-secondary">
                                    <?= $item->nama_item ?>
                                </a>
                            </h4>
                            <div class="color-wrapper d-flex gap-2 flex-wrap mt-4">
                                <?php if (!empty($item->warna)): ?>
                                    <?php foreach ($item->warna as $w): ?>
                                        <label class="color-radio d-flex align-items-center m-0" style="cursor:pointer;">
                                            <input type="radio" name="warna_<?= $item->id_item ?>" value="<?= $w->warna ?>"
                                                data-image="<?= base_url('assets/images/item/' . $w->gambar) ?>" style="display:none;">
                                            <span class="color-circle mb-1 me-2" style="width:30px;height:30px;border-radius:50%;
                                                background-color:<?= $w->kode_hex ?>;">
                                            </span>
                                        </label>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <p class="text-muted small">Warna tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                            <div class="price d-flex justify-content-start mt-0">
                                <?php
                                $harga_asli = $item->harga_termurah;
                                $harga_diskon = $harga_asli;
                                if ($item->is_sale) {
                                    if ($item->persen_promo > 0) {
                                        $harga_diskon = $harga_asli - ($harga_asli * $item->persen_promo / 100);
                                    } elseif ($item->harga_promo > 0) {
                                        $harga_diskon = $harga_asli - $item->harga_promo;
                                    }
                                }
                                ?>
                                <div class="price d-flex flex-column">
                                    <?php if ($item->is_sale && $harga_diskon < $harga_asli): ?>
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
                            <span class="category text-primary"><?= $item->nama_kategori ?> | <?= $item->merk ?></span>
                            <h4 class="title">
                                <a href="<?= site_url('detailproduct/' . $item->id_item) ?>">
                                    <?= $item->nama_item ?>
                                </a>
                            </h4>
                            <div class="color-wrapper d-flex gap-2 flex-wrap mt-4">
                                <?php if (!empty($item->warna)): ?>
                                    <?php foreach ($item->warna as $w): ?>
                                        <label class="color-radio d-flex align-items-center m-0" style="cursor:pointer;">
                                            <input type="radio" name="warna_<?= $item->id_item ?>" value="<?= $w->warna ?>"
                                                data-image="<?= base_url('assets/images/item/' . $w->gambar) ?>" style="display:none;">
                                            <span class="color-circle mb-1 me-2" style="width:30px;height:30px;border-radius:50%;
                                                background-color:<?= $w->kode_hex ?>;">
                                            </span>
                                        </label>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <p class="text-muted small">Warna tidak tersedia</p>
                                <?php endif; ?>
                            </div>
                            <div class="price d-flex justify-content-start mt-0">
                                <?php
                                $harga_asli = $item->harga_termurah;
                                $harga_diskon = $harga_asli;
                                if ($item->is_sale) {
                                    if ($item->persen_promo > 0) {
                                        $harga_diskon = $harga_asli - ($harga_asli * $item->persen_promo / 100);
                                    } elseif ($item->harga_promo > 0) {
                                        $harga_diskon = $harga_asli - $item->harga_promo;
                                    }
                                }
                                ?>
                                <div class="price d-flex flex-column">
                                    <?php if ($item->is_sale && $harga_diskon < $harga_asli): ?>
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
                <!-- End Single Product -->
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
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
