<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Alamat Pengiriman</title>
    <style>
        body {
            background-color: #f5f6f8;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .breadcrumbs {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 16px 24px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        .breadcrumb-nav {
            list-style: none;
            display: inline-flex;
            gap: 8px;
            padding: 0;
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        .breadcrumb-nav li a {
            color: #0d6efd;
            text-decoration: none;
        }

        .profile-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .profile-sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
            padding: 20px;
        }

        .profile-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .profile-user img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-user h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .profile-user span {
            font-size: 12px;
            color: #777;
        }

        .profile-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-menu li {
            margin-bottom: 8px;
        }

        .profile-menu a {
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
        }

        .profile-menu a.active,
        .profile-menu a:hover {
            background-color: #eef2ff;
            color: #0d6efd;
            font-weight: 500;
        }

        .profile-content {
            flex: 1;
            padding: 40px;
            background: #fff;
        }

        .profile-header h4 {
            font-weight: 600;
        }

        .profile-header p {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .alamat-wrapper {
            max-width: 900px;
        }

        .alamat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .alamat-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .btn-add {
            background: #0d6efd;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add:hover {
            background: #0b5ed7;
        }

        .alamat-card {
            background: #fff;
            padding: 18px 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .20);
            margin-bottom: 18px;
            border: 2px solid #f0f0f0;
        }

        .alamat-card.default {
            border-color: #0d6efd;
        }

        .alamat-card-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .alamat-card-actions .btn {
            padding: 6px 12px;
            background: #0d6efd;
            color: #fff;
            border-radius: 6px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .alamat-card-actions .btn:hover {
            background: #000;
        }

        .alamat-card-actions .btn-danger {
            background: #dc3545;
        }

        .alamat-card-actions .btn-danger:hover {
            background: #c82333;
        }

        .alamat-card-actions .btn-success-primary {
            background: #28a745;
            color: whitesmoke;
            margin-left: auto;
        }

        .alamat-card-actions .btn-success-primary:hover {
            background: #218838;
        }

        /* ================= MODAL IMPROVEMENTS ================= */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: opacity .18s ease, visibility .18s ease;
            padding: 20px;
            overflow-y: auto;
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden !important;
            position: fixed;
            width: 100%;
            height: 100vh;
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 620px;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .15);
            animation: zoomIn .2s ease;
            overflow: hidden;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-content h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            background: #fff;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e5e5;
            flex-shrink: 0;
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        /* ================= FORM GRID IMPROVEMENTS ================= */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group label.required::after {
            content: '*';
            color: #dc3545;
            margin-left: 2px;
        }

        /* ================= IMPROVED INPUT STYLING ================= */
        .form-group input,
        .form-group textarea {
            padding: 11px 14px;
            border-radius: 6px;
            border: 1.5px solid #ddd;
            font-size: 14px;
            transition: all .2s ease;
            font-family: inherit;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:hover {
            border-color: #bbb;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
            opacity: 1;
        }

        /* ================= IMPROVED DROPDOWN STYLING ================= */
        .dropdown-box {
            position: relative;
            width: 100%;
        }

        .dropdown-selected {
            border: 1.5px solid #ddd;
            border-radius: 6px;
            padding: 11px 14px;
            cursor: pointer;
            background: #fff;
            font-size: 14px;
            color: #333;
            transition: all .2s ease;
            user-select: none;
            position: relative;
            padding-right: 40px;
        }

        .dropdown-selected::after {
            content: '▼';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            color: #666;
            transition: transform .2s ease;
        }

        .dropdown-selected:hover {
            border-color: #bbb;
            background: #fafafa;
        }

        .dropdown-selected.active {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .1);
        }

        .dropdown-selected.active::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .dropdown-list {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            z-index: 999999;
            display: none;
            max-height: 280px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        }

        .dropdown-list input {
            width: 100%;
            border: none;
            border-bottom: 1.5px solid #eee;
            padding: 11px 14px;
            font-size: 13px;
            outline: none;
            box-sizing: border-box;
            background: #fafafa;
        }

        .dropdown-list input:focus {
            background: #fff;
            border-bottom-color: #0d6efd;
        }

        .dropdown-list input::placeholder {
            color: #999;
        }

        .dropdown-items {
            max-height: 220px;
            overflow-y: auto;
            background: #fff;
        }

        /* Custom scrollbar for dropdown */
        .dropdown-items::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-items::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .dropdown-items::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .dropdown-items::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        .dropdown-item {
            padding: 11px 14px;
            cursor: pointer;
            font-size: 13px;
            transition: background .15s ease;
            color: #333;
        }

        .dropdown-item:hover {
            background: #f5f8ff;
            color: #0d6efd;
        }

        .dropdown-item.active {
            background: #0d6efd;
            color: #fff;
        }

        /* Empty state for dropdown */
        .dropdown-items:empty::before {
            content: 'Tidak ada data';
            display: block;
            padding: 20px 14px;
            text-align: center;
            color: #999;
            font-size: 13px;
        }

        /* Loading state */
        .dropdown-items.loading::before {
            content: 'Memuat data...';
            display: block;
            padding: 20px 14px;
            text-align: center;
            color: #0d6efd;
            font-size: 13px;
        }

        /* Disable dropdown when loading */
        .dropdown-selected.disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            color: #999;
            opacity: 0.6;
        }

        .dropdown-selected.disabled:hover {
            border-color: #ddd;
            background: #f5f5f5;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            background: #f8f9fa;
            border-top: 1px solid #e5e5e5;
            flex-shrink: 0;
        }

        .modal-actions .btn {
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
        }

        .btn-primary {
            background: #0d6efd;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            box-shadow: 0 2px 6px rgba(13, 110, 253, .3);
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 2px 6px rgba(108, 117, 125, .3);
        }

        .breadcrumb-inner {
            padding-left: 0;
            padding-right: 0;
        }

        /* ================= MOBILE RESPONSIVE ================= */
        @media (max-width: 991px) {

            .profile-wrapper,
            .container-fluid>.row {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
            }

            .profile-content {
                padding: 20px 16px;
            }

            .alamat-wrapper {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .modal {
                align-items: flex-start;
                padding: 16px;
            }

            .modal-content {
                margin: 0;
                max-width: 100%;
                max-height: 95vh;
            }

            .modal-content h3 {
                padding: 16px 18px;
                font-size: 16px;
            }

            .modal-body {
                padding: 18px;
            }

            .modal-actions {
                padding: 14px 18px;
                gap: 8px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-group.full {
                grid-column: span 1;
            }

            .alamat-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .breadcrumbs {
                padding: 14px 16px;
            }

            .breadcrumb-nav {
                flex-wrap: wrap;
                gap: 6px;
                font-size: 13px;
            }

            .modal {
                padding: 12px;
            }

            .dropdown-list {
                max-height: 240px;
            }

            .dropdown-items {
                max-height: 180px;
            }
        }

        .input-kodepos {
            max-width: 150px;
        }

        /* TAMBAHAN KHUSUS MODAL ALERT */
        .alert-text {
            font-size: 14px;
            color: #555;
            margin-top: 6px;
        }

        .alamat-title {
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 6px 0;
            color: #222;
        }

        /* ================= MODAL ANIMATION ENHANCEMENT ================= */

        /* animation base */
        .modal.show .modal-content {
            animation: modalEnter .25s cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: translateY(20px) scale(.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* exit animation (optional, visual only) */
        .modal.hide .modal-content {
            animation: modalExit .2s ease forwards;
        }

        @keyframes modalExit {
            to {
                opacity: 0;
                transform: translateY(10px) scale(.96);
            }
        }

        /* ================= ALERT MODAL (WARNING) ================= */

        .modal-alert .modal-content h3 {
            background: linear-gradient(135deg, #fff3cd, #ffe69c);
            color: #856404;
        }

        .modal-alert .modal-body p {
            font-size: 14px;
            color: #6c5700;
            line-height: 1.5;
        }

        /* ================= DANGER MODAL (DELETE) ================= */

        .modal-danger .modal-content h3 {
            background: linear-gradient(135deg, #f8d7da, #f1aeb5);
            color: #842029;
        }

        .modal-danger .modal-body p {
            color: #842029;
            font-size: 14px;
        }

        /* ================= BUTTON MICRO INTERACTION ================= */

        .modal-actions .btn {
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .modal-actions .btn:hover {
            transform: translateY(-1px);
        }

        .modal-actions .btn:active {
            transform: translateY(0);
        }

        .modal-alert .modal-content h3::before {
            content: "⚠️ ";
        }

        .modal-danger .modal-content h3::before {
            content: "🗑️ ";
        }

        /* ================= MODAL KONFIRMASI ================= */
        .modal-confirm .modal-content {
            text-align: center;
            padding-top: 30px;
        }

        .modal-confirm .modal-content h3 {
            background: none;
            border: none;
            padding: 15px 24px;
            font-size: 20px;
            color: #333;
        }

        .modal-confirm .modal-body {
            padding: 10px 30px 20px;
        }

        .modal-confirm .modal-body p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        /* ================= ICON ANIMATION ================= */
        .modal-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* PIN ICON */
        .pin-icon {
            width: 56px;
            height: 56px;
            animation: pinBounce 0.6s ease;
        }

        @keyframes pinBounce {
            0% {
                transform: translateY(-30px) scale(0.7);
                opacity: 0;
            }

            60% {
                transform: translateY(8px) scale(1.1);
            }

            100% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        /* CHECKMARK */
        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #28a745;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #28a745;
            position: relative;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #28a745;
            fill: #fff;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            stroke: #fff;
            stroke-width: 3;
            position: relative;
            z-index: 2;
        }

        .modal-confirm.show .checkmark-circle {
            animation: strokeCircle 0.6s ease forwards;
        }

        .modal-confirm.show .checkmark-check {
            animation: strokeCheck 0.4s ease 0.6s forwards;
        }

        .modal-confirm.show .checkmark {
            animation: fillGreen 0.4s ease 1s forwards;
        }

        @keyframes strokeCircle {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes strokeCheck {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fillGreen {
            100% {
                box-shadow: inset 0px 0px 0px 40px #28a745;
            }
        }

        /* ================= BUTTON SUCCESS ================= */
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1abc9c 100%);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
            transform: translateY(-2px);
        }

        /* ================= MODAL ENTRANCE ANIMATION ================= */
        .modal-confirm.show .modal-content {
            animation: modalConfirmEnter 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes modalConfirmEnter {
            0% {
                opacity: 0;
                transform: scale(0.7) translateY(-20px);
            }

            50% {
                transform: scale(1.05) translateY(0);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* ================= PULSE EFFECT ON TITLE ================= */
        .modal-confirm.show h3 {
            animation: titlePulse 0.6s ease-in-out 0.3s;
        }

        @keyframes titlePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* ================= FADE IN TEXT ================= */
        .modal-confirm.show .modal-body p {
            animation: fadeInUp 0.5s ease-out 0.4s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= BUTTONS ANIMATION ================= */
        .modal-confirm.show .modal-actions {
            animation: fadeInUp 0.5s ease-out 0.5s both;
        }
    </style>
</head>

<body>
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <div class="row align-items-center">
                <div class="col-md-6 text-end">
                    <ul class="breadcrumb-nav">
                        <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="<?= site_url('profile') ?>">Profile</a></li>
                        <li>Alamat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- SIDEBAR -->
            <div class="col-lg-3 col-md-4 profile-sidebar">
                <div class="profile-user">
                    <img src="<?= base_url('assets/images/products/product-6.jpg') ?>" alt="user">
                    <div>
                        <strong><?= htmlspecialchars($this->session->userdata('nama') ?? 'User') ?></strong><br>
                        <span>Ubah Profil</span>
                    </div>
                </div>

                <ul class="profile-menu">
                    <li class="menu-title"><i class="bi bi-person"></i> Akun Saya</li>
                    <li><a href="<?= site_url('profile') ?>">Profil</a></li>
                    <li><a href="<?= site_url('alamat') ?>" class="active">Alamat</a></li>
                    <li><a href="<?= site_url('ubah-password') ?>">Ubah Password</a></li>
                    <hr>
                    <li><a href="<?= site_url('pesanan') ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                    <li><a href="#"><i class="bi bi-bell"></i> Notifikasi</a></li>
                </ul>
            </div>

            <!-- CONTENT -->
            <div class="col-lg-9 col-md-8 profile-content">
                <div class="alamat-wrapper">
                    <div class="alamat-header">
                        <h2>Alamat Saya</h2>
                        <button type="button" class="btn-add" onclick="openModal()">+ Tambah Alamat</button>
                    </div>

                    <div id="alamatContainer">
                        <?php if (empty($alamat_list)): ?>
                            <p style="text-align: center; color: #999; padding: 40px 0;">
                                Belum ada alamat. Silakan tambahkan alamat pengiriman.
                            </p>
                        <?php else: ?>
                            <?php foreach ($alamat_list as $idx => $a): ?>
                                <div class="alamat-card <?= $a->is_default ? 'default' : '' ?>"
                                    data-id="<?= $a->id_alamat ?>"
                                    data-index="<?= $idx + 1 ?>">

                                    <?php if ($a->is_default): ?>
                                        <span style="display: inline-block; background: #0d6efd; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 8px;">
                                            Alamat Utama
                                        </span>
                                    <?php endif; ?>

                                    <h5 class="alamat-title">
                                        <?= htmlspecialchars($a->nama_alamat ?: '-') ?>
                                    </h5>

                                    <p style="margin: 4px 0; font-size: 14px;">
                                        <?= htmlspecialchars($a->nama_kelurahan ?: 'Belum dipilih') ?>,
                                        <?= htmlspecialchars($a->nama_kecamatan ?: 'Belum dipilih') ?>
                                        <?= htmlspecialchars($a->nama_kabupaten ?? '-') ?>,
                                        <?= htmlspecialchars($a->nama_provinsi ?? '-') ?>
                                    </p>

                                    <p style="margin: 8px 0; font-weight: 600;">
                                        Detail : <br><?= htmlspecialchars($a->detail) ?>
                                    </p>

                                    <p style="margin: 8px 0; font-weight: 600;">
                                        Kode Pos: <?= htmlspecialchars($a->kode_pos) ?>
                                    </p>

                                    <div class="alamat-card-actions">
                                        <button class="btn" onclick="openEditModal('<?= $a->id_alamat ?>')">
                                            Edit
                                        </button>

                                        <?php if (!$a->is_default): ?>
                                            <button class="btn btn-danger"
                                                onclick="deleteAlamat('<?= $a->id_alamat ?>','<?= htmlspecialchars($a->nama_alamat) ?>')">
                                                Hapus
                                            </button>
                                            <button class="btn btn-success-primary"
                                                onclick="setDefault('<?= $a->id_alamat ?>', '<?= htmlspecialchars($a->nama_alamat) ?>')">
                                                Jadikan Utama
                                            </button>
                                        <?php endif; ?>
                                        </div>
                                </div>
                                <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- MODAL TAMBAH/EDIT -->
        <div class="modal" id="modalAlamat">
            <div class="modal-content">
                <h3 id="modalTitle">Tambah Alamat</h3>
                <div class="modal-body">
                    <form id="formAlamat">
                        <input type="hidden" id="id_alamat">
                        <div class="form-grid">
                            <div class="form-group full">
                                <label class="required">Nama Alamat</label>
                                <input type="text" id="nama_alamat" placeholder="Contoh: Rumah 1, Kantor, Kos">
                            </div>
                            <div class="form-group">
                                <label class="required">Provinsi</label>
                                <div class="dropdown-box">
                                    <div class="dropdown-selected" id="provinsiSelected" onclick="toggleDropdown('provinsi')">
                                        Pilih Provinsi
                                    </div>
                                    <div class="dropdown-list" id="provinsiList">
                                        <input type="text" placeholder="Cari provinsi..." onkeyup="filterDropdown(this,'provinsi')">
                                        <div class="dropdown-items" id="provinsiItems"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Kabupaten</label>
                                <div class="dropdown-box">
                                    <div class="dropdown-selected" id="kabupatenSelected" onclick="toggleDropdown('kabupaten')">
                                        Pilih Kabupaten
                                    </div>
                                    <div class="dropdown-list" id="kabupatenList">
                                        <input type="text" placeholder="Cari kabupaten..." onkeyup="filterDropdown(this,'kabupaten')">
                                        <div class="dropdown-items" id="kabupatenItems"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Kecamatan</label>
                                <div class="dropdown-box">
                                    <div class="dropdown-selected" id="kecamatanSelected" onclick="toggleDropdown('kecamatan')">
                                        Pilih Kecamatan
                                    </div>
                                    <div class="dropdown-list" id="kecamatanList">
                                        <input type="text" placeholder="Cari kecamatan..." onkeyup="filterDropdown(this,'kecamatan')">
                                        <div class="dropdown-items" id="kecamatanItems"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="required">Kelurahan</label>
                                <div class="dropdown-box">
                                    <div class="dropdown-selected" id="kelurahanSelected" onclick="toggleDropdown('kelurahan')">
                                        Pilih Kelurahan
                                    </div>
                                    <div class="dropdown-list" id="kelurahanList">
                                        <input type="text" placeholder="Cari kelurahan..." onkeyup="filterDropdown(this,'kelurahan')">
                                        <div class="dropdown-items" id="kelurahanItems"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group full">
                                <label class="required">Detail Alamat</label>
                                <input type="text" id="detail">
                            </div>
                            <div class="form-group full">
                                <label class="required">Kode Pos</label>
                                <input type="text" id="kode_pos" class="input-kodepos">
                            </div>
                            <div class="form-group full">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; user-select: none;">
                                    <input type="checkbox" id="is_default" style="width: 18px; height: 18px; cursor: pointer;">
                                    <span>Jadikan sebagai alamat utama</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanAlamat()">Simpan Alamat</button>
                </div>
            </div>
        </div>

        <!-- MODAL HAPUS -->
        <div class="modal modal-danger" id="modalHapus">
            <div class="modal-content" style="max-width:420px">
                <h3>Hapus Alamat</h3>
                <div class="modal-body">
                    <p>Yakin ingin menghapus alamat <b id="hapusNama"></b>?</p>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="closeHapus()">Batal</button>
                    <button class="btn btn-danger" onclick="confirmHapus()">Hapus</button>
                </div>
            </div>
        </div>

        <!-- MODAL ALERT -->
        <div class="modal modal-alert" id="modalAlert">
            <div class="modal-content" style="max-width:420px">
                <h3>Data Belum Lengkap</h3>
                <div class="modal-body">
                    <p id="alertMessage"></p>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="closeAlert()">OK</button>
                </div>
            </div>
        </div>

        <!-- MODAL KONFIRMASI SET DEFAULT -->
        <div class="modal modal-confirm" id="modalConfirm">
            <div class="modal-content" style="max-width:460px">
                <div class="modal-icon" id="confirmIcon">
                    <svg class="pin-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path fill="#0d6efd" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                    </svg>
                </div>
                <h3 id="confirmTitle">Jadikan Alamat Utama?</h3>
                <div class="modal-body">
                    <p id="confirmMessage"></p>
                </div>
                <div class="modal-actions" id="confirmActions">
                    <button class="btn btn-secondary" onclick="closeConfirm()">Batal</button>
                    <button class="btn btn-success" id="btnConfirmSet" onclick="confirmSetDefault()">Ya, Jadikan Utama</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = '<?= base_url("index.php/") ?>';
    let selectedProvinsi = null, selectedKabupaten = null, selectedKecamatan = null, selectedKelurahan = null;
    let hapusId = null, tempDefaultId = null, tempDefaultNama = null;

    function toggleDropdown(type) {
        const list = document.getElementById(type + 'List');
        const selected = document.getElementById(type + 'Selected');
        const open = list.style.display === 'block';
        document.querySelectorAll('.dropdown-list').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.dropdown-selected').forEach(el => el.classList.remove('active'));
        if (!open) {
            list.style.display = 'block';
            selected.classList.add('active');
        }
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-list').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.dropdown-selected').forEach(el => el.classList.remove('active'));
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.dropdown-box')) closeAllDropdowns();
    });

    function filterDropdown(input, type) {
        const val = input.value.toLowerCase();
        document.querySelectorAll('#' + type + 'Items .dropdown-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    }

    function openModal() {
        document.getElementById('modalAlamat').classList.add('show');
        document.body.classList.add('modal-open');
        document.getElementById('modalTitle').innerText = 'Tambah Alamat';
        resetAll();
        loadProvinsi();
    }

    function closeModal() {
        document.getElementById('modalAlamat').classList.remove('show');
        document.body.classList.remove('modal-open');
    }

    function resetAll() {
        selectedProvinsi = selectedKabupaten = selectedKecamatan = selectedKelurahan = null;
        document.getElementById('id_alamat').value = '';
        document.getElementById('nama_alamat').value = '';
        document.getElementById('detail').value = '';
        document.getElementById('kode_pos').value = '';
        document.getElementById('is_default').checked = false;
        setSelectedText('provinsi', 'Pilih Provinsi');
        setSelectedText('kabupaten', 'Pilih Kabupaten');
        setSelectedText('kecamatan', 'Pilih Kecamatan');
        setSelectedText('kelurahan', 'Pilih Kelurahan');
        clearItems('kabupaten');
        clearItems('kecamatan');
        clearItems('kelurahan');
    }

    function setSelectedText(type, text) {
        document.getElementById(type + 'Selected').innerText = text;
    }

    function clearItems(type) {
        document.getElementById(type + 'Items').innerHTML = '';
    }

    function loadProvinsi() {
        fetch(BASE_URL + 'alamat/provinsi')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('provinsiItems');
                container.innerHTML = '';
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'dropdown-item';
                    div.innerText = item.name;
                    div.onclick = () => {
                        selectedProvinsi = item.id;
                        setSelectedText('provinsi', item.name);
                        closeAllDropdowns();
                        selectedKabupaten = selectedKecamatan = selectedKelurahan = null;
                        setSelectedText('kabupaten', 'Pilih Kabupaten');
                        setSelectedText('kecamatan', 'Pilih Kecamatan');
                        setSelectedText('kelurahan', 'Pilih Kelurahan');
                        clearItems('kabupaten');
                        clearItems('kecamatan');
                        clearItems('kelurahan');
                        loadKabupaten(item.id);
                    };
                    container.appendChild(div);
                });
            })
            .catch(error => console.error('Error loading provinsi:', error));
    }

    function loadKabupaten(provinsiId) {
        fetch(BASE_URL + 'alamat/kabupaten/' + provinsiId)
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('kabupatenItems');
                container.innerHTML = '';
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'dropdown-item';
                    div.innerText = item.name;
                    div.onclick = () => {
                        selectedKabupaten = item.id;
                        setSelectedText('kabupaten', item.name);
                        closeAllDropdowns();
                        selectedKecamatan = selectedKelurahan = null;
                        setSelectedText('kecamatan', 'Pilih Kecamatan');
                        setSelectedText('kelurahan', 'Pilih Kelurahan');
                        clearItems('kecamatan');
                        clearItems('kelurahan');
                        loadKecamatan(item.id);
                    };
                    container.appendChild(div);
                });
            })
            .catch(error => console.error('Error loading kabupaten:', error));
    }

    function loadKecamatan(kabupatenId) {
        fetch(BASE_URL + 'alamat/kecamatan/' + kabupatenId)
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('kecamatanItems');
                container.innerHTML = '';
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'dropdown-item';
                    div.innerText = item.name;
                    div.onclick = () => {
                        selectedKecamatan = item.id;
                        setSelectedText('kecamatan', item.name);
                        closeAllDropdowns();
                        selectedKelurahan = null;
                        setSelectedText('kelurahan', 'Pilih Kelurahan');
                        clearItems('kelurahan');
                        loadKelurahan(item.id);
                    };
                    container.appendChild(div);
                });
            })
            .catch(error => console.error('Error loading kecamatan:', error));
    }

    function loadKelurahan(kecamatanId) {
        return fetch(BASE_URL + 'alamat/kelurahan/' + kecamatanId)
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('kelurahanItems');
                container.innerHTML = '';
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'dropdown-item';
                    div.innerText = item.name;
                    div.onclick = () => {
                        selectedKelurahan = item.id;
                        setSelectedText('kelurahan', item.name);
                        closeAllDropdowns();
                    };
                    container.appendChild(div);
                });
                return data;
            })
            .catch(error => console.error('Error loading kelurahan:', error));
    }

    function simpanAlamat() {
        const nama = document.getElementById('nama_alamat').value.trim();
        const detail = document.getElementById('detail').value.trim();
        const kode = document.getElementById('kode_pos').value.trim();
        const isDefault = document.getElementById('is_default').checked ? 1 : 0;

        if (!nama) { openAlert('Nama alamat wajib diisi (contoh: Rumah, Kantor).'); return; }
        if (!selectedProvinsi) { openAlert('Silakan pilih provinsi.'); return; }
        if (!selectedKabupaten) { openAlert('Silakan pilih kabupaten / kota.'); return; }
        if (!selectedKecamatan) { openAlert('Silakan pilih kecamatan.'); return; }
        if (!selectedKelurahan) { openAlert('Silakan pilih kelurahan.'); return; }
        if (!detail) { openAlert('Detail alamat wajib diisi.'); return; }
        if (!kode) { openAlert('Kode pos wajib diisi.'); return; }

        const data = {
            id_alamat: document.getElementById('id_alamat').value,
            nama_alamat: nama,
            provinsi_id: selectedProvinsi,
            kabupaten_id: selectedKabupaten,
            kecamatan_id: selectedKecamatan,
            kelurahan_id: selectedKelurahan,
            detail: detail,
            kode_pos: kode,
            is_default: isDefault
        };

        const url = data.id_alamat ? BASE_URL + 'alamat/update' : BASE_URL + 'alamat/simpan';

        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(data)
        })
        .then(r => r.json())
        .then(r => {
            if (r.success) {
                location.reload();
            } else {
                openAlert(r.message || 'Gagal menyimpan alamat');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            openAlert('Terjadi kesalahan saat menyimpan data');
        });
    }

    function setDefault(id, nama) {
        tempDefaultId = id;
        tempDefaultNama = nama;

        document.getElementById('confirmIcon').innerHTML = `
            <svg class="pin-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path fill="#0d6efd" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
            </svg>
        `;

        document.getElementById('confirmTitle').innerText = 'Jadikan Alamat Utama?';
        document.getElementById('confirmMessage').innerHTML = `Alamat <strong>"${nama}"</strong> akan dijadikan alamat utama Anda.<br>Alamat utama sebelumnya akan otomatis dinonaktifkan.`;
        document.getElementById('confirmActions').innerHTML = `
            <button class="btn btn-secondary" onclick="closeConfirm()">Batal</button>
            <button class="btn btn-success" id="btnConfirmSet" onclick="confirmSetDefault()">Ya, Jadikan Utama</button>
        `;

        document.getElementById('modalConfirm').classList.add('show');
        document.body.classList.add('modal-open');
    }

    function closeConfirm() {
        document.getElementById('modalConfirm').classList.remove('show');
        document.body.classList.remove('modal-open');
        tempDefaultId = null;
        tempDefaultNama = null;
    }

    function confirmSetDefault() {
        if (!tempDefaultId) return;

        const btnConfirm = document.getElementById('btnConfirmSet');
        btnConfirm.innerText = '⏳ Memproses...';
        btnConfirm.disabled = true;

        fetch(BASE_URL + 'alamat/set_default', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ id_alamat: tempDefaultId })
        })
        .then(r => r.json())
        .then(r => {
            if (r.success) {
                showSuccessAnimation();
                setTimeout(() => location.reload(), 1500);
            } else {
                btnConfirm.innerText = 'Ya, Jadikan Utama';
                btnConfirm.disabled = false;
                closeConfirm();
                openAlert(r.message || 'Gagal mengubah alamat utama');
            }
        })
        .catch(err => {
            btnConfirm.innerText = 'Ya, Jadikan Utama';
            btnConfirm.disabled = false;
            closeConfirm();
            openAlert('Terjadi kesalahan jaringan');
        });
    }

    function showSuccessAnimation() {
        document.getElementById('confirmTitle').innerText = 'Berhasil!';
        document.getElementById('confirmMessage').innerText = 'Alamat utama berhasil diubah.';
        document.getElementById('confirmIcon').innerHTML = `
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        `;
        document.getElementById('confirmActions').innerHTML = '';
    }

    function openEditModal(id) {
        if (!id) { alert('ID alamat tidak valid'); return; }

        fetch(BASE_URL + 'alamat/get_by_id', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ id_alamat: id })
        })
        .then(res => {
            if (!res.ok) throw new Error('HTTP error! status: ' + res.status);
            return res.json();
        })
        .then(res => {
            if (!res.success) {
                alert('Gagal memuat data: ' + (res.message || 'Data tidak ditemukan'));
                return;
            }

            const d = res.data;
            document.getElementById('modalAlamat').classList.add('show');
            document.body.classList.add('modal-open');
            document.getElementById('modalTitle').innerText = 'Edit Alamat';

            document.getElementById('id_alamat').value = d.id_alamat || '';
            document.getElementById('nama_alamat').value = d.nama_alamat || '';
            document.getElementById('detail').value = d.detail || '';
            document.getElementById('kode_pos').value = d.kode_pos || '';
            document.getElementById('is_default').checked = d.is_default == 1;

            selectedProvinsi = d.provinsi_id;
            selectedKabupaten = d.kabupaten_id;
            selectedKecamatan = d.kecamatan_id;
            selectedKelurahan = d.kelurahan_id;

            loadProvinsi();

            setTimeout(() => {
                if (d.nama_provinsi) setSelectedText('provinsi', d.nama_provinsi);
                if (d.provinsi_id) {
                    loadKabupaten(d.provinsi_id);
                    setTimeout(() => {
                        if (d.nama_kabupaten) setSelectedText('kabupaten', d.nama_kabupaten);
                        if (d.kabupaten_id) {
                            loadKecamatan(d.kabupaten_id);
                            setTimeout(() => {
                                if (d.nama_kecamatan) setSelectedText('kecamatan', d.nama_kecamatan);
                                if (d.kecamatan_id) {
                                    loadKelurahan(d.kecamatan_id);
                                    setTimeout(() => {
                                        if (d.nama_kelurahan) setSelectedText('kelurahan', d.nama_kelurahan);
                                    }, 250);
                                }
                            }, 250);
                        }
                    }, 250);
                }
            }, 250);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data: ' + error.message);
        });
    }

    function deleteAlamat(id, nama) {
        hapusId = id;
        document.getElementById('hapusNama').innerText = nama;
        document.getElementById('modalHapus').classList.add('show');
        document.body.classList.add('modal-open');
    }

    function closeHapus() {
        document.getElementById('modalHapus').classList.remove('show');
        document.body.classList.remove('modal-open');
    }

    function confirmHapus() {
        const btnHapus = document.querySelector('#modalHapus .btn-danger');
        const originalText = btnHapus.innerHTML;
        btnHapus.innerHTML = '⏳ Menghapus...';
        btnHapus.disabled = true;

        fetch(BASE_URL + 'alamat/hapus', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ id_alamat: hapusId })
        })
        .then(r => r.json())
        .then(r => {
            if (r.success) {
                location.reload();
            } else {
                btnHapus.innerHTML = originalText;
                btnHapus.disabled = false;
                closeHapus();
                alert(r.message || 'Gagal menghapus alamat');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btnHapus.innerHTML = originalText;
            btnHapus.disabled = false;
            closeHapus();
            alert('Terjadi kesalahan saat menghapus data');
        });
    }

    function openAlert(msg) {
        document.getElementById('alertMessage').innerText = msg;
        document.getElementById('modalAlert').classList.add('show');
        document.body.classList.add('modal-open');
    }

    function closeAlert() {
        document.getElementById('modalAlert').classList.remove('show');
        document.body.classList.remove('modal-open');
    }
</script>