<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran - <?= $transaksi->no_nota ?></title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1a1a2e;
      --accent: #e94560;
      --soft-bg: #f8f9fa;
      --border: #e1e4e8;
      --success: #28a745;
      --shadow: 0 4px 12px rgba(0,0,0,0.08);
      --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Work Sans', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      padding: 2rem 1rem;
      line-height: 1.6;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
    }

    /* Header dengan animasi */
    .payment-header {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      margin-bottom: 2rem;
      box-shadow: var(--shadow-lg);
      text-align: center;
      animation: slideDown 0.6s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .payment-header h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 2rem;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }

    .order-number {
      font-size: 1.125rem;
      color: #666;
      font-weight: 500;
    }

    .order-number span {
      color: var(--accent);
      font-weight: 600;
    }

    /* Grid Layout */
    .payment-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      animation: fadeIn 0.8s ease-out 0.2s both;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: var(--shadow-lg);
    }

    .card-title {
      font-family: 'DM Serif Display', serif;
      font-size: 1.5rem;
      color: var(--primary);
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--border);
    }

    /* Bank Account Section */
    .bank-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .bank-item {
      padding: 1.25rem;
      background: var(--soft-bg);
      border-radius: 12px;
      border: 2px solid var(--border);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .bank-item:hover {
      border-color: var(--accent);
      box-shadow: var(--shadow);
      transform: translateX(4px);
    }

    .bank-name {
      font-weight: 600;
      font-size: 1.125rem;
      color: var(--primary);
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .bank-icon {
      width: 32px;
      height: 32px;
      background: white;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: var(--accent);
    }

    .account-number {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--accent);
      font-family: 'Courier New', monospace;
      letter-spacing: 1px;
      margin: 0.5rem 0;
    }

    .account-name {
      color: #666;
      font-size: 0.95rem;
    }

    .copy-btn {
      margin-top: 0.75rem;
      padding: 0.5rem 1rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.875rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .copy-btn:hover {
      background: var(--accent);
      transform: scale(1.05);
    }

    /* Order Summary */
    .order-item {
      display: flex;
      gap: 1rem;
      padding: 1rem 0;
      border-bottom: 1px solid var(--border);
    }

    .order-item:last-child {
      border-bottom: none;
    }

    .item-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      background: var(--soft-bg);
    }

    .item-details {
      flex: 1;
    }

    .item-name {
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 0.25rem;
    }

    .item-variant {
      font-size: 0.875rem;
      color: #666;
    }

    .item-price {
      font-weight: 600;
      color: var(--accent);
      margin-top: 0.5rem;
    }

    /* Total Section */
    .total-section {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 2px solid var(--border);
    }

    .total-row {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 0;
      font-size: 0.95rem;
    }

    .total-row.grand-total {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary);
      padding-top: 1rem;
      border-top: 2px solid var(--border);
      margin-top: 1rem;
    }

    .total-row.grand-total .amount {
      color: var(--accent);
    }

    /* Upload Section */
    .upload-section {
      grid-column: 1 / -1;
      animation: fadeIn 1s ease-out 0.4s both;
    }

    .upload-area {
      border: 3px dashed var(--border);
      border-radius: 16px;
      padding: 3rem 2rem;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .upload-area:hover {
      border-color: var(--accent);
      background: var(--soft-bg);
    }

    .upload-area.dragover {
      border-color: var(--success);
      background: rgba(40, 167, 69, 0.05);
    }

    .upload-icon {
      font-size: 3rem;
      color: var(--accent);
      margin-bottom: 1rem;
    }

    .upload-text {
      font-size: 1.125rem;
      color: var(--primary);
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .upload-hint {
      color: #666;
      font-size: 0.95rem;
    }

    #file-input {
      display: none;
    }

    .preview-container {
      margin-top: 1.5rem;
      display: none;
    }

    .preview-container.active {
      display: block;
    }

    .preview-image {
      max-width: 100%;
      max-height: 400px;
      border-radius: 12px;
      box-shadow: var(--shadow);
    }

    .submit-btn {
      width: 100%;
      padding: 1.25rem;
      background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.125rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1.5rem;
      transition: all 0.3s ease;
      box-shadow: var(--shadow);
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }

    .submit-btn:disabled {
      background: #ccc;
      cursor: not-allowed;
      transform: none;
    }

    /* Alert */
    .alert {
      padding: 1rem 1.25rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      animation: slideDown 0.6s ease-out;
    }

    .alert-warning {
      background: #fff3cd;
      border: 2px solid #ffc107;
      color: #856404;
    }

    .alert-success {
      background: #d4edda;
      border: 2px solid var(--success);
      color: #155724;
    }

    .alert-icon {
      font-size: 1.5rem;
    }

    /* Loading Spinner */
    .spinner {
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-top: 3px solid white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: spin 0.8s linear infinite;
      display: inline-block;
      margin-left: 0.5rem;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .payment-content {
        grid-template-columns: 1fr;
      }

      .payment-header h1 {
        font-size: 1.5rem;
      }

      .card {
        padding: 1.5rem;
      }
    }

    /* Success Animation */
    @keyframes checkmark {
      0% {
        stroke-dashoffset: 100;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }

    .success-checkmark {
      width: 80px;
      height: 80px;
      margin: 0 auto 1rem;
    }

    .success-checkmark circle {
      stroke: var(--success);
      stroke-width: 3;
      fill: none;
    }

    .success-checkmark path {
      stroke: var(--success);
      stroke-width: 3;
      stroke-dasharray: 100;
      stroke-dashoffset: 100;
      animation: checkmark 0.6s ease-out forwards;
    }
  </style>
</head>
<body>
  <div class="container">
    
    <!-- Header -->
    <div class="payment-header">
      <h1>💳 Selesaikan Pembayaran</h1>
      <p class="order-number">No. Pesanan: <span><?= $transaksi->no_nota ?></span></p>
    </div>

    <!-- Alert -->
    <div class="alert alert-warning">
      <span class="alert-icon">⚠️</span>
      <div>
        <strong>Selesaikan pembayaran dalam 24 jam</strong><br>
        Transfer sesuai nominal dan upload bukti transfer untuk verifikasi
      </div>
    </div>

    <!-- Content Grid -->
    <div class="payment-content">
      
      <!-- Bank Accounts -->
      <div class="card">
        <h2 class="card-title">💰 Transfer ke Rekening</h2>
        <div class="bank-list">
          
          <div class="bank-item">
            <div class="bank-name">
              <span class="bank-icon">🏦</span>
              Bank BCA
            </div>
            <div class="account-number">1234567890</div>
            <div class="account-name">PT. Toko Sepatu Indonesia</div>
            <button class="copy-btn" onclick="copyToClipboard('1234567890')">📋 Salin Nomor</button>
          </div>

          <div class="bank-item">
            <div class="bank-name">
              <span class="bank-icon">🏧</span>
              Bank Mandiri
            </div>
            <div class="account-number">9876543210</div>
            <div class="account-name">PT. Toko Sepatu Indonesia</div>
            <button class="copy-btn" onclick="copyToClipboard('9876543210')">📋 Salin Nomor</button>
          </div>

          <div class="bank-item">
            <div class="bank-name">
              <span class="bank-icon">🏦</span>
              Bank BNI
            </div>
            <div class="account-number">1122334455</div>
            <div class="account-name">PT. Toko Sepatu Indonesia</div>
            <button class="copy-btn" onclick="copyToClipboard('1122334455')">📋 Salin Nomor</button>
          </div>

        </div>
      </div>

      <!-- Order Summary -->
      <div class="card">
        <h2 class="card-title">📦 Ringkasan Pesanan</h2>
        
        <?php foreach ($items as $item): ?>
        <div class="order-item">
          <img src="<?= base_url('assets/images/item/' . $item->gambar_item) ?>" 
               alt="<?= $item->nama_item ?>" 
               class="item-image"
               onerror="this.src='<?= base_url('assets/images/no-image.jpg') ?>'">
          <div class="item-details">
            <div class="item-name"><?= $item->nama_item ?></div>
            <div class="item-variant">
              <?= $item->ukuran ?> • <?= $item->warna ?> • Qty: <?= $item->qty ?>
            </div>
            <div class="item-price">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></div>
          </div>
        </div>
        <?php endforeach; ?>

        <div class="total-section">
          <?php if ($transaksi->diskon_item > 0): ?>
          <div class="total-row">
            <span>Diskon Item</span>
            <span style="color: var(--success);">-Rp <?= number_format($transaksi->diskon_item, 0, ',', '.') ?></span>
          </div>
          <?php endif; ?>

          <?php if ($transaksi->diskon_voucher > 0): ?>
          <div class="total-row">
            <span>Diskon Voucher</span>
            <span style="color: var(--success);">-Rp <?= number_format($transaksi->diskon_voucher, 0, ',', '.') ?></span>
          </div>
          <?php endif; ?>

          <div class="total-row">
            <span>Ongkir</span>
            <span>Rp <?= number_format($transaksi->ongkir, 0, ',', '.') ?></span>
          </div>

          <?php if ($transaksi->diskon_ongkir > 0): ?>
          <div class="total-row">
            <span>Diskon Ongkir</span>
            <span style="color: var(--success);">-Rp <?= number_format($transaksi->diskon_ongkir, 0, ',', '.') ?></span>
          </div>
          <?php endif; ?>

          <div class="total-row grand-total">
            <span>Total Pembayaran</span>
            <span class="amount">Rp <?= number_format($transaksi->total, 0, ',', '.') ?></span>
          </div>
        </div>
      </div>

      <!-- Upload Section -->
      <div class="card upload-section">
        <h2 class="card-title">📤 Upload Bukti Transfer</h2>
        
        <form id="upload-form" method="POST" enctype="multipart/form-data">
          <div class="upload-area" id="upload-area" onclick="document.getElementById('file-input').click()">
            <div class="upload-icon">📁</div>
            <div class="upload-text">Klik atau drag & drop bukti transfer</div>
            <div class="upload-hint">Format: JPG, PNG, PDF (Max 5MB)</div>
            <input type="file" 
                   id="file-input" 
                   name="bukti_transfer" 
                   accept="image/*,application/pdf"
                   onchange="handleFileSelect(event)">
          </div>

          <div class="preview-container" id="preview-container">
            <img id="preview-image" class="preview-image" alt="Preview">
          </div>

          <button type="submit" class="submit-btn" id="submit-btn" disabled>
            🚀 Kirim Bukti Transfer
          </button>
        </form>
      </div>

    </div>

  </div>

  <script>
    // Copy to clipboard
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert('✅ Nomor rekening berhasil disalin!');
      });
    }

    // File upload handling
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const submitBtn = document.getElementById('submit-btn');

    // Drag & drop
    uploadArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
      uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadArea.classList.remove('dragover');
      const file = e.dataTransfer.files[0];
      if (file) {
        fileInput.files = e.dataTransfer.files;
        handleFileSelect({ target: { files: [file] } });
      }
    });

    // File select
    function handleFileSelect(event) {
      const file = event.target.files[0];
      if (!file) return;

      // Validate file size (5MB)
      if (file.size > 5 * 1024 * 1024) {
        alert('❌ File terlalu besar! Maksimal 5MB');
        return;
      }

      // Preview image
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
          previewImage.src = e.target.result;
          previewContainer.classList.add('active');
          submitBtn.disabled = false;
        };
        reader.readAsDataURL(file);
      } else if (file.type === 'application/pdf') {
        previewContainer.classList.remove('active');
        submitBtn.disabled = false;
        alert('✅ File PDF berhasil dipilih: ' + file.name);
      }
    }

    // Form submit
    document.getElementById('upload-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const originalText = submitBtn.innerHTML;
      
      submitBtn.disabled = true;
      submitBtn.innerHTML = '⏳ Mengirim...<span class="spinner"></span>';

      fetch('<?= site_url('pembayaran/upload_bukti/' . $transaksi->id_transaksi) ?>', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          // Show success
          document.querySelector('.container').innerHTML = `
            <div class="payment-header" style="animation: slideDown 0.6s ease-out;">
              <svg class="success-checkmark" viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25"/>
                <path fill="none" d="M14 27l7.5 7.5L38 18"/>
              </svg>
              <h1 style="color: var(--success);">✅ Bukti Transfer Berhasil Dikirim!</h1>
              <p style="margin-top: 1rem; color: #666;">
                Terima kasih! Kami akan memverifikasi pembayaran Anda dalam 1x24 jam.
              </p>
              <button onclick="window.location.href='<?= site_url('') ?>'" 
                      style="margin-top: 2rem; padding: 1rem 2rem; background: var(--primary); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1rem; font-weight: 600;">
                🏠 Kembali ke Beranda
              </button>
            </div>
          `;
        } else {
          alert('❌ ' + result.message);
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan. Silakan coba lagi.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      });
    });
  </script>
</body>
</html>