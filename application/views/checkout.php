<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Modern E-Commerce</title>
  <style>
    :root {
      --primary: #4f46e5;
      --primary-dark: #4338ca;
      --primary-light: #eef2ff;
      --success: #059669;
      --danger: #dc2626;
      --warning: #d97706;
      --muted: #64748b;
      --border: #e2e8f0;
      --bg: #f8fafc;
      --bg-secondary: #f1f5f9;
      --text: #0f172a;
      --text-secondary: #475569;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
      --radius: 12px;
      --radius-sm: 8px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    .checkout-wrapper {
      max-width: 1200px;
      margin: 2rem auto 3rem;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 1.5rem;
      padding: 0 1rem;
    }

    .box {
      background: white;
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border);
      transition: all 0.3s ease;
    }

    .box:hover {
      box-shadow: var(--shadow);
    }

    .box-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--bg-secondary);
    }

    .box h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--text);
      margin: 0;
    }

    .btn {
      padding: 0.625rem 1.25rem;
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      border: none;
      outline: none;
    }

    .btn-link {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--primary);
      padding: 0.5rem 1rem;
    }

    .btn-link:hover {
      background: var(--bg);
      border-color: var(--primary);
    }

    .btn-primary {
      background: var(--primary);
      color: white;
      box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: var(--shadow);
    }

    /* Address */
    .address-display {
      display: grid;
      gap: 0.5rem;
      padding: 1rem;
      background: var(--bg);
      border-radius: var(--radius-sm);
      border-left: 3px solid var(--primary);
    }

    .address-display strong {
      font-size: 1rem;
      color: var(--text);
    }

    .address-display p {
      color: var(--text-secondary);
      font-size: 0.875rem;
      margin: 0;
    }

    .address-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: var(--primary);
      color: white;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 500;
      margin-top: 0.5rem;
    }

    /* Product Item */
    .product-item {
      display: flex;
      gap: 1rem;
      padding: 1rem;
      background: var(--bg);
      border-radius: var(--radius-sm);
      margin-bottom: 1rem;
      transition: all 0.3s ease;
      animation: slideIn 0.4s ease;
    }

    .product-item:hover {
      background: var(--bg-secondary);
      transform: translateX(4px);
    }

    .product-img {
      width: 80px;
      height: 80px;
      border-radius: var(--radius-sm);
      object-fit: cover;
      box-shadow: var(--shadow-sm);
    }

    .product-info {
      flex: 1;
    }

    .product-name {
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.25rem;
    }

    .product-variant {
      font-size: 0.8125rem;
      color: var(--muted);
      margin-bottom: 0.5rem;
    }

    .product-price-detail {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .product-qty {
      font-size: 0.8125rem;
      color: var(--text-secondary);
    }

    .product-price {
      font-size: 1rem;
      font-weight: 700;
      color: var(--primary);
    }

    /* Promo Section */
    .promo-input-group {
      display: flex;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .promo-input {
      flex: 1;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      transition: all 0.2s;
    }

    .promo-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-apply-promo {
      padding: 0.75rem 1.25rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-apply-promo:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }

    .promo-applied {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem;
      background: linear-gradient(135deg, #059669 0%, #10b981 100%);
      border-radius: var(--radius-sm);
      color: white;
      margin-top: 1rem;
      animation: slideIn 0.3s ease;
    }

    .promo-applied-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .promo-icon {
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
    }

    .promo-text strong {
      display: block;
      font-size: 0.875rem;
    }

    .promo-text small {
      font-size: 0.75rem;
      opacity: 0.9;
    }

    .btn-remove-promo {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 0.5rem 0.75rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.75rem;
      transition: all 0.2s;
    }

    .btn-remove-promo:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    /* Voucher Card */
    .voucher-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      background: linear-gradient(135deg, var(--primary-light) 0%, #fef3ff 100%);
      border: 1px dashed var(--primary);
      border-radius: var(--radius-sm);
      margin-bottom: 0.75rem;
      transition: all 0.3s ease;
      animation: slideIn 0.3s ease;
    }

    .voucher-card:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow);
      border-style: solid;
    }

    .voucher-card.used {
      opacity: 0.5;
      pointer-events: none;
    }

    .voucher-left {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex: 1;
    }

    .voucher-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      color: white;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.125rem;
      font-weight: 700;
      flex-shrink: 0;
    }

    .voucher-info {
      flex: 1;
    }

    .voucher-title {
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.25rem;
    }

    .voucher-desc {
      font-size: 0.8125rem;
      color: var(--text-secondary);
      margin-bottom: 0.25rem;
    }

    .voucher-valid {
      font-size: 0.75rem;
      color: var(--muted);
    }

    .btn-use-voucher {
      padding: 0.5rem 1rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 0.8125rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
    }

    .btn-use-voucher:hover {
      background: var(--primary-dark);
      transform: scale(1.05);
    }

    .btn-use-voucher:disabled {
      background: var(--muted);
      cursor: not-allowed;
      transform: none;
    }

    /* Summary */
    .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      font-size: 0.9375rem;
      border-bottom: 1px solid var(--bg-secondary);
    }

    .summary-row:last-child {
      border-bottom: none;
    }

    .summary-row .label {
      color: var(--text-secondary);
    }

    .summary-row .value {
      font-weight: 600;
      color: var(--text);
    }

    .summary-row.discount .value {
      color: var(--success);
    }

    .summary-row.total {
      margin-top: 0.5rem;
      padding-top: 1rem;
      border-top: 2px solid var(--border);
      font-size: 1.125rem;
    }

    .summary-row.total .label {
      color: var(--text);
      font-weight: 600;
    }

    .summary-row.total .value {
      color: var(--primary);
      font-size: 1.5rem;
      font-weight: 700;
    }

    /* Checkout Button */
    .btn-checkout {
      width: 100%;
      padding: 1rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1rem;
      transition: all 0.3s ease;
      box-shadow: var(--shadow);
    }

    .btn-checkout:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-checkout:active {
      transform: translateY(0);
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 9999;
      animation: fadeIn 0.2s ease;
    }

    .modal[aria-hidden="false"] {
      display: block;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
    }

    .modal-content {
      position: relative;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      margin: 2rem auto;
      background: white;
      border-radius: var(--radius);
      padding: 1.5rem;
      box-shadow: var(--shadow-lg);
      animation: slideUp 0.3s ease;
    }

    .modal-close {
      position: absolute;
      right: 1rem;
      top: 1rem;
      width: 32px;
      height: 32px;
      border: none;
      background: var(--bg);
      border-radius: 50%;
      font-size: 1.25rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      color: var(--text-secondary);
    }

    .modal-close:hover {
      background: var(--bg-secondary);
      transform: rotate(90deg);
    }

    .address-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      background: var(--bg);
      margin-bottom: 1rem;
      transition: 0.25s ease;
    }

    .address-card:hover {
      border-color: var(--primary);
      background: var(--primary-light);
      transform: translateY(-2px);
    }

    .address-card.active {
      border-color: var(--primary);
      background: var(--primary-light);
      border-width: 2px;
    }

    .address-info strong {
      font-size: 0.95rem;
      color: var(--text);
      display: block;
      margin-bottom: 0.5rem;
    }

    .address-detail {
      font-size: 0.85rem;
      color: var(--text-secondary);
      line-height: 1.5;
    }

    .btn-use-address {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.55rem 1.25rem;
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.25s;
    }

    .btn-use-address:hover:not(:disabled) {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }

    .btn-use-address:disabled {
      background: var(--muted);
      cursor: not-allowed;
      transform: none;
    }

    .spinner {
      width: 16px;
      height: 16px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      display: inline-block;
      margin-right: 0.5rem;
      vertical-align: middle;
    }

    .alert {
      padding: 1rem;
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
    }

    .alert-warning {
      background: #fef3c7;
      border: 1px solid #f59e0b;
      color: #92400e;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .checkout-wrapper {
        grid-template-columns: 1fr;
      }

      .address-card {
        flex-direction: column;
        gap: 0.75rem;
      }

      .btn-use-address {
        width: 100%;
      }

      .product-item {
        flex-direction: column;
      }

      .product-img {
        width: 100%;
        height: 200px;
      }

      .voucher-card {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
      }

      .voucher-left {
        flex-direction: column;
        text-align: center;
      }

      .btn-use-voucher {
        width: 100%;
      }

      .promo-input-group {
        flex-direction: column;
      }

      .btn-apply-promo {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="checkout-wrapper">
  <div class="checkout-left">
    
    <!-- Alamat Pengiriman -->
    <div class="box">
      <div class="box-header">
        <h3>📍 Alamat Pengiriman</h3>
        <button class="btn btn-link" id="btn-open-modal">Ganti Alamat</button>
      </div>
      
      <div class="address-display" id="address-display-main">
        <?php if ($alamat_checkout): ?>
          <strong><?= htmlspecialchars($alamat_checkout->nama_alamat) ?></strong>
          <p><?= htmlspecialchars($alamat_checkout->detail) ?></p>
          
          <?php if (!empty($alamat_checkout->nama_kelurahan)): ?>
            <p>
              <?= htmlspecialchars($alamat_checkout->nama_kelurahan) ?>, 
              <?= htmlspecialchars($alamat_checkout->nama_kecamatan) ?>, 
              <?= htmlspecialchars($alamat_checkout->nama_kabupaten) ?>, 
              <?= htmlspecialchars($alamat_checkout->nama_provinsi) ?>
            </p>
          <?php endif; ?>
          
          <p>Kode Pos: <?= htmlspecialchars($alamat_checkout->kode_pos) ?></p>
          
          <?php if (!empty($alamat_checkout->no_telp)): ?>
            <p>📱 <?= htmlspecialchars($alamat_checkout->no_telp) ?></p>
          <?php endif; ?>
          
          <span class="address-badge">Alamat Pengiriman</span>
        <?php else: ?>
          <div class="alert alert-warning">
            ⚠️ Belum ada alamat pengiriman. Silakan pilih alamat.
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Produk -->
    <div class="box">
      <h3>🛍️ Pesanan Anda (3 item)</h3>

      <!-- Product 1 -->
      <div class="product-item">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop" class="product-img" alt="Nike Air Max">
        <div class="product-info">
          <div class="product-name">Nike Air Max 270</div>
          <div class="product-variant">Ukuran: 42 • Warna: Hitam</div>
          <div class="product-price-detail">
            <span class="product-qty">× 1</span>
            <span class="product-price">Rp 1.200.000</span>
          </div>
        </div>
      </div>

      <!-- Product 2 -->
      <div class="product-item">
        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&h=400&fit=crop" class="product-img" alt="Adidas Ultraboost">
        <div class="product-info">
          <div class="product-name">Adidas Ultraboost 21</div>
          <div class="product-variant">Ukuran: 41 • Warna: Putih</div>
          <div class="product-price-detail">
            <span class="product-qty">× 2</span>
            <span class="product-price">Rp 3.800.000</span>
          </div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="product-item">
        <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=400&h=400&fit=crop" class="product-img" alt="Converse Chuck Taylor">
        <div class="product-info">
          <div class="product-name">Converse Chuck Taylor All Star</div>
          <div class="product-variant">Ukuran: 40 • Warna: Merah</div>
          <div class="product-price-detail">
            <span class="product-qty">× 1</span>
            <span class="product-price">Rp 800.000</span>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="checkout-right">
    
    <!-- Promo -->
    <div class="box">
      <h3>🎁 Promo & Voucher</h3>
      
      <div id="promo-container">
        <!-- Input Promo -->
        <div class="promo-input-group">
          <input type="text" class="promo-input" id="promo-code" placeholder="Masukkan kode promo">
          <button class="btn-apply-promo" id="btn-apply-promo">Pakai</button>
        </div>

        <!-- Available Vouchers -->
        <div style="margin-top: 1.5rem;">
          <div style="font-size: 0.875rem; font-weight: 600; color: var(--text); margin-bottom: 0.75rem;">
            Voucher Tersedia
          </div>

          <!-- Voucher 1 -->
          <div class="voucher-card" data-code="DISKON10" data-type="percentage" data-value="10">
            <div class="voucher-left">
              <div class="voucher-icon">10%</div>
              <div class="voucher-info">
                <div class="voucher-title">Diskon 10%</div>
                <div class="voucher-desc">Potongan 10% untuk semua produk</div>
                <div class="voucher-valid">Berlaku hingga 31 Jan 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucher('DISKON10', 'percentage', 10)">
              Pakai
            </button>
          </div>

          <!-- Voucher 2 -->
          <div class="voucher-card" data-code="GRATIS50" data-type="fixed" data-value="50000">
            <div class="voucher-left">
              <div class="voucher-icon">50K</div>
              <div class="voucher-info">
                <div class="voucher-title">Potongan Rp 50.000</div>
                <div class="voucher-desc">Untuk pembelian min. Rp 500.000</div>
                <div class="voucher-valid">Berlaku hingga 28 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucher('GRATIS50', 'fixed', 50000)">
              Pakai
            </button>
          </div>

          <!-- Voucher 3 -->
          <div class="voucher-card" data-code="FREEONGKIR" data-type="shipping" data-value="0">
            <div class="voucher-left">
              <div class="voucher-icon">🚚</div>
              <div class="voucher-info">
                <div class="voucher-title">Gratis Ongkir</div>
                <div class="voucher-desc">Bebas biaya pengiriman</div>
                <div class="voucher-valid">Berlaku hingga 15 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucher('FREEONGKIR', 'shipping', 0)">
              Pakai
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="box">
      <h3>📋 Ringkasan Belanja</h3>

      <div class="summary-row">
        <span class="label">Subtotal (3 item)</span>
        <span class="value" id="subtotal">Rp 5.800.000</span>
      </div>

      <div class="summary-row">
        <span class="label">Ongkir</span>
        <span class="value" id="shipping">Rp 25.000</span>
      </div>

      <div class="summary-row discount" id="discount-row" style="display: none;">
        <span class="label">Diskon</span>
        <span class="value" id="discount">- Rp 0</span>
      </div>

      <div class="summary-row total">
        <span class="label">Total</span>
        <span class="value" id="total">Rp 5.825.000</span>
      </div>

      <button class="btn-checkout" id="btn-checkout">💳 Bayar Sekarang</button>
    </div>

  </div>
</div>

<!-- Modal Alamat -->
<div id="alamat-modal" class="modal" aria-hidden="true">
  <div class="modal-overlay" id="modal-overlay"></div>
  <div class="modal-content">
    <button class="modal-close" id="modal-close">×</button>
    <h3>Pilih Alamat Pengiriman</h3>

    <div id="address-list-container">
      <?php if (!empty($alamat_list)): ?>
        <?php foreach ($alamat_list as $alamat): ?>
          <?php 
          $is_selected = false;
          if ($this->session->userdata('id_alamat_checkout')) {
              $is_selected = ($alamat->id_alamat == $this->session->userdata('id_alamat_checkout'));
          } else {
              $is_selected = ($alamat->is_default == 1);
          }
          ?>
          
          <div class="address-card <?= $is_selected ? 'active' : '' ?>" data-id="<?= $alamat->id_alamat ?>">
            <div class="address-info">
              <strong>
                <?= htmlspecialchars($alamat->nama_alamat) ?>
                <?php if ($alamat->is_default == 1): ?>
                  <span style="color: var(--success); font-size: 0.8rem;">⭐ Utama</span>
                <?php endif; ?>
                <?php if ($is_selected && $alamat->is_default != 1): ?>
                  <span style="color: var(--primary); font-size: 0.8rem;">✓ Dipilih</span>
                <?php endif; ?>
              </strong>
              <div class="address-detail">
                <?= htmlspecialchars($alamat->detail) ?><br>
                
                <?php if (!empty($alamat->nama_kelurahan)): ?>
                  <?= htmlspecialchars($alamat->nama_kelurahan) ?>, 
                  <?= htmlspecialchars($alamat->nama_kecamatan) ?><br>
                  <?= htmlspecialchars($alamat->nama_kabupaten) ?>, 
                  <?= htmlspecialchars($alamat->nama_provinsi) ?><br>
                <?php endif; ?>
                
                Kode Pos: <?= htmlspecialchars($alamat->kode_pos) ?>
                
                <?php if (!empty($alamat->no_telp)): ?>
                  <br>📱 <?= htmlspecialchars($alamat->no_telp) ?>
                <?php endif; ?>
              </div>
            </div>
            <button 
              class="btn-use-address" 
              data-id="<?= $alamat->id_alamat ?>"
              <?= $is_selected ? 'disabled' : '' ?>>
              <?= $is_selected ? 'Dipilih' : 'Gunakan' ?>
            </button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="text-align: center; padding: 2rem;">
          <p style="color: var(--muted); margin-bottom: 1rem;">📍 Anda belum memiliki alamat</p>
          <a href="<?= base_url('profile/alamat') ?>" class="btn btn-primary">Tambah Alamat</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
// State
const state = {
  subtotal: 5800000,
  shipping: 25000,
  discount: 0,
  promoCode: null
};

// Format Rupiah
function formatRupiah(amount) {
  return 'Rp ' + amount.toLocaleString('id-ID');
}

// Calculate Total
function calculateTotal() {
  return state.subtotal + state.shipping - state.discount;
}

// Update Display
function updatePriceDisplay() {
  document.getElementById('subtotal').textContent = formatRupiah(state.subtotal);
  document.getElementById('shipping').textContent = formatRupiah(state.shipping);
  document.getElementById('total').textContent = formatRupiah(calculateTotal());

  const discountRow = document.getElementById('discount-row');
  if (state.discount > 0) {
    discountRow.style.display = 'flex';
    document.getElementById('discount').textContent = '- ' + formatRupiah(state.discount);
  } else {
    discountRow.style.display = 'none';
  }
}

// Apply Promo (dari input)
function applyPromo(code) {
  code = code.toUpperCase().trim();
  
  const promos = {
    'DISKON10': { type: 'percentage', value: 10, desc: 'Diskon 10%' },
    'GRATIS50': { type: 'fixed', value: 50000, desc: 'Potongan Rp 50.000' },
    'FREEONGKIR': { type: 'shipping', value: 0, desc: 'Gratis Ongkir' }
  };

  if (!promos[code]) {
    showNotification('❌ Kode promo tidak valid', 'error');
    return;
  }

  const promo = promos[code];
  applyDiscount(code, promo.type, promo.value, promo.desc);
}

// Apply Voucher (dari card)
function applyVoucher(code, type, value) {
  let desc = '';
  if (type === 'percentage') desc = `Diskon ${value}%`;
  else if (type === 'fixed') desc = `Potongan Rp ${value.toLocaleString('id-ID')}`;
  else if (type === 'shipping') desc = 'Gratis Ongkir';

  applyDiscount(code, type, value, desc);
}

// Core Apply Discount
function applyDiscount(code, type, value, description) {
  let discountAmount = 0;

  if (type === 'percentage') {
    discountAmount = Math.floor(state.subtotal * (value / 100));
  } else if (type === 'fixed') {
    discountAmount = value;
  } else if (type === 'shipping') {
    discountAmount = state.shipping;
    state.shipping = 0;
  }

  state.discount = discountAmount;
  state.promoCode = code;

  // Update UI - Replace entire promo container
  const promoContainer = document.getElementById('promo-container');
  promoContainer.innerHTML = `
    <div class="promo-applied">
      <div class="promo-applied-info">
        <div class="promo-icon">🎉</div>
        <div class="promo-text">
          <strong>${code}</strong>
          <small>${description} diterapkan</small>
        </div>
      </div>
      <button class="btn-remove-promo" onclick="removePromo()">Hapus</button>
    </div>
  `;

  updatePriceDisplay();
  showNotification('✅ Voucher berhasil diterapkan!', 'success');
}

// Remove Promo
function removePromo() {
  state.discount = 0;
  state.shipping = 25000;
  state.promoCode = null;

  const promoContainer = document.getElementById('promo-container');
  promoContainer.innerHTML = `
    <!-- Input Promo -->
    <div class="promo-input-group">
      <input type="text" class="promo-input" id="promo-code" placeholder="Masukkan kode promo">
      <button class="btn-apply-promo" id="btn-apply-promo">Pakai</button>
    </div>

    <!-- Available Vouchers -->
    <div style="margin-top: 1.5rem;">
      <div style="font-size: 0.875rem; font-weight: 600; color: var(--text); margin-bottom: 0.75rem;">
        Voucher Tersedia
      </div>

      <!-- Voucher 1 -->
      <div class="voucher-card">
        <div class="voucher-left">
          <div class="voucher-icon">10%</div>
          <div class="voucher-info">
            <div class="voucher-title">Diskon 10%</div>
            <div class="voucher-desc">Potongan 10% untuk semua produk</div>
            <div class="voucher-valid">Berlaku hingga 31 Jan 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('DISKON10', 'percentage', 10)">
          Pakai
        </button>
      </div>

      <!-- Voucher 2 -->
      <div class="voucher-card">
        <div class="voucher-left">
          <div class="voucher-icon">50K</div>
          <div class="voucher-info">
            <div class="voucher-title">Potongan Rp 50.000</div>
            <div class="voucher-desc">Untuk pembelian min. Rp 500.000</div>
            <div class="voucher-valid">Berlaku hingga 28 Feb 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('GRATIS50', 'fixed', 50000)">
          Pakai
        </button>
      </div>

      <!-- Voucher 3 -->
      <div class="voucher-card">
        <div class="voucher-left">
          <div class="voucher-icon">🚚</div>
          <div class="voucher-info">
            <div class="voucher-title">Gratis Ongkir</div>
            <div class="voucher-desc">Bebas biaya pengiriman</div>
            <div class="voucher-valid">Berlaku hingga 15 Feb 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('FREEONGKIR', 'shipping', 0)">
          Pakai
        </button>
      </div>
    </div>
  `;

  // Re-attach input event
  const btnApplyPromo = document.getElementById('btn-apply-promo');
  if (btnApplyPromo) {
    btnApplyPromo.addEventListener('click', function() {
      const code = document.getElementById('promo-code').value;
      if (code) applyPromo(code);
    });
  }

  const promoInput = document.getElementById('promo-code');
  if (promoInput) {
    promoInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const code = this.value;
        if (code) applyPromo(code);
      }
    });
  }

  updatePriceDisplay();
  showNotification('ℹ️ Voucher dihapus', 'info');
}

// Modal
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  
  // Promo
  const btnApplyPromo = document.getElementById('btn-apply-promo');
  if (btnApplyPromo) {
    btnApplyPromo.addEventListener('click', function() {
      const code = document.getElementById('promo-code').value;
      if (code) applyPromo(code);
    });
  }

  // Enter key for promo
  const promoInput = document.getElementById('promo-code');
  if (promoInput) {
    promoInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const code = this.value;
        if (code) applyPromo(code);
      }
    });
  }

  // Open modal
  const btnOpenModal = document.getElementById('btn-open-modal');
  if (btnOpenModal) {
    btnOpenModal.addEventListener('click', function(e) {
      e.preventDefault();
      openModal('alamat-modal');
    });
  }
  
  // Close modal
  const modalClose = document.getElementById('modal-close');
  if (modalClose) {
    modalClose.addEventListener('click', function() {
      closeModal('alamat-modal');
    });
  }
  
  const modalOverlay = document.getElementById('modal-overlay');
  if (modalOverlay) {
    modalOverlay.addEventListener('click', function() {
      closeModal('alamat-modal');
    });
  }
  
  // Address buttons
  const addressListContainer = document.getElementById('address-list-container');
  if (addressListContainer) {
    addressListContainer.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-use-address') && !e.target.disabled) {
        const alamatId = e.target.getAttribute('data-id');
        setAlamat(alamatId, e.target);
      }
    });
  }
  
  // Checkout button
  const btnCheckout = document.getElementById('btn-checkout');
  if (btnCheckout) {
    btnCheckout.addEventListener('click', function() {
      showNotification('🚀 Melanjutkan ke pembayaran...', 'success');
      // Add checkout logic here
    });
  }

  // Keyboard
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeModal('alamat-modal');
    }
  });

  // Init
  updatePriceDisplay();
});

// Set Alamat
function setAlamat(id_alamat, button) {
  const originalText = button.innerHTML;
  
  button.innerHTML = '<span class="spinner"></span> Memproses...';
  button.disabled = true;

  const url = "<?= base_url('index.php/checkout/set_alamat') ?>";

  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "X-Requested-With": "XMLHttpRequest"
    },
    body: "id_alamat=" + encodeURIComponent(id_alamat)
  })
  .then(res => {
    if (!res.ok) {
      throw new Error(`HTTP ${res.status}`);
    }
    return res.json();
  })
  .then(data => {
    if (data.status === 'ok') {
      showNotification('✅ ' + data.message, 'success');
      
      if (data.alamat) {
        updateAddressDisplay(data.alamat);
        updateModalAddressList(id_alamat);
      }
      
      setTimeout(() => {
        closeModal('alamat-modal');
      }, 500);
      
      button.innerHTML = originalText;
      button.disabled = false;
    } else {
      showNotification('❌ ' + data.message, 'error');
      button.innerHTML = originalText;
      button.disabled = false;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('❌ Terjadi kesalahan', 'error');
    button.innerHTML = originalText;
    button.disabled = false;
  });
}

// Update Address Display
function updateAddressDisplay(alamat) {
  const addressDisplay = document.getElementById('address-display-main');
  if (!addressDisplay) return;
  
  let wilayahHTML = '';
  if (alamat.nama_kelurahan) {
    wilayahHTML = `
      <p>
        ${escapeHtml(alamat.nama_kelurahan)}, 
        ${escapeHtml(alamat.nama_kecamatan)}, 
        ${escapeHtml(alamat.nama_kabupaten)}, 
        ${escapeHtml(alamat.nama_provinsi)}
      </p>
    `;
  }
  
  let telpHTML = '';
  if (alamat.no_telp) {
    telpHTML = `<p>📱 ${escapeHtml(alamat.no_telp)}</p>`;
  }
  
  addressDisplay.innerHTML = `
    <strong>${escapeHtml(alamat.nama_alamat)}</strong>
    <p>${escapeHtml(alamat.detail)}</p>
    ${wilayahHTML}
    <p>Kode Pos: ${escapeHtml(alamat.kode_pos)}</p>
    ${telpHTML}
    <span class="address-badge">Alamat Pengiriman</span>
  `;
}

// Update Modal List
function updateModalAddressList(selected_id) {
  const addressCards = document.querySelectorAll('.address-card');
  
  addressCards.forEach(card => {
    const cardId = card.getAttribute('data-id');
    const button = card.querySelector('.btn-use-address');
    const addressInfo = card.querySelector('.address-info strong');
    
    const badges = addressInfo.querySelectorAll('span');
    badges.forEach(badge => {
      if (badge.textContent.includes('Dipilih')) {
        badge.remove();
      }
    });
    
    card.classList.remove('active');
    button.disabled = false;
    button.textContent = 'Gunakan';
    
    if (cardId == selected_id) {
      card.classList.add('active');
      button.disabled = true;
      button.textContent = 'Dipilih';
      
      const hasUtamaBadge = Array.from(badges).some(b => b.textContent.includes('Utama'));
      if (!hasUtamaBadge) {
        const badge = document.createElement('span');
        badge.style.cssText = 'color: var(--primary); font-size: 0.8rem;';
        badge.textContent = ' ✓ Dipilih';
        addressInfo.appendChild(badge);
      }
    }
  });
}

// Helper
function escapeHtml(text) {
  if (!text) return '';
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return String(text).replace(/[&<>"']/g, m => map[m]);
}

// Notification
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    background: ${type === 'success' ? '#059669' : type === 'error' ? '#dc2626' : '#4f46e5'};
    color: white;
    border-radius: 8px;
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    z-index: 10000;
    animation: slideInRight 0.3s ease;
    font-size: 0.875rem;
    font-weight: 500;
  `;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = 'slideOutRight 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

// Styles
const style = document.createElement('style');
style.textContent = `
  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(100%);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  @keyframes slideOutRight {
    from {
      opacity: 1;
      transform: translateX(0);
    }
    to {
      opacity: 0;
      transform: translateX(100%);
    }
  }
`;
document.head.appendChild(style);
</script>

</body>
</html>