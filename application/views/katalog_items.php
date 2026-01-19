<style>
    .title {
        font-size: 25px;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .title {
            font-size: 15px;
            line-height: 1.3;
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
                <div class="single-product card h-100">
                    <div class="product-image position-relative">
                        <img src="<?= base_url('assets/images/item/' . $item->gambar) ?>" alt="<?= $item->nama_sepatu ?>">
                        <div class="product-actions position-absolute top-0 end-0 m-2
                    <?= $item->in_wishlist ? 'in-wishlist' : 'not-in-wishlist' ?>">
                            <button class="btn btn-sm btn-danger btn-wishlist" data-page="catalog"
                                data-id="<?= $item->id_item ?>"
                                data-login="<?= $this->session->userdata('logged_in') ? 1 : 0 ?>">
                                <i class="lni <?= $item->in_wishlist ? 'lni-heart-filled' : 'lni-heart' ?>"></i>
                            </button>
                        </div>
                        <?php if ($item->is_new): ?>
                            <span class="new-tag">Baru</span>
                        <?php endif; ?>
                        <div class="button">
                            <a href="<?= site_url('detailproduct/' . $item->id_item) ?>" class="btn">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    <div class="product-info mt-2">
                        <span class="category text-primary fw-bold"><?= $item->nama_kategori ?> | <?= $item->merk ?></span>
                        <h5 class="title my-2"><?= $item->nama_sepatu ?></h5>
                        <div class="price mb-3">
                            Rp <?= number_format($item->harga_termurah, 0, ',', '.') ?>
                        </div>
                        <?php if ($item->total_stok <= 0): ?>
                            <span class="category text-danger fw-bold">Stok sedang kosong</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>