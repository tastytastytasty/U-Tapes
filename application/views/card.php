<div class="row">
    <?php foreach ($items as $item): ?>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="single-product d-flex flex-column h-100 mt-0">
                <div class="product-image position-relative">
                    <a href="<?= site_url('detailproduct/' . $item->id_item) ?>">
                        <?php if ($item->total_stok <= 0): ?>
                            <div class="stok-overlay">HABIS</div>
                        <?php endif; ?>
                        <img src="<?= base_url('assets/images/item/' . $item->gambar) ?>" alt="<?= $item->nama_sepatu ?>">
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
                    <span class="category text-primary"><?= $item->nama_kategori ?> | <?= $item->merk ?></span>
                    <h4 class="title">
                        <a href="<?= site_url('detailproduct/' . $item->id_item) ?>">
                            <?= $item->nama_sepatu ?>
                        </a>
                    </h4>
                    <div class="color-wrapper d-flex gap-2 flex-wrap mt-2">
                        <?php if (!empty($item->warna)): ?>
                            <?php foreach ($item->warna as $w): ?>
                                    <label class="color-radio d-flex align-items-center m-0" style="cursor:pointer;">
                                        <input type="radio" name="warna" value="<?= $w->id_warna ?>" <?= isset($default_warna) && $w->id_warna == $default_warna ? 'checked' : '' ?> style="display:none;">
                                        <span class="color-circle mb-1 me-2"
                                            style="width:30px;height:30px;border-radius:50%;background-color:<?= $w->hex ?>;">
                                        </span>
                                    </label>
                            <?php endforeach; ?>
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
                </div>
            </div>
            <!-- End Single Product -->
        </div>
    <?php endforeach; ?>
</div>