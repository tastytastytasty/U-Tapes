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
    <link href="<?= base_url('assets/css/select2.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
        rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link
        href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css"
        rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css"
        rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="<?= base_url('assets/') ?>https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/') ?>css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .select2-container .select2-selection--single {
            height: 48px;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fff;
        }

        .select2-selection__rendered {
            line-height: 30px !important;
            padding-left: 0 !important;
        }

        .select2-selection__arrow {
            height: 46px !important;
        }

        .select2-container--focus .select2-selection--single,
        .select2-container--open .select2-selection--single {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
        }
    </style>
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container ms-0">
                    <div class="row">
                        <div class="col-xl-8 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder text-center">Register</h4>
                                    <p class="mb-0 text-center">Silahkan Buat Akunmu Terlebih Dahulu</p>
                                </div>
                                <div class="card-body">
                                    <form action="<?= site_url('register') ?>" method="post">
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger alert-dismissible fade show text-white"
                                                role="alert">
                                                <?= $this->session->flashdata('error'); ?>
                                                <button type="button" class="btn-close btn-close-light"
                                                    data-bs-dismiss="alert">X</button>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (validation_errors()): ?>
                                            <div class="alert alert-danger alert-dismissible fade show text-white"
                                                role="alert">
                                                <?= validation_errors(); ?>
                                                <button type="button" class="btn-close btn-close-light"
                                                    data-bs-dismiss="alert">X</button>
                                            </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="mb-0">Email</p>
                                                    <input type="email" class="form-control form-control-lg"
                                                        name="email" placeholder="Email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <p class="mb-0">Password</p>
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="password" placeholder="Password" required>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Kode OTP</p>
                                                    <input type="number" class="form-control form-control-lg"
                                                        name="no_telp" placeholder="Kode OTP" required>
                                                </div>
                                                <div class="d-flex justify-content-inline justify-content-between">
                                                    <p class="text-sm text-center mt-3 text-primary">Kirim kode</p>
                                                    <p class="text-sm text-center mt-3 text-primary">Kirim ulang</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="mb-0">Nama Lengkap</p>
                                                    <input type="text" class="form-control form-control-lg" name="nama"
                                                        placeholder="Nama Lengkap" required>
                                                </div>
                                                <div class="mb-3">
                                                    <p class="mb-0">Konfirmasi Password</p>
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="password2" placeholder="Konfirmasi Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary px-5 w-100">Register</button>
                                        </div>
                                        <p class="text-sm text-center mt-3">
                                            Sudah punya akun?
                                            <a href="<?= site_url('login') ?>" class="text-primary">Klik disini</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('<?= base_url('assets/') ?>images/item/item6.jpg');
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
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/') ?>js/core/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/core/bootstraplog.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
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
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>