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
      background: #f5f6f8;
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
      <h1>Selesaikan Pembayaran</h1>
      <p class="order-number">No. Pesanan: <span><?= $transaksi->no_nota ?></span></p>
    </div>

    <!-- Alert -->
    <div class="alert alert-warning">
      <span class="alert-icon">⚠</span>
      <div>
        <strong>Selesaikan pembayaran dalam 1 jam</strong><br>
        Transfer sesuai nominal dan upload bukti transfer untuk verifikasi
      </div>
    </div>

    <!-- Content Grid -->
    <div class="payment-content">
      
      <!-- Bank Account -->
      <div class="card">
        <h2 class="card-title">Transfer ke Rekening</h2>
        <div class="bank-list">
          
          <?php if ($rekening): ?>
            <!-- ✅ SHOW SELECTED BANK ONLY (Dynamic) -->
            <div class="bank-item">
              <div class="bank-name">
                <span class="bank-icon"><?= strtoupper(substr($rekening->bank, 0, 3)) ?></span>
              </div>
              <div class="account-number"><?= $rekening->nomor_rekening ?></div>
              <div class="account-name">a.n. <?= $rekening->atas_nama ?></div>
              <button class="copy-btn" onclick="copyToClipboard('<?= $rekening->nomor_rekening ?>')">
                Salin Nomor Rekening
              </button>
            </div>
          <?php else: ?>
            <!-- ❌ NO REKENING DATA -->
            <div style="padding: 1.25rem; background: #fee; border-radius: 12px; border: 2px solid #fca5a5; text-align: center; color: #991b1b;">
              <strong>⚠️ Data Rekening Tidak Ditemukan</strong><br>
              <span style="font-size: 0.9rem;">Silakan hubungi customer service</span>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- Order Summary -->
      <div class="card">
        <h2 class="card-title">Ringkasan Pesanan</h2>
        
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
            
            <?php 
            // ✅ USE SNAPSHOT DATA - KURANGIN DISKON!
            $harga_per_item = $item->harga;  // Original price per item
            $subtotal_sebelum_diskon = $item->subtotal_final;  // From transaksi_item.Total (BELUM DIKURANGIN!)
            $nilai_diskon = $item->nilai_diskon ?? 0;  // Discount from transaksi_promo_item.nilai
            $qty = $item->qty;
            
            // ✅ KURANGIN diskon dari subtotal
            $subtotal_final = $subtotal_sebelum_diskon - $nilai_diskon;
            
            // Calculate prices
            $subtotal_asli = $harga_per_item * $qty;  // Original subtotal
            $harga_final_per_item = $subtotal_final / $qty;  // Discounted price per item
            
            // Check if item had discount at checkout time
            $has_discount = ($nilai_diskon > 0);  // ✅ Only check snapshot value
            ?>
            
            <?php if ($has_discount): ?>
              <!-- Item WITH Discount (SNAPSHOT) -->
              
              <!-- Show per-item prices -->
              <div style="margin-top: 8px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <!-- Original price per item (strikethrough) -->
                <div style="display: flex; align-items: center; gap: 6px;">
                  <span style="font-size: 12px; color: #999;">Harga satuan:</span>
                  <span style="text-decoration: line-through; color: #999; font-size: 13px;">
                    Rp <?= number_format($harga_per_item, 0, ',', '.') ?>
                  </span>
                </div>
                
                <!-- Discount badge -->
                <div style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 3px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; box-shadow: 0 2px 6px rgba(255,107,107,0.3);">
                  -Rp <?= number_format($nilai_diskon / $qty, 0, ',', '.') ?>
                </div>
                
                <!-- Final price per item -->
              </div>
              
              <!-- Subtotal -->
              <div class="item-price" style="margin-top: 6px;">
                Subtotal: Rp <?= number_format($subtotal_final, 0, ',', '.') ?>
              </div>
              
            <?php else: ?>
              <!-- Item NO Discount -->
              <div style="margin-top: 8px;">
                <div style="font-size: 12px; color: #666; margin-bottom: 4px;">
                  Harga satuan: Rp <?= number_format($harga_per_item, 0, ',', '.') ?>
                </div>
                <div class="item-price">
                  Subtotal: Rp <?= number_format($subtotal_final, 0, ',', '.') ?>
                </div>
              </div>
            <?php endif; ?>
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
        <h2 class="card-title">Bukti Transfer</h2>
        
        <?php if ($has_bukti): ?>
          <!-- ✅ BUKTI SUDAH ADA - SHOW PREVIEW ONLY -->
          <div class="alert alert-info" style="background: #e3f2fd; border-left: 4px solid #2196f3; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
            <strong>✓ Bukti Transfer Telah Diterima</strong><br>
            <span style="color: #666;">
              <?php if ($transaksi->status_transaksi == 'Menunggu'): ?>
                Pembayaran Anda sedang diproses oleh admin. Silakan tunggu konfirmasi.
              <?php elseif ($transaksi->status_transaksi == 'Berhasil'): ?>
                Pembayaran Anda telah dikonfirmasi!
              <?php else: ?>
                Status: <?= ucfirst($transaksi->status_transaksi) ?>
              <?php endif; ?>
            </span>
          </div>
          
          <div style="text-align: center; padding: 20px;">
            <div style="margin-bottom: 12px; font-weight: 600; color: #555;">Bukti Transfer Anda:</div>
            <img src="<?= base_url('assets/bukti_transfer/' . $transaksi->bukti_transfer) ?>" 
                 alt="Bukti Transfer" 
                 style="max-width: 100%; max-height: 500px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
          </div>
        
        <?php else: ?>
          <!-- ✅ BELUM ADA BUKTI - SHOW COUNTDOWN + UPLOAD FORM -->
          
          <?php
          // Calculate time remaining
          $now = time();
          $deadline = strtotime($transaksi->tenggat_pembayaran);
          $time_left = $deadline - $now;
          $is_expired = $time_left <= 0;
          ?>
          
          <!-- ⏰ COUNTDOWN TIMER -->
          <div id="countdown-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; text-align: center;">
            <div style="font-size: 14px; margin-bottom: 8px; opacity: 0.9;">
              <?php if ($is_expired): ?>
                ⚠️ Waktu Pembayaran Telah Berakhir
              <?php else: ?>
                ⏰ Selesaikan Pembayaran Dalam
              <?php endif; ?>
            </div>
            
            <?php if (!$is_expired): ?>
              <div id="countdown" style="font-size: 32px; font-weight: 700; letter-spacing: 2px; font-family: 'Courier New', monospace;">
                <span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span>
              </div>
              <div style="font-size: 12px; margin-top: 8px; opacity: 0.8;">
                Batas: <?= date('d M Y, H:i', $deadline) ?> WIB
              </div>
            <?php else: ?>
              <div style="font-size: 24px; font-weight: 700; margin: 8px 0;">
                EXPIRED
              </div>
              <div style="font-size: 13px; opacity: 0.9;">
                Batas waktu: <?= date('d M Y, H:i', $deadline) ?> WIB
              </div>
            <?php endif; ?>
          </div>
          
          <?php if ($is_expired): ?>
            <!-- ❌ EXPIRED - Disable upload -->
            <div class="alert alert-danger" style="background: #fee; border-left: 4px solid #e11d48; padding: 16px; border-radius: 8px; text-align: center;">
              <strong>⚠️ Waktu Pembayaran Habis</strong><br>
              <span style="color: #666;">Silakan hubungi customer service atau buat pesanan baru.</span>
            </div>
          <?php else: ?>
            <!-- ✅ NOT EXPIRED - Show upload form -->
            <form id="upload-form" method="POST" enctype="multipart/form-data">
            <div class="upload-area" id="upload-area" onclick="document.getElementById('file-input').click()">
              <div class="upload-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="17 8 12 3 7 8"></polyline>
                  <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
              </div>
              <div class="upload-text">Klik atau drag & drop bukti transfer</div>
              <div class="upload-hint">Format: JPG, PNG, PDF (Max 2MB)</div>
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
              Kirim Bukti Transfer
            </button>
          </form>
          <?php endif; // End NOT EXPIRED check ?>
        <?php endif; // End has_bukti check ?>
        
      </div>

    </div>

  </div>

  <script>
    // ⏰ COUNTDOWN TIMER
    <?php if (!$has_bukti && !$is_expired): ?>
    const deadline = new Date('<?= date('Y-m-d H:i:s', strtotime($transaksi->tenggat_pembayaran)) ?>').getTime();
    
    function updateCountdown() {
      const now = new Date().getTime();
      const distance = deadline - now;
      
      if (distance < 0) {
        // ❌ EXPIRED - Reload page
        clearInterval(countdownInterval);
        document.getElementById('countdown').innerHTML = '<span style="color: #fee;">EXPIRED</span>';
        setTimeout(() => {
          location.reload();
        }, 1000);
        return;
      }
      
      // Calculate time
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
      // Update display
      document.getElementById('hours').textContent = String(hours).padStart(2, '0');
      document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
      document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
      
      // ⚠️ Warning when < 1 hour
      if (distance < 3600000) { // 1 hour
        document.getElementById('countdown-box').style.background = 'linear-gradient(135deg, #f59e0b 0%, #dc2626 100%)';
      }
    }
    
    // Update every second
    updateCountdown();
    const countdownInterval = setInterval(updateCountdown, 1000);
    <?php endif; ?>
    
    // Copy to clipboard
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert('Nomor rekening berhasil disalin!');
      });
    }

    // File upload handling
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const submitBtn = document.getElementById('submit-btn');

    // ✅ Only setup upload if elements exist (not expired)
    if (uploadArea && fileInput) {
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
    }

    // File select
    function handleFileSelect(event) {
      const file = event.target.files[0];
      if (!file) return;

      // Validate file size (5MB)
      if (file.size > 5 * 1024 * 1024) {
        alert('File terlalu besar! Maksimal 5MB');
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
        alert('File PDF berhasil dipilih: ' + file.name);
      }
    }

    // Form submit
    document.getElementById('upload-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const originalText = submitBtn.innerHTML;
      
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Mengirim...<span class="spinner"></span>';

      fetch('<?= site_url('pembayaran/upload_bukti/' . $transaksi->no_nota) ?>', {
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
              <h1 style="color: var(--success);">Bukti Transfer Berhasil Dikirim!</h1>
              <p style="margin-top: 1rem; color: #666;">
                Terima kasih! Kami akan memverifikasi pembayaran Anda dalam 1x24 jam.
              </p>
              <button onclick="window.location.href='<?= site_url('pesanan') ?>'" 
                      style="margin-top: 2rem; padding: 1rem 2rem; background: var(--primary); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1rem; font-weight: 600;">
                Lihat Status Pesanan
              </button>
            </div>
          `;
        } else {
          alert(result.message);
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      });
    });
  </script>
</body>
</html>