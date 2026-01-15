<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice #INV-001</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            color: #1e293b;
            padding: 20px 16px;
            min-height: 100vh;
        }

        /* Container */
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* Header */
        .invoice-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
        }

        .invoice-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .invoice-header::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .invoice-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
            gap: 20px;
        }

        .invoice-title-section {
            flex: 1;
            min-width: 200px;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .invoice-number {
            font-size: 16px;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .invoice-meta {
            text-align: right;
            flex-shrink: 0;
        }

        .invoice-date {
            font-size: 15px;
            margin-bottom: 10px;
            opacity: 0.95;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .badge-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Content */
        .invoice-content {
            padding: 32px 28px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .info-box {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border-radius: 16px;
            padding: 20px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }

        .info-box:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }

        .info-box-title {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box-title i {
            color: #3b82f6;
            font-size: 16px;
        }

        .info-list {
            list-style: none;
            font-size: 15px;
            color: #475569;
            line-height: 1.8;
        }

        .info-list li {
            margin-bottom: 6px;
        }

        .info-list li strong {
            color: #1e293b;
            font-weight: 600;
        }

        /* Table */
        .invoice-section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 4px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 24px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .invoice-table thead {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .invoice-table th {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .invoice-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
            color: #475569;
            vertical-align: top;
        }

        .invoice-table tbody tr {
            transition: all 0.2s;
        }

        .invoice-table tbody tr:hover {
            background: #f8fafc;
        }

        .invoice-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .product-variant {
            color: #94a3b8;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .price-cell {
            font-weight: 600;
            color: #3b82f6;
            white-space: nowrap;
        }

        /* Summary */
        .invoice-summary {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 24px;
            border: 2px solid #e2e8f0;
            max-width: 400px;
            margin-left: auto;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            font-size: 15px;
            color: #475569;
        }

        .summary-row:not(:last-child) {
            border-bottom: 1px dashed #cbd5e1;
        }

        .summary-row.total {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            padding-top: 16px;
            margin-top: 8px;
            border-top: 2px solid #cbd5e1;
            border-bottom: none;
        }

        .summary-row.total .amount {
            color: #3b82f6;
        }

        .payment-method {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed #cbd5e1;
            font-size: 14px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-method i {
            color: #3b82f6;
        }

        /* Action Buttons */
        .invoice-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px dashed #e2e8f0;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #fff;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 12px 8px;
            }

            .invoice-container {
                border-radius: 16px;
            }

            .invoice-header {
                padding: 24px 20px;
            }

            .invoice-header-content {
                flex-direction: column;
            }

            .invoice-title {
                font-size: 26px;
            }

            .invoice-meta {
                text-align: left;
                width: 100%;
            }

            .invoice-date {
                justify-content: flex-start;
            }

            .invoice-content {
                padding: 24px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .section-title {
                font-size: 16px;
            }

            .invoice-table {
                font-size: 14px;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 12px;
            }

            .invoice-table th:nth-child(2),
            .invoice-table td:nth-child(2) {
                display: none;
            }

            .invoice-summary {
                max-width: 100%;
            }

            .summary-row {
                font-size: 14px;
            }

            .summary-row.total {
                font-size: 18px;
            }

            .invoice-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .invoice-header {
                padding: 20px 16px;
            }

            .invoice-title {
                font-size: 22px;
            }

            .invoice-content {
                padding: 20px 16px;
            }

            .info-box {
                padding: 16px;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 10px 8px;
                font-size: 13px;
            }

            .invoice-table th:nth-child(3),
            .invoice-table td:nth-child(3) {
                display: none;
            }

            .product-name {
                font-size: 14px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
                border-radius: 0;
            }

            .invoice-actions {
                display: none;
            }

            .invoice-header {
                background: #3b82f6;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="invoice-header-content">
                <div class="invoice-title-section">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-number"><i class="bi bi-hash"></i> INV-001</div>
                </div>
                <div class="invoice-meta">
                    <div class="invoice-date"><i class="bi bi-calendar-event"></i> 15 Januari 2025</div>
                    <div class="badge-status"><i class="bi bi-clock-history"></i> Menunggu Pembayaran</div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="invoice-content">
            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-box-title"><i class="bi bi-person-circle"></i> Customer</div>
                    <ul class="info-list">
                        <li><strong>John Doe</strong></li>
                        <li><i class="bi bi-envelope"></i> john.doe@email.com</li>
                        <li><i class="bi bi-telephone"></i> +62 812 3456 7890</li>
                    </ul>
                </div>

                <div class="info-box">
                    <div class="info-box-title"><i class="bi bi-truck"></i> Pengiriman</div>
                    <ul class="info-list">
                        <li><strong>Jl. Merdeka No. 123, RT 01 RW 05</strong></li>
                        <li>Cicendo, Bandung</li>
                        <li>Kota Bandung, Jawa Barat, 40123</li>
                        <li><i class="bi bi-box-seam"></i> <strong>JNE</strong> - REG</li>
                    </ul>
                </div>
            </div>

            <!-- Products -->
            <div class="invoice-section">
                <div class="section-title">Detail Produk</div>
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th style="width: 80px;">Qty</th>
                            <th style="width: 130px;">Harga</th>
                            <th style="width: 150px; text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="product-name">Keyboard Mechanical RGB</div>
                                <div class="product-variant"><i class="bi bi-tag"></i> Gateron Brown Switch</div>
                            </td>
                            <td>1</td>
                            <td class="price-cell">Rp 750.000</td>
                            <td class="price-cell" style="text-align: right;">Rp 750.000</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-name">Mouse Gaming Wireless</div>
                                <div class="product-variant"><i class="bi bi-tag"></i> Black Edition</div>
                            </td>
                            <td>2</td>
                            <td class="price-cell">Rp 450.000</td>
                            <td class="price-cell" style="text-align: right;">Rp 900.000</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-name">Headset Gaming 7.1 Surround</div>
                            </td>
                            <td>1</td>
                            <td class="price-cell">Rp 500.000</td>
                            <td class="price-cell" style="text-align: right;">Rp 500.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="invoice-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="amount">Rp 2.150.000</span>
                </div>
                <div class="summary-row">
                    <span>Ongkos Kirim</span>
                    <span class="amount">Rp 25.000</span>
                </div>
                <div class="summary-row total">
                    <span>Total Pembayaran</span>
                    <span class="amount">Rp 2.175.000</span>
                </div>
                <div class="payment-method">
                    <i class="bi bi-credit-card"></i>
                    <span><strong>Metode:</strong> Transfer Bank BCA</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="invoice-actions">
                <a href="<?= site_url('pesanan') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Pesanan
                </a>
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20butuh%20bantuan%20untuk%20pesanan%20INV-001"
                    class="btn btn-primary" target="_blank">
                    <i class="bi bi-whatsapp"></i> Hubungi Penjual
                </a>
            </div>
        </div>
    </div>
</body>

</html>