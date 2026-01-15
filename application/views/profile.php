<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Document</title>
</head>
<style>
    /* ======================
   GLOBAL
====================== */
    body {
        background-color: #f5f6f8;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ======================
   LAYOUT
====================== */
    .profile-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* ======================
   SIDEBAR
====================== */
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

    /* ======================
   CONTENT
====================== */
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

    /* ======================
   FORM
====================== */
    .profile-form {
        max-width: 900px;
    }

    .profile-row {
        display: flex;
        margin-bottom: 20px;
    }

    .profile-row label {
        width: 160px;
        font-size: 14px;
        color: #555;
        padding-top: 8px;
    }

    .profile-row input,
    .profile-row select {
        flex: 1;
        border: 1px solid #ddd;
        padding: 8px 10px;
        border-radius: 4px;
        font-size: 14px;
    }

    .profile-row small {
        margin-left: 10px;
        font-size: 13px;
        color: #0d6efd;
        cursor: pointer;
    }

    /* ======================
   AVATAR
====================== */
    .profile-avatar {
        text-align: center;
        margin-left: 40px;
    }

    .profile-avatar img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .profile-avatar button {
        font-size: 13px;
    }

    .profile-avatar p {
        font-size: 12px;
        color: #777;
    }

    /* ======================
   BUTTON
====================== */
    .btn-save {
        background: #ee4d2d;
        color: #fff;
        padding: 10px 35px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-save:hover {
        background: #ffffffff;
    }

    /* ======================
   RESPONSIVE
====================== */
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

        .profile-row {
            flex-direction: column;
        }

        .profile-row label {
            width: 100%;
            margin-bottom: 6px;
        }

        .profile-avatar {
            margin-left: 0;
            margin-top: 30px;
        }
    }

    @media (max-width: 576px) {
        .profile-content {
            padding: 15px;
        }

        .profile-header h4 {
            font-size: 18px;
        }

        .btn-save {
            width: 100%;
        }
    }
</style>

<body>
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Profile</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Homepage</a></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <div class="container-fluid">
        <div class="row min-vh-100">

            <!-- SIDEBAR -->
            <div class="col-lg-3 col-md-4 profile-sidebar">
                <div class="profile-user">
                    <img src="<?= base_url('assets/images/products/product-6.jpg') ?>" alt="user">
                    <div>
                        <strong><strong><?= $logged_in && !empty($user['nama'])
                            ? htmlspecialchars($user['nama'])
                            : 'Guest' ?>
                            </strong></strong><br>
                        <span>Ubah Profil</span>
                    </div>
                </div>

                <ul class="profile-menu">
                    <li class="menu-title">
                        <i class="bi bi-person"></i> Akun Saya
                    </li>
                    <li><a href="#" class="active">Profil</a></li>
                    <li><a href="<?= site_url('alamat') ?>">Alamat</a></li>
                    <li><a href="#">Ubah Password</a></li>

                    <hr>

                    <li class="menu-link">
                        <a href="<?= site_url('pesanan') ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a>
                    </li>
                    <li class="menu-link">
                        <a href="#"><i class="bi bi-bell"></i> Notifikasi</a>
                    </li>
                </ul>
            </div>


            <!-- CONTENT -->
            <div class="col-lg-9 col-md-8 p-5 profile-content">
                <h4>Profil Saya</h4>
                <p class="text-muted">
                    Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
                </p>
                <hr>

                <form class="row">
                    <!-- FORM KIRI -->
                    <div class="col-lg-8">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <?= isset($user['nama']) ? htmlspecialchars($user['nama']) : 'Guest' ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9 pt-2">
                                <?= isset($user['email']) ? htmlspecialchars($user['email']) : 'email belum terdaftar' ?>
                                <a href="#">Ubah</a>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9 pt-2">
                                <?= isset($user['no_telp']) ? htmlspecialchars($user['no_telp']) : 'nomor telephone belum terdaftar' ?>
                                <a href="#">Ubah</a>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9 pt-2">
                                <?php
                                $jk = strtolower(trim($user['jenis_kelamin'] ?? ''));
                                if ($jk === '') {
                                    echo '<span class="text-muted">Belum diisi</span>';
                                } else {
                                    if (in_array($jk, ['p', 'pria', 'l', 'laki', 'laki-laki'], true)) {
                                        echo 'Pria';
                                    } elseif (in_array($jk, ['w', 'wanita', 'perempuan', 'wanita'], true)) {
                                        echo 'Wanita';
                                    } else {
                                        echo htmlspecialchars(ucfirst($jk));
                                    }
                                }
                                ?>
                            </div>
                        </div>


                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9 pt-2">
                                <?php
                                if (!empty($user['tanggal_lahir'])) {
                                    echo date('d F Y', strtotime($user['tanggal_lahir']));
                                } else {
                                    echo '<span class="text-muted">Belum diisi</span>';
                                }
                                ?>
                            </div>
                        </div>


                        <button class="btn btn-primary px-4">Simpan</button>
                    </div>

                    <!-- FOTO PROFILE -->
                    <div class="col-lg-4 text-center mt-4 mt-lg-0">
                        <img src="https://via.placeholder.com/150" class="rounded-circle mb-3"
                            style="width:150px;height:150px;object-fit:cover">

                        <div>
                            <input type="file" class="form-control mb-2">
                            <small class="text-muted">
                                Ukuran maks. 1 MB<br>
                                Format JPG, PNG
                            </small>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

</body>

</html>