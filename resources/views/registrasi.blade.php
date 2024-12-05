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
  <link rel="stylesheet" href="plugins/select2/dist/css/select2.min.css" />
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
              <h6 class="font-weight-light">Registrasi.</h6>
              <!-- <h4>Let's get started</h4> -->
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->

              <form id="form-registrasi" class="pt-3">
                <div class="form-group row">
                  <label for="user_jenis" class="control-label col-sm-4">Jenis Pengguna</label>
                  <div class="col-sm-7">
                    <select id="user_jenis" name="kode_fakultas" class="select2 form-control form-control-sm">
                      <option>--- Pilih Salah Satu ---</option>
                      <option value='1'>Dokter</option>
                      <option value='2'>Tenaga Medis</option>
                      <option value='3'>Pasien</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_nama" class="control-label col-sm-4">Nama</label>
                  <div class="col-sm-7">
                    <input type="text" id="user_nama" name="kode_fakultas" class="form-control form-control-sm" maxlength="50" placeholder="contoh: Ridwan" />
                  </div>
                </div>
                <div class="identitas">
                <div class="form-group row">
                  <label for="user_jenis_kelamin" class="control-label col-sm-4">Jenis Kelamin</label>
                  <div class="col-sm-7">
                    <label>
                      <input type="radio" name="user_jenis_kelamin" id="col-sm-6en_jenis_kelamin_L" class="" value="L" checked />
                      <span>Laki - laki</spanselect2 >
                    </label>
                    <label>
                      <input type="radio" name="user_jenis_kelamin" id="user_jenis_kelamin_P" class="" value="P" />
                      <span>Perempuan</span>
                    </label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_tanggal_lahir" class="control-label col-sm-4">Tanggal Lahir</label>
                  <div class="col-sm-7">
                    <input type="date" id="user_tanggal_lahir" class="form-control form-control-sm" maxlength="10" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_alamat" class="control-label col-sm-4">Alamat</label>
                  <div class="col-sm-7">
                    <textarea id="user_alamat" class="form-control form-control-sm" placeholder="Jln. Pajajaran Bandung"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_no_handphone" select2 class="control-label col-sm-4">No. Handphone</label>
                  <div class="col-sm-7">
                    <input type="text" id="user_no_handphone" name="kode_fakultas" class="form-control form-control-sm" maxlength="13" placeholder="contoh: 089643349293" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_email" class="control-label col-sm-4">E-mail</label>
                  <div class="col-sm-7">
                    <input type="text" id="user_email" name="kode_fakultas" class="form-control form-control-sm" placeholder="contoh: ridwan08@gmail.com" />
                  </div>
                </div>
              </div>
                <div class="form-group row">
                  <label for="user_username" class="control-label col-sm-4">Username</label>
                  <div class="col-sm-7">
                    <input type="text" id="user_username" name="kode_fakultas" class="form-control form-control-sm" placeholder="Username" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="user_password" class="control-label col-sm-4">Password</label>
                  <div class="col-sm-6">
                    <input type="password" id="user_password" name="kode_fakultas" class="form-control form-control-sm" placeholder="Password" maxlength="15" />
                  </div>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="registrasi()" href="javascript:;">Registrasi</a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check"></div>
                </div>
                <div class="mb-2">
                </div>
              </form>
              <div id="status-registrasi" style="display: none">
                <label class="alert alert-success mt-3"><span>Berhasil masuk.</span></label>
              </div>
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

  <script src="plugins/select2/dist/js/select2.min.js"></script>
  <script>
  $(document).ready(function(e) {
    $('.select2').select2()
  })

  $('#user_password').on('keydown', function(e) {

    if (e.keyCode == 13)
      registrasi()
  })

  function registrasi() {
    let data = {},
        empty = []

    $.each($('#form-registrasi').find('input, textarea, select'), (i, item) => {
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'date' || item.type == 'password' || item.type == 'hidden')
        data[item.id] = item.value
      else if (item.type == 'radio' && item.checked == true)
        data[item.name] = item.value
      else if (item.type == 'select-one')
        $.each($('#'+item.id).find('option'), (i2, item2) => {
          if (item2.selected == true) data[item.id] = item.value
        })

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    let val_akun = (data.user_id != '' &&
                    (data.user_username == '' || data.user_password == '')),
        val_email = (data.user_email.split('@').length == 1)

    // console.log(data)
    // return false

    $.ajax({
      url: '/pengguna/create',
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
              window.location = './signin'
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
