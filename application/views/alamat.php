<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Alamat Pengiriman</title>
    <style>
        body {
            background-color: #f5f6f8;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

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

        .profile-wrapper {
            display: flex;
            min-height: 100vh;
        }

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

        .profile-content {
            flex: 1;
            padding: 40px;
            background: #fff;
        }

        .profile-header h4 {
            font-weight: 600;
        }

        .profile-header p {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .alamat-wrapper {
            max-width: 900px;
        }

        .alamat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .alamat-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .btn-add {
            background: #0d6efd;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add:hover {
            background: #0b5ed7;
        }

        .alamat-card {
            background: #fff;
            padding: 18px 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .20);
            margin-bottom: 18px;
            border: 2px solid #f0f0f0;
        }

        .alamat-card.default {
            border-color: #0d6efd;
        }

        .alamat-card-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .alamat-card-actions .btn {
            padding: 6px 12px;
            background: #49f846;
            color: #fff;
            border-radius: 6px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .alamat-card-actions .btn:hover {
            background: #000;
        }

        .alamat-card-actions .btn-danger {
            background: #dc3545;
        }

        .alamat-card-actions .btn-danger:hover {
            background: #c82333;
        }

        /* ================= MODAL IMPROVEMENTS ================= */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: opacity .18s ease, visibility .18s ease;
            padding: 20px;
            overflow-y: auto;
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden !important;
            position: fixed;
            width: 100%;
            height: 100vh;
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 620px;
            border-radius: 8px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .15);
            animation: zoomIn .2s ease;
            overflow: hidden;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-content h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            background: #fff;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e5e5;
            flex-shrink: 0;
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        /* ================= FORM GRID IMPROVEMENTS ================= */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-group label.required::after {
            content: '*';
            color: #dc3545;
            margin-left: 2px;
        }

        /* ================= IMPROVED INPUT STYLING ================= */
        .form-group input,
        .form-group textarea {
            padding: 11px 14px;
            border-radius: 6px;
            border: 1.5px solid #ddd;
            font-size: 14px;
            transition: all .2s ease;
            font-family: inherit;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:hover {
            border-color: #bbb;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
            opacity: 1;
        }

        /* ================= IMPROVED DROPDOWN STYLING ================= */
        .dropdown-box {
            position: relative;
            width: 100%;
        }

        .dropdown-selected {
            border: 1.5px solid #ddd;
            border-radius: 6px;
            padding: 11px 14px;
            cursor: pointer;
            background: #fff;
            font-size: 14px;
            color: #333;
            transition: all .2s ease;
            user-select: none;
            position: relative;
            padding-right: 40px;
        }

        .dropdown-selected::after {
            content: '▼';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            color: #666;
            transition: transform .2s ease;
        }

        .dropdown-selected:hover {
            border-color: #bbb;
            background: #fafafa;
        }

        .dropdown-selected.active {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .1);
        }

        .dropdown-selected.active::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .dropdown-list {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: #fff;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            z-index: 999999;
            display: none;
            max-height: 280px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        }

        .dropdown-list input {
            width: 100%;
            border: none;
            border-bottom: 1.5px solid #eee;
            padding: 11px 14px;
            font-size: 13px;
            outline: none;
            box-sizing: border-box;
            background: #fafafa;
        }

        .dropdown-list input:focus {
            background: #fff;
            border-bottom-color: #0d6efd;
        }

        .dropdown-list input::placeholder {
            color: #999;
        }

        .dropdown-items {
            max-height: 220px;
            overflow-y: auto;
            background: #fff;
        }

        /* Custom scrollbar for dropdown */
        .dropdown-items::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-items::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .dropdown-items::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .dropdown-items::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        .dropdown-item {
            padding: 11px 14px;
            cursor: pointer;
            font-size: 13px;
            transition: background .15s ease;
            color: #333;
        }

        .dropdown-item:hover {
            background: #f5f8ff;
            color: #0d6efd;
        }

        .dropdown-item.active {
            background: #0d6efd;
            color: #fff;
        }

        /* Empty state for dropdown */
        .dropdown-items:empty::before {
            content: 'Tidak ada data';
            display: block;
            padding: 20px 14px;
            text-align: center;
            color: #999;
            font-size: 13px;
        }

        /* Loading state */
        .dropdown-items.loading::before {
            content: 'Memuat data...';
            display: block;
            padding: 20px 14px;
            text-align: center;
            color: #0d6efd;
            font-size: 13px;
        }

        /* Disable dropdown when loading */
        .dropdown-selected.disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            color: #999;
            opacity: 0.6;
        }

        .dropdown-selected.disabled:hover {
            border-color: #ddd;
            background: #f5f5f5;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            background: #f8f9fa;
            border-top: 1px solid #e5e5e5;
            flex-shrink: 0;
        }

        .modal-actions .btn {
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
        }

        .btn-primary {
            background: #0d6efd;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            box-shadow: 0 2px 6px rgba(13, 110, 253, .3);
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 2px 6px rgba(108, 117, 125, .3);
        }

        .breadcrumb-inner {
            padding-left: 0;
            padding-right: 0;
        }

        /* ================= MOBILE RESPONSIVE ================= */
        @media (max-width: 991px) {

            .profile-wrapper,
            .container-fluid>.row {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
            }

            .profile-content {
                padding: 20px 16px;
            }

            .alamat-wrapper {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .modal {
                align-items: flex-start;
                padding: 16px;
            }

            .modal-content {
                margin: 0;
                max-width: 100%;
                max-height: 95vh;
            }

            .modal-content h3 {
                padding: 16px 18px;
                font-size: 16px;
            }

            .modal-body {
                padding: 18px;
            }

            .modal-actions {
                padding: 14px 18px;
                gap: 8px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .form-group.full {
                grid-column: span 1;
            }

            .alamat-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .breadcrumbs {
                padding: 14px 16px;
            }

            .breadcrumb-nav {
                flex-wrap: wrap;
                gap: 6px;
                font-size: 13px;
            }

            .modal {
                padding: 12px;
            }

            .dropdown-list {
                max-height: 240px;
            }

            .dropdown-items {
                max-height: 180px;
            }
        }
    </style>
</head>

<body>
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <div class="row align-items-center">
                <div class="col-md-6 text-end">
                    <ul class="breadcrumb-nav">
                        <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="<?= site_url('profile') ?>">Profile</a></li>
                        <li>Alamat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- SIDEBAR -->
            <div class="col-lg-3 col-md-4 profile-sidebar">
                <div class="profile-user">
                    <img src="<?= base_url('assets/images/products/product-6.jpg') ?>" alt="user">
                    <div>
                        <strong><?= htmlspecialchars($this->session->userdata('nama') ?? 'User') ?></strong><br>
                        <span>Ubah Profil</span>
                    </div>
                </div>

                <ul class="profile-menu">
                    <li class="menu-title"><i class="bi bi-person"></i> Akun Saya</li>
                    <li><a href="<?= site_url('profile') ?>">Profil</a></li>
                    <li><a href="<?= site_url('alamat') ?>" class="active">Alamat</a></li>
                    <li><a href="<?= site_url('ubah-password') ?>">Ubah Password</a></li>
                    <hr>
                    <li><a href="<?= site_url('pesanan') ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                    <li><a href="#"><i class="bi bi-bell"></i> Notifikasi</a></li>
                </ul>
            </div>

            <!-- CONTENT -->
            <div class="col-lg-9 col-md-8 profile-content">
                <div class="alamat-wrapper">
                    <div class="alamat-header">
                        <h2>Alamat Saya</h2>
                        <button type="button" class="btn-add" onclick="openModal()">+ Tambah Alamat</button>
                    </div>

                    <div id="alamatContainer">
                        <?php if (empty($alamat_list)): ?>
                            <p style="text-align: center; color: #999; padding: 40px 0;">Belum ada alamat. Silakan tambahkan alamat pengiriman.</p>
                        <?php else: ?>
                            <?php foreach ($alamat_list as $idx => $a): ?>
                                <div class="alamat-card <?= $a->is_default ? 'default' : '' ?>" data-id="<?= $a->id_alamat ?>" data-index="<?= $idx + 1 ?>">
                                    <?php if ($a->is_default): ?>
                                        <span style="display: inline-block; background: #0d6efd; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 8px;">Alamat Utama</span>
                                    <?php endif; ?>

                                    <!-- TAMPILKAN NAMA DARI JOIN -->
                                    <p style="margin: 4px 0; font-size: 14px;">
                                        <?= htmlspecialchars($a->nama_kelurahan ?: 'Belum dipilih') ?>, <?= htmlspecialchars($a->nama_kecamatan ?: 'Belum dipilih') ?>
                                        <?= htmlspecialchars($a->nama_kabupaten ?? '-') ?>, <?= htmlspecialchars($a->nama_provinsi ?? '-') ?>
                                    </p>
                                    <p style="margin: 8px 0; font-weight: 600;">Detail : <br><?= htmlspecialchars($a->detail) ?></p>
                                    <p style="margin: 8px 0; font-weight: 600;">Kode Pos: <?= htmlspecialchars($a->kode_pos) ?></p>

                                    <div class="alamat-card-actions">
                                        <button class="btn btn-succes" onclick="openEditModal('<?= $a->id_alamat ?>')">Edit</button>
                                        <button class="btn btn-danger" onclick="deleteAlamat('<?= $a->id_alamat ?>')">Hapus</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- MODAL -->
                <div class="modal" id="modalAlamat">
                    <div class="modal-content">
                        <h3 id="modalTitle">Tambah Alamat</h3>

                        <div class="modal-body">
                            <form id="formAlamat">
                                <input type="hidden" id="id_alamat">

                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <div class="dropdown-box">
                                            <div class="dropdown-selected" id="provinsiSelected" onclick="toggleDropdown('provinsi')">Pilih Provinsi</div>
                                            <div class="dropdown-list" id="provinsiList">
                                                <input type="text" placeholder="Cari provinsi..." onkeyup="filterDropdown(this, 'provinsi')">
                                                <div class="dropdown-items" id="provinsiItems"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Kabupaten</label>
                                        <div class="dropdown-box">
                                            <div class="dropdown-selected" id="kabupatenSelected" onclick="toggleDropdown('kabupaten')">Pilih Kabupaten</div>
                                            <div class="dropdown-list" id="kabupatenList">
                                                <input type="text" placeholder="Cari kabupaten..." onkeyup="filterDropdown(this, 'kabupaten')">
                                                <div class="dropdown-items" id="kabupatenItems"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <div class="dropdown-box">
                                            <div class="dropdown-selected" id="kecamatanSelected" onclick="toggleDropdown('kecamatan')">Pilih Kecamatan</div>
                                            <div class="dropdown-list" id="kecamatanList">
                                                <input type="text" placeholder="Cari kecamatan..." onkeyup="filterDropdown(this, 'kecamatan')">
                                                <div class="dropdown-items" id="kecamatanItems"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Kelurahan</label>
                                        <div class="dropdown-box">
                                            <div class="dropdown-selected" id="kelurahanSelected" onclick="toggleDropdown('kelurahan')">Pilih Kelurahan</div>
                                            <div class="dropdown-list" id="kelurahanList">
                                                <input type="text" placeholder="Cari kelurahan..." onkeyup="filterDropdown(this, 'kelurahan')">
                                                <div class="dropdown-items" id="kelurahanItems"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group full">
                                        <label>Detail Alamat</label>
                                        <input type="text" id="detail" placeholder="Contoh: Jl. Merdeka No. 123, RT 01 RW 05">
                                    </div>

                                    <div class="form-group full">
                                        <label>Kode Pos</label>
                                        <input type="text" id="kode_pos" placeholder="Kode Pos">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="simpanAlamat()">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script>
const BASE_URL = '<?= base_url("index.php/") ?>';

let selectedProvinsi = null;
let selectedKabupaten = null;
let selectedKecamatan = null;
let selectedKelurahan = null;

/* ================= DROPDOWN CONTROL ================= */
function toggleDropdown(type) {
    const list = document.getElementById(type + 'List');
    const selected = document.getElementById(type + 'Selected');
    const open = list.style.display === 'block';

    document.querySelectorAll('.dropdown-list').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.dropdown-selected').forEach(el => el.classList.remove('active'));

    if (!open) {
        list.style.display = 'block';
        selected.classList.add('active');
    }
}

function closeAllDropdowns() {
    document.querySelectorAll('.dropdown-list').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.dropdown-selected').forEach(el => el.classList.remove('active'));
}

document.addEventListener('click', e => {
    if (!e.target.closest('.dropdown-box')) closeAllDropdowns();
});

/* ================= FILTER ================= */
function filterDropdown(input, type) {
    const val = input.value.toLowerCase();
    document.querySelectorAll('#' + type + 'Items .dropdown-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
}

/* ================= MODAL ================= */
function openModal() {
    document.getElementById('modalAlamat').classList.add('show');
    document.body.classList.add('modal-open');
    resetAll();
    loadProvinsi();
}

function closeModal() {
    document.getElementById('modalAlamat').classList.remove('show');
    document.body.classList.remove('modal-open');
}

/* ================= RESET ================= */
function resetAll() {
    selectedProvinsi = selectedKabupaten = selectedKecamatan = selectedKelurahan = null;
    document.getElementById('id_alamat').value = '';
    setSelectedText('provinsi', 'Pilih Provinsi');
    setSelectedText('kabupaten', 'Pilih Kabupaten');
    setSelectedText('kecamatan', 'Pilih Kecamatan');
    setSelectedText('kelurahan', 'Pilih Kelurahan');
    clearItems('kabupaten');
    clearItems('kecamatan');
    clearItems('kelurahan');
    document.getElementById('detail').value = '';
    document.getElementById('kode_pos').value = '';
}

function setSelectedText(type, text) {
    document.getElementById(type + 'Selected').innerText = text;
}

function clearItems(type) {
    document.getElementById(type + 'Items').innerHTML = '';
}

/* ================= FETCH DATA ================= */
function loadProvinsi() {
    fetch(BASE_URL + 'alamat/provinsi')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('provinsiItems');
            container.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'dropdown-item';
                div.innerText = item.name;
                div.onclick = () => {
                    selectedProvinsi = item.id;
                    setSelectedText('provinsi', item.name);
                    closeAllDropdowns();

                    selectedKabupaten = selectedKecamatan = selectedKelurahan = null;
                    setSelectedText('kabupaten', 'Pilih Kabupaten');
                    setSelectedText('kecamatan', 'Pilih Kecamatan');
                    setSelectedText('kelurahan', 'Pilih Kelurahan');
                    clearItems('kabupaten');
                    clearItems('kecamatan');
                    clearItems('kelurahan');

                    loadKabupaten(item.id);
                };
                container.appendChild(div);
            });
        });
}

function loadKabupaten(provinsiId) {
    fetch(BASE_URL + 'alamat/kabupaten/' + provinsiId)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('kabupatenItems');
            container.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'dropdown-item';
                div.innerText = item.name;
                div.onclick = () => {
                    selectedKabupaten = item.id;
                    setSelectedText('kabupaten', item.name);
                    closeAllDropdowns();

                    selectedKecamatan = selectedKelurahan = null;
                    setSelectedText('kecamatan', 'Pilih Kecamatan');
                    setSelectedText('kelurahan', 'Pilih Kelurahan');
                    clearItems('kecamatan');
                    clearItems('kelurahan');

                    loadKecamatan(item.id);
                };
                container.appendChild(div);
            });
        });
}

function loadKecamatan(kabupatenId) {
    fetch(BASE_URL + 'alamat/kecamatan/' + kabupatenId)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('kecamatanItems');
            container.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'dropdown-item';
                div.innerText = item.name;
                div.onclick = () => {
                    selectedKecamatan = item.id;
                    setSelectedText('kecamatan', item.name);
                    closeAllDropdowns();

                    selectedKelurahan = null;
                    setSelectedText('kelurahan', 'Pilih Kelurahan');
                    clearItems('kelurahan');

                    loadKelurahan(item.id);
                };
                container.appendChild(div);
            });
        });
}

function loadKelurahan(kecamatanId) {
    return fetch(BASE_URL + 'alamat/kelurahan/' + kecamatanId)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('kelurahanItems');
            container.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'dropdown-item';
                div.innerText = item.name;
                div.onclick = () => {
                    selectedKelurahan = item.id;
                    setSelectedText('kelurahan', item.name);
                    closeAllDropdowns();
                };
                container.appendChild(div);
            });
            return data; // ⬅️ penting
        });
}


function resetKabupaten() {
    $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>').trigger('change');
}

function resetKecamatan() {
    $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>').trigger('change');
}

function resetKelurahan() {
    $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>').trigger('change');
}

function confirmChange(type) {
    if (type === 'provinsi') {
        resetKabupaten();
        resetKecamatan();
        resetKelurahan();
    }
    if (type === 'kabupaten') {
        resetKecamatan();
        resetKelurahan();
    }
    if (type === 'kecamatan') {
        resetKelurahan();
    }
}


/* ================= CRUD ================= */
function simpanAlamat() {
    if (!selectedProvinsi || !selectedKabupaten || !selectedKecamatan || !selectedKelurahan) {
        alert('Lengkapi alamat wilayah!');
        return;
    }

    const detail = document.getElementById('detail').value.trim();
    const kode_pos = document.getElementById('kode_pos').value.trim();
    if (!detail || !kode_pos) {
        alert('Detail alamat dan kode pos wajib diisi!');
        return;
    }

    const id = document.getElementById('id_alamat').value;
    const data = {
        provinsi_id: selectedProvinsi,
        kabupaten_id: selectedKabupaten,
        kecamatan_id: selectedKecamatan,
        kelurahan_id: selectedKelurahan,
        detail: detail,
        kode_pos: kode_pos
    };
    if (id) data.id_alamat = id;

    const url = id ? BASE_URL + 'alamat/update' : BASE_URL + 'alamat/simpan';

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(data)
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            location.reload();
        } else {
            alert(res.message || 'Gagal menyimpan');
        }
    })
    .catch(() => alert('Gagal menyimpan alamat'));
}

function deleteAlamat(id) {
    if (!confirm('Yakin ingin menghapus alamat ini?')) return;

    fetch(BASE_URL + 'alamat/hapus', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ id_alamat: id })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            location.reload();
        } else {
            alert(res.message || 'Gagal menghapus');
        }
    })
    .catch(() => alert('Gagal menghapus alamat'));
}

function openEditModal(id) {
    fetch(BASE_URL + 'alamat/get/' + id)
        .then(res => res.json())
        .then(res => {
            if (!res.success) {
                alert('Gagal memuat data');
                return;
            }

            const d = res.data;
            openModal();

            document.getElementById('id_alamat').value = d.id_alamat;
            document.getElementById('detail').value = d.detail;
            document.getElementById('kode_pos').value = d.kode_pos;

            selectedProvinsi = d.provinsi_id;
            selectedKabupaten = d.kabupaten_id;
            selectedKecamatan = d.kecamatan_id;
            selectedKelurahan = d.kelurahan_id;

            loadProvinsi();
            setTimeout(() => {
                setSelectedText('provinsi', d.nama_provinsi);
                loadKabupaten(d.provinsi_id);
                setTimeout(() => {
                    setSelectedText('kabupaten', d.nama_kabupaten);
                    loadKecamatan(d.kabupaten_id);
                    setTimeout(() => {
                        setSelectedText('kecamatan', d.nama_kecamatan);
                        loadKelurahan(d.kecamatan_id);
                        setTimeout(() => {
                            setSelectedText('kelurahan', d.nama_kelurahan);
                        }, 200);
                    }, 200);
                }, 200);
            }, 200);
        });
}
</script>

</body>

</html>