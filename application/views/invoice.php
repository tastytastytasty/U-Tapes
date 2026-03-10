<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= $transaksi->no_nota ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6f8;
            padding: 40px 20px;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .invoice-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
        }

        .invoice-header h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .invoice-header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .invoice-body {
            padding: 40px;
        }

        .invoice-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #eee;
        }

        .info-block h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-block p {
            margin-bottom: 6px;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 8px;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #eee;
        }

        .item-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .item-detail {
            font-size: 13px;
            color: #666;
        }

        .summary {
            max-width: 400px;
            margin-left: auto;
            background: #f8f9fa;
            padding: 24px;
            border-radius: 8px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .summary-total {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            padding-top: 16px;
            border-top: 2px solid #dee2e6;
            margin-top: 12px;
        }

        .actions {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }

        .btn {
            display: inline-block;
            padding: 14px 32px;
            margin: 0 8px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-print {
            background: #28a745;
            color: white;
        }

        .btn-print:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <h1>📄 INVOICE</h1>
            <p>Terima kasih atas pesanan Anda!</p>
        </div>

        <!-- Body -->
        <div class="invoice-body">
            <!-- Invoice Info -->
            <div class="invoice-info">
                <div class="info-block">
                    <h3>Invoice Details</h3>
                    <p><strong>No. Invoice:</strong> <?= $transaksi->no_nota ?></p>
                    <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($transaksi->tanggal)) ?></p>
                    <p><strong>Metode Pembayaran:</strong> <?= $transaksi->metode_pembayaran ?></p>
                    <div class="status-badge status-success">
                        ✅ Pembayaran Berhasil
                    </div>
                </div>

                <div class="info-block">
                    <h3>Alamat Pengiriman</h3>
                    <?php if ($alamat): ?>
                        <p><strong><?= $alamat->nama_penerima ?></strong></p>
                        <p><?= $alamat->nomor_telp_penerima ?></p>
                        <p><?= $alamat->detail ?></p>
                        <p><?= $alamat->nama_kelurahan ?>, <?= $alamat->nama_kecamatan ?></p>
                        <p><?= $alamat->nama_kabupaten ?>, <?= $alamat->nama_provinsi ?> <?= $alamat->kode_pos ?></p>
                    <?php else: ?>
                        <p style="color: #999;">Alamat tidak tersedia</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Items Table -->
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Harga</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <?php 
                    // Calculate prices
                    $harga_asli = $item->harga;
                    $harga_final = $harga_asli;
                    
                    // Check if item has promo
                    if ($item->is_sale == 1) {
                        if ($item->persen_promo > 0) {
                            $harga_final = $harga_asli - floor($harga_asli * ($item->persen_promo / 100));
                        } elseif ($item->harga_promo > 0) {
                            $harga_final = max(0, $harga_asli - $item->harga_promo);
                        }
                    }
                    
                    $subtotal_final = $harga_final * $item->qty;
                    ?>
                    <tr>
                        <td>
                            <div class="item-name">
                                <?= $item->nama_item ?>
                                <?php if ($item->is_sale == 1 && $harga_final < $harga_asli): ?>
                                    <span style="background: #fee; color: #e11d48; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; margin-left: 8px;">
                                        <?php if ($item->persen_promo > 0): ?>
                                            DISKON <?= $item->persen_promo ?>%
                                        <?php else: ?>
                                            DISKON Rp <?= number_format($item->harga_promo, 0, ',', '.') ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="item-detail">
                                <?= $item->warna ?> • Ukuran <?= $item->ukuran ?>
                            </div>
                        </td>
                        <td style="text-align: center;"><?= $item->qty ?></td>
                        <td style="text-align: right;">
                            <?php if ($item->is_sale == 1 && $harga_final < $harga_asli): ?>
                                <div style="text-decoration: line-through; color: #999; font-size: 13px;">
                                    Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                                </div>
                                <div style="color: #e11d48; font-weight: 600;">
                                    Rp <?= number_format($harga_final, 0, ',', '.') ?>
                                </div>
                            <?php else: ?>
                                Rp <?= number_format($harga_asli, 0, ',', '.') ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <strong>Rp <?= number_format($subtotal_final, 0, ',', '.') ?></strong>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Summary -->
            <div class="summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>Rp <?= number_format($transaksi->total - $transaksi->ongkir, 0, ',', '.') ?></span>
                </div>
                <div class="summary-row">
                    <span>Ongkir:</span>
                    <span>Rp <?= number_format($transaksi->ongkir, 0, ',', '.') ?></span>
                </div>
                <?php if ($transaksi->diskon_item > 0): ?>
                <div class="summary-row" style="color: #28a745;">
                    <span>Diskon Item:</span>
                    <span>- Rp <?= number_format($transaksi->diskon_item, 0, ',', '.') ?></span>
                </div>
                <?php endif; ?>
                <?php if ($transaksi->diskon_voucher > 0): ?>
                <div class="summary-row" style="color: #28a745;">
                    <span>Diskon Voucher:</span>
                    <span>- Rp <?= number_format($transaksi->diskon_voucher, 0, ',', '.') ?></span>
                </div>
                <?php endif; ?>
                <?php if ($transaksi->diskon_ongkir > 0): ?>
                <div class="summary-row" style="color: #28a745;">
                    <span>Diskon Ongkir:</span>
                    <span>- Rp <?= number_format($transaksi->diskon_ongkir, 0, ',', '.') ?></span>
                </div>
                <?php endif; ?>
                <div class="summary-row summary-total">
                    <span>TOTAL:</span>
                    <span>Rp <?= number_format($transaksi->total, 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="javascript:window.print()" class="btn btn-print">
                    🖨️ Print Invoice
                </a>
                <a href="<?= base_url('index.php/pesanan') ?>" class="btn btn-back">
                    ← Kembali ke Pesanan
                </a>
            </div>
        </div>
    </div>
</body>
</html>