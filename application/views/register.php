<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/images/favicon.svg') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.svg') ?>" />
    <title>
        U-tapes
    </title>
    <!--     Fonts and icons     -->
    <link href="<?= base_url('assets/') ?>https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
        rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link
        href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css"
        rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css"
        rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/') ?>css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder text-center">Register</h4>
                                    <p class="mb-0 text-center">Silahkan Buat Akunmu Terlebih Dahulu</p>
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url('register') ?>" method="post">
                                        <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                            <?= $this->session->flashdata('error'); ?>
                                            <button type="button" class="btn-close btn-close-light" data-bs-dismiss="alert">X</button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if (validation_errors()): ?>
                                        <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                                            <?= validation_errors(); ?>
                                            <button type="button" class="btn-close btn-close-light" data-bs-dismiss="alert">X</button>
                                        </div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" name="email"
                                                placeholder="Masukkan Email" aria-label="Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" name="password"
                                                placeholder="Masukan Password" aria-label="Password" required min="8">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" name="password2"
                                                placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" required min="8">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" name="nama"
                                                placeholder="Nama Lengkap" aria-label="Nama Lengkap" max="25" required>
                                        </div>
                                        <div class="mb-3">
                                            <select name="jenis_kelamin" class="form-control form-control-lg" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Pria">Laki-laki</option>
                                                <option value="Wanita">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="date" class="form-control form-control-lg" name="tanggal_lahir" aria-label="Tanggal Lahir" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" name="no_telp"
                                                placeholder="Nomor Telepon" aria-label="Nomor Telepon" required>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="alamat" class="form-control form-control-lg" placeholder="Alamat Lengkap" required></textarea>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mb-0">Register</button>
                                        </div>
                                        <p class="text-sm text-end mx-auto mt-2">Sudah punya akun?<a href="<?= site_url('login') ?>"
                                                class="text-primary"> Klik disini</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('<?= base_url('assets/') ?>images/products/product-4.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">“Belanja Mudah, Langkah
                                    Maksimal.”</h4>
                                <p class="text-white position-relative">Temui sepatu yang terbaik untukmu disini!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/') ?>js/core/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/core/bootstraplog.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/') ?>js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>