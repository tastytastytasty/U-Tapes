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
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .modal {
                align-items: flex-start;
                padding-top: 28px;
                padding-bottom: 28px;
            }

            .modal-content {
                margin: 0 12px;
                max-width: 100%;
            }
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 760px;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
            animation: zoomIn .25s ease;
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

        body.modal-open {
            overflow: hidden;
        }

        .modal-content h3 {
            margin: 0 0 20px;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            padding-bottom: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0d6efd;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }

        .modal-actions .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #0d6efd;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        .breadcrumb-inner {
            padding-left: 0;
            padding-right: 0;
        }

        @media (max-width: 576px) {
            .modal-content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
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

        /* ================= MOBILE LAYOUT FIX ================= */
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

        /* ================= BREADCRUMB MOBILE ================= */
        @media (max-width: 576px) {
            .breadcrumbs {
                padding: 14px 16px;
            }

            .breadcrumb-nav {
                flex-wrap: wrap;
                gap: 6px;
                font-size: 13px;
            }
        }

        /* ================= MODAL MOBILE ================= */
        @media (max-width: 576px) {
            .modal {
                align-items: flex-start;
                padding: 12px;
            }

            .modal-content {
                width: 100%;
                max-height: 90vh;
                overflow-y: auto;
                border-radius: 12px;
                padding: 18px;
            }

            .modal-content h3 {
                font-size: 18px;
            }
        }

        /* ================= SELECT2 COLORED INPUT ================= */
        .select2-container--default .select2-selection--single {
            height: 46px;
            border-radius: 10px;
            border: 1.5px solid #dbeafe;
            /* soft blue border */
            background: linear-gradient(180deg, #f8fbff, #eef4ff);
            display: flex;
            align-items: center;
            padding: 0 14px;
            font-size: 14px;
            transition: all .25s ease;
        }

        /* Placeholder look */
        .select2-container--default .select2-selection__rendered {
            color: #94a3b8;
            padding-left: 0;
        }

        /* Arrow */
        .select2-container--default .select2-selection__arrow {
            height: 46px;
            right: 10px;
        }

        /* Hover */
        .select2-container--default .select2-selection--single:hover {
            border-color: #93c5fd;
            background: linear-gradient(180deg, #ffffff, #eef4ff);
        }

        /* Focus */
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .15);
        }

        /* Sudah dipilih */
        .select2-container--default .select2-selection__rendered:not(:empty) {
            color: #1f2937;
        }

        /* ================= DROPDOWN ================= */
        .select2-dropdown {
            border-radius: 12px;
            border: 1px solid #e5edff;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .12);
        }

        .select2-results__option {
            padding: 12px 14px;
            font-size: 14px;
        }

        .select2-results__option--highlighted {
            background: #3b82f6 !important;
            color: #fff;
        }

        /* ================= SELECT2 FULL CLICK AREA ================= */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            width: 100%;
            height: 46px;
            border-radius: 10px;
            border: 1.5px solid #dbeafe;
            background: linear-gradient(180deg, #f8fbff, #eef4ff);
            display: flex;
            align-items: center;
            padding: 0 44px 0 14px;
            /* kanan dikasih ruang arrow */
            cursor: pointer;
        }

        /* teks full lebar */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            flex: 1;
            width: 100%;
            padding: 0;
            margin: 0;
            color: #94a3b8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* arrow absolute biar ga motong klik */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            position: absolute;
            right: 12px;
            top: 0;
            height: 100%;
            width: 32px;
            pointer-events: none;
            /* klik tembus ke parent */
        }

        /* hover */
        .select2-container--default .select2-selection--single:hover {
            border-color: #93c5fd;
        }

        /* focus */
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .15);
        }

        /* value sudah dipilih */
        .select2-container--default .select2-selection__rendered:not(:empty) {
            color: #1f2937;
        }


        /* ================= DISABLED LOOK (OPSIONAL) ================= */
        .select2-container--disabled .select2-selection--single {
            background: #f1f5f9;
            cursor: not-allowed;
            opacity: .7;
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
                        <strong><?= htmlspecialchars($this->session->userdata('nama') ?? 'aku adalah halo') ?></strong><br>
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
                        <button class="btn-add" onclick="openModal()">+ Tambah Alamat</button>
                    </div>

                    <div id="alamatContainer">
                        <?php if (empty($alamat_list)): ?>
                            <p style="text-align: center; color: #999; padding: 40px 0;">Belum ada alamat. Silakan tambahkan
                                alamat pengiriman.</p>
                        <?php else: ?>
                            <?php foreach ($alamat_list as $idx => $a): ?>
                                <div class="alamat-card <?= $a->is_default ? 'default' : '' ?>" data-id="<?= $a->id_alamat ?>"
                                    data-index="<?= $idx + 1 ?>">
                                    <?php if ($a->is_default): ?>
                                        <span
                                            style="display: inline-block; background: #0d6efd; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; margin-bottom: 8px;">Alamat
                                            Utama</span>
                                    <?php endif; ?>
                                    <p style="margin: 4px 0; font-size: 14px;">
                                        <?= htmlspecialchars($a->kelurahan) ?>, <?= htmlspecialchars($a->kecamatan) ?><br>
                                        <?= htmlspecialchars($a->kabupaten) ?>, <?= htmlspecialchars($a->provinsi) ?>
                                    </p>
                                    <p style="margin: 8px 0; font-weight: 600;">Detail : <br><?= htmlspecialchars($a->detail) ?>
                                    </p>
                                    <p style="margin: 8px 0; font-weight: 600;">Kode Pos: <?= htmlspecialchars($a->kode_pos) ?>
                                    </p>

                                    <div class="alamat-card-actions">
                                        <button class="btn btn-succes"
                                            onclick="openEditModal('<?= $a->id_alamat ?>')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteAlamat('<?= $a->id_alamat ?>')">Hapus</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal" id="modalAlamat">
                    <div class="modal-content">
                        <h3 id="modalTitle">Tambah Alamat</h3>

                        <form id="formAlamat">
                            <input type="hidden" id="id_alamat">

                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select id="provinsi" class="form-select2" style="width: 100%;">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <select id="kabupaten" class="form-select2" style="width: 100%;">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select id="kecamatan" class="form-select2" style="width: 100%;">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select id="kelurahan" class="form-select2" style="width: 100%;">
                                        <option></option>
                                    </select>
                                </div>

                                <div class="form-group full">
                                    <label>Detail Alamat</label>
                                    <input type="text" id="detail"
                                        placeholder="Contoh: Jl. Merdeka No. 123, RT 01 RW 05">
                                </div>
                                <div class="form-group full">
                                    <label>Kode Pos</label>
                                    <input type="text" id="kode_pos" placeholder="Kode Pos">
                                </div>
                            </div>

                            <div class="modal-actions">
                                <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="simpanAlamat()">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const BASE_URL = '<?= base_url("index.php/") ?>';

        let select2Ready = false;

        /* ================= MODAL ================= */

        function openModal() {
            $('#modalAlamat').addClass('show');
            $('body').addClass('modal-open');

            // reset form
            $('#formAlamat')[0].reset();
            $('#kode_pos').val('');

            // INIT select2 SETELAH modal tampil
            if (!select2Ready) {
                initSelect2();
                select2Ready = true;
            }

            // load provinsi SETELAH select2 siap
            loadProvinsi();
        }

        function closeModal() {
            $('#modalAlamat').removeClass('show');
            $('body').removeClass('modal-open');
        }

        /* ================= SELECT2 ================= */

        function initSelect2() {
            $('#provinsi, #kabupaten, #kecamatan, #kelurahan').select2({
                dropdownParent: $('#modalAlamat'),
                placeholder: 'Pilih...',
                allowClear: true,
                width: '100%'
            });

            // CHAIN dengan RESET
            $('#provinsi').on('change', function () {
                const id = $(this).val();

                // Reset semua dropdown di bawahnya
                resetSelect('#kabupaten');
                resetSelect('#kecamatan');
                resetSelect('#kelurahan');

                if (id) loadKabupaten(id);
            });

            $('#kabupaten').on('change', function () {
                const id = $(this).val();

                // Reset dropdown di bawahnya
                resetSelect('#kecamatan');
                resetSelect('#kelurahan');

                if (id) loadKecamatan(id);
            });

            $('#kecamatan').on('change', function () {
                const id = $(this).val();

                // Reset dropdown di bawahnya
                resetSelect('#kelurahan');

                if (id) loadKelurahan(id);
            });
        }


        function resetSelect(selector) {
            $(selector).html('<option></option>').val(null).trigger('change');
        }

        /* ================= LOAD DATA ================= */

        function loadProvinsi() {
            return $.getJSON(BASE_URL + 'alamat/provinsi', function (res) {
                let html = '<option></option>';
                res.forEach(r => {
                    html += `<option value="${r.id}">${r.name}</option>`;
                });
                $('#provinsi').html(html).trigger('change.select2');
            });
        }

        function loadKabupaten(id) {
            return $.getJSON(BASE_URL + 'alamat/kabupaten/' + id, function (res) {
                let html = '<option></option>';
                res.forEach(r => {
                    html += `<option value="${r.id}">${r.name}</option>`;
                });
                $('#kabupaten').html(html).trigger('change.select2');
            });
        }

        function loadKecamatan(id) {
            return $.getJSON(BASE_URL + 'alamat/kecamatan/' + id, function (res) {
                let html = '<option></option>';
                res.forEach(r => {
                    html += `<option value="${r.id}">${r.name}</option>`;
                });
                $('#kecamatan').html(html).trigger('change.select2');
            });
        }

        function loadKelurahan(id) {
            return $.getJSON(BASE_URL + 'alamat/kelurahan/' + id, function (res) {
                let html = '<option></option>';
                res.forEach(r => {
                    html += `<option value="${r.id}">${r.name}</option>`;
                });
                $('#kelurahan').html(html).trigger('change.select2');
            });
        }


        function simpanAlamat() {
            const id = $('#id_alamat').val();
            const provinsiVal = $('#provinsi').val();
            const kabupatenVal = $('#kabupaten').val();
            const kecamatanVal = $('#kecamatan').val();
            const kelurahanVal = $('#kelurahan').val();
            const detail = $('#detail').val();
            const kode_pos = $('#kode_pos').val();

            if (!provinsiVal || !kabupatenVal || !kecamatanVal || !kelurahanVal || !detail || !kode_pos) {
                alert('Lengkapi semua field!');
                return;
            }

            const data = {
                provinsi_id: provinsiVal,
                kabupaten_id: kabupatenVal,
                kecamatan_id: kecamatanVal,
                kelurahan_id: kelurahanVal,
                detail: detail,
                kode_pos: kode_pos
            };
            if (id) data.id_alamat = id;

            const url = id ? (BASE_URL + 'alamat/update') : (BASE_URL + 'alamat/simpan');

            $.post(url, data, function (res) {
                if (typeof res === 'string') res = JSON.parse(res);
                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan');
                }
            }).fail(() => alert('Gagal menyimpan alamat'));
        }

        function deleteAlamat(id) {
            if (!confirm('Yakin ingin menghapus alamat ini?')) return;

            $.post(BASE_URL + 'alamat/hapus', {
                id_alamat: id
            }, function (res) {
                if (typeof res === 'string') res = JSON.parse(res);

                if (res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus');
                }
            }).fail(() => alert('Gagal menghapus alamat'));
        }

        function openEditModal(id) {
            $.getJSON(BASE_URL + 'alamat/get/' + id, function (res) {
                if (!res.success) {
                    alert('Gagal memuat data');
                    return;
                }

                const d = res.data;

                openModal();

                $('#id_alamat').val(d.id_alamat);
                $('#detail').val(d.detail);
                $('#kode_pos').val(d.kode_pos);

                // CHAIN PROMISE (PENTING)
                loadProvinsi().then(() => {
                    $('#provinsi').val(d.provinsi_id).trigger('change');

                    return loadKabupaten(d.provinsi_id);
                }).then(() => {
                    $('#kabupaten').val(d.kabupaten_id).trigger('change');

                    return loadKecamatan(d.kabupaten_id);
                }).then(() => {
                    $('#kecamatan').val(d.kecamatan_id).trigger('change');

                    return loadKelurahan(d.kecamatan_id);
                }).then(() => {
                    $('#kelurahan').val(d.kelurahan_id).trigger('change');
                });
            });
        }
    </script>
</body>

</html>