<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Profile - Toko Sepatu</title>
</head>

<style>
    /* ======================
   GLOBAL
====================== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f6f8;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
        padding: 0;
        margin: 0;
    }

    /* ======================
   BREADCRUMBS
====================== */
    .breadcrumbs {
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
        padding: 16px 24px;
        margin-bottom: 0;
    }

    .page-title {
        font-size: 22px;
        font-weight: 600;
        margin: 0;
    }

    .breadcrumb-nav {
        list-style: none;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        color: #777;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    .breadcrumb-nav li {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .breadcrumb-nav a {
        color: #0d6efd;
        text-decoration: none;
        transition: all 0.3s;
    }

    .breadcrumb-nav a:hover {
        color: #0a58ca;
    }

    /* ======================
   MAIN CONTAINER
====================== */
    .profile-container {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .profile-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* ======================
   SIDEBAR CARD
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

    .profile-user-card {
        display: none;
    }

    .profile-avatar-wrapper {
        display: none;
    }

    .profile-avatar {
        display: none;
    }

    .profile-user-info {
        display: none;
    }

    .profile-user-name {
        display: none;
    }

    .profile-user-email {
        display: none;
    }

    /* Menu */
    .profile-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .profile-menu li {
        margin-bottom: 8px;
    }

    .profile-menu .menu-title {
        font-size: 13px;
        font-weight: 600;
        color: #555;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .menu-section-title {
        display: none;
    }

    .profile-menu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
        transition: all 0.2s;
    }

    .profile-menu li a i {
        display: none;
    }

    .profile-menu li a:hover {
        background: #eef2ff;
        color: #0d6efd;
        font-weight: 500;
    }

    .profile-menu li a.active {
        background: #eef2ff;
        color: #0d6efd;
        font-weight: 500;
    }

    .profile-menu li a.active i {
        display: none;
    }

    .profile-menu hr {
        margin: 15px 0;
        border: none;
        border-top: 1px solid #e5e5e5;
    }

    /* ======================
   CONTENT CARD
====================== */
    .profile-content {
        flex: 1;
        padding: 40px;
        background: #f5f6f8;
    }

    .profile-header {
        margin-bottom: 32px;
    }

    .profile-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .profile-header p {
        color: #888;
        font-size: 14px;
        line-height: 1.6;
    }

    .profile-divider {
        height: 1px;
        background: #e5e5e5;
        margin: 24px 0 32px 0;
    }

    /* ======================
   FORM LAYOUT
====================== */
    .profile-form-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
    }

    /* Form Fields */
    .profile-field {
        display: grid;
        grid-template-columns: 140px 1fr;
        align-items: start;
        gap: 20px;
        margin-bottom: 24px;
    }

    .profile-field label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
        padding-top: 10px;
    }

    .profile-field-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-field-value {
        flex: 1;
        padding: 10px 16px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid transparent;
        font-size: 14px;
        color: #333;
        transition: all 0.3s;
    }

    .profile-field-value:focus {
        outline: none;
        border-color: #0d6efd;
        background: white;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .profile-field-value.readonly {
        background: #f8f9fa;
        color: #666;
        font-weight: 500;
    }

    .profile-field-value.empty {
        color: #999;
        font-style: italic;
    }

    .btn-edit {
        padding: 8px 16px;
        background: transparent;
        border: 2px solid #0d6efd;
        color: #0d6efd;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit:hover {
        background: #0d6efd;
        color: white;
    }

    /* Avatar Upload Section */
    .profile-avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 2px dashed #ddd;
    }

    .profile-avatar-large {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .profile-avatar-large:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 32px rgba(102, 126, 234, 0.3);
    }

    .avatar-upload-btn {
        padding: 10px 24px;
        background: #0d6efd;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 12px;
    }

    .avatar-upload-btn:hover {
        background: #0a58ca;
    }

    .avatar-upload-info {
        font-size: 12px;
        color: #888;
        text-align: center;
        line-height: 1.6;
    }

    input[type="file"] {
        display: none;
    }

    /* Save Button */
    .profile-actions {
        margin-top: 32px;
        display: flex;
        gap: 12px;
    }

    .btn-save {
        padding: 12px 32px;
        background: #0d6efd;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-save:hover {
        background: #0a58ca;
    }

    .btn-cancel {
        padding: 12px 32px;
        background: white;
        color: #666;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    /* ======================
   RESPONSIVE ADJUSTMENTS
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

        .profile-form-wrapper {
            grid-template-columns: 1fr;
        }

        .profile-avatar-section {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .profile-content {
            padding: 24px;
        }

        .profile-field {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .profile-field label {
            padding-top: 0;
        }

        .btn-save,
        .btn-cancel {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        body {
            padding: 10px 0;
        }

        .profile-container {
            padding: 0 10px;
        }

        .profile-content {
            padding: 20px;
        }

        .profile-header h2 {
            font-size: 22px;
        }

        .profile-field-content {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-edit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<body>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Profile</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-container">
        <div class="profile-wrapper">

            <!-- SIDEBAR -->
            <div class="profile-sidebar">
                <div class="profile-user">
                    <?php 
                    $avatar = $user['avatar'] ?? null;
                    $nama = $user['nama'] ?? 'Guest';
                    $inisial = strtoupper(substr($nama, 0, 1));
                    $avatarFile = FCPATH . 'assets/images/avatar/' . $avatar;
                    ?>
                    <?php if (!empty($avatar) && file_exists($avatarFile)): ?>
                        <img src="<?= base_url('assets/images/avatar/' . $avatar) ?>" alt="user" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                    <?php else: ?>
                        <div style="width: 48px; height: 48px; background: #0d6efd; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            <?= $inisial ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <strong><?= htmlspecialchars($nama) ?></strong><br>
                    </div>
                </div>

                <ul class="profile-menu">
                    <li class="menu-title"><i class="bi bi-person"></i> Akun Saya</li>
                    <li><a href="<?= site_url('profile') ?>" class="active">Profil</a></li>
                    <li><a href="<?= site_url('alamat') ?>">Alamat</a></li>
                    <li><a href="#">Ubah Kata Sandi</a></li>

                    <hr>

                    <li><a href="<?= site_url('pesanan') ?>"><i class="bi bi-receipt"></i> Pesanan Saya</a></li>
                    <li><a href="#"><i class="bi bi-bell"></i> Notifikasi</a></li>
                </ul>
            </div>

            <!-- CONTENT -->
            <main class="profile-content">
                <!-- Alert Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-check-circle"></i>
                        <span><?= $this->session->flashdata('success') ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-exclamation-circle"></i>
                        <span><?= $this->session->flashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <!-- Header -->
                <div class="profile-header">
                    <h2>Profil Saya</h2>
                    <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                </div>

                <div class="profile-divider"></div>

                <!-- Form -->
                <form method="POST" action="<?= site_url('profile/update_profile') ?>" enctype="multipart/form-data">
                    <div class="profile-form-wrapper">
                        
                        <!-- Left: Form Fields -->
                        <div>
                            <!-- Nama -->
                            <div class="profile-field">
                                <label>Nama Lengkap</label>
                                <div class="profile-field-content">
                                    <input type="text" 
                                           class="profile-field-value readonly" 
                                           value="<?= isset($user['nama']) ? htmlspecialchars($user['nama']) : '' ?>"
                                           readonly>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="profile-field">
                                <label>Email</label>
                                <div class="profile-field-content">
                                    <input type="email" 
                                           class="profile-field-value readonly" 
                                           value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>"
                                           readonly>
                                    <a href="<?= site_url('profile/edit_email') ?>" class="btn-edit">
                                        <i class="bi bi-pencil"></i> Ubah
                                    </a>
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="profile-field">
                                <label>Nomor Telepon</label>
                                <div class="profile-field-content">
                                    <input type="tel" 
                                           name="no_telp"
                                           class="profile-field-value" 
                                           placeholder="Masukkan nomor telepon"
                                           value="<?= isset($user['no_telp']) ? htmlspecialchars($user['no_telp']) : '' ?>">
                                </div>
                            </div>



                            <!-- Actions -->
                            <div class="profile-actions">
                                <button type="submit" class="btn-save">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                                <button type="reset" class="btn-cancel">
                                    Batal
                                </button>
                            </div>
                        </div>

                        <!-- Right: Avatar Upload -->
                        <div class="profile-avatar-section">
                            <?php 
                            $avatar = $user['avatar'] ?? null;
                            $nama = $user['nama'] ?? 'Guest';
                            $inisial = strtoupper(substr($nama, 0, 1));
                            $avatarFile = FCPATH . 'assets/images/avatar/' . $avatar;
                            ?>
                            <?php if (!empty($avatar) && file_exists($avatarFile)): ?>
                                <img src="<?= base_url('assets/images/avatar/' . $avatar) ?>" 
                                     alt="Profile" 
                                     class="profile-avatar-large"
                                     id="avatar-preview">
                            <?php else: ?>
                                <div style="width: 140px; height: 140px; background: #0d6efd; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: bold; margin-bottom: 20px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);" id="avatar-preview">
                                    <?= $inisial ?>
                                </div>
                            <?php endif; ?>
                            
                            <label for="avatar-upload" class="avatar-upload-btn">
                                <i class="bi bi-camera"></i> Pilih Foto
                            </label>
                            <input type="file" 
                                   id="avatar-upload"
                                   name="avatar"
                                   accept="image/*"
                                   onchange="previewAvatar(this)">
                            
                            <div class="avatar-upload-info">
                                Ukuran maksimal: <strong>2 MB</strong><br>
                                Format: <strong>JPG, PNG, JPEG, GIF, WEBP</strong>
                            </div>
                        </div>

                    </div>
                </form>
            </main>

        </div>
    </div>

    <script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size
            if (file.size > 2 * 1024 * 1024) { // 2MB
                alert('Ukuran file terlalu besar. Maksimal 2 MB');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                let previewEl = document.getElementById('avatar-preview');
                
                // If it's a div (initial), replace with img
                if (previewEl.tagName === 'DIV') {
                    const newImg = document.createElement('img');
                    newImg.id = 'avatar-preview';
                    newImg.className = 'profile-avatar-large';
                    newImg.alt = 'Profile';
                    newImg.src = e.target.result;
                    previewEl.replaceWith(newImg);
                    previewEl = document.getElementById('avatar-preview');
                } else {
                    previewEl.src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>

</html>