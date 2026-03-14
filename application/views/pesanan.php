<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Pesanan Saya</title>

<?php
/**
 * Function to render order card
 * Avoid duplicate code in each tab
 */
function render_order_card($transaksi) {
    $CI = &get_instance();
    
    // Get display status
    $display_status = $transaksi->show_status;
    
    // Map status to CSS class
    $status_class = 'status-pending';
    if (in_array($display_status, ['Berhasil', 'Selesai', 'Diterima'])) {
        $status_class = 'status-success';
    } elseif (in_array($display_status, ['Ditolak', 'Gagal', 'Dibatalkan'])) {
        $status_class = 'status-cancelled';
    } elseif (in_array($display_status, ['Diproses', 'Dikemas', 'Menunggu Kurir'])) {
        $status_class = 'status-process';
    } elseif (in_array($display_status, ['Dalam Pengiriman', 'Dikirim'])) {
        $status_class = 'status-send';
    } elseif (in_array($display_status, ['Menunggu', 'Menunggu Pembayaran'])) {
        $status_class = 'status-pending';
    }
    
    // ✅ Get items WITH SNAPSHOT dari transaksi_promo_item
    $items = $CI->db
        ->select('
            item.nama_item, 
            item.gambar_item, 
            item_detail.ukuran, 
            item_detail.warna, 
            item_detail.harga AS harga_asli,
            transaksi_item.qty, 
            transaksi_item.Total as harga_final_total,
            transaksi_promo_item.nilai AS diskon_snapshot
        ')
        ->from('transaksi_item')
        ->join('item_detail', 'transaksi_item.id_item_detail = item_detail.id_item_detail')
        ->join('item', 'item_detail.id_item = item.id_item')
        ->join('transaksi_promo_item', 'transaksi_promo_item.id_transaksi_item = transaksi_item.id_transaksi_item', 'left')
        ->where('transaksi_item.id_transaksi', $transaksi->id_transaksi)
        ->get()
        ->result();
    
    $total_items = count($items);
    $first_items = array_slice($items, 0, 1);
    $other_items = array_slice($items, 1);
    ?>
    
    <div class="ps-card">
        <div class="ps-header">
            <div class="ps-header-left">
                <div class="ps-invoice"><i class="bi bi-file-earmark-text"></i> <?= htmlspecialchars($transaksi->no_nota) ?></div>
                <div class="ps-date"><i class="bi bi-calendar3"></i> <?= date('d M Y', strtotime($transaksi->tanggal)) ?></div>
            </div>
            <div class="ps-header-right">
                <div class="ps-status <?= $status_class ?>"><?= $display_status ?></div>
            </div>
        </div>

        <?php foreach ($first_items as $item): ?>
            <?php
            // ✅ USE SNAPSHOT - KURANGIN DISKON!
            $harga_asli = $item->harga_asli;           // Original price per item
            $total_sebelum_diskon = $item->harga_final_total;  // From transaksi_item.Total (BELUM DIKURANGIN!)
            $diskon_snapshot = $item->diskon_snapshot ?? 0;  // Discount from transaksi_promo_item.nilai
            $qty = $item->qty;
            
            // ✅ KURANGIN diskon
            $harga_final_total = $total_sebelum_diskon - $diskon_snapshot;
            
            // Calculate
            $total_asli = $harga_asli * $qty;          // Original subtotal
            $has_discount = ($diskon_snapshot > 0);    // ✅ Check if has discount from snapshot
            
            // If has discount, use the snapshot value
            if ($has_discount) {
                $diskon_total = $diskon_snapshot;      // ✅ Use snapshot discount directly
                $harga_final_per_item = $harga_final_total / $qty;
                $diskon_per_item = $diskon_total / $qty;
            }
            ?>
            
            <div class="ps-item">
                <img src="<?= base_url('assets/images/item/' . $item->gambar_item) ?>" 
                     alt="<?= htmlspecialchars($item->nama_item) ?>"
                     onerror="this.src='<?= base_url('assets/images/no-image.jpg') ?>'">
                
                <div class="ps-item-info">
                    <div class="ps-item-name">
                        <?= htmlspecialchars($item->nama_item) ?> 
                        <span style="color: #999; font-size: 12px; font-weight: 400;">
                            (<?= $item->warna ?>, <?= $item->ukuran ?>, <?= $qty ?>x)
                        </span>
                    </div>
                    
                    <!-- ✅ PRICE with DISKON badge -->
                    <?php if ($has_discount): ?>
                        <div style="margin-top: 6px;">
                            <!-- Harga asli -->
                            <div style="text-decoration: line-through; color: #999; font-size: 12px;">
                                Rp <?= number_format($total_asli, 0, ',', '.') ?>
                            </div>
                            
                            <!-- Harga final + Badge DISKON -->
                            <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                                <div class="ps-item-price">Rp <?= number_format($harga_final_total, 0, ',', '.') ?></div>
                                <span style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 700; box-shadow: 0 2px 6px rgba(255,107,107,0.3);">
                                    DISKON Rp <?= number_format($diskon_total, 0, ',', '.') ?>
                                </span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="ps-item-price" style="margin-top: 6px;">Rp <?= number_format($harga_final_total, 0, ',', '.') ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($total_items > 1): ?>
            <div class="ps-more-items" id="items-<?= $transaksi->id_transaksi ?>">
                <?php foreach ($other_items as $item): ?>
                    <?php
                    // ✅ USE SNAPSHOT - KURANGIN DISKON!
                    $harga_asli = $item->harga_asli;
                    $total_sebelum_diskon = $item->harga_final_total;
                    $diskon_snapshot = $item->diskon_snapshot ?? 0;
                    $qty = $item->qty;
                    
                    // ✅ KURANGIN diskon
                    $harga_final_total = $total_sebelum_diskon - $diskon_snapshot;
                    
                    $total_asli = $harga_asli * $qty;
                    $has_discount = ($diskon_snapshot > 0);  // ✅ Check snapshot
                    
                    if ($has_discount) {
                        $diskon_total = $diskon_snapshot;  // ✅ Use snapshot directly
                    }
                    ?>
                    
                    <div class="ps-item">
                        <img src="<?= base_url('assets/images/item/' . $item->gambar_item) ?>" 
                             alt="<?= htmlspecialchars($item->nama_item) ?>"
                             onerror="this.src='<?= base_url('assets/images/no-image.jpg') ?>'">
                        
                        <div class="ps-item-info">
                            <div class="ps-item-name">
                                <?= htmlspecialchars($item->nama_item) ?> 
                                <span style="color: #999; font-size: 12px; font-weight: 400;">
                                    (<?= $item->warna ?>, <?= $item->ukuran ?>, <?= $qty ?>x)
                                </span>
                            </div>
                            
                            <!-- ✅ PRICE with DISKON badge -->
                            <?php if ($has_discount): ?>
                                <div style="margin-top: 6px;">
                                    <div style="text-decoration: line-through; color: #999; font-size: 12px;">
                                        Rp <?= number_format($total_asli, 0, ',', '.') ?>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                                        <div class="ps-item-price">Rp <?= number_format($harga_final_total, 0, ',', '.') ?></div>
                                        <span style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 700; box-shadow: 0 2px 6px rgba(255,107,107,0.3);">
                                            DISKON Rp <?= number_format($diskon_total, 0, ',', '.') ?>
                                        </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ps-item-price" style="margin-top: 6px;">Rp <?= number_format($harga_final_total, 0, ',', '.') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button class="ps-more-btn" onclick="toggleItems('items-<?= $transaksi->id_transaksi ?>', this)">
                <span>Lihat <?= $total_items - 1 ?> barang lainnya</span> <i class="bi bi-chevron-down"></i>
            </button>
        <?php endif; ?>

        <div class="ps-footer">
            <div class="ps-total">Total: <span>Rp <?= number_format($transaksi->total, 0, ',', '.') ?></span></div>
            
            <?php if ($transaksi->has_paid): ?>
                <a class="ps-btn ps-btn-success" href="<?= site_url('pesanan/invoice/' . $transaksi->no_nota) ?>">
                    <i class="bi bi-file-text"></i> Lihat Invoice
                </a>
            <?php else: ?>
                <a class="ps-btn" href="<?= site_url('pembayaran/' . $transaksi->no_nota) ?>">
                    <i class="bi bi-credit-card"></i> Bayar Sekarang
                </a>
            <?php endif; ?>
        </div>
    </div>
    
<?php
}
?>

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
            flex-wrap: wrap;
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

        .status-pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .status-success {
            background: #f0fdf4;
            color: #16a34a;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #dc2626;
        }

        .status-process {
            background: #eff6ff;
            color: #2563eb;
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

        /* Toggle Button - FIXED! */
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
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
            background: #fff;
            border-radius: 12px;
        }

        .ps-empty i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .ps-empty p {
            font-size: 16px;
            margin-top: 8px;
            color: #666;
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
                <h1 class="page-title">Pesanan Saya</h1>
            </div>
            <div class="col-md-6 text-end">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('') ?>"><i class="bi bi-house"></i> Home</a></li>
                    <li>Pesanan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="profile-wrapper">
        <!-- SIDEBAR -->
        <div class="profile-sidebar">
            <div class="profile-user">
                <img src="<?= base_url('assets/images/user-default.jpg') ?>" alt="user" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2248%22 height=%2248%22 viewBox=%220 0 24 24%22 fill=%22%23ccc%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E'">
                <div>
                    <strong><?= isset($logged_in) && $logged_in && !empty($user['nama']) ? htmlspecialchars($user['nama']) : 'Guest' ?></strong><br>
                    <span>Ubah Profil</span>
                </div>
            </div>

            <ul class="profile-menu">
                <li class="menu-title">
                    <i class="bi bi-person"></i> Akun Saya
                </li>
                <li><a href="<?= site_url('profile') ?>">Profil</a></li>
                <li><a href="<?= site_url('alamat') ?>">Alamat</a></li>
                <li><a href="#">Ubah Kata Sandi</a></li>

                <hr>

                <li><a href="<?= site_url('pesanan') ?>" class="active"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                <li><a href="#"><i class="bi bi-bell"></i> Notifikasi</a></li>
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
                    <div class="ps-tab" onclick="showTab('pending')">
                        <i class="bi bi-hourglass-split"></i> Menunggu
                    </div>
                    <div class="ps-tab" onclick="showTab('process')">
                        <i class="bi bi-box-seam"></i> Dikemas
                    </div>
                    <div class="ps-tab" onclick="showTab('send')">
                        <i class="bi bi-truck"></i> Dikirim
                    </div>
                    <div class="ps-tab" onclick="showTab('done')">
                        <i class="bi bi-check-circle"></i> Selesai
                    </div>
                </div>

                <!-- SEMUA -->
                <div id="all" class="ps-content active">
                    <?php if (empty($transaksi_list)): ?>
                        <div class="ps-empty">
                            <i class="bi bi-inbox"></i>
                            <h3 style="font-size: 20px; margin-bottom: 8px; color: #333;">Belum Ada Pesanan</h3>
                            <p>Anda belum memiliki riwayat pesanan</p>
                            <br>
                            <a href="<?= site_url('') ?>" class="ps-btn">Mulai Belanja</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($transaksi_list as $transaksi): ?>
                            <?php render_order_card($transaksi); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- MENUNGGU PEMBAYARAN -->
                <div id="pending" class="ps-content">
                    <?php 
                    $pending = array_filter($transaksi_list ?? [], function($t) { 
                        return $t->show_status == 'Menunggu'; 
                    });
                    ?>
                    <?php if (empty($pending)): ?>
                        <div class="ps-empty">
                            <i class="bi bi-hourglass-split"></i>
                            <p>Tidak ada pesanan yang menunggu pembayaran</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($pending as $transaksi): ?>
                            <?php render_order_card($transaksi); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- DIKEMAS -->
                <div id="process" class="ps-content">
                    <?php 
                    $process = array_filter($transaksi_list ?? [], function($t) { 
                        return in_array($t->show_status, ['Diproses', 'Dikemas', 'Menunggu Kurir']); 
                    });
                    ?>
                    <?php if (empty($process)): ?>
                        <div class="ps-empty">
                            <i class="bi bi-box-seam"></i>
                            <p>Tidak ada pesanan yang sedang dikemas</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($process as $transaksi): ?>
                            <?php render_order_card($transaksi); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- DIKIRIM -->
                <div id="send" class="ps-content">
                    <?php 
                    $send = array_filter($transaksi_list ?? [], function($t) { 
                        return in_array($t->show_status, ['Dalam Pengiriman', 'Dikirim']); 
                    });
                    ?>
                    <?php if (empty($send)): ?>
                        <div class="ps-empty">
                            <i class="bi bi-truck"></i>
                            <p>Tidak ada pesanan yang sedang dikirim</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($send as $transaksi): ?>
                            <?php render_order_card($transaksi); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- SELESAI -->
                <div id="done" class="ps-content">
                    <?php 
                    $done = array_filter($transaksi_list ?? [], function($t) { 
                        return in_array($t->show_status, ['Selesai', 'Diterima', 'Berhasil']); 
                    });
                    ?>
                    <?php if (empty($done)): ?>
                        <div class="ps-empty">
                            <i class="bi bi-check-circle"></i>
                            <p>Tidak ada pesanan yang telah selesai</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($done as $transaksi): ?>
                            <?php render_order_card($transaksi); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(id) {
            // Remove active dari semua
            document.querySelectorAll('.ps-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.ps-tab').forEach(el => el.classList.remove('active'));

            // Set active
            document.getElementById(id).classList.add('active');
            event.target.closest('.ps-tab').classList.add('active');
        }

        function toggleItems(id, btn) {
            const box = document.getElementById(id);
            const span = btn.querySelector('span');
            const icon = btn.querySelector('i');

            if (box.classList.contains('active')) {
                // Collapse
                box.classList.remove('active');
                btn.classList.remove('active');
                
                const count = box.querySelectorAll('.ps-item').length;
                span.textContent = 'Lihat ' + count + ' barang lainnya';
                icon.className = 'bi bi-chevron-down';
            } else {
                // Expand
                box.classList.add('active');
                btn.classList.add('active');
                
                span.textContent = 'Sembunyikan barang';
                icon.className = 'bi bi-chevron-up';
            }
        }
    </script>
</body>
</html>