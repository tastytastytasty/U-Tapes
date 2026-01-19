<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .qty-plus,
    .qty-minus {
        height: 48px;
        width: 48px;
    }

    #qty {
        height: 48px;
        text-align: center;
        font-weight: 600;
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

    .size-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .size-box {
        min-width: 45px;
        padding: 8px 12px;
        text-align: center;
        border: 1px solid #0d6efd;
        border-radius: 6px;
        cursor: pointer;
        user-select: none;
    }

    .size-box.active {
        background: #0d6efd;
        color: #fff;
    }

    .size-box.disabled {
        opacity: .4;
        cursor: not-allowed;
        border-style: dashed;
        pointer-events: none;
    }
    .product-main-img {
        width: 600px;
        height: 600px;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .product-main-img {
            width: 260px;
            height: 260px;
            margin: 0 auto;
            display: block;
        }

        .mobile-title h5 {
            font-size: 16px;
            line-height: 1.3;
        }
    }
</style>
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Detail Produk</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Homepage</a></li>
                    <li><a href="<?= site_url('katalog') ?>">Katalog Produk</a></li>
                    <li><?= $item->nama_sepatu ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Item Details -->
<section class="item-details section">
    <div class="container-fluid px-4">
        <div class="top-area">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="product-images">
                        <div class="mobile-title d-block d-lg-none text-center mb-2">
                            <h5 class="fw-bold"><?= $item->nama_sepatu ?></h5>
                        </div>
                        <main id="gallery">
                            <div class="main-img" style="position: relative;">
                                <?php if ($item->is_new): ?>
                                    <span style="position: absolute;top: 10px;left: 10px;
                                        z-index: 10;padding: 4px 10px;font-size: 13px;font-weight: 600;
                                        color: #fff;background: #0d6efd;
                                        border-radius: 4px;">Baru
                                    </span>
                                <?php endif; ?>
                                <img src="<?= base_url('assets/images/item/' . $gambar_detail) ?>"
                                    class="product-main-img" id="current" alt="#">
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="mb-2 d-none d-lg-block"><?= $item->nama_sepatu ?></h2>
                        <label><i class="lni lni-tag me-2"></i> <?= $item->nama_kategori ?> | <label
                                class="text-primary"><?= $item->merk ?></label></label>
                        <hr class="text text-primary">
                        <h4 id="harga">Rp. <?= number_format($harga, 0, ',', '.') ?></h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group color-option">
                                    <label class="title-label">Pilih Warna</label>
                                    <div class="color-wrapper d-flex gap-2 flex-wrap mt-4">
                                        <?php foreach ($warna as $w): ?>
                                            <div class="card d-flex justify-content-center align-items-center"
                                                style="width:120px; height:60px; border-radius:12px; cursor:pointer;">
                                                <label class="color-radio d-flex align-items-center m-0"
                                                    style="cursor:pointer;">
                                                    <input type="radio" name="warna" value="<?= $w->id_warna ?>"
                                                        <?= $w->id_warna == $default_warna ? 'checked' : '' ?>
                                                        style="display:none;">
                                                    <span class="color-circle mb-1 me-2" style="width:30;height:30;border-radius:50%;
                                                        background-color:<?= $w->hex ?>;">
                                                    </span>
                                                    <span style="font-size:13px;font-weight:500;" class="text-dark">
                                                        <?= $w->warna ?>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pilih Ukuran</label>
                                    <div id="ukuran-wrapper" class="size-wrapper d-flex gap-2 flex-wrap"></div>
                                    <input type="hidden" id="ukuran" name="ukuran">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group quantity">
                                    <label>Jumlah</label>
                                    <div class="input-group input-group-sm" style="max-width:150px">
                                        <button class="btn btn-outline-primary qty-minus" type="button">−</button>
                                        <input type="number" id="qty" class="form-control" min="0" value="0">
                                        <button class="btn btn-outline-primary qty-plus" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <div class="row align-items-end">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="button mt-2">
                                        <a href="<?= site_url('checkout') ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="lni lni-wallet"></i> Checkout
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn btn-wishlist" data-id="<?= $item->id_item ?>"
                                            data-login="<?= $this->session->userdata('id_customer') ? '1' : '0' ?>">
                                            <i class="lni <?= $in_wishlist ? 'lni-heart-filled' : 'lni-heart' ?>"></i>
                                            To Wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <hr class="text text-primary">
                            <div class="info-body custom-responsive-margin">
                                <h4 class="mb-2">Deskripsi</h4>
                                <p><?= $item->deskripsi ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('.btn-wishlist-detail').on('click', function () {
        let btn = $(this);
        let icon = btn.find('i');
        let id_item = btn.data('id');

        $.ajax({
            url: "<?= site_url('wishlist/toggle') ?>",
            type: "POST",
            data: { id_item: id_item },
            dataType: "json",
            success: function (res) {

                if (res.status === 'login') {
                    $('#loginModal').modal('show');
                    return;
                }

                if (res.status === 'added') {
                    icon.removeClass('lni-heart').addClass('lni-heart-filled');
                }

                if (res.status === 'removed') {
                    icon.removeClass('lni-heart-filled').addClass('lni-heart');
                }
            }
        });
    });
</script>

<!-- End Item Details -->