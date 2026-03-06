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
<body>
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title"></h1>
            </div>
            <div class="col-md-6 text-end">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('') ?>">🏠 Home</a></li>
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
                    <li><a href="<?= site_url('profile') ?>">Profil</a></li>
                    <li><a href="<?= site_url('alamat') ?>">Alamat</a></li>
                    <li><a href="#">Ubah Kata sandi</a></li>

                    <hr>

                    <li class="menu-link">
                        <a href="<?= site_url('pesanan') ?>" class="active"><i class="bi bi-receipt"></i> Pesanan Saya</a>
                    </li>
                    <li class="menu-link">
                        <a href="#"><i class="bi bi-bell"></i> Notifikasi</a>
                    </li>
                </ul>
            </div>
        <!-- CONTENT -->
        <div class="profile-content">
            <div class="ps-container">
                <div class="ps-title">🛍️ Pesanan Saya</div>

                <div class="ps-tabs">
                    <div class="ps-tab active" onclick="showTab('all')">
                        📋 Semua
                    </div>
                    <div class="ps-tab" onclick="showTab('pending')">
                        ⏳ Menunggu
                    </div>
                    <div class="ps-tab" onclick="showTab('process')">
                        📦 Dikemas
                    </div>
                    <div class="ps-tab" onclick="showTab('send')">
                        🚚 Dikirim
                    </div>
                    <div class="ps-tab" onclick="showTab('done')">
                        ✅ Selesai
                    </div>
                </div>

                <!-- SEMUA -->
                <div id="all" class="ps-content active">
                    <?php if (empty($transaksi_list)): ?>
                        <div style="text-align: center; padding: 64px 24px; background: #fff; border-radius: 12px;">
                            <div style="font-size: 48px; margin-bottom: 16px;">📦</div>
                            <h3 style="font-size: 20px; margin-bottom: 8px;">Belum Ada Pesanan</h3>
                            <p style="color: #666; margin-bottom: 24px;">Anda belum memiliki riwayat pesanan</p>
                            <a href="<?= site_url('') ?>" class="ps-btn">Mulai Belanja</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($transaksi_list as $transaksi): ?>
                            <div class="ps-card">
                                <div class="ps-header">
                                    <div class="ps-header-left">
                                        <div class="ps-invoice">📄 <?= htmlspecialchars($transaksi->no_nota) ?></div>
                                        <div class="ps-date">📅 <?= date('d M Y', strtotime($transaksi->tanggal)) ?></div>
                                    </div>
                                    <div class="ps-header-right">
                                        <?php 
                                        $status_class = 'status-process';
                                        if ($transaksi->payment_status == 'Berhasil') $status_class = 'status-success';
                                        elseif ($transaksi->payment_status == 'Ditolak') $status_class = 'status-cancelled';
                                        elseif ($transaksi->payment_status == 'Menunggu') $status_class = 'status-pending';
                                        ?>
                                        <div class="ps-status <?= $status_class ?>"><?= $transaksi->payment_status ?></div>
                                    </div>
                                </div>

                                <?php
                                $items = $this->db
                                    ->select('item.nama_item, item.gambar_item, item_detail.ukuran, item_detail.warna, transaksi_item.qty, transaksi_item.Total as subtotal')
                                    ->from('transaksi_item')
                                    ->join('item_detail', 'transaksi_item.id_item_detail = item_detail.id_item_detail')
                                    ->join('item', 'item_detail.id_item = item.id_item')
                                    ->where('transaksi_item.id_transaksi', $transaksi->id_transaksi)
                                    ->get()
                                    ->result();
                                
                                $total_items = count($items);
                                $first_items = array_slice($items, 0, 1);
                                $other_items = array_slice($items, 1);
                                ?>
                                
                                <?php foreach ($first_items as $item): ?>
                                    <div class="ps-item">
                                        <img src="<?= base_url('uploads/items/' . $item->gambar_item) ?>" alt="<?= htmlspecialchars($item->nama_item) ?>">
                                        <div class="ps-item-info">
                                            <div class="ps-item-name"><?= htmlspecialchars($item->nama_item) ?> <span style="color: #999; font-size: 12px;">(<?= $item->warna ?>, <?= $item->ukuran ?>, <?= $item->qty ?>x)</span></div>
                                            <div class="ps-item-price">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <?php if ($total_items > 1): ?>
                                    <div class="ps-more-items" id="items-<?= $transaksi->id_transaksi ?>">
                                        <?php foreach ($other_items as $item): ?>
                                            <div class="ps-item">
                                                <img src="<?= base_url('uploads/items/' . $item->gambar_item) ?>" alt="<?= htmlspecialchars($item->nama_item) ?>">
                                                <div class="ps-item-info">
                                                    <div class="ps-item-name"><?= htmlspecialchars($item->nama_item) ?> <span style="color: #999; font-size: 12px;">(<?= $item->warna ?>, <?= $item->ukuran ?>, <?= $item->qty ?>x)</span></div>
                                                    <div class="ps-item-price">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <button class="ps-more-btn" onclick="toggleItems('items-<?= $transaksi->id_transaksi ?>', this)">
                                        <span>Lihat <?= $total_items - 1 ?> barang lainnya</span> ▼
                                    </button>
                                <?php endif; ?>

                                <div class="ps-footer">
                                    <div class="ps-total">Total: <span>Rp <?= number_format($transaksi->total, 0, ',', '.') ?></span></div>
                                    
                                    <?php if ($transaksi->has_paid): ?>
                                        <a class="ps-btn ps-btn-success" href="<?= site_url('pesanan/invoice/' . $transaksi->no_nota) ?>">
                                            📄 Lihat Invoice
                                        </a>
                                    <?php else: ?>
                                        <a class="ps-btn" href="<?= site_url('pembayaran/' . $transaksi->no_nota) ?>">
                                            💳 Bayar Sekarang
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- MENUNGGU -->
                <div id="pending" class="ps-content">
                    <?php 
                    $pending = array_filter($transaksi_list, function($t) { return $t->payment_status == 'Menunggu'; });
                    if (empty($pending)): ?>
                        <p style="text-align: center; padding: 32px; color: #666;">Tidak ada pesanan yang menunggu pembayaran</p>
                    <?php else: foreach ($pending as $transaksi): ?>
                        <!-- Same card structure as above -->
                    <?php endforeach; endif; ?>
                </div>

                <!-- Other tabs (process, send, done) similar structure -->
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
            const arrow = btn.childNodes[btn.childNodes.length - 1];

            if (box.classList.contains('active')) {
                box.classList.remove('active');
                btn.classList.remove('active');
                const count = box.querySelectorAll('.ps-item').length;
                span.textContent = 'Lihat ' + count + ' barang lainnya';
                btn.innerHTML = '<span>' + span.textContent + '</span> ▼';
            } else {
                box.classList.add('active');
                btn.classList.add('active');
                span.textContent = 'Sembunyikan barang';
                btn.innerHTML = '<span>Sembunyikan barang</span> ▲';
            }
        }
    </script>
</body>
</html>