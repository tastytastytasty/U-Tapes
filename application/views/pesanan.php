<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Pesanan Saya</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f5f6f8;
            overflow-x: hidden;
            width: 100%;
        }

        html {
            overflow-x: hidden;
            width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Breadcrumbs */
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

        /* Layout */
        .profile-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .profile-user strong {
            display: block;
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

        .profile-menu .menu-title {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: all 0.2s;
        }

        .profile-menu a.active,
        .profile-menu a:hover {
            background-color: #eef2ff;
            color: #0d6efd;
            font-weight: 500;
        }

        .profile-menu hr {
            margin: 15px 0;
            border: none;
            border-top: 1px solid #e5e5e5;
        }

        /* Content */
        .profile-content {
            flex: 1;
            padding: 40px;
            background: #f5f6f8;
        }

        .ps-container {
            width: 100%;
            max-width: 900px;
        }

        .ps-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Tabs */
        .ps-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 4px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }

        .ps-tabs::-webkit-scrollbar {
            height: 3px;
        }

        .ps-tabs::-webkit-scrollbar-track {
            background: transparent;
        }

        .ps-tabs::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .ps-tab {
            padding: 10px 20px;
            border-radius: 24px;
            background: #e5e7eb;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            color: #64748b;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ps-tab:hover {
            background: #d1d5db;
        }

        .ps-tab.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Card */
        .ps-card {
            background: #fff;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
            width: 100%;
        }

        .ps-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Header */
        .ps-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ps-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ps-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ps-invoice {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ps-invoice i {
            color: #94a3b8;
        }

        .ps-date {
            color: #94a3b8;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .ps-date i {
            font-size: 11px;
        }

        .ps-status {
            font-weight: 600;
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .status-process {
            background: #fff7ed;
            color: #ea580c;
        }

        .status-send {
            background: #eff6ff;
            color: #2563eb;
        }

        .status-done {
            background: #f0fdf4;
            color: #16a34a;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Item */
        .ps-item {
            display: flex;
            gap: 14px;
            margin-bottom: 12px;
            padding: 8px;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .ps-item:hover {
            background: #f8fafc;
        }

        .ps-item img {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            background: #f1f5f9;
            border: 2px solid #e2e8f0;
            flex-shrink: 0;
        }

        .ps-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        }

        .ps-item-name {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .ps-item-price {
            font-size: 14px;
            color: #3b82f6;
            font-weight: 600;
        }

        /* More Items */
        .ps-more-items {
            display: none;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #e2e8f0;
        }

        .ps-more-items.active {
            display: block;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Toggle Button */
        .ps-toggle {
            background: #f1f5f9;
            border: none;
            color: #3b82f6;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 8px 16px;
            margin-top: 8px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .ps-toggle:hover {
            background: #e2e8f0;
        }

        .ps-toggle i {
            transition: transform 0.3s;
        }

        .ps-toggle.active i {
            transform: rotate(180deg);
        }

        /* Footer */
        .ps-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 2px solid #f1f5f9;
            padding-top: 14px;
            margin-top: 14px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ps-total {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        .ps-total span {
            color: #3b82f6;
        }

        .ps-btn {
            padding: 10px 20px;
            font-size: 13px;
            font-weight: 600;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ps-btn:hover {
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .ps-btn:active {
            transform: translateY(0);
        }

        .ps-btn-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            box-shadow: 0 2px 8px rgba(100, 116, 139, 0.3);
        }

        .ps-btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .ps-btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        /* Content */
        .ps-content {
            display: none;
            width: 100%;
        }

        .ps-content.active {
            display: block;
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Empty State */
        .ps-empty {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .ps-empty i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .ps-empty p {
            font-size: 16px;
            margin-top: 8px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .profile-wrapper {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
            }

            .profile-content {
                padding: 25px;
            }
        }

        @media (max-width: 768px) {
            .ps-container {
                padding: 0;
                width: 100%;
            }

            .ps-title {
                font-size: 20px;
                margin-bottom: 16px;
            }

            .ps-tabs {
                gap: 8px;
            }

            .ps-tab {
                padding: 8px 16px;
                font-size: 13px;
            }

            .ps-card {
                padding: 16px;
                border-radius: 12px;
            }

            .ps-item img {
                width: 65px;
                height: 65px;
            }

            .ps-item-name {
                font-size: 14px;
            }

            .ps-item-price {
                font-size: 13px;
            }

            .ps-footer {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .ps-btn {
                width: 100%;
                justify-content: center;
            }

            .ps-total {
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .profile-content {
                padding: 15px;
            }

            .ps-title {
                font-size: 18px;
            }

            .ps-tabs {
                gap: 6px;
            }

            .ps-tab {
                padding: 8px 14px;
                font-size: 12px;
            }

            .ps-card {
                padding: 14px;
                margin-bottom: 12px;
            }

            .ps-item {
                gap: 12px;
                padding: 6px;
            }

            .ps-item img {
                width: 60px;
                height: 60px;
            }

            .ps-item-name {
                font-size: 13px;
            }

            .ps-item-price {
                font-size: 13px;
            }

            .ps-invoice {
                font-size: 12px;
            }

            .ps-status {
                font-size: 11px;
                padding: 5px 10px;
            }

            .ps-header-left {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title"></h1>
            </div>
            <div class="col-md-6 text-end">
                <ul class="breadcrumb-nav">
                    <li><a href="#"><i class="lni lni-home"></i> Home</a></li>
                    <li>Pesanan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="profile-wrapper">
        <!-- SIDEBAR -->
        <div class="col-lg-3 col-md-4 profile-sidebar">
            <div class="profile-user">
                <img src="<?= base_url('assets/images/products/product-6.jpg') ?>" alt="user">
                <div>
                    <strong><strong><?= $logged_in && !empty($user['nama'])
                                        ? htmlspecialchars($user['nama'])
                                        : 'Guest' ?>
                        </strong></strong><br>
                    <span>Ubah Profil</span>
                </div>
            </div>

            <ul class="profile-menu">
                <li class="menu-title">
                    <i class="bi bi-person"></i> Akun Saya
                </li>
                <li><a href="#" class="active">Profil</a></li>
                <li><a href="<?= site_url('alamat') ?>">Alamat</a></li>
                <li><a href="#">Ubah Password</a></li>

                <hr>

                <li class="menu-link">
                    <a href="<?= site_url('pesanan') ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a>
                </li>
                <li class="menu-link">
                    <a href="#"><i class="bi bi-bell"></i> Notifikasi</a>
                </li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="profile-content">
            <div class="ps-container">
                <div class="ps-title"><i class="bi bi-bag-check"></i> Pesanan Saya</div>

                <div class="ps-tabs">
                    <div class="ps-tab active" onclick="showTab('all')">
                        <i class="bi bi-list-ul"></i> Semua
                    </div>
                    <div class="ps-tab" onclick="showTab('process')">
                        <i class="bi bi-clock-history"></i> Diproses
                    </div>
                    <div class="ps-tab" onclick="showTab('send')">
                        <i class="bi bi-truck"></i> Dikirim
                    </div>
                    <div class="ps-tab" onclick="showTab('done')">
                        <i class="bi bi-check-circle"></i> Selesai
                    </div>
                    <div class="ps-tab" onclick="showTab('cancelled')">
                        <i class="bi bi-x-circle"></i> Dibatalkan
                    </div>
                </div>

                <!-- SEMUA -->
                <div id="all" class="ps-content active">
                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-001</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 15 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-process">Diproses</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Keyboard Mechanical RGB</div>
                                <div class="ps-item-price">Rp 750.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span>Rp 750.000</span></div>
                            <a class="ps-btn" href="<?= site_url('invoice/view/INV-001') ?>">
                                <i class="bi bi-eye"></i> Invoice
                            </a>
                        </div>
                    </div>

                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-006</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 8 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-cancelled">Dibatalkan</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Laptop Gaming RTX 4060</div>
                                <div class="ps-item-price">Rp 15.000.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span>Rp 15.000.000</span></div>
                            <a class="ps-btn ps-btn-success" href="<?= site_url('invoice/view/INV-006') ?>">
                                <i class="bi bi-cart-plus"></i> Beli Lagi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- DIPROSES -->
                <div id="process" class="ps-content">
                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-002</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 18 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-process">Diproses</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Mouse Gaming Pro X</div>
                                <div class="ps-item-price">Rp 350.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span>Rp 350.000</span></div>
                            <a class="ps-btn" href="<?= site_url('invoice/view/INV-002') ?>">
                                <i class="bi bi-eye"></i> Invoice
                            </a>
                        </div>
                    </div>
                </div>

                <!-- DIKIRIM -->
                <div id="send" class="ps-content">
                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-003</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 12 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-send">Dikirim</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Headset Gaming 7.1 Surround</div>
                                <div class="ps-item-price">Rp 500.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span>Rp 500.000</span></div>
                            <a class="ps-btn" href="<?= site_url('invoice/view/INV-003') ?>">
                                <i class="bi bi-geo-alt"></i> Invoice
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SELESAI -->
                <div id="done" class="ps-content">
                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-004</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 5 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-done">Selesai</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Monitor LED 24 inch Full HD</div>
                                <div class="ps-item-price">Rp 2.000.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span>Rp 2.000.000</span></div>
                            <a class="ps-btn ps-btn-success" href="<?= site_url('invoice/view/INV-004') ?>">
                                <i class="bi bi-cart-plus"></i> Beli Lagi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- DIBATALKAN -->
                <div id="cancelled" class="ps-content">
                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-006</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 8 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-cancelled">Dibatalkan</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Laptop Gaming RTX 4060</div>
                                <div class="ps-item-price">Rp 15.000.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span style="text-decoration: line-through; color: #94a3b8;">Rp 15.000.000</span></div>
                            <a class="ps-btn ps-btn-success" href="<?= site_url('invoice/view/INV-006') ?>">
                                <i class="bi bi-cart-plus"></i> Beli Lagi
                            </a>
                        </div>
                    </div>

                    <div class="ps-card">
                        <div class="ps-header">
                            <div class="ps-header-left">
                                <div class="ps-invoice"><i class="bi bi-receipt"></i> INV-007</div>
                                <div class="ps-date"><i class="bi bi-calendar3"></i> 3 Jan 2026</div>
                            </div>
                            <div class="ps-header-right">
                                <div class="ps-status status-cancelled">Dibatalkan</div>
                            </div>
                        </div>

                        <div class="ps-item">
                            <img src="https://via.placeholder.com/70" alt="Product">
                            <div class="ps-item-info">
                                <div class="ps-item-name">Smartphone Android Flagship</div>
                                <div class="ps-item-price">Rp 8.500.000</div>
                            </div>
                        </div>

                        <div class="ps-footer">
                            <div class="ps-total">Total: <span style="text-decoration: line-through; color: #94a3b8;">Rp 8.500.000</span></div>
                            <a class="ps-btn ps-btn-success" href="<?= site_url('invoice/view/INV-007') ?>">
                                <i class="bi bi-cart-plus"></i> Beli Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(id) {
            document.querySelectorAll('.ps-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.ps-tab').forEach(el => el.classList.remove('active'));

            document.getElementById(id).classList.add('active');
            event.target.closest('.ps-tab').classList.add('active');
        }

        function toggleItems(id, btn) {
            const box = document.getElementById(id);
            const span = btn.querySelector('span');

            if (box.classList.contains('active')) {
                box.classList.remove('active');
                btn.classList.remove('active');
                span.textContent = 'Lihat 2 barang lainnya';
            } else {
                box.classList.add('active');
                btn.classList.add('active');
                span.textContent = 'Sembunyikan barang';
            }
        }
    </script>
</body>

</html>