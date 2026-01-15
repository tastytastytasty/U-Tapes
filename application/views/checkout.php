<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>

  <style>
    /* Variables */
    :root {
      --primary: #0015ffff; /* action color */
      --muted: #6c757d;
      --border: #eaeaea;
      --bg: #f5f6f8;
      --text: #111;
    }

    /* Reset */
    * { box-sizing: border-box; }
    html, body { height: 100%; }

    body {
      margin: 0;
      background: var(--bg);
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
      color: var(--text);
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Layout */
    .checkout-wrapper {
      max-width: 1200px;
      margin: 30px auto;
      display: flex;
      gap: 24px;
      padding: 0 16px;
    }

    /* LEFT & RIGHT */
    .checkout-left { flex: 1; }
    .checkout-right { width: 360px; }

    /* Card / Box */
    .box {
      background: #fff;
      border-radius: 8px;
      padding: 16px;
      margin-bottom: 20px;
      box-shadow: 0 1px 6px rgba(0,0,0,.04);
      border: 1px solid rgba(0,0,0,0.03);
    }

    .box-header { display: flex; justify-content: space-between; align-items: center; }
    .box h3 { margin: 0 0 12px; font-size: 16px; }

    .btn-link {
      background: none;
      border: 1px solid #eee;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      color: var(--text);
      font-size: 13px;
    }

    /* PRODUCT LISTING */
    .product-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 12px 0;
      border-top: 1px solid #f1f1f1;
    }

    .product-item img { width: 90px; height: 90px; border-radius: 6px; object-fit: cover; }

    .product-info h4 { margin: 0; font-size: 14px; }
    .product-info p { font-size: 12px; color: var(--muted); margin: 4px 0 0; }

    .product-price { margin-left: auto; text-align: right; }
    .product-price span { font-weight: 600; display: block; }

    /* OPTIONAL NOTE */
    .note textarea {
      width: 100%; min-height: 70px; padding: 10px; margin-top: 10px;
      border-radius: 6px; border: 1px solid #e6e6e6; resize: vertical; font-size: 14px;
    }

    /* Payment radio list */
    .radio { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f1f1f1; font-size: 14px; }

    /* Promo / Coupon */
    .coupon-box { display:flex; gap:8px; margin-top:6px; }
    .coupon-box input { flex:1; height:40px; padding:0 10px; border:1px solid #e6e6e6; border-radius:6px 0 0 6px; }
    .coupon-box .btn-apply { height:40px; padding:0 14px; background:var(--primary); color:#fff; border:none; border-radius:0 6px 6px 0; cursor:pointer; }
    .promo-list label { display:block; font-size:13px; color:var(--muted); margin-top:8px; }

    /* Modal */
    .modal { display: none; }
    .modal[aria-hidden="false"] { display:block; position:fixed; inset:0; z-index:9999; }
    .modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,0.45); }
    .modal-content { position:relative; max-width:520px; margin:70px auto; background:#fff; border-radius:8px; padding:18px; z-index:10000; box-shadow:0 10px 30px rgba(0,0,0,.2); }
    .modal-close { position:absolute; right:12px; top:12px; border:none; background:none; font-size:22px; cursor:pointer; }

    /* Promo cards inside modal */
    .promo-cards { margin-top:14px; display:flex; flex-direction:column; gap:10px; }
    .promo-card { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:12px; border-radius:8px; border:1px solid #f1f1f1; background:#fff; }
    .promo-card .details { display:flex; flex-direction:column; }
    .promo-card .details strong { font-size:14px; }
    .promo-card .details .desc { font-size:13px; color:var(--muted); margin-top:4px; }
    .promo-card .btn-use { background:var(--primary); color:#fff; border:none; padding:8px 12px; border-radius:6px; cursor:pointer; }

    /* Address modal */
    .address-cards { margin-top:14px; display:flex; flex-direction:column; gap:10px; }
    .address-card { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:12px; border-radius:8px; border:1px solid #f1f1f1; background:#fff; }
    .address-card .details { font-size:13px; color:var(--muted); }
    .address-card .btn-use-address { background:transparent; color:var(--primary); border:1px solid var(--primary); padding:6px 10px; border-radius:6px; cursor:pointer; }
    .address-form input, .address-form textarea { width:100%; padding:8px; border:1px solid #e6e6e6; border-radius:6px; margin-top:8px; }
    .address-form .btn-save-address { margin-top:10px; padding:8px 12px; background:var(--primary); color:#fff; border:none; border-radius:6px; cursor:pointer; }

    /* PRICE */
    .price-row { display: flex; justify-content: space-between; margin: 10px 0; font-size: 14px; }
    .price-row.total { font-weight: 700; border-top: 1px solid #f1f1f1; padding-top: 10px; }

    /* ACTION */
    .btn-pay {
      width: 100%; margin-top: 16px; padding: 12px; background: var(--primary); border: none; border-radius: 8px;
      color: #fff; font-size: 15px; cursor: pointer;
    }

    /* Responsive */
    @media(max-width: 900px) {
      .checkout-wrapper { flex-direction: column; }
      .checkout-right { width: 100%; }
    }

    /* small tweaks for very small screens */
    @media(max-width: 480px) {
      .product-item img { width: 72px; height: 72px; }
      .box { padding: 12px; }
    }
  </style>
</head>

<body>
  <!-- Start Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-12">
          <div class="breadcrumbs-content">
            <h1 class="page-title">Checkout</h1>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <ul class="breadcrumb-nav">
            <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Homepage</a></li>
            <li><a href="<?= site_url('listbarang') ?>">List Barang</a></li>
            <li><a href="<?= site_url('detailproduct') ?>">Detail Produk</a></li>
            <li>Checkout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End Breadcrumbs -->
  <div class="checkout-page">
  <div class="checkout-wrapper">

  <!-- LEFT -->
  <div class="checkout-left">

    <!-- ALAMAT -->
    <div class="box">
      <div class="box-header">
        <h3>Alamat Pengiriman</h3>
        <button id="open-address" class="btn-link" style="text-decoration: none;">Ganti</button>
      </div>
      <div id="shipping-address">
        <p><strong>Zal</strong></p>
        <p>Jl. neo nusantara</p>
        <p>123</p>
      </div>
    </div>

    <!-- PRODUK -->
    <div class="box">
      <h3>Pesanan</h3>

      <div class="product-item">
                                <img src="<?= base_url('assets/images/product-details/01.jpg') ?>" class="img" alt="#">
        <div class="product-info">
          <h4>ANG Tonggiss Tripod Bluetooth 4in1</h4>
          <p>Variasi: Hitam</p>
        </div>
        <div class="product-price">
          <span>Rp13.894</span>
          <small>x1</small>
        </div>
      </div>

      <div class="note">
        <textarea placeholder="Tulis catatan untuk penjual (opsional)"></textarea>
      </div>
    </div>

  </div>

  <!-- RIGHT -->
  <div class="checkout-right">

    <!-- PROMO -->
    <div class="box">
      <div class="box-header">
        <h3>Promo</h3>
      </div>
      <div style="margin-top:8px;">
        <button id="open-promo" class="btn-link" style="padding:8px 16px; text-decoration:none;">Pakai Promo</button>
      </div>
    </div>

    <!-- RINGKASAN -->
    <div class="box">
      <h3>Ringkasan Belanja</h3>

      <div class="price-row">
        <span>Total Harga</span>
        <span>Rp13.894</span>
      </div>

      <div class="price-row">
        <span>Ongkir</span>
        <span>Rp10.000</span>
      </div>

      <div class="price-row total">
        <span>Total Tagihan</span>
        <span>Rp23.894</span>
      </div>

      <button class="btn-pay">Bayar Sekarang</button>
    </div>

  </div>

</div>
</div>

  <!-- Promo Modal -->
  <div id="promo-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" id="promo-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="promo-title">
      <button class="modal-close" id="promo-close" aria-label="Tutup">&times;</button>
      <h3 id="promo-title">Masukkan Kode Promo</h3>

      <div style="margin-top:10px;">
        <input id="promo-input" type="text" placeholder="Kode Promo" style="width:100%; padding:10px; border:1px solid #e6e6e6; border-radius:6px;">
        <div style="margin-top:12px; display:flex; gap:8px;">
          <button id="promo-apply" class="btn-pay" style="flex:1; padding:10px;">Apply</button>
        </div>

        <!-- Contoh promo cards -->
        <div class="promo-cards">
          <div class="promo-card">
            <div class="details">
              <strong>PROMO10</strong>
              <div class="desc">Diskon 10% untuk pembelian pertama</div>
            </div>
            <div class="actions">
              <button class="btn-use" data-code="PROMO10">Pakai</button>
            </div>
          </div>

          <div class="promo-card">
            <div class="details">
              <strong>FREEONGKIR</strong>
              <div class="desc">Gratis ongkir untuk pembelian di atas Rp100.000</div>
            </div>
            <div class="actions">
              <button class="btn-use" data-code="FREEONGKIR">Pakai</button>
            </div>
          </div>

          <div class="promo-card">
            <div class="details">
              <strong>DISKON50</strong>
              <div class="desc">Diskon Rp50.000 untuk order tertentu</div>
            </div>
            <div class="actions">
              <button class="btn-use" data-code="DISKON50">Pakai</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    (function () {
      const openBtn = document.getElementById('open-promo');
      const modal = document.getElementById('promo-modal');
      const overlay = document.getElementById('promo-overlay');
      const closeBtn = document.getElementById('promo-close');
      const cancelBtn = document.getElementById('promo-cancel');
      const applyBtn = document.getElementById('promo-apply');
      const input = document.getElementById('promo-input');

      function closeModal() {
        modal.setAttribute('aria-hidden', 'true');
      }

      function openModal() {
        modal.setAttribute('aria-hidden', 'false');
        setTimeout(() => input && input.focus(), 50);
      }

      function applyCode(code) {
        if (!code) { alert('Masukkan kode promo'); return; }
        // Demo: replace with real ajax call to validate/apply
        alert('Kode "' + code + '" diterapkan (demo)');
        closeModal();
      }

      openBtn && openBtn.addEventListener('click', openModal);
      closeBtn && closeBtn.addEventListener('click', closeModal);
      cancelBtn && cancelBtn.addEventListener('click', closeModal);
      overlay && overlay.addEventListener('click', closeModal);

      applyBtn && applyBtn.addEventListener('click', function () {
        applyCode(input.value.trim());
      });

      document.querySelectorAll('.promo-card .btn-use').forEach((btn) => {
        btn.addEventListener('click', function (e) {
          const code = e.currentTarget.dataset.code;
          input.value = code;
          applyCode(code);
        });
      });

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
      });
    })();
  </script>

  <!-- Address Modal -->
  <div id="address-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" id="address-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="address-title">
      <button class="modal-close" id="address-close" aria-label="Tutup">&times;</button>
      <h3 id="address-title">Pilih / Tambah Alamat</h3>

      <div class="address-cards">
        <div class="address-card">
          <div class="details">
            <strong>Zal</strong>
            <div>Jl. neo nusantara<br>123<br>0812xxxxxxx</div>
          </div>
          <div><button class="btn-use-address" data-name="Zal" data-line="Jl. neo nusantara" data-phone="0812xxxxxxx">Pilih</button></div>
        </div>

        <div class="address-card">
          <div class="details">
            <strong>Rina</strong>
            <div>Jl. Merdeka No. 45<br>Jakarta Pusat<br>0813yyyyyyyy</div>
          </div>
          <div><button class="btn-use-address" data-name="Rina" data-line="Jl. Merdeka No. 45, Jakarta Pusat" data-phone="0813yyyyyyyy">Pilih</button></div>
        </div>
      </div>

      <hr style="margin:14px 0; border:none; border-top:1px solid #f1f1f1;">
      <h4>Tambah Alamat</h4>
      <form id="address-form" class="address-form" onsubmit="return false;">
        <input id="addr-name" type="text" placeholder="Nama">
        <input id="addr-line" type="text" placeholder="Alamat (jalan, kec, kab)">
        <input id="addr-phone" type="text" placeholder="No. HP">
        <button class="btn-save-address">Simpan & Pilih</button>
      </form>
    </div>
  </div>

     <script src="<?= base_url('assets/js/checkout.js') ?>"></script>


</body>

</html>
