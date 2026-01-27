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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
</head>
<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.2);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preloader-inner {
        width: 50px;
        height: 50px;
    }

    .preloader-icon span {
        position: absolute;
        width: 40px;
        height: 40px;
        border: 4px solid #0d6efd;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .preloader-icon span:last-child {
        animation-delay: -0.5s;
    }

    @keyframes spin {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(0.3);
            opacity: 0;
        }
    }
</style>
<div class="preloader d-none" id="otpPreloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>

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
                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    showAlert("<?= addslashes($this->session->flashdata('error')) ?>", "error");
                                                });
                                            </script>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", () => {
                                                    showAlert("<?= addslashes($this->session->flashdata('success')) ?>", "success");
                                                });
                                            </script>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <p class="mb-0">Email</p>
                                            <input type="text" class="form-control form-control-lg" name="email"
                                                id="emailInput" placeholder="Email" value="<?= set_value('email') ?>"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <p class="mb-0">Nama Lengkap</p>
                                            <input type="text" class="form-control form-control-lg" name="nama"
                                                placeholder="Nama Lengkap" value="<?= set_value('nama') ?>"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <p class="mb-0">Password</p>
                                            <input type="password" class="form-control form-control-lg" name="password"
                                                min="8" placeholder="Password" value="<?= set_value('password') ?>"
                                                autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <p class="mb-0">Konfirmasi Password</p>
                                            <input type="password" class="form-control form-control-lg" name="password2"
                                                placeholder="Konfirmasi Password" value="<?= set_value('password2') ?>"
                                                autocomplete="off">
                                            <input type="hidden" name="otp" id="otpHidden">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="btn-send-otp"
                                                class="btn btn-none text-primary p-0"
                                                style="box-shadow: none; font-weight: normal">
                                                Kirim Kode OTP
                                            </button>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary px-5 w-100">Register</button>
                                        </div>
                                        <p class="text-sm text-end">
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
    <div class="modal fade" id="otpModal" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi OTP</h5>
                    <button type="button" class="btn-close text-primary" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body text-center">
                    <p>Masukkan kode OTP yang dikirim ke email</p>
                    <input type="text" id="otpInput" class="form-control text-center mb-3" maxlength="6"
                        placeholder="Kode OTP" autocomplete="off">

                    <div class="small text-muted mb-2">
                        OTP kadaluarsa dalam <span id="otp-timer">05:00</span>
                    </div>

                    <button id="btn-verify-otp" class="btn btn-primary w-100 mb-2">Verifikasi</button>
                    <button id="btn-resend-otp" class="btn btn-link p-0">Kirim Ulang</button>
                </div>
            </div>
        </div>
    </div>
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
        let otpTimerInterval, otpSeconds = 300;
        function startOtpTimer() {
            otpSeconds = 300; clearInterval(otpTimerInterval);
            otpTimerInterval = setInterval(() => {
                otpSeconds--;
                let m = Math.floor(otpSeconds / 60), s = otpSeconds % 60;
                $('#otp-timer').text(`${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`);
                if (otpSeconds <= 0) { clearInterval(otpTimerInterval); $('#otp-timer').text('Kadaluarsa'); }
            }, 1000);
        }
        $('form').on('submit', function (e) {
            if (!otpVerified) {
                e.preventDefault();
                showAlert("Silakan verifikasi OTP terlebih dahulu", "error");
                return false;
            }
        });
        $('#btn-send-otp').on('click', function () {
            let email = $('#emailInput').val().trim();
            if (!email) {
                showAlert("Email wajib diisi", "warning");
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showAlert("Format email tidak valid", "error");
                return;
            }

            $('#otpPreloader').removeClass('d-none');

            $.ajax({
                url: "<?= site_url('register/send_otp') ?>",
                type: "POST",
                data: { email: email },
                dataType: "json",
                success: function (res) {
                    $('#otpPreloader').addClass('d-none');

                    if (res.status) {
                        const modal = new bootstrap.Modal(document.getElementById('otpModal'));
                        modal.show();
                        startOtpTimer();
                        showAlert("OTP dikirim ke email", "success");
                    } else {
                        showAlert(res.message, "error");
                    }
                },
                error: function () {
                    $('#otpPreloader').addClass('d-none');
                    showAlert("Gagal menghubungi server", "error");
                }
            });
        });

        $('#btn-resend-otp').on('click', () => $('#btn-send-otp').click());
        let otpVerified = false;
        $('#btn-verify-otp').on('click', function () {
            let otp = $('#otpInput').val().trim();
            let email = $('#emailInput').val().trim();
            if (!otp) return showAlert('Masukkan kode OTP', 'error');

            $.post("<?= site_url('register/verify_otp') ?>", { email, otp }, res => {
                if (res.status) {
                    otpVerified = true;
                    $('#otpHidden').val(otp);
                    showAlert(res.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('otpModal')).hide();
                } else showAlert(res.message, 'error');
            }, 'json').fail(() => showAlert('Gagal menghubungi server', 'error'));
        });
    </script>
    <script>
        function showAlert(message, type = 'error') {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: type,
                title: message,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        }
    </script>
</body>

</html>