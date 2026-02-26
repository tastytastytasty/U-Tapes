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
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

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

    .login-modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0, 0, 0, 0.14), 0 4px 16px rgba(0, 0, 0, 0.08);
        background: #ffffff;
        animation: modalSlideUp 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modalSlideUp {
        from {
            transform: translateY(24px) scale(0.97);
            opacity: 0;
        }

        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    .login-modal-accent {
        height: 5px;
        background: linear-gradient(90deg, #0d397b, #0d6efd, #72aaff);
    }

    .btn-close-custom {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #e8ebee;
        color: #0d6efd;
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.2s, color 0.2s, transform 0.2s;
    }

    .btn-close-custom:hover {
        background: #d4d6db;
        color: #0d397b;
        transform: rotate(90deg);
    }

    .login-modal-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto;
        border-radius: 50%;
        background: linear-gradient(135deg, #deebff, #c8deff);
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        letter-spacing: -0.02em;
    }

    .login-modal-text {
        font-size: 0.9rem;
        color: #6b7280;
        line-height: 1.6;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .login-modal-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0d6efd, #0d397b);
        color: #fff !important;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s, filter 0.2s;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        width: 100%;
        justify-content: center;
    }

    .login-modal-btn:hover {
        filter: brightness(1.08);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }

    .login-modal-btn:active {
        transform: translateY(0);
    }

    .login-modal-cancel {
        font-size: 0.8rem;
        margin-bottom: 0;
    }

    .login-modal-cancel a {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.2s;
    }

    .login-modal-cancel a:hover {
        color: #6b7280;
        text-decoration: underline;
    }

    .delete-accent {
        background: linear-gradient(90deg, #c91818, #ef4444, #ff8888) !important;
    }

    .delete-icon {
        background: linear-gradient(135deg, #ffefef, #fadada) !important;
        color: #ef4444 !important;
    }

    .delete-btn {
        background: linear-gradient(135deg, #ef4444, #c91818) !important;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.35) !important;
    }

    .delete-btn:hover {
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.45) !important;
    }

    .delete-modal .btn-close-custom {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #fee8e8;
        color: #ef4444;
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.2s, color 0.2s, transform 0.2s;
    }

    .delete-modal .btn-close-custom:hover {
        background: #ffcbcb;
        color: #c91818;
    }
    .nav-cart-item-empty {
    position: relative;
    }
    .nav-cart-item-empty .remove {
        opacity: 1 !important;
        pointer-events: all !important;
        z-index: 10;
        position: relative;
    }

    .nav-cart-item-empty .input-group button:disabled,
    .nav-cart-item-empty .input-group input:disabled {
        pointer-events: none;
        cursor: not-allowed;
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
        left: 25%;
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
                                <a href="<?= site_url('promo') ?>" class="main-btn">
                                    <i class="lni lni-ticket"></i>
                                </a>
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
                                            Masuk dulu untuk melihat wishlist
                                        </p>
                                        <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary w-100">
                                            Masuk Sekarang
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="cart-items me-3">
                                <?php if ($this->session->userdata('logged_in')): ?>
                                    <a href="javascript:void(0)" class="main-btn btn-cart-navbar"
                                        data-href="<?= site_url('keranjang') ?>">
                                        <i class="lni lni-cart"></i>
                                        <span class="total-items total-carts"><?= $cart_count ?></span>
                                    </a>
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span id="cart-count"><?= $cart_count ?> Item</span>
                                            <a href="<?= site_url('keranjang') ?>">Lihat Semua</a>
                                        </div>
                                        <ul class="shopping-list" id="cart-list">
                                            <?php if (!empty($cart_items)): ?>
                                                <?php
                                                $total_items = count($cart_items);
                                                $displayed_items = array_slice($cart_items, 0, 3);
                                                $remaining_items = $total_items - 3;
                                                foreach ($displayed_items as $c):
                                                    $is_empty = ($c->stok <= 0);

                                                    $harga_asli = $c->harga * $c->qty;
                                                    $harga_diskon = $harga_asli;
                                                    if (!$is_empty && $c->is_sale) {
                                                        if ($c->persen_promo > 0) {
                                                            $harga_diskon = $harga_asli - ($harga_asli * $c->persen_promo / 100);
                                                        } elseif ($c->harga_promo > 0) {
                                                            $harga_diskon = $harga_asli - ($c->harga_promo * $c->qty);
                                                        }
                                                    }
                                                ?>
                                                    <li id="nav-cart-<?= $c->id_cart ?>" class="<?= $is_empty ? 'nav-cart-item-empty' : '' ?>">
                                                        <a href="javascript:void(0)" class="remove btn-remove-cart" data-cart="<?= $c->id_cart ?>">
                                                            <i class="lni lni-close"></i>
                                                        </a>
                                                        <div class="row" style="<?= $is_empty ? 'opacity: 0.5;' : '' ?>">
                                                            <div class="cart-img-head">
                                                                <a class="cart-img" href="<?= site_url('detailproduct/' . $c->id_item) ?>">
                                                                    <img src="<?= base_url('assets/images/item/' . $c->gambar) ?>"
                                                                        style="<?= $is_empty ? 'filter: grayscale(60%);' : '' ?>">
                                                                </a>
                                                            </div>
                                                            <div class="content">
                                                                <h4>
                                                                    <a href="<?= site_url('detailproduct/' . $c->id_item) ?>">
                                                                        <?= $c->nama_item ?> (<?= $c->ukuran ?>)
                                                                    </a>
                                                                </h4>
                                                                <?php if ($is_empty): ?>
                                                                    <small class="text-danger fw-semibold">
                                                                        <i class="lni lni-ban"></i> Produk tidak tersedia
                                                                    </small>
                                                                <?php else: ?>
                                                                    <small class="text-muted">Stok: <?= $c->stok ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="mt-2 d-flex justify-content-between gap-2">
                                                                <div class="input-group input-group-sm" style="max-width:100px">
                                                                    <button class="btn btn-outline-primary cart-qty-minus"
                                                                        data-cart="<?= $c->id_cart ?>" data-price="<?= $c->harga ?>"
                                                                        data-stok="<?= $c->stok ?>" type="button"
                                                                        <?= $is_empty ? 'disabled' : '' ?>>−</button>
                                                                    <input type="number"
                                                                        class="form-control cart-qty-input text-center"
                                                                        id="cart-qty-<?= $c->id_cart ?>"
                                                                        data-cart="<?= $c->id_cart ?>" data-price="<?= $c->harga ?>"
                                                                        data-stok="<?= $c->stok ?>"
                                                                        data-persen="<?= $c->persen_promo ?>"
                                                                        data-promo="<?= $c->harga_promo ?>"
                                                                        data-issale="<?= $is_empty ? 0 : $c->is_sale ?>"
                                                                        min="1" max="<?= $c->stok ?>" value="<?= $c->qty ?>"
                                                                        <?= $is_empty ? 'disabled' : '' ?>>
                                                                    <button class="btn btn-outline-primary cart-qty-plus"
                                                                        data-cart="<?= $c->id_cart ?>" data-price="<?= $c->harga ?>"
                                                                        data-stok="<?= $c->stok ?>" type="button"
                                                                        <?= $is_empty ? 'disabled' : '' ?>>+</button>
                                                                </div>
                                                                <div class="quantity mt-2">
                                                                    <?php if ($is_empty): ?>
                                                                        <h6 class="amount text-muted mb-0" id="item-total-<?= $c->id_cart ?>">-</h6>
                                                                    <?php else: ?>
                                                                        <h6 class="amount text-dark mb-0" id="item-total-<?= $c->id_cart ?>">
                                                                            Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
                                                                        </h6>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                                <?php if ($remaining_items > 0): ?>
                                                    <li style="text-align: center; padding: 10px; background: #f8f9fa;">
                                                        <a href="<?= site_url('keranjang') ?>" style="color: #0d6efd; text-decoration: none;">
                                                            <strong><?= $remaining_items ?> produk lainnya...</strong>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <div class="bottom">
                                                <div class="total">
                                                    <span>Total</span>
                                                    <span class="total-amount" id="cart-total">Rp
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
                                        Masuk dulu untuk melihat keranjang belanja
                                    </p>
                                    <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary w-100">
                                        Masuk Sekarang
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
                                    <li><a href="<?= site_url('profile') ?>">Profil</a></li>
                                    <li><a href="<?= site_url('login/logout') ?>">Keluar</a></li>
                                </ul>
                            </div>

                        <?php else: ?>
                            <div class="button ms-2">
                                <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary animate">
                                    Masuk
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
            <div class="modal-content login-modal-content">
                <div class="login-modal-accent"></div>
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <button type="button" class="btn-close-custom ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body text-center px-5 pb-5 pt-2">
                    <div class="login-modal-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h5 class="login-modal-title mb-2">Masuk Diperlukan</h5>
                    <p class="login-modal-text mb-4">Untuk menggunakan fitur ini, silakan masuk ke akun Anda terlebih
                        dahulu.</p>
                    <a href="<?= site_url('login') ?>" class="btn login-modal-btn">
                        <span>Masuk Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content login-modal-content delete-modal">
                <div class="login-modal-accent delete-accent"></div>
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <button type="button" class="btn-close-custom ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body text-center px-5 pb-5 pt-2">
                    <div class="login-modal-icon delete-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                            <path d="M10 11v6"></path>
                            <path d="M14 11v6"></path>
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                        </svg>
                    </div>
                    <h5 class="login-modal-title mb-2">Hapus dari Wishlist?</h5>
                    <p class="login-modal-text mb-4">Apakah Anda yakin ingin menghapus item ini dari wishlist?</p>
                    <button type="button" class="btn login-modal-btn delete-btn mb-2" id="btnConfirmDelete">
                        <span>Ya, Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content login-modal-content delete-modal">
                <div class="login-modal-accent delete-accent"></div>
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <button type="button" class="btn-close-custom ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body text-center px-5 pb-5 pt-2">
                    <div class="login-modal-icon delete-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                            <path d="M10 11v6"></path>
                            <path d="M14 11v6"></path>
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                        </svg>
                    </div>
                    <h5 class="login-modal-title mb-2">Hapus dari Keranjang?</h5>
                    <p class="login-modal-text mb-4">Apakah Anda yakin ingin menghapus item ini dari keranjang?</p>
                    <button type="button" class="btn login-modal-btn delete-btn mb-2" id="modalConfirmOk">
                        <span>Ya, Hapus</span>
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
    <script>
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        function showAlert(message, type = 'error') {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: type,
                title: message,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        }
        $(document).ready(function () {
            updateSummaryByChecklist();
            $(document).on('click', '.cart-qty-plus', function (e) {
                e.preventDefault();
                var cartId = $(this).data('cart');
                var price = $(this).data('price');
                var stok = parseInt($(this).data('stok')) || 0;
                var qtyInput = $('#cart-qty-' + cartId);
                var currentQty = parseInt(qtyInput.val()) || 0;
                var newQty = currentQty + 1;
                updateCartQuantity(cartId, newQty, price, stok);
            });
            $(document).on('click', '.cart-qty-minus', function (e) {
                e.preventDefault();
                var cartId = $(this).data('cart');
                var price = $(this).data('price');
                var stok = parseInt($(this).data('stok')) || 0;
                var qtyInput = $('#cart-qty-' + cartId);
                var currentQty = parseInt(qtyInput.val()) || 0;
                if (currentQty > 1) {
                    var newQty = currentQty - 1;
                    updateCartQuantity(cartId, newQty, price, stok);
                }
            });
            $(document).on('input', '.cart-qty-input', function () {
                var cartId = $(this).data('cart');
                var price = $(this).data('price');
                var stok = parseInt($(this).data('stok')) || 0;
                var qty = parseInt($(this).val()) || 1;
                if (qty < 1) {
                    qty = 1;
                }
                if (qty > stok) {
                    qty = stok;
                }
                $(this).val(qty);
            });
            $(document).on('blur', '.cart-qty-input', function () {
                var cartId = $(this).data('cart');
                var price = $(this).data('price');
                var stok = parseInt($(this).data('stok')) || 0;
                var qty = parseInt($(this).val()) || 1;
                if (qty < 1) qty = 1;
                if (qty > stok) qty = stok;
                $(this).val(qty);
                updateCartQuantity(cartId, qty, price, stok);
            });
            function updateCartQuantity(cartId, qty, price, stok) {
                if (qty < 1) qty = 1;
                if (qty > stok) qty = stok;
                var allInputs = $('.cart-qty-input[data-cart="' + cartId + '"]');
                var qtyInput = allInputs.filter('[data-persen]').first();

                var hargaSatuan = parseFloat(qtyInput.attr('data-price')) || 0;
                var diskonPersen = parseFloat(qtyInput.attr('data-persen')) || 0;
                var diskonRp = parseFloat(qtyInput.attr('data-promo')) || 0;
                var isSale = qtyInput.attr('data-issale') == '1';
                $.ajax({
                    url: '<?= site_url("keranjang/update_quantity") ?>',
                    type: 'POST',
                    data: {
                        id_cart: cartId,
                        qty: qty
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.cart-qty-plus[data-cart="' + cartId + '"]').prop('disabled', true);
                        $('.cart-qty-minus[data-cart="' + cartId + '"]').prop('disabled', true);
                        $('#cart-qty-' + cartId).prop('disabled', true);
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#cart-qty-' + cartId).val(qty);
                            $('.cart-qty-input[data-cart="' + cartId + '"]').val(qty);
                            var hargaAsli = hargaSatuan * qty;
                            var hargaDiskon = hargaAsli;
                            if (isSale) {
                                if (diskonPersen > 0) {
                                    hargaDiskon = hargaAsli - (hargaAsli * diskonPersen / 100);
                                } else if (diskonRp > 0) {
                                    hargaDiskon = hargaAsli - (diskonRp * qty);
                                }
                            }
                            $('#item-harga-asli-' + cartId).text('Rp ' + formatRupiah(Math.round(hargaAsli)));
                            if ($('#item-harga-diskon-' + cartId).length) {
                                $('#item-harga-diskon-' + cartId).text('Rp ' + formatRupiah(Math.round(hargaDiskon)));
                            }
                            $('#item-total-' + cartId).text('Rp ' + formatRupiah(Math.round(hargaDiskon)));
                            var newTotalAsli = 0;
                            var newTotalDiskon = 0;
                            $('#cart-items-wrapper .cart-qty-input').each(function () {
                                var itemQty = parseInt($(this).val()) || 0;
                                var itemHarga = parseFloat($(this).attr('data-price')) || 0;
                                var itemPersen = parseFloat($(this).attr('data-persen')) || 0;
                                var itemPromo = parseFloat($(this).attr('data-promo')) || 0;
                                var itemIsSale = $(this).attr('data-issale') == '1';

                                var itemAsli = itemHarga * itemQty;
                                var itemDiskon = itemAsli;

                                if (itemIsSale) {
                                    if (itemPersen > 0) {
                                        itemDiskon = itemAsli - (itemAsli * itemPersen / 100);
                                    } else if (itemPromo > 0) {
                                        itemDiskon = itemAsli - (itemPromo * itemQty);
                                    }
                                }

                                newTotalAsli += itemAsli;
                                newTotalDiskon += itemDiskon;
                            });
                            var newPotongan = newTotalAsli - newTotalDiskon;
                            $('#summary-harga-asli').text('Rp ' + formatRupiah(Math.round(newTotalAsli)));
                            $('#summary-potongan').text(newPotongan > 0 ? '- Rp ' + formatRupiah(Math.round(newPotongan)) : '-');
                            $('#summary-total-akhir').text('Rp ' + formatRupiah(Math.round(newTotalDiskon)));
                            $('#cart-total').text('Rp ' + formatRupiah(response.cart_total));
                            if (qty >= stok) {
                                $('.cart-qty-plus[data-cart="' + cartId + '"]')
                                    .prop('disabled', true).addClass('disabled');
                            } else {
                                $('.cart-qty-plus[data-cart="' + cartId + '"]')
                                    .removeClass('disabled');
                            }
                        } else {
                            showAlert(response.message || 'Gagal mengupdate keranjang');
                        }
                    },
                    complete: function () {
                        $('.cart-qty-plus[data-cart="' + cartId + '"]').prop('disabled', false);
                        $('.cart-qty-minus[data-cart="' + cartId + '"]').prop('disabled', false);
                        $('#cart-qty-' + cartId).prop('disabled', false);
                        var currentQty = parseInt($('#cart-qty-' + cartId).val());
                        if (currentQty >= stok) {
                            $('.cart-qty-plus[data-cart="' + cartId + '"]')
                                .prop('disabled', true)
                                .addClass('disabled');
                        }
                    }
                });
            }
            if ($('#stok-tersedia').length > 0 && $('#product-qty').length > 0) {
                var currentStok = parseInt($('#stok-tersedia').text()) || 0;
                var itemHabis = currentStok <= 0;
                if (itemHabis) {
                    $('#product-qty').val(0).prop('disabled', true);
                    $('.product-qty-plus, .product-qty-minus').prop('disabled', true);
                }
                $('.product-qty-plus').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (itemHabis || $('#product-qty').prop('disabled')) return;

                    let qty = parseInt($('#product-qty').val()) || 0;
                    if (qty < currentStok) {
                        $('#product-qty').val(qty + 1);
                    }
                });
                $('.product-qty-minus').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (itemHabis || $('#product-qty').prop('disabled')) return;
                    let qty = parseInt($('#product-qty').val()) || 0;
                    if (qty > 1) {
                        $('#product-qty').val(qty - 1);
                    }
                });
                $('#product-qty').on('input', function (e) {
                    e.stopPropagation();
                    if (itemHabis || $(this).prop('disabled')) return;
                    let qty = parseInt($(this).val()) || 1;
                    if (qty < 1) qty = 1;
                    if (qty > currentStok) {
                        qty = currentStok;
                    }
                    $(this).val(qty);
                });
            }
            $('.cart-qty-input').each(function () {
                var cartId = $(this).data('cart');
                var qty = parseInt($(this).val());
                var stok = parseInt($(this).data('stok'));

                if (qty >= stok) {
                    $('.cart-qty-plus[data-cart="' + cartId + '"]')
                        .prop('disabled', true)
                        .addClass('disabled');
                }
            });
        });
        $(document).on('change', '#selectAll', function () {
            var isChecked = $(this).is(':checked');
            $('.item-checkbox:not(:disabled)').each(function () {
                if ($(this).is(':checked') !== isChecked) {
                    $(this).prop('checked', isChecked).trigger('change');
                }
            });
        });

        $(document).on('change', '.item-checkbox', function () {
            var total = $('.item-checkbox:not(:disabled)').length;
            var checked = $('.item-checkbox:not(:disabled):checked').length;
            $('#selectAll').prop('checked', total > 0 && total === checked);
            var idCart = $(this).data('id-cart');
            var checklist = $(this).is(':checked') ? 'Yes' : 'No';
            $.ajax({
                url: '<?= site_url("keranjang/update_checklist") ?>',
                type: 'POST',
                data: { id_cart: idCart, checklist: checklist },
                dataType: 'json',
                success: function (response) {
                    if (!response.success) {
                        showAlert(response.message || 'Gagal update checklist');
                    }
                },
                error: function () {
                    showAlert('Terjadi kesalahan saat update checklist');
                }
            });
            updateSummaryByChecklist();
        });
        function updateSummaryByChecklist() {
            var newTotalAsli = 0;
            var newTotalDiskon = 0;

            $('#cart-items-wrapper .item-checkbox:checked').each(function () {
                var idCart = $(this).attr('data-id-cart');
                var input = $('#cart-items-wrapper .cart-qty-input[data-cart="' + idCart + '"]');

                var itemQty = parseInt(input.val()) || 0;
                var itemHarga = parseFloat(input.attr('data-price')) || 0;
                var itemPersen = parseFloat(input.attr('data-persen')) || 0;
                var itemPromo = parseFloat(input.attr('data-promo')) || 0;
                var itemIsSale = input.attr('data-issale') == '1';

                var itemAsli = itemHarga * itemQty;
                var itemDiskon = itemAsli;

                if (itemIsSale) {
                    if (itemPersen > 0) {
                        itemDiskon = itemAsli - (itemAsli * itemPersen / 100);
                    } else if (itemPromo > 0) {
                        itemDiskon = itemAsli - (itemPromo * itemQty);
                    }
                }

                newTotalAsli += itemAsli;
                newTotalDiskon += itemDiskon;
            });

            var newPotongan = newTotalAsli - newTotalDiskon;

            $('#summary-harga-asli').text('Rp ' + formatRupiah(Math.round(newTotalAsli)));
            $('#summary-potongan').text(newPotongan > 0 ? '- Rp ' + formatRupiah(Math.round(newPotongan)) : '-');
            $('#summary-total-akhir').text('Rp ' + formatRupiah(Math.round(newTotalDiskon)));
        }
        $(document).on('click', 'a[href*="checkout"]', function (e) {
            var checked = $('.item-checkbox:checked').length;
            if (checked === 0) {
                e.preventDefault();
                showAlert('Pilih minimal 1 produk sebelum checkout!');
            }
        });
    </script>
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

                $('#discount-badge').hide().text('');
                updateHargaStok(warna, ukuran);
            });
            $(document).on('change', 'input[name="warna"]', function () {
                if (itemHabis) return;

                const warna = $(this).val();
                const ukuran = $('#ukuran').val() || $('.size-box.active').data('ukuran');

                $('#discount-badge').hide().text('');
                updateHargaStok(warna, ukuran);
            });
            function updateHargaStok(warna, ukuran) {
                if (!warna || !ukuran) return;

                $.ajax({
                    url: '<?= site_url("ajax/get_detail") ?>',
                    type: 'POST',
                    data: {
                        id_item: id_item,
                        warna: warna,
                        ukuran: ukuran
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.price').css('opacity', '0.5');
                        $('#discount-badge').hide().text('');
                    },
                    success: function (data) {
                        console.log('Response dari server:', data);
                        if (data.success) {
                            if (data.is_sale && data.harga_diskon < data.harga_asli) {
                                $('.price').html(`
                                    <div class="d-flex justify-content-start align-items-center gap-2">
                                        <h4 class="mb-0">Rp ${new Intl.NumberFormat('id-ID').format(data.harga_diskon)}</h4>
                                        <span class="discount-price text-muted text-decoration-line-through fs-5">
                                            Rp ${new Intl.NumberFormat('id-ID').format(data.harga_asli)}
                                        </span>
                                    </div>
                                `);
                                if (data.persen_promo > 0) {
                                    $('#discount-badge').text('-' + data.persen_promo + '%').show();
                                } else if (data.harga_promo > 0) {
                                    $('#discount-badge').text('-Rp ' + new Intl.NumberFormat('id-ID').format(data.harga_promo)).show();
                                }
                            } else {
                                $('.price').html(`
                                    <h4 class="mb-0">Rp ${new Intl.NumberFormat('id-ID').format(data.harga_asli)}</h4>
                                `);
                                $('#discount-badge').hide().text('');
                            }
                            currentStok = parseInt(data.stok);
                            $('#stok-tersedia').text(currentStok);
                            if (currentStok <= 0) {
                                $('#qty').val(0).prop('disabled', true);
                            } else {
                                $('#qty').val(1).prop('disabled', false);
                            }
                            if (data.is_in_cart) {
                                console.log('Item sudah ada di keranjang');
                            }

                            $('.price').css('opacity', '1');
                        } else {
                            $('.price').html(`
                                <h4 class="mb-0">Rp ${new Intl.NumberFormat('id-ID').format(data.harga_asli)}</h4>
                            `);
                            $('#stok-tersedia').text('0');
                            $('#qty').val(0).prop('disabled', true);
                            $('#discount-badge').hide().text('');
                            $('.price').css('opacity', '1');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#discount-badge').hide().text('');
                        $('.price').css('opacity', '1');
                    }
                });
            }

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
        $(document)
            .off('click', '.btn-remove-cart')
            .on('click', '.btn-remove-cart', function (e) {
                e.preventDefault();
                e.stopPropagation();
                let id = $(this).data('cart');
                $.ajax({
                    url: "<?= site_url('keranjang/delete') ?>",
                    type: "POST",
                    data: { id_cart: id },
                    dataType: "json",
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#nav-cart-' + id).fadeOut(300, function () {
                                $(this).remove();
                                let sisa = $('#cart-list li').length;
                                $('.total-carts').text(sisa);
                                $('#cart-count').text(sisa + ' Item');
                                if (sisa === 0) {
                                    $('#cart-list').hide();
                                    $('#cart-empty').show();
                                }
                            });
                        }
                    }
                });
            });
        function ShowConfirm(message, onConfirm) {
            $('#modalConfirmMsg').text(message);
            $('#modalConfirm').modal('show');
            $('#modalConfirmOk').off('click').on('click', function () {
                $('#modalConfirm').modal('hide');
                onConfirm();
            });
        }
        $(document).on('click', '.btn-hapus-item', function () {
            var idCart = $(this).data('id-cart');

            ShowConfirm('Hapus item ini dari keranjang?', function () {
                $.ajax({
                    url: '<?= site_url("keranjang/hapus_item") ?>',
                    type: 'POST',
                    data: { id_cart: idCart },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            var $item = $('#cart-' + idCart);

                            $item.fadeOut(300, function () {
                                $(this).remove();
                                updateSummaryByChecklist();

                                var sisa = $('.cart-item').length;
                                if (sisa === 0) {
                                    $('#cart-items-wrapper').remove();
                                    $('#cart-empty').removeClass('d-none').show();
                                }
                            });
                        } else {
                            ShowAlert(response.message || 'Gagal menghapus item');
                        }
                    },
                    error: function () {
                        ShowAlert('Terjadi kesalahan saat menghapus item');
                    }
                });
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
        $(document).on('change', 'input[name="minusia"]', function () {
            const minVal = parseInt($(this).val());
            const $maxInput = $('input[name="maxusia"]');
            const maxVal = parseInt($maxInput.val());

            $maxInput.attr('min', minVal || 0);

            if (maxVal < minVal) {
                $maxInput.val($(this).val());
            }

            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => loadKatalog(1), typingDelay);
        });
        $(document).on('keyup', 'input[name="maxusia"]', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => loadKatalog(1), typingDelay);
        });

        $(document).on('change', 'input[name="maxusia"]', function () {
            const $minInput = $('input[name="minusia"]');
            const minVal = parseInt($minInput.val());
            const maxVal = parseInt($(this).val());

            if (minVal && maxVal < minVal) {
                $(this).val($minInput.val());
                loadKatalog(1);
            }
        });
        $(document).on('keyup', 'input[name="minusia"], input[name="maxusia"]', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => loadKatalog(1), typingDelay);
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