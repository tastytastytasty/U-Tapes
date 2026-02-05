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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets/') ?>css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

  input[type="password"]::-ms-reveal,
  input[type="password"]::-ms-clear,
  input[type="password"]::-webkit-credentials-auto-fill-button {
    display: none;
  }
</style>
<div class="preloader d-none" id="resetPreloader">
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
                  <h4 class="font-weight-bolder text-center">Login</h4>
                  <p class="mb-0 text-center">Silahkan Login Terlebih Dahulu</p>
                </div>
                <div class="card-body">
                  <form id="loginForm" action="<?= site_url('login/auth') ?>" method="post">
                    <?php if ($this->session->flashdata('error')): ?>
                      <script>
                        document.addEventListener("DOMContentLoaded", function () {
                          showAlert("<?= addslashes($this->session->flashdata('error')) ?>");
                        });
                      </script>
                    <?php endif; ?>

                    <div class="mb-3">
                      <p class="mb-0">Email / No Telp</p>
                      <input type="text" class="form-control form-control-lg" name="identity"
                        placeholder="Email / No Telp" autocomplete="off" value="<?= set_value('identity') ?>">
                    </div>

                    <div class="mb-3">
                      <p class="mb-0">Password</p>
                      <div class="input-group">
                        <input type="password" class="form-control form-control-lg" name="password" id="passwordInput"
                          placeholder="Password" autocomplete="off" value="<?= set_value('password') ?>">
                        <button class="btn btn-primary m-0 w-15" type="button" id="togglePassword">
                          <i class="fa fa-eye" id="eyeIcon"></i>
                        </button>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="d-flex justify-content-center" style="width: 100%;">
                        <?php echo $widget; ?>
                      </div>
                      <?php echo $script; ?>
                    </div>
                    <p class="text-sm text-end">
                      <button type="button" id="btn-forgot-password" class="btn btn-link p-0">
                        <span id="forgot-password-text">Lupa Password?</span>
                      </button>
                    </p>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary w-100">
                        Login
                      </button>
                    </div>

                    <p class="text-sm text-end mt-2">
                      Belum punya akun?
                      <a href="<?= site_url('register') ?>" class="text-primary">Klik disini</a>
                    </p>

                    <p class="text-sm text-end mt-2">
                      Masuk sebagai
                      <a href="<?= site_url('homepage') ?>" class="text-primary">Tamu</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
            <div
              class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div
                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                style="background-image: url('<?= base_url('assets/') ?>images/item/item1.1.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">“Belanja Mudah, Langkah Maksimal.”</h4>
                <p class="text-white position-relative">Temui sepatu yang terbaik untukmu disini!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <div class="modal fade" id="resetOtpModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Verifikasi Kode Reset</h5>
          <button type="button" class="btn-close text-primary" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body text-center">
          <p>Masukkan kode reset yang dikirim ke email</p>

          <input type="text" id="resetOtpInput" class="form-control text-center mb-3" maxlength="6"
            placeholder="Kode Reset" autocomplete="off">

          <div class="small text-muted mb-2">
            <span id="reset-otp-timer">OTP kadaluarsa dalam 05:00</span>
          </div>

          <button id="btn-verify-reset-otp" class="btn btn-primary w-100 mb-2">Verifikasi</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="newPasswordModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buat Password Baru</h5>
          <button type="button" class="btn-close text-primary" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
          <p class="text-muted">Masukkan password baru Anda</p>

          <div class="mb-3">
            <label>Password Baru</label>
            <div class="input-group">
              <input type="password" id="newPassword" class="form-control form-control-lg"
                placeholder="Minimal 8 karakter" autocomplete="off">
              <button class="btn btn-primary m-0 w-15" type="button" id="toggleNewPassword">
                <i class="fa fa-eye" id="eyeIconNew"></i>
              </button>
            </div>
          </div>

          <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <div class="input-group">
              <input type="password" id="newPassword2" class="form-control form-control-lg"
                placeholder="Ulangi password baru" autocomplete="off">
              <button class="btn btn-primary m-0 w-15" type="button" id="toggleNewPassword2">
                <i class="fa fa-eye" id="eyeIconNew2"></i>
              </button>
            </div>
          </div>
          <button id="btn-reset-password" class="btn btn-primary w-100">Ubah Password</button>
        </div>
      </div>
    </div>
  </div>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        let recaptchaResponse = grecaptcha.getResponse();
        let formData = $(this).serialize();
        formData += '&g-recaptcha-response=' + recaptchaResponse;
        $.ajax({
          url: "<?= site_url('login/auth') ?>",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function (res) {
            console.log(res);
            if (res.status) {
              showAlert(res.message, "success");
              setTimeout(() => {
                window.location.href = "<?= site_url('homepage') ?>";
              }, 1000);
            } else {
              showAlert(res.message, "error");
              grecaptcha.reset();
            }
          },
          error: function (xhr) {
            console.log(xhr.responseText);
            showAlert("Terjadi kesalahan server", "error");
            grecaptcha.reset();
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      let forgotPasswordCooldown = 0;
      let forgotPasswordTimer = null;
      let resetOtpSeconds = 300;
      let resetOtpTimerInterval = null;
      function startForgotPasswordCooldown(seconds) {
        forgotPasswordCooldown = seconds;
        forgotPasswordTimer = setInterval(function () {
          if (forgotPasswordCooldown > 0) {
            $('#forgot-password-text').text(`Kirim Ulang OTP (${forgotPasswordCooldown}s)`);
            forgotPasswordCooldown--;
          } else {
            clearInterval(forgotPasswordTimer);
            $('#forgot-password-text').text('Lupa Password?');
          }
        }, 1000);
      }
      function startResetOtpTimer() {
        resetOtpSeconds = 300;
        clearInterval(resetOtpTimerInterval);
        resetOtpTimerInterval = setInterval(() => {
          resetOtpSeconds--;
          let m = Math.floor(resetOtpSeconds / 60), s = resetOtpSeconds % 60;
          $('#reset-otp-timer').text(`OTP kadaluarsa dalam ${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`);
          if (resetOtpSeconds <= 0) {
            clearInterval(resetOtpTimerInterval);
            $('#reset-otp-timer').text('OTP sudah kadaluarsa');
          }
        }, 1000);
      }
      function clearResetOtpInput() {
        $('#resetOtpInput').val('');
      }
      $('#btn-forgot-password').on('click', function () {
        if (forgotPasswordCooldown > 0) {
          showAlert(`Tunggu ${forgotPasswordCooldown} detik untuk kirim OTP lagi`, 'error');
          const otpModal = new bootstrap.Modal(document.getElementById('resetOtpModal'));
          otpModal.show();
          return;
        }
        let identity = $('input[name="identity"]').val().trim();
        let recaptchaResponse = grecaptcha.getResponse();
        if (!identity) {
          showAlert('Email atau No. Telepon wajib diisi', 'error');
          return;
        }
        $('#resetPreloader').removeClass('d-none');
        $.post("<?= site_url('login/forgot_password_send_otp') ?>", {
          identity: identity,
          'g-recaptcha-response': recaptchaResponse
        }, function (res) {
          $('#resetPreloader').addClass('d-none');
          if (res.status) {
            showAlert(res.message, 'success');
            const otpModal = new bootstrap.Modal(document.getElementById('resetOtpModal'));
            otpModal.show();
            startResetOtpTimer();
            startForgotPasswordCooldown(60);
          } else {
            showAlert(res.message, 'error');
            grecaptcha.reset();
          }
        }, 'json').fail(function () {
          $('#resetPreloader').addClass('d-none');
          showAlert('Gagal menghubungi server', 'error');
        });
      });
      $('#btn-verify-reset-otp').on('click', function () {
        let identity = $('input[name="identity"]').val().trim();
        let otp = $('#resetOtpInput').val().trim();

        if (!otp) {
          showAlert('Masukkan kode reset', 'error');
          return;
        }

        $('#resetPreloader').removeClass('d-none');

        $.post("<?= site_url('login/forgot_password_verify_otp') ?>", {
          identity: identity,
          otp: otp
        }, function (res) {
          $('#resetPreloader').addClass('d-none');

          if (res.status) {
            showAlert(res.message, 'success');
            clearResetOtpInput();
            bootstrap.Modal.getInstance(document.getElementById('resetOtpModal')).hide();
            const newPassModal = new bootstrap.Modal(document.getElementById('newPasswordModal'));
            newPassModal.show();
          } else {
            showAlert(res.message, 'error');
            clearResetOtpInput();
          }
        }, 'json').fail(function () {
          $('#resetPreloader').addClass('d-none');
          showAlert('Gagal menghubungi server', 'error');
        });
      });
      $('#btn-reset-password').on('click', function () {
        let password = $('#newPassword').val();
        let password2 = $('#newPassword2').val();
        if (!password || !password2) {
          showAlert('Password wajib diisi', 'error');
          return;
        }
        if (password !== password2) {
          showAlert('Konfirmasi password tidak sama', 'error');
          return;
        }
        if (password.length < 8) {
          showAlert('Password minimal 8 karakter', 'error');
          return;
        }
        $('#resetPreloader').removeClass('d-none');
        $.post("<?= site_url('login/reset_password') ?>", {
          password: password,
          password2: password2
        }, function (res) {
          $('#resetPreloader').addClass('d-none');
          if (res.status) {
            showAlert(res.message, 'success');
            bootstrap.Modal.getInstance(document.getElementById('newPasswordModal')).hide();
            setTimeout(function () {
              window.location.href = "<?= site_url('login') ?>";
            }, 1500);
          } else {
            showAlert(res.message, 'error');
          }
        }, 'json').fail(function () {
          $('#resetPreloader').addClass('d-none');
          showAlert('Gagal menghubungi server', 'error');
        });
      });
      $('#toggleNewPassword').on('click', function () {
        const input = $('#newPassword');
        const icon = $('#eyeIconNew');
        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
      $('#toggleNewPassword2').on('click', function () {
        const input = $('#newPassword2');
        const icon = $('#eyeIconNew2');
        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
      $('#resetOtpModal').on('hidden.bs.modal', function () {
        clearResetOtpInput();
        clearInterval(resetOtpTimerInterval);
      });

      $('#newPasswordModal').on('hidden.bs.modal', function () {
        clearInterval(forgotPasswordTimer);
        $('#forgot-password-text').text('Lupa Password?');
        $('#btn-forgot-password').prop('disabled', false);
        forgotPasswordCooldown = 0;
      });
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
    document.getElementById('togglePassword').addEventListener('click', function () {
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('eyeIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  </script>

</body>

</html>