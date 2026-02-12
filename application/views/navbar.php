<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>U-taps</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.svg') ?>" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/LineIcons.3.0.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tiny-slider.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/glightbox.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
</head>
<style>
    .profile-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .user a {
        cursor: pointer;
    }

    .middle-right-area .main-btn {
        position: relative;
    }

    .mega-category-menu.user-menu {
        width: auto !important;
        max-width: max-content !important;
        display: inline-flex !important;
        align-items: center;
        margin-left: auto;
        padding: 0 !important;
    }

    .mega-category-menu.user-menu .user-trigger {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .mega-category-menu.user-menu .profile-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .mega-category-menu.user-menu:hover .sub-category {
        display: block;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        background: #0d6efd;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        text-transform: uppercase;
    }

    body.modal-open {
        padding-right: 0 !important;
    }

    body.modal-open .navbar-area {
        padding-right: 0 !important;
    }

    .navbar-area {
        background: #fff;
        border-bottom: 1px solid #eee;
        top: 0;
        z-index: 1000;
        padding-right: 0 !important;
    }

    .navbar-nav .nav-link {
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    .navbar-nav .nav-link.active {
        color: #0d6efd;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            padding: 15px 0;
        }
    }

    html,
    body {
        overflow-x: hidden;
    }

    .cart-items {
        position: relative;
    }

    .cart-items .shopping-item {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 10px;
        z-index: 9999;
        min-width: 280px;
    }
</style>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <header class="header navbar-area">
        <div class="header-middle">
            <div class="container-fluid px-4">
                <nav class="navbar navbar-expand-lg position-relative">
                    <a class="navbar-brand" href="<?= site_url('homepage') ?>">
                        <img src="<?= base_url('assets/images/logo/logo.svg') ?>" alt="Logo" style="height:40px;">
                    </a>
                    <button class="navbar-toggler border-0 my-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mainNavbar">
                        <i class="lni lni-menu fs-3"></i>
                    </button>
                    <!-- MENU (CENTER) -->
                    <div class="collapse navbar-collapse position-absolute start-50 translate-middle-x" id="mainNavbar">
                        <ul class="navbar-nav mx-auto text-center gap-lg-4 py-3 py-lg-0">
                            <?php $controller = $this->router->fetch_class(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($controller == 'homepage') ? 'active' : '' ?>"
                                    href="<?= site_url('homepage') ?>" style="font-size: 17px;">
                                    Beranda
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($controller == 'katalog') ? 'active' : '' ?>"
                                    href="<?= site_url('katalog') ?>" style="font-size: 17px;">
                                    Katalog Produk
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" style="font-size: 17px;">
                                    Tentang Kami
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- RIGHT ICON -->
                    <div class="d-flex align-items-center gap-3 ms-auto">

                        <div class="navbar-cart">
                            <div class="cart-items me-3">
                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-ticket"></i>
                                </a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>1 Items</span>
                                        <a href="<?= site_url('keranjang') ?>">Selengkapnya</a>
                                    </div>
                                    <ul class="shopping-list">
                                        <li>
                                            <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                                    class="lni lni-close"></i></a>
                                            <div class="cart-img-head">
                                                <a class="cart-img" href="<?= site_url('detailproduct') ?>"><img
                                                        src="<?= base_url('assets/images/header/cart-items/item1.jpg') ?>"
                                                        alt="#"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="<?= site_url('detailproduct') ?>">
                                                        Apple Watch Series 6</a></h4>
                                                <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cart-items me-3">
                                <?php if ($this->session->userdata('logged_in')): ?>
                                    <a href="javascript:void(0)" class="main-btn btn-wishlist-navbar"
                                        data-href="<?= site_url('wishlist') ?>">
                                        <i class="lni lni-heart"></i>
                                        <span class="total-items total-wishes"><?= $wishlist_count ?></span>
                                    </a>
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span id="wishlist-count"><?= $wishlist_count ?> Item</span>
                                            <a href="<?= site_url('wishlist') ?>">Lihat Semua</a>
                                        </div>
                                        <ul class="shopping-list" id="wishlist-list">
                                            <?php if (!empty($wishlist_items)): ?>
                                                <?php foreach ($wishlist_items as $w): ?>
                                                    <li id="nav-wishlist-<?= $w->id_wishlist ?>">
                                                        <a href="javascript:void(0)" class="remove btn-remove-wishlist"
                                                            data-wishlist="<?= $w->id_wishlist ?>">
                                                            <i class="lni lni-close"></i>
                                                        </a>

                                                        <div class="cart-img-head">
                                                            <a class="cart-img"
                                                                href="<?= site_url('detailproduct/' . $w->id_item) ?>">
                                                                <img src="<?= base_url('assets/images/item/' . $w->gambar_item) ?>">
                                                            </a>
                                                        </div>

                                                        <div class="content">
                                                            <h4>
                                                                <a href="<?= site_url('detailproduct/' . $w->id_item) ?>">
                                                                    <?= $w->nama_item ?>
                                                                </a>
                                                            </h4>
                                                            <p class="quantity">
                                                                <span class="amount">
                                                                    Rp <?= number_format($w->harga_termurah, 0, ',', '.') ?>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </ul>
                                        <div id="wishlist-empty" class="dropdown-cart-header"
                                            style="<?= $wishlist_count > 0 ? 'display:none' : '' ?>">
                                            <span>Wishlist kosong</span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="main-btn btn-wishlist-navbar" data-need-login="1">
                                        <i class="lni lni-heart"></i>
                                    </a>
                                    <div class="shopping-item text-center p-3">
                                        <p class="mb-3 text-muted">
                                            <i class="lni lni-lock me-1"></i>
                                            Login dulu untuk melihat wishlist
                                        </p>
                                        <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary w-100">
                                            Login Sekarang
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="cart-items me-3">
                                <?php if ($this->session->userdata('logged_in')): ?>
                                    <a href="javascript:void(0)" class="main-btn btn-cart-navbar"
                                        data-href="<?= site_url('keranjang') ?>">
                                        <i class="lni lni-cart"></i>
                                        <span class="total-items total-cart"><?= $cart_count ?></span>
                                    </a>
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span id="cart-count"><?= $cart_count ?> Item</span>
                                            <a href="<?= site_url('keranjang') ?>">Lihat Semua</a>
                                        </div>
                                        <ul class="shopping-list" id="cart-list">
                                            <?php if (!empty($cart_items)): ?>
                                                <?php foreach ($cart_items as $c): ?>
                                                    <li id="nav-cart-<?= $c->id_cart ?>">
                                                        <a href="javascript:void(0)" class="remove btn-remove-cart"
                                                            data-cart="<?= $c->id_cart ?>">
                                                            <i class="lni lni-close"></i>
                                                        </a>
                                                        <div class="cart-img-head">
                                                            <a class="cart-img"
                                                                href="<?= site_url('detailproduct/' . $c->id_item) ?>">
                                                                <img src="<?= base_url('assets/images/item/' . $c->gambar) ?>">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <h4>
                                                                <a href="<?= site_url('detailproduct/' . $c->id_item) ?>">
                                                                    <?= $c->nama_item ?> (<?= $c->ukuran ?>)
                                                                </a>
                                                            </h4>
                                                            <p class="quantity">
                                                                <span class="amount">
                                                                    Rp <?= number_format($c->total, 0, ',', '.') ?> (<?= $c->qty ?>)
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                            <div class="bottom">
                                                <div class="total">
                                                    <span>Total</span>
                                                    <span class="total-amount">Rp
                                                        <?= number_format($cart_total, 0, ',', '.') ?></span>
                                                </div>
                                                <div class="button">
                                                    <a href="<?= site_url('checkout') ?>" class="btn animate">Checkout</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div id="cart-empty" class="dropdown-cart-header"
                                            style="<?= $cart_count > 0 ? 'display:none' : '' ?>">
                                            <span>Keranjang belanja kosong</span>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="javascript:void(0)" class="main-btn btn-cart-navbar" data-need-login="1">
                                    <i class="lni lni-cart"></i>
                                </a>
                                <div class="shopping-item text-center p-3">
                                    <p class="mb-3 text-muted">
                                        <i class="lni lni-lock me-1"></i>
                                        Login dulu untuk melihat keranjang belanja
                                    </p>
                                    <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary w-100">
                                        Login Sekarang
                                    </a>
                                </div>
                            <?php endif; ?>
                            <!-- End Shopping Item -->
                        </div>
                    </div>
                    <div class="user d-flex align-items-center gap-2">
                        <?php if ($this->session->userdata('logged_in')): ?>
                            <?php
                            $user = $this->session->userdata('user');
                            $nama = $user['nama'] ?? 'User';
                            $avatar = $user['avatar'] ?? null;
                            $inisial = strtoupper(substr($nama, 0, 1));

                            $avatarFile = FCPATH . 'assets/images/avatar/' . $avatar;
                            ?>
                            <div class="mega-category-menu user-menu">
                                <div class="user-trigger d-flex align-items-center gap-2">

                                    <?php if (!empty($avatar) && file_exists($avatarFile)): ?>
                                        <img src="<?= base_url('assets/images/avatar/' . $avatar) ?>" alt="Profile"
                                            class="profile-img">
                                    <?php else: ?>
                                        <div class="avatar-circle">
                                            <?= $inisial ?>
                                        </div>
                                    <?php endif; ?>

                                    <span class="cat-button">
                                        <?= html_escape($nama) ?>
                                    </span>
                                </div>

                                <ul class="sub-category">
                                    <li><a href="<?= site_url('profile') ?>">Profile</a></li>
                                    <li><a href="<?= site_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </div>

                        <?php else: ?>
                            <div class="button ms-2">
                                <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary animate">
                                    Login
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
            </div>
            </nav>
        </div>
        </div>
    </header>

    <?= $contents; ?>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-2">Untuk menggunakan fitur ini, silakan login terlebih dahulu</p>
                    <a href="<?= site_url('login') ?>" class="btn btn-primary">Login</a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus item ini dari wishlist?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-danger" id="btnConfirmDelete">
                        Ya, hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container-fluid px-4">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="<?= site_url('homepage') ?>">
                                    <img src="<?= base_url('assets/images/logo/white-logo.svg') ?>" alt="#">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    Subscribe to our Newsletter
                                    <span>Get all the latest information, Sales and Offers.</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="#" method="get" target="_blank" class="newsletter-form">
                                        <input name="EMAIL" placeholder="Email address here..." type="email">
                                        <div class="button">
                                            <button class="btn">Subscribe<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <!-- Start Footer Middle -->
        <div class="footer-middle">
            <div class="container-fluid px-4">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-contact">
                                <h3>Get In Touch With Us</h3>
                                <p class="phone">Phone: +1 (900) 33 169 7720</p>
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer our-app">
                                <h3>Our Mobile App</h3>
                                <ul class="app-btn">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-apple"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">App Store</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-play-store"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">Google Play</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Information</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Shop Departments</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                    <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                    <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                    <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                    <li><a href="javascript:void(0)">Headphones</a></li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container-fluid px-4">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>We Accept:</span>
                                <img src="<?= base_url('assets/images/footer/credit-cards-footer.png') ?>" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>Designed and Developed by<a href="https://graygrids.com/" rel="nofollow"
                                        target="_blank">GrayGrids</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="socila">
                                <li>
                                    <span>Follow Us On:</span>
                                </li>
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/tiny-slider.js') ?>"></script>
    <script src="<?= base_url('assets/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
    <script>
        const DEFAULT_UKURAN = '<?= $default_ukuran ?>';
        const TOTAL_STOK = <?= (int) $total_stok ?>;
        $(document).ready(function () {
            const id_item = '<?= $item->id_item ?>';
            let currentStok = 0;
            let itemHabis = TOTAL_STOK <= 0;
            if (itemHabis) {
                $('#qty').val(0).prop('disabled', true);
                $('.qty-plus, .qty-minus').prop('disabled', true);
            }
            $(document).on('change', 'input[name="warna"]', function () {
                const warna = $(this).val();
                $.post(
                    '<?= site_url("ajax/get_gambar_warna") ?>',
                    { id_item, warna },
                    function (res) {
                        const data = JSON.parse(res);
                        if (data.gambar) {
                            $('#current').fadeOut(100, function () {
                                $(this)
                                    .attr('src', '<?= base_url("assets/images/item/") ?>' + data.gambar)
                                    .fadeIn(150);
                            });
                        }
                    }
                );
                $.post(
                    '<?= site_url("ajax/get_ukuran") ?>',
                    { id_item, warna },
                    function (res) {
                        $('#ukuran-wrapper').html(res);
                        $('#ukuran').val('');

                        if (itemHabis) {
                            $('.size-box').addClass('disabled').removeClass('active');
                            return;
                        }

                        let target = $('.size-box[data-ukuran="' + DEFAULT_UKURAN + '"]:not(.disabled)');
                        if (!target.length) {
                            target = $('.size-box:not(.disabled)').first();
                        }

                        if (target.length) {
                            target.trigger('click');
                        } else {
                            $('#qty').val(0).prop('disabled', true);
                        }
                    }
                );
                $.post(
                    '<?= site_url("ajax/get_detail") ?>',
                    { id_item, warna, ukuran: $('#ukuran').val() },
                    function (res) {
                        const data = JSON.parse(res);
                        updateCartButton(data);
                    }
                );
            });
            
            $(document).on('click', '.size-box:not(.disabled)', function () {
                if (itemHabis) return;
                $('.size-box').removeClass('active');
                $(this).addClass('active');
                const ukuran = $(this).data('ukuran');
                const warna = $('input[name="warna"]:checked').val();
                $('#ukuran').val(ukuran);
                $.post(
                    '<?= site_url("ajax/get_detail") ?>',
                    { id_item, warna, ukuran },
                    function (res) {
                        const data = JSON.parse(res);
                        if (data.harga_diskon && data.harga_diskon < data.harga_asli) {
                            $('.price').html(`
                                <h4>Rp ${new Intl.NumberFormat('id-ID').format(data.harga_diskon)}</h4>
                                <span class="discount-price text-muted text-decoration-line-through fs-5 mt-2" style="margin-left: 0 !important;">
                                    Rp ${new Intl.NumberFormat('id-ID').format(data.harga_asli)}
                                </span>
                            `);
                        } else {
                            $('.price').html(`
                                <h4>Rp ${new Intl.NumberFormat('id-ID').format(data.harga_asli || data.harga)}</h4>
                            `);
                        }
                        currentStok = parseInt(data.stok);
                        if (currentStok <= 0) {
                            $('#qty').val(0).prop('disabled', true);
                        } else {
                            $('#qty').val(1).prop('disabled', false);
                        }
                    }
                );
            });
            $(document).on('click', '.qty-plus', function () {
                if (itemHabis || $('#qty').prop('disabled')) return;

                let qty = parseInt($('#qty').val()) || 0;
                if (qty < currentStok) {
                    $('#qty').val(qty + 1);
                }
            });
            $(document).on('click', '.qty-minus', function () {
                if (itemHabis || $('#qty').prop('disabled')) return;

                let qty = parseInt($('#qty').val()) || 0;
                if (qty > 1) {
                    $('#qty').val(qty - 1);
                }
            });
            $(document).on('input', '#qty', function () {
                if (itemHabis || $(this).prop('disabled')) return;

                let qty = parseInt($(this).val()) || 1;
                if (qty < 1) qty = 1;
                if (qty > currentStok) qty = currentStok;
                $(this).val(qty);
            });
            $('input[name="warna"]:checked').trigger('change');
        });
    </script>
    <script>
        let wishlistId = null;
        $(document).on('click', '.btn-wishlist', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let btn = $(this);
            let page = btn.data('page');
            let icon = btn.find('i');
            let isLogin = btn.data('login');
            let id_item = btn.data('id');
            if (page === 'wishlist') {
                wishlistId = btn.data('wishlist');
                $('#confirmDeleteModal').modal('show');
                return;
            }
            if (isLogin == 0) {
                $('#loginModal').modal('show');
                return;
            }
            $.ajax({
                url: "<?= site_url('wishlist/toggle') ?>",
                type: "POST",
                data: { id_item: id_item },
                dataType: "json",
                success: function (res) {

                    if (res.status === 'added') {
                        icon.removeClass('lni-heart')
                            .addClass('lni-heart-filled');
                            showAlert('Masuk ke wishlist!', 'success');
                    }

                    if (res.status === 'removed') {
                        icon.removeClass('lni-heart-filled')
                            .addClass('lni-heart');
                        showAlert('Dihapus dari wishlist', 'info');
                    }
                }
            });
        });
        $(document).ready(function () {
            let sisa = $('#wishlist-container .wishlist-item').length;

            if (sisa === 0) {
                $('#wishlist-container').hide();
                $('#wishlist-empty').removeClass('d-none');
            }
        });
        $('#btnConfirmDelete').on('click', function () {
            $.ajax({
                url: "<?= site_url('wishlist/delete') ?>",
                type: "POST",
                data: { id_wishlist: wishlistId },
                dataType: "json",
                success: function (res) {
                    if (res.status !== 'success') return;

                    let $item = $('#wishlist-' + wishlistId);

                    $item.fadeOut(300, function () {
                        $(this).remove();

                        let sisa = $('.wishlist-item').length;

                        if (sisa === 0) {
                            $('#wishlist-container').remove();
                            $('#wishlist-empty').removeClass('d-none').show();
                        }
                    });

                    $('#confirmDeleteModal').modal('hide');
                }
            });
        });
        $(document)
            .off('click', '.btn-remove-wishlist')
            .on('click', '.btn-remove-wishlist', function (e) {
                e.preventDefault();
                e.stopPropagation();
                let id = $(this).data('wishlist');
                $.ajax({
                    url: "<?= site_url('wishlist/delete') ?>",
                    type: "POST",
                    data: { id_wishlist: id },
                    dataType: "json",
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#nav-wishlist-' + id).fadeOut(300, function () {
                                $(this).remove();
                                let sisa = $('#wishlist-list li').length;
                                $('.total-wishes').text(sisa);
                                $('#wishlist-count').text(sisa + ' Item');
                                if (sisa === 0) {
                                    $('#wishlist-list').hide();
                                    $('#wishlist-empty').show();
                                }
                            });
                        }
                    }
                });
            });
    </script>
    <script>
        let typingTimer;
        const typingDelay = 500;

        function loadKatalog(page = 1) {
            const formData = $('#filterForm').serialize();

            $.ajax({
                url: "<?= site_url('katalog/ajax_katalog/') ?>" + page,
                type: "GET",
                data: formData,
                dataType: "json",
                success: function (res) {
                    $('#ajax-katalog').html(res.html);
                    $('#ajax-pagination').html(res.pagination);
                }
            });
        }
        $(document).on('change', '.auto-submit', function () {
            loadKatalog(1);
        });
        $(document).on('keyup', 'input[name="keyword"]', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => loadKatalog(1), typingDelay);
        });
        $(document).on('keydown', 'input[name="keyword"]', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                loadKatalog(1);
                return false;
            }
        });
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            loadKatalog($(this).data('page'));
        });
        $(document).ready(function () {
            loadKatalog(1);
        });
    </script>

</body>

</html>