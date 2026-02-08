<style>
    .product-image img {
        width: 100%;
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
    }

    .product-image:hover .product-actions {
        opacity: 1;
    }

    .new-tag,
    .sale-tag {
        position: static !important;
        margin-top: 15px;
    }
</style>
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
                            <div class="single-product card p-3 mb-3 h-100">
                                <div class="product-image position-relative"> <img
                                        src="<?= base_url('assets/images/item/' . $w->gambar_item) ?>" alt="<?= $w->nama_item ?>"
                                        class="img-fluid">
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
                                    <div class="button mt-2 text-center"> <a href="<?= site_url('detailproduct/' . $w->id_item) ?>"
                                            class="btn btn-sm btn-primary"> Lihat Detail </a> </div>
                                </div>
                                <div class="product-info mt-2 text-center"> <span class="category text-muted">
                                        <?= $w->nama_kategori ?> </span>
                                    <h4 class="title my-2"> <a href="<?= site_url('detailproduct/' . $w->id_item) ?>"
                                            class="text-dark text-decoration-none"> <?= $w->nama_item ?> </a> </h4>
                                    <div class="price"> <span class="fw-bold text-primary"> Rp.
                                            <?= number_format($w->harga_termurah, 0, ',', '.') ?> </span> </div>
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