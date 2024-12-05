<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rekam Medis</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <!-- <img src="images/logo.svg" alt="logo"> -->
              </div>
              <h4>Rekam Medis Elektronik</h4>
              <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>
              <!-- <h4>Let's get started</h4> -->
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->

              <div id="status-login" style="display: none">
                <label class="alert alert-success mt-3"><span>Berhasil masuk.</span></label>
              </div>
              <form id="form-login" class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="user_username" placeholder="Username" />
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="user_password" id="user_password" placeholder="Password" />
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="login()" href="javascript:;">Masuk</a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <!-- <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label> -->
                  </div>
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <div class="mb-2">
                  <!-- <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button> -->
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Belum memiliki akun? <a href="./registrasi" class="text-primary">Registrasi</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <script>
  $('#user_password').on('keydown', function(e) {
    if (e.keyCode == 13)
      login()
  })

  function login() {
    let data = {},
        empty = []

    $.each($('#form-login').find('input'), (i, item) => {
      if (item.type == 'text' || item.type == 'password')
        data[item.id] = item.value

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    // console.log(data, empty)
    // return false

    $.ajax({
      url: '/signin/login',
      type: 'POST',
      data: data,
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        let _status = $('#status-login')
        if (response.status == 'succ')
          (function() {
            if (_status.find('label').hasClass('alert-danger'))
              _status.find('label').removeClass('alert-danger')

            _status.find('label').addClass('alert-success')
            _status.find('span').html('Berhasil masuk.')
            _status.css('display', 'block')

            setTimeout(function() {
              let path = ''
              switch (response.user_role) {
                case '1':
                  // code...
                  path = '/';
                  break;
                case '2':
                  // code...
                  path = '/pasien';
                  break;
                case '3':
                  // code...
                  path = '/kunjungan';
                  break;

                default:
                  // code...
                  break;
              }

              window.location = '.' + path
            }, 700)
          }())
        else
          (function() {
            if (_status.find('label').hasClass('alert-success'))
              _status.find('label').removeClass('alert-success')

            _status.find('label').addClass('alert-danger')
            _status.find('span').html('Gagal masuk, ' + response.message)
            _status.css('display', 'block')
          }())
      }
    })
  }
  </script>
</body>

</html>
