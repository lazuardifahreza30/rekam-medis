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
              <h6 class="font-weight-light"></h6>
              <!-- <h4>Let's get started</h4> -->
              <h6 class="font-weight-light">Ganti Password.</h6>

              <div id="status-change_password" style="display: none">
                <label class="alert alert-success mt-3"><span>Berhasil mengganti password.</span></label>
              </div>
              <form id="form-change_password" class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-md" id="user_username" placeholder="Username atau E-mail" />
                </div>
                <div class="formInput-password">
                  <div class="form-group input-group">
                    <input type="password" class="form-control form-control-md" id="user_password" placeholder="Password" />
                    <div class="input-group-prepend bg-transparent generatePassword" style="cursor: pointer">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-recycle text-primary"></i>
                      </span>
                    </div>
                    <div class="input-group-prepend bg-transparent showPassword" style="cursor: pointer">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-eye text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <div class="form-group input-group">
                    <input type="password" class="form-control form-control-md" id="user_re_password" placeholder="Re Password" />
                    <div class="input-group-prepend bg-transparent showPassword" style="cursor: pointer">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-eye text-primary"></i>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="user_no_verifikasi" placeholder="No. Verifikasi" maxlength="5" />
                    <input type="hidden" id="no_verifikasi" />
                    <a href="javaScript:;" style="color: #000; font-size: 12px" onclick="generateNoVerifikasi()">Minta No. Verifikasi</a>
                    <br />
                    <span id="countdown_no_verifikasi" style="font-size: 30px"></span>
                  </div>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-md melanjutkan" onclick="periksaAkun()" href="javascript:;">Lanjutkan</a>
                  <a class="btn btn-block btn-primary btn-md gantiPassword" onclick="gantiPassword()" href="javascript:;">Ganti Password</a>
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
  $(document).ready(function(e) {
    $('.formInput-password, .gantiPassword').css('display', 'none')

    $('#user_re_password').on('keydown', function(e) {
      if (e.keyCode == 13)
        gantiPassword()
    })

    $('.showPassword').on('click', function(e) {
      let attr = $(this).parent().find('input').attr('type')

      $(this).parent().find('input').attr('type', attr == 'text'? 'password' : 'text')
      $(this).find('i').removeClass(attr == 'text'? 'mdi-eye-off' : 'mdi-eye')
      $(this).find('i').addClass(attr == 'text'? 'mdi-eye' : 'mdi-eye-off')
    })

    $('.generatePassword').on('click', function(e) {
      let karakter = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
                      'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                      '!', '@', '#', '$', '_', '|', '0', '1', '2', '3', '4', '5', '6',
                      '7', '8', '9'],
          password = ''

      for (let i = 0; i < 10; i++)
        (function() {
          password += typeof karakter[Math.floor((Math.random() * 41))] == "number"?
                      karakter[Math.floor((Math.random() * 41))] : (
                      Math.floor((Math.random() * 2)) == 2?
                        karakter[Math.floor((Math.random() * 41)).toUpperCase()] :
                        karakter[Math.floor((Math.random() * 41))]
                      )
        }())

      $('#user_password').val(password)
    })
  })

  function periksaAkun() {
    let data = {},
        empty = []

    $.each($('#form-change_password').find('input'), (i, item) => {
      if (item.type == 'text')
        data[item.id] = item.value

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    // console.log(data, empty)
    // return false

    $.ajax({
      url: '/signin/periksaAkun',
      type: 'POST',
      data: data,
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        let _status = $('#status-change_password')
        if (response.status == 'succ')
          (function() {
            if (_status.find('label').hasClass('alert-danger'))
              _status.find('label').removeClass('alert-danger')

            _status.find('label').addClass('alert-success')
            _status.find('label span').html('Akun ditemukan.')
            _status.css('display', 'block')

            $('.melanjutkan').css('display', 'none')
            $('.formInput-password, .gantiPassword').css('display', 'block')
          }())
        else
          (function() {
            if (_status.find('label').hasClass('alert-success'))
              _status.find('label').removeClass('alert-success')

            _status.find('label').addClass('alert-danger')
            _status.find('label span').html('Akun tidak ditemukan.')
            _status.css('display', 'block')
          }())
      }
    })
  }

  var intervalNoVerifikasi = null
  function generateNoVerifikasi() {
    let no_verifikasi = Math.floor((Math.random() * 99999))

    $('#no_verifikasi').val(no_verifikasi)

    $.ajax({
      url: 'signin/kirimEmail',
      type: 'POST',
      data: {
        no_verifikasi: no_verifikasi,
        user_username: $('#user_username').val()
      },
      dataType: 'JSON',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        console.log(response)
      }
    })

    let countdown = 60;

    clearInterval(intervalNoVerifikasi)
    intervalNoVerifikasi = setInterval(function() {
      if (countdown >= 0)
        (function() {
          $('#countdown_no_verifikasi').css('font-size', countdown == 0? '12px' : '30px')
          $('#countdown_no_verifikasi').html(countdown == 0? 'Waktu Habis, silakan minta nomor verifikasi lagi.' : countdown)

          countdown--
        }())
      else
        clearInterval(intervalNoVerifikasi)
    }, 1000)
  }

  function gantiPassword() {
    let data = {},
        empty = [],
        condPasswordEmpty = $('#user_password').val() == '',
        condPassword = $('#user_password').val() != $('#user_re_password').val(),
        condNoVerifikasiEmpty = $('#no_verifikasi').val() == '',
        condNoVerifikasi = $('#user_no_verifikasi').val() != $('#no_verifikasi').val(),
        _status = $('#status-change_password')

    $.each($('#form-change_password').find('input'), (i, item) => {
      if (item.type == 'text' || item.type == 'password')
        data[item.id] = item.value

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    // console.log(data, empty)
    // return false

    if (condPasswordEmpty)
      (function() {
        _status.find('label').removeClass('alert-success')
        _status.find('label').addClass('alert-warning')
        _status.find('span').html('Anda belum mengisi Password, silakan isi password terlebih dahulu!')
        // _status.css('display', 'block')

        $('#' + empty[0]).focus()
      }())
    else if (condPassword)
      (function() {
        _status.find('label').removeClass('alert-success')
        _status.find('label').addClass('alert-warning')
        _status.find('span').html('Pastikan isi Password dan Re-Password sama, silakan isi kembali!')
        _status.css('display', 'block')

        $('#' + empty[0]).focus()
      }())
    else if (condNoVerifikasiEmpty)
      (function() {
        _status.find('label').removeClass('alert-success')
        _status.find('label').addClass('alert-warning')
        _status.find('span').html('Anda belum mendapatkan no. verifikasi, silakan klik <b>Minta No. Verifikasi</b> untuk mendapatkan no. verifikasi!')
        _status.css('display', 'block')

        $('#' + empty[0]).focus()
      }())
    else if (condNoVerifikasi)
      (function() {
        _status.find('label').removeClass('alert-success')
        _status.find('label').addClass('alert-warning')
        _status.find('span').html('No. verifikasi yang Anda masukkan <b>tidak sesuai</b>, silakan masukkan no. verifikasi yang Anda dapatkan dari E-mail!')
        _status.css('display', 'block')

        $('#' + empty[0]).focus()
      }())
    else
      $.ajax({
        url: '/signin/gantiPassword',
        type: 'POST',
        data: data,
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.status == 'succ')
            (function() {
              if (_status.find('label').hasClass('alert-warning'))
                _status.find('label').removeClass('alert-warning')

              _status.find('label').addClass('alert-success')
              _status.find('span').html('Berhasil mengganti password.')
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
                    path = '/pengguna';
                    break;
                  case '3':
                    // code...
                    path = '/kunjungan';
                    break;

                  default:
                    // code...
                    break;
                }

                window.location = '/signin'
              }, 2000)
            }())
          else
            (function() {
              if (_status.find('label').hasClass('alert-success'))
                _status.find('label').removeClass('alert-success')

              _status.find('label').addClass('alert-danger')
              _status.find('span').html('Gagal masuk, silakan periksa jaringan internet Anda, pastikan sudah terhubung ke jaringan internet dan silakan coba lagi.')
              _status.css('display', 'block')
            }())
        }
      })
  }
  </script>
</body>

</html>
