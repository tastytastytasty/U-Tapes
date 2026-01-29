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
  <link href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css"
    rel="stylesheet" />
  <link href="<?= base_url('assets/') ?>https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css"
    rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets/') ?>css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/css/sweetalert2.min.css') ?>">
  <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
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
                        <button class="btn btn-primary m-0" type="button" id="togglePassword">
                          <p class="mb-0 text-light" id="toggleText">Lihat</p>
                        </button>
                      </div>
                    </div>

                    <p class="text-sm text-end">
                      <a href="#" class="text-primary">Lupa Password?</a>
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

        $.ajax({
          url: "<?= site_url('login/auth') ?>",
          type: "POST",
          data: $(this).serialize(),
          dataType: "json",
          success: function (res) {
            console.log(res);
            if (res.status) {
              showAlert(res.message, "success");
              setTimeout(() => {
                window.location.href = "<?= site_url('homepage') ?>";
              }, 1000);
            } else {
              showAlert(res.message || "Data tidak terkirim ke server");
            }
          },
          error: function (xhr) {
            console.log(xhr.responseText);
            showAlert("Terjadi kesalahan server");
          }
        });
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
      const text = document.getElementById('toggleText');

      if (input.type === 'password') {
        input.type = 'text';
        text.textContent = 'Tutup';
      } else {
        input.type = 'password';
        text.textContent = 'Lihat';
      }
    });
  </script>

</body>

</html>