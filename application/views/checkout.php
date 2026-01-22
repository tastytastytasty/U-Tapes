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
      --secondary: #818cf8;
      --success: #059669;
      --danger: #dc2626;
      --warning: #d97706;
      --info: #0891b2;
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
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Breadcrumbs */
    .breadcrumbs {
      background: white;
      border-bottom: 1px solid var(--border);
      padding: 1rem 0;
      margin-bottom: 2rem;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    .breadcrumb-nav {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      font-size: 0.875rem;
      color: var(--muted);
    }

    .breadcrumb-nav li {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .breadcrumb-nav li:not(:last-child)::after {
      content: '/';
      color: var(--border);
    }

    .breadcrumb-nav a {
      color: var(--muted);
      text-decoration: none;
      transition: color 0.2s;
    }

    .breadcrumb-nav a:hover {
      color: var(--primary);
    }

    /* Main Layout */
    .checkout-wrapper {
      max-width: 1200px;
      margin: 0 auto 3rem;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 1.5rem;
      padding: 0 1rem;
    }

    /* Card/Box */
    .box {
      background: white;
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border);
      transition: box-shadow 0.3s ease;
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

    /* Buttons */
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

    .btn-primary:active {
      transform: translateY(0);
    }

    /* Address Section */
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
      display: grid;
      grid-template-columns: 100px 1fr auto;
      gap: 1rem;
      padding: 1rem;
      background: var(--bg);
      border-radius: var(--radius-sm);
      transition: all 0.2s ease;
    }

    .product-item:hover {
      background: var(--bg-secondary);
    }

    .product-img {
      width: 100px;
      height: 100px;
      border-radius: var(--radius-sm);
      object-fit: cover;
      box-shadow: var(--shadow-sm);
    }

    .product-info h4 {
      font-size: 0.9375rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text);
    }

    .product-variant {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.8125rem;
      color: var(--text-secondary);
      background: white;
      padding: 0.25rem 0.75rem;
      border-radius: 6px;
      border: 1px solid var(--border);
      margin-top: 0.25rem;
    }

    .product-price {
      text-align: right;
    }

    .product-price-amount {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--primary);
      display: block;
    }

    .product-quantity {
      font-size: 0.8125rem;
      color: var(--muted);
      margin-top: 0.25rem;
    }

    /* Note/Textarea */
    .note {
      margin-top: 1rem;
    }

    .note textarea {
      width: 100%;
      min-height: 80px;
      padding: 0.75rem;
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      font-family: inherit;
      resize: vertical;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .note textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .note textarea::placeholder {
      color: var(--muted);
    }

    /* Promo Section */
    .promo-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      background: var(--bg);
      border-radius: var(--radius-sm);
      border: 2px dashed var(--border);
      text-align: center;
    }

    .promo-empty-icon {
      width: 48px;
      height: 48px;
      background: var(--bg-secondary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 0.75rem;
      font-size: 1.5rem;
    }

    .promo-empty p {
      color: var(--muted);
      font-size: 0.875rem;
      margin-bottom: 1rem;
    }

    .promo-applied {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem;
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      border-radius: var(--radius-sm);
      color: white;
      box-shadow: var(--shadow);
    }

    .promo-applied-info strong {
      display: block;
      font-size: 1rem;
      margin-bottom: 0.25rem;
    }

    .promo-applied-info small {
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

    /* Price Summary */
    .price-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      font-size: 0.9375rem;
    }

    .price-row span:first-child {
      color: var(--text-secondary);
    }

    .price-row span:last-child {
      font-weight: 600;
      color: var(--text);
    }

    .price-row.discount span:last-child {
      color: var(--success);
    }

    .price-row.total {
      border-top: 2px solid var(--border);
      padding-top: 1rem;
      margin-top: 0.5rem;
      font-size: 1.125rem;
    }

    .price-row.total span {
      font-weight: 700;
    }

    .price-row.total span:last-child {
      color: var(--primary);
      font-size: 1.5rem;
    }

    /* Pay Button */
    .btn-pay {
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

    .btn-pay:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-pay:active {
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
      animation: fadeIn 0.2s ease;
    }

    .modal-content {
      position: relative;
      max-width: 540px;
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
      color: var(--text);
      transform: rotate(90deg);
    }

    .modal-content h3 {
      font-size: 1.25rem;
      margin-bottom: 1rem;
      padding-right: 2rem;
    }

    /* Custom Confirmation Modal */
    .confirm-modal-content {
      text-align: center;
      padding: 2rem 1.5rem;
    }

    .confirm-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 1.5rem;
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      animation: scaleIn 0.3s ease;
    }

    .confirm-modal-content h2 {
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
      color: var(--text);
    }

    .confirm-modal-content p {
      color: var(--text-secondary);
      margin-bottom: 1.5rem;
      font-size: 0.9375rem;
    }

    .order-summary {
      background: var(--bg);
      border-radius: var(--radius-sm);
      padding: 1rem;
      margin: 1.5rem 0;
      text-align: left;
    }

    .order-summary-row {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      font-size: 0.875rem;
    }

    .order-summary-row.total {
      border-top: 2px solid var(--border);
      padding-top: 0.75rem;
      margin-top: 0.5rem;
      font-weight: 700;
      font-size: 1.125rem;
      color: var(--primary);
    }

    .modal-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
      margin-top: 1.5rem;
    }

    .btn-cancel {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--text);
      padding: 0.75rem 1.5rem;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-cancel:hover {
      background: var(--bg);
      border-color: var(--muted);
    }

    .btn-confirm {
      background: var(--primary);
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      box-shadow: var(--shadow-sm);
    }

    .btn-confirm:hover {
      background: var(--primary-dark);
      box-shadow: var(--shadow);
    }

    /* Success Modal */
    .success-icon {
      background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    }

    .success-modal h2 {
      color: var(--success);
    }

    .loading-spinner {
      width: 24px;
      height: 24px;
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      display: inline-block;
      margin-right: 0.5rem;
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
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

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.8);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .checkout-wrapper {
        grid-template-columns: 1fr 340px;
        gap: 1.25rem;
      }
    }

    @media (max-width: 768px) {
      .checkout-wrapper {
        grid-template-columns: 1fr;
      }

      .box {
        padding: 1.25rem;
      }

      .product-item {
        grid-template-columns: 80px 1fr auto;
      }

      .product-img {
        width: 80px;
        height: 80px;
      }

      .modal-content {
        margin: 1rem;
        max-height: calc(100vh - 2rem);
      }

      .modal-actions {
        grid-template-columns: 1fr;
      }

      .confirm-modal-content {
        padding: 1.5rem 1rem;
      }

      .confirm-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
      }
    }

    @media (max-width: 480px) {
      .container {
        padding: 0 0.75rem;
      }

      .checkout-wrapper {
        padding: 0 0.75rem;
        gap: 1rem;
      }

      .box {
        padding: 1rem;
        margin-bottom: 1rem;
      }

      .box h3 {
        font-size: 1rem;
      }

      .product-item {
        grid-template-columns: 70px 1fr;
        gap: 0.75rem;
      }

      .product-img {
        width: 70px;
        height: 70px;
      }

      .product-price {
        grid-column: 2;
        text-align: left;
        margin-top: 0.5rem;
      }

      .product-price-amount {
        font-size: 1rem;
      }

      .promo-empty {
        padding: 1rem;
      }

      .promo-empty-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
      }

      .promo-empty p {
        font-size: 0.8125rem;
        margin-bottom: 0.75rem;
      }

      .promo-applied {
        flex-direction: column;
        gap: 0.75rem;
        text-align: center;
      }

      .promo-applied-info {
        width: 100%;
      }

      .btn-remove-promo {
        width: 100%;
      }

      .price-row {
        font-size: 0.875rem;
      }

      .price-row.total {
        font-size: 1rem;
      }

      .price-row.total span:last-child {
        font-size: 1.25rem;
      }

      .btn-pay {
        position: sticky;
        bottom: 0;
        z-index: 100;
        border-radius: var(--radius-sm) var(--radius-sm) 0 0;
        box-shadow: 0 -4px 6px -1px rgb(0 0 0 / 0.1);
        margin-bottom: -1rem;
        margin-left: -1rem;
        margin-right: -1rem;
        width: calc(100% + 2rem);
      }

      .modal-content {
        margin: 0.5rem;
        padding: 1rem;
        border-radius: var(--radius-sm);
        max-height: calc(100vh - 1rem);
      }

      .modal-content h3 {
        font-size: 1.125rem;
        margin-bottom: 0.75rem;
      }

      .promo-input-group {
        flex-direction: column;
        gap: 0.5rem;
      }

      .promo-input-group input {
        width: 100%;
      }

      .promo-input-group .btn {
        width: 100%;
      }

      .promo-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
      }

      .promo-card .btn-use {
        width: 100%;
      }

      .address-card {
        flex-direction: column;
        gap: 0.75rem;
      }

      .address-card .btn-use-address {
        width: 100%;
      }

      .breadcrumb-nav {
        font-size: 0.75rem;
      }

      .note textarea {
        font-size: 0.8125rem;
        min-height: 70px;
      }
    }

    /* =========================
   PROMO MODAL STYLING
========================= */

    /* Input promo */
    .promo-input-group {
      display: flex;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .promo-input-group input {
      flex: 1;
      padding: 0.75rem 1rem;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
      font-size: 0.875rem;
      transition: 0.2s;
    }

    .promo-input-group input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    /* Promo cards */
    .promo-cards {
      display: grid;
      gap: 1rem;
    }

    .promo-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      background: var(--bg);
      transition: 0.25s ease;
    }

    .promo-card:hover {
      border-color: var(--primary);
      background: var(--primary-light);
      box-shadow: var(--shadow-sm);
      transform: translateY(-2px);
    }

    /* Promo detail */
    .promo-card-details strong {
      font-size: 0.95rem;
      color: var(--text);
    }

    .promo-card-desc {
      font-size: 0.8rem;
      color: var(--text-secondary);
      margin-top: 0.25rem;
    }

    /* Badge promo */
    .promo-card-badge {
      display: inline-block;
      margin-top: 0.5rem;
      font-size: 0.7rem;
      padding: 0.25rem 0.6rem;
      border-radius: 999px;
      background: linear-gradient(135deg, #4f46e5, #7c3aed);
      color: #fff;
      font-weight: 600;
    }

    /* Button pakai */
    .btn-use {
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 0.55rem 1rem;
      border-radius: var(--radius-sm);
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.25s;
      box-shadow: var(--shadow-sm);
    }

    .btn-use:hover {
      background: var(--primary-dark);
      box-shadow: var(--shadow);
      transform: translateY(-1px);
    }

    .btn-use:active {
      transform: translateY(0);
    }
  </style>
</head>

<body>

  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
    </div>
  </div>

  <!-- Main Checkout -->
  <div class="checkout-wrapper">

    <!-- LEFT SECTION -->
    <div class="checkout-left">

      <!-- Shipping Address -->
      <div class="box">
        <div class="box-header">
          <h3>📍 Alamat Pengiriman</h3>
          <button class="btn btn-link">Ganti Alamat</button>
        </div>
        <div class="address-display">
          <strong>Zal</strong>
          <p>Jl. neo nusantara</p>
          <p>123</p>
          <p>📱 0812xxxxxxx</p>
          <span class="address-badge">Alamat Utama</span>
        </div>
      </div>

      <!-- Products -->
      <div class="box">
        <h3>🛍️ Pesanan Anda</h3>

        <div class="product-item">
          <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop" class="product-img" alt="Product">
          <div class="product-info">
            <h4>ANG Tonggiss Tripod Bluetooth 4in1</h4>
            <span class="product-variant">🎨 Variasi: Hitam</span>
          </div>
          <div class="product-price">
            <span class="product-price-amount">Rp13.894</span>
            <small class="product-quantity">× 1 item</small>
          </div>
        </div>

        <div class="note">
          <textarea id="seller-note" placeholder="💬 Tulis catatan untuk penjual (opsional)..."></textarea>
        </div>
      </div>

    </div>

    <!-- RIGHT SECTION -->
    <div class="checkout-right">

      <!-- Promo Section -->
      <div class="box">
        <div class="box-header">
          <h3>🎁 Promo & Voucher</h3>
        </div>
        <div id="promo-display">
          <div class="promo-empty">
            <div class="promo-empty-icon">🏷️</div>
            <p>Belum ada promo yang digunakan</p>
            <button id="open-promo" class="btn btn-primary">Pilih Promo</button>
          </div>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="box">
        <h3>📋 Ringkasan Belanja</h3>

        <div class="price-row">
          <span>Subtotal Produk</span>
          <span id="subtotal">Rp13.894</span>
        </div>

        <div class="price-row">
          <span>Biaya Pengiriman</span>
          <span id="shipping-cost">Rp10.000</span>
        </div>

        <div class="price-row discount" id="discount-row" style="display: none;">
          <span>Diskon</span>
          <span id="discount-amount">- Rp0</span>
        </div>

        <div class="price-row total">
          <span>Total Pembayaran</span>
          <span id="total-amount">Rp23.894</span>
        </div>

        <button class="btn-pay" id="btn-checkout">💳 Bayar Sekarang</button>
      </div>

    </div>

  </div>

  <!-- Promo Modal -->
  <div id="promo-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" id="promo-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true">
      <button class="modal-close" id="promo-close" aria-label="Tutup">×</button>
      <h3>🎁 Pilih Promo</h3>

      <div class="promo-input-group">
        <input id="promo-input" type="text" placeholder="Masukkan kode promo">
        <button id="promo-apply" class="btn btn-primary">Apply</button>
      </div>

      <div class="promo-cards">
        <div class="promo-card" data-code="PROMO10" data-type="percentage" data-value="10">
          <div class="promo-card-details">
            <strong>PROMO10</strong>
            <div class="promo-card-desc">Diskon 10% untuk pembelian pertama</div>
            <span class="promo-card-badge">HEMAT 10%</span>
          </div>
          <button class="btn-use">Pakai</button>
        </div>

        <div class="promo-card" data-code="FREEONGKIR" data-type="shipping" data-value="0">
          <div class="promo-card-details">
            <strong>FREEONGKIR</strong>
            <div class="promo-card-desc">Gratis ongkir untuk pembelian di atas Rp100.000</div>
            <span class="promo-card-badge">GRATIS ONGKIR</span>
          </div>
          <button class="btn-use">Pakai</button>
        </div>

        <div class="promo-card" data-code="DISKON50" data-type="fixed" data-value="50000">
          <div class="promo-card-details">
            <strong>DISKON50</strong>
            <div class="promo-card-desc">Diskon Rp50.000 untuk order tertentu</div>
            <span class="promo-card-badge">HEMAT 50K</span>
          </div>
          <button class="btn-use">Pakai</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div id="confirm-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" id="confirm-overlay"></div>
    <div class="modal-content confirm-modal-content">
      <div class="confirm-icon">💳</div>
      <h2>Konfirmasi Pembayaran</h2>
      <p>Pastikan data pesanan Anda sudah benar sebelum melanjutkan pembayaran</p>

      <div class="order-summary">
        <div class="order-summary-row">
          <span>Subtotal</span>
          <span id="modal-subtotal">Rp13.894</span>
        </div>
        <div class="order-summary-row">
          <span>Ongkir</span>
          <span id="modal-shipping">Rp10.000</span>
        </div>
        <div class="order-summary-row" id="modal-discount-row" style="display: none;">
          <span>Diskon</span>
          <span id="modal-discount" style="color: var(--success);">- Rp0</span>
        </div>
        <div class="order-summary-row total">
          <span>Total</span>
          <span id="modal-total">Rp23.894</span>
        </div>
      </div>

      <div id="modal-note-display" style="display: none; margin: 1rem 0; padding: 0.75rem; background: var(--bg); border-radius: var(--radius-sm); text-align: left;">
        <strong style="font-size: 0.875rem; color: var(--text);">Catatan:</strong>
        <p id="modal-note-text" style="font-size: 0.875rem; color: var(--text-secondary); margin-top: 0.25rem;"></p>
      </div>

      <div class="modal-actions">
        <button class="btn-cancel" id="btn-cancel-checkout">Batal</button>
        <button class="btn-confirm" id="btn-confirm-checkout">
          Lanjutkan Pembayaran
        </button>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
  <div id="success-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" id="success-overlay"></div>
    <div class="modal-content confirm-modal-content success-modal">
      <div class="confirm-icon success-icon">✓</div>
      <h2>Pembayaran Berhasil!</h2>
      <p>Pesanan Anda sedang diproses. Kami akan mengirimkan konfirmasi ke email Anda.</p>

      <div class="order-summary">
        <div class="order-summary-row">
          <span>No. Pesanan</span>
          <span style="font-weight: 600; color: var(--primary);" id="order-number">ORD-001234</span>
        </div>
        <div class="order-summary-row total">
          <span>Total Pembayaran</span>
          <span id="success-total">Rp23.894</span>
        </div>
      </div>

      <button class="btn-confirm" id="btn-close-success" style="width: 100%; margin-top: 1.5rem;">
        Lihat Detail Pesanan
      </button>
    </div>
  </div>

  <script>
    // State Management
    const state = {
      subtotal: 13894,
      shipping: 10000,
      discount: 0,
      appliedPromo: null
    };

    // Format currency
    function formatRupiah(amount) {
      return 'Rp' + amount.toLocaleString('id-ID');
    }

    // Calculate total
    function calculateTotal() {
      return state.subtotal + state.shipping - state.discount;
    }

    // Update price display
    function updatePriceDisplay() {
      document.getElementById('subtotal').textContent = formatRupiah(state.subtotal);
      document.getElementById('shipping-cost').textContent = formatRupiah(state.shipping);
      document.getElementById('total-amount').textContent = formatRupiah(calculateTotal());

      const discountRow = document.getElementById('discount-row');
      if (state.discount > 0) {
        discountRow.style.display = 'flex';
        document.getElementById('discount-amount').textContent = '- ' + formatRupiah(state.discount);
      } else {
        discountRow.style.display = 'none';
      }
    }

    // Modal Management
    function openModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    // Checkout button - Open confirmation modal
    document.getElementById('btn-checkout').addEventListener('click', () => {
      const sellerNote = document.getElementById('seller-note').value.trim();

      // Update modal content
      document.getElementById('modal-subtotal').textContent = formatRupiah(state.subtotal);
      document.getElementById('modal-shipping').textContent = formatRupiah(state.shipping);
      document.getElementById('modal-total').textContent = formatRupiah(calculateTotal());

      // Show discount if exists
      const modalDiscountRow = document.getElementById('modal-discount-row');
      if (state.discount > 0) {
        modalDiscountRow.style.display = 'flex';
        document.getElementById('modal-discount').textContent = '- ' + formatRupiah(state.discount);
      } else {
        modalDiscountRow.style.display = 'none';
      }

      // Show note if exists
      const modalNoteDisplay = document.getElementById('modal-note-display');
      if (sellerNote) {
        modalNoteDisplay.style.display = 'block';
        document.getElementById('modal-note-text').textContent = sellerNote;
      } else {
        modalNoteDisplay.style.display = 'none';
      }

      openModal('confirm-modal');
    });

    // Cancel checkout
    document.getElementById('btn-cancel-checkout').addEventListener('click', () => {
      closeModal('confirm-modal');
    });

    document.getElementById('confirm-overlay').addEventListener('click', () => {
      closeModal('confirm-modal');
    });

    // Confirm checkout
    document.getElementById('btn-confirm-checkout').addEventListener('click', function() {
      // Show loading
      const originalText = this.innerHTML;
      this.innerHTML = '<div class="loading-spinner"></div> Memproses...';
      this.disabled = true;

      // Simulate payment processing
      setTimeout(() => {
        closeModal('confirm-modal');

        // Generate order number
        const orderNumber = 'ORD-' + Math.random().toString(36).substr(2, 9).toUpperCase();
        document.getElementById('order-number').textContent = orderNumber;
        document.getElementById('success-total').textContent = formatRupiah(calculateTotal());

        // Show success modal
        openModal('success-modal');

        // Reset button
        this.innerHTML = originalText;
        this.disabled = false;
      }, 2000);
    });

    // Close success modal
    document.getElementById('btn-close-success').addEventListener('click', () => {
      closeModal('success-modal');
      // Redirect to order detail or refresh page
      // window.location.href = '/orders/' + orderNumber;
    });

    document.getElementById('success-overlay').addEventListener('click', () => {
      closeModal('success-modal');
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeModal('confirm-modal');
        closeModal('success-modal');
      }
    });

    // Initialize
    updatePriceDisplay();

    // Promo Modal
    const promoModal = document.getElementById('promo-modal');
    const promoInput = document.getElementById('promo-input');

    document.getElementById('open-promo').addEventListener('click', () => {
      openModal('promo-modal');
      setTimeout(() => promoInput.focus(), 100);
    });

    document.getElementById('promo-close').addEventListener('click', () => closeModal('promo-modal'));
    document.getElementById('promo-overlay').addEventListener('click', () => closeModal('promo-modal'));

    // Apply promo
    function applyPromo(code, type, value) {
      const promoDisplay = document.getElementById('promo-display');

      let discountAmount = 0;
      let discountText = '';

      if (type === 'percentage') {
        discountAmount = Math.floor(state.subtotal * (value / 100));
        discountText = `Diskon ${value}%`;
      } else if (type === 'fixed') {
        discountAmount = value;
        discountText = `Diskon ${formatRupiah(value)}`;
      } else if (type === 'shipping') {
        discountAmount = state.shipping;
        state.shipping = 0;
        discountText = 'Gratis Ongkir';
      }

      state.discount = discountAmount;
      state.appliedPromo = {
        code,
        type,
        value
      };

      promoDisplay.innerHTML = `
        <div class="promo-applied">
          <div class="promo-applied-info">
            <strong>🎉 ${code}</strong>
            <small>${discountText} diterapkan!</small>
          </div>
          <button class="btn-remove-promo" onclick="removePromo()">Hapus</button>
        </div>
      `;

      updatePriceDisplay();
      closeModal('promo-modal');
      showNotification('✅ Promo berhasil diterapkan!', 'success');
    }

    // Remove promo
    function removePromo() {
      state.discount = 0;
      state.shipping = 10000;
      state.appliedPromo = null;

      document.getElementById('promo-display').innerHTML = `
        <div class="promo-empty">
          <div class="promo-empty-icon">🏷️</div>
          <p>Belum ada promo yang digunakan</p>
          <button id="open-promo" class="btn btn-primary">Pilih Promo</button>
        </div>
      `;

      // Re-attach event listener
      document.getElementById('open-promo').addEventListener('click', () => openModal('promo-modal'));

      updatePriceDisplay();
      showNotification('ℹ️ Promo dihapus', 'info');
    }

    // Promo card clicks
    document.querySelectorAll('.promo-card .btn-use').forEach(btn => {
      btn.addEventListener('click', function(e) {
        const card = e.target.closest('.promo-card');
        const code = card.dataset.code;
        const type = card.dataset.type;
        const value = parseInt(card.dataset.value);

        promoInput.value = code;
        applyPromo(code, type, value);
      });
    });

    // Manual promo input
    document.getElementById('promo-apply').addEventListener('click', () => {
      const code = promoInput.value.trim().toUpperCase();
      if (!code) {
        showNotification('⚠️ Masukkan kode promo', 'warning');
        return;
      }

      // Find matching promo
      const promoCard = Array.from(document.querySelectorAll('.promo-card')).find(
        card => card.dataset.code === code
      );

      if (promoCard) {
        const type = promoCard.dataset.type;
        const value = parseInt(promoCard.dataset.value);
        applyPromo(code, type, value);
      } else {
        showNotification('❌ Kode promo tidak valid', 'error');
      }
    });

    // Notification system
    function showNotification(message, type = 'info') {
      const notification = document.createElement('div');
      notification.textContent = message;
      notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#059669' : type === 'error' ? '#dc2626' : type === 'warning' ? '#d97706' : '#4f46e5'};
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

    // Add slide animations for notifications
    const notifStyle = document.createElement('style');
    notifStyle.textContent = `
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
    document.head.appendChild(notifStyle);
  </script>

</body>

</html>