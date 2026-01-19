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
        transition: opacity 0.3s ease, transform 0.2s ease;
        z-index: 2;
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

    .product-actions button:hover {
        transform: scale(1.1);
    }
</style>
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Katalog Produk</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                    <li>Katalog Produk</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<section class="product-grids section py-5">
    <div class="container-fluid px-4">
        <div class="d-lg-none mb-2">
            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobileFilter">
                ☰ Filter Produk
            </button>
        </div>
        <form id="filterForm">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="collapse d-lg-block" id="mobileFilter">
                        <div class="product-sidebar card p-3 mb-2">
                            <div class="single-widget mb-4">
                                <label class="mb-2 text-primary">Urut Berdasarkan</label>
                                <select name="sort" class="form-control auto-submit">
                                    <option value="terbaru">Terbaru</option>
                                    <option value="terlama">Terlama</option>
                                    <option value="harga_tertinggi">Harga Tertinggi</option>
                                    <option value="harga_terendah">Harga Terendah</option>
                                </select>
                            </div>

                            <div class="single-widget mb-4">
                                <label class="mb-2 text-primary">Sex</label>
                                <select name="sex" class="form-control auto-submit">
                                    <option value="">Semua</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                    <option value="Anak Laki - laki">Anak Laki-Laki</option>
                                    <option value="Anak Perempuan">Anak Perempuan</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>

                            <div class="single-widget">
                                <label class="mb-2 text-primary">Kategori</label>
                                <?php foreach ($kategori as $kat): ?>
                                    <div class="form-check">
                                        <input class="form-check-input auto-submit" type="checkbox" name="kategori[]"
                                            id="kategori<?= $kat->id_kategori ?>" value="<?= $kat->id_kategori ?>">
                                        <label class="form-check-label" for="kategori<?= $kat->id_kategori ?>">
                                            <?= $kat->nama_kategori ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grid-topbar d-flex justify-content-between align-items-center mb-4">
                        <input type="text" name="keyword" class="form-control w-100" placeholder="Cari produk...">
                    </div>
                    <div id="ajax-katalog">
                        <?php $this->load->view('katalog_items', ['items' => $items]); ?>
                    </div>
                    <div id="ajax-pagination">
                        <?php $this->load->view('katalog_pagination', [
                            'page' => $page,
                            'start' => $start,
                            'end' => $end,
                            'total_page' => $total_page
                        ]); ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>