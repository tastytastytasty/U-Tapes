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
                                            <!-- KIRI: DATA AKUN -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <input type="email" class="form-control form-control-lg"
                                                        name="email" placeholder="Email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="password" placeholder="Password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="password2" placeholder="Konfirmasi Password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control form-control-lg" name="nama"
                                                        placeholder="Nama Lengkap" required>
                                                </div>
                                                <div class="mb-3">
                                                    <select name="jenis_kelamin" class="form-control form-control-lg"
                                                        required>
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="Pria">Laki-laki</option>
                                                        <option value="Wanita">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="date" class="form-control form-control-lg"
                                                        name="tanggal_lahir" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control form-control-lg"
                                                        name="no_telp" placeholder="Nomor Telepon" required>
                                                </div>
                                            </div>

                                            <!-- KANAN: ALAMAT -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <select name="provinsi_id" id="provinsi"
                                                        class="form-control form-control-lg select2" required>
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($provinsi as $p): ?>
                                                            <option value="<?= $p->provinsi_id ?>"><?= $p->nama ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select name="kabupaten_id" id="kabupaten"
                                                        class="form-control form-control-lg select2" required>
                                                        <option value="">Pilih Kabupaten</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select name="kecamatan_id" id="kecamatan"
                                                        class="form-control form-control-lg select2" required>
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select name="kelurahan_id" id="kelurahan"
                                                        class="form-control form-control-lg select2" required>
                                                        <option value="">Pilih Kelurahan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" name="kode_pos"
                                                        class="form-control form-control-lg" placeholder="Kode Pos"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="detail" class="form-control form-control-lg"
                                                        placeholder="Detail Alamat" required
                                                        style="height: 115px;"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- BUTTON TENGAH -->
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
    <script>
        $(document).ready(function () {
            $('.select2').select2({ width: '100%' });

            $('#provinsi').on('change', function () {
                let id = $(this).val();
                console.log('Provinsi:', id);

                $('#kabupaten').html('<option value="">Loading...</option>');
                $.get('<?= site_url("wilayah/get_kabupaten/") ?>' + id, function (data) {
                    $('#kabupaten').html(data).trigger('change.select2');
                    $('#kecamatan').html('<option value="">Pilih Kecamatan</option>').trigger('change.select2');
                    $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').trigger('change.select2');
                });
            });

            $('#kabupaten').on('change', function () {
                let id = $(this).val();
                $('#kecamatan').html('<option value="">Loading...</option>');
                $.get('<?= site_url("wilayah/get_kecamatan/") ?>' + id, function (data) {
                    $('#kecamatan').html(data).trigger('change.select2');
                    $('#kelurahan').html('<option value="">Pilih Kelurahan</option>').trigger('change.select2');
                });
            });

            $('#kecamatan').on('change', function () {
                let id = $(this).val();
                $('#kelurahan').html('<option value="">Loading...</option>');
                $.get('<?= site_url("wilayah/get_kelurahan/") ?>' + id, function (data) {
                    $('#kelurahan').html(data).trigger('change.select2');
                });
            });
        });
    </script>

</body>

</html>