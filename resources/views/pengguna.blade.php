<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rekam Medis</title>

  <!-- <link href="plugins/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" /> -->
  <link href="plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" />
  <link href="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.css" rel="stylesheet" />
  <link href="plugins/datatables/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- <link href="plugins/tailwindcss/tailwind.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css" />
  <link rel="stylesheet" href="plugins/select2/dist/css/select2.min.css" />
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include("php/header.php"); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include("php/sidebar.php"); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pengguna</h4>
                  <p class="card-description"></p>
                  <div class="pull-right">
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-fw" data-fancybox data-src="#popup-barang"><i class="mdi mdi-plus-circle"></i> Tambah</button> -->
                    <button type="button" class="btn btn-sm btn-primary btn-fw tambahData" data-toggle="modal" data-target="#popup-barang"><i class="mdi mdi-plus-circle"></i> Tambah</button>
                  </div>
                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-striped" width="100%">
                      <thead>
                        <tr class="btn-primary">
                          <th>No.</th>
                          <th>Aksi</th>
                          <th>Nama</th>
                          <th>Jenis</th>
                          <th>Username</th>
                          <th>Password</th>
                        </tr>
                      </thead>
                    </table>
                  </div>

                  <div id="popup-barang" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Pengguna</h4>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow: auto; margin: 10px 15px">
                          <form id="form-barang" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <input type="hidden" id="user_id" />
                              <div class="form-group row">
                                <label for="user_jenis" class="control-label col-sm-4">Jenis</label>
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                  <input type="text" id="user_nama" name="kode_fakultas" class="form-control form-control-sm" maxlength="50" placeholder="contoh: Ridwan" />
                                </div>
                              </div>
                              <div class="identitas">
                              <div class="form-group row">
                                <label for="user_jenis_kelamin" class="control-label col-sm-4">Jenis Kelamin</label>
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                  <input type="date" id="user_tanggal_lahir" class="form-control form-control-sm" maxlength="10" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="user_alamat" class="control-label col-sm-4">Alamat</label>
                                <div class="col-sm-6">
                                  <textarea id="user_alamat" class="form-control form-control-sm" placeholder="Jln. Pajajaran Bandung"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="user_no_handphone" select2 class="control-label col-sm-4">No. Handphone</label>
                                <div class="col-sm-6">
                                  <input type="text" id="user_no_handphone" name="kode_fakultas" class="form-control form-control-sm" maxlength="13" placeholder="contoh: 089643349293" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="user_email" class="control-label col-sm-4">E-mail</label>
                                <div class="col-sm-6">
                                  <input type="text" id="user_email" name="kode_fakultas" class="form-control form-control-sm" placeholder="contoh: ridwan08@gmail.com" />
                                </div>
                              </div>
                            </div>
                              <div class="form-group row">
                                <label for="user_username" class="control-label col-sm-4">Username</label>
                                <div class="col-sm-6">
                                  <input type="text" id="user_username" name="kode_fakultas" class="form-control form-control-sm" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="user_password" class="control-label col-sm-4">Password</label>
                                <div class="col-sm-6">
                                  <input type="password" id="user_password" name="kode_fakultas" class="form-control form-control-sm" maxlength="15" />
                                </div>
                              </div>

                            <!-- </div> -->
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-primary btn-rounded" onclick="simpan()"><i class="mdi mdi-content-save"></i> Simpan</button>
                          <button type="button" class="btn btn-sm btn-secondary btn-rounded" data-dismiss="modal"><i class="mdi mdi-recycle"></i> Batal</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="popup-barang2" style="display: none">
                    <h2>Pasien</h2>

                    <div class="flex items-center justify-end gap-x-6" style="position: relative; top: 25px">

                    </div>
                  </div>


                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->

  <script src="plugins/jquery/jquery-3.5.1.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="plugins/select2/dist/js/select2.min.js"></script>
  <script src="plugins/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
  <script src="plugins/datatables/datatables/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function(e) {
    loadData()

    $('.select2').select2()

    $('.tambahData').on('click', function(e) {
      let id = $('#user_id').val()

      if (id != '')
        (function() {
          clearForm()

          $('#user_jenis').attr('disabled', false)
          $('#user_nama').attr('readonly', false)
        }())

      $('.identitas').css('display', 'block')
    })

    $('#user_nama').on('keydown', function(e) {
      let val = $(this).val()

      if ((e.keyCode > 64 && e.keyCode < 91) || e.keyCode == 32 || e.keyCode == 8)
        return
      else
        return false
    })

    $('#user_no_handphone').on('keydown', function(e) {
      // console.log(e)

      let val = $(this).val()

      if (val.length == 0 && e.keyCode != 48)
        return false
      else if (val.length == 1 && e.keyCode == 8)
        return
      else if (val.length == 1 && e.keyCode != 56)
        return false
      else if ((e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8)
        return
      else
        return false
        // $(this).val(val.substr(0, val.length - 1))
    })
  })

  function loadData() {
    json_datatable = null;

    var table = $('#datatable').DataTable();

    table.destroy();
    table.clear();
    table.draw();

    var timer = null;
    var table = $('#datatable').DataTable({
      initComplete: function() {
        $('#datatable').find('td').addClass('border border-slate-300')
        $('#datatable').find('.paginate_button.current').css('color', '#fff !important')

        $('#form-search').find('input').on('keyup', function(e) {
          clearTimeout(timeSearch)
          timeSearch = setTimeout(function() {
            if (e.target.value != '')
              loadData()
          }, 1500)
        })
      },
      bFilter: true,
      processing: true,
      serverSide: true,
      searching: false,
      lengthChange: true,
      order: [
        [1, "asc"]
      ],
      sAjaxSource: "pengguna/data",
      fnServerData: function(sSource, aoData, fnCallback) {
        // let s_data = customize({
        //   role: 'search',
        //   target: 'form-search'
        // })
        //
        // $.each(s_data, (i, item) => aoData.push(item))

        $.ajax({
          type: "POST",
          url: sSource,
          data: aoData,
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            fnCallback(data)

            json_datatable = data.aaData;

            $('#datatable').find('.actionUbah').on('click', function(e) {
              let id = $(this).attr('data-user')

              $('.identitas').css('display', 'none')
              $('#user_jenis').attr('disabled', true)
              $('#user_nama').attr('readonly', true)

              $.ajax({
                url: 'pengguna/getData',
                type: 'GET',
                data: {
                  user_id: id
                },
                dataType: 'JSON',
                success: function(response) {
                  let filter = []
                  let data = Object.entries(response[0])

                  // console.log(data)

                  $.each($('#form-barang').find('input, select, textarea'), (i, item) => {
                    if (item.type != 'file') {
                      filter = data.filter((item2) => (item2[0] == item.id))

                      // console.log(filter)

                      if (item.type == 'select-one')
                        $('#'+item.id).val(filter[0][1]).trigger('change')

                      if (filter.length > 0)
                        item.value = filter[0][1]
                    }
                  })

                  // $.each($('#user_jenis').find('option'), (i, item) => {
                  //   if (item.value == response[0].user_jenis)
                  //     item.selected = true
                  // })

                  // $.each($('[name="user_jenis_kelamin"]'), (i, item) => {
                  //   if (item.value == response[0].user_jenis_kelamin)
                  //     item.checked = true
                  // })

                  // $('#modal-barang').modal('show')
                }
              })
            })

            $('#datatable').find('.actionHapus').on('click', function(e) {
              let id = $(this).attr('data-user')

              Swal.fire({
        				title: 'Konfirmasi..',
        				html: 'Apakah Anda Yakin, Ingin <b><font color="red">Menghapus</b></font> Data Tersebut?!',
        				icon: 'warning',
        				showCancelButton: true,
        				confirmButtonColor: '#2962FF',
        				cancelButtonColor: '#BBB',
        				confirmButtonText: 'Ya',
        				cancelButtonText: 'Tidak'
              }).then((result) => {
                if (result.value)
                  $.ajax({
                    url: 'pengguna/hapus',
                    type: 'DELETE',
                    data: { user_id: id },
                    dataType: 'JSON',
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                      if (response.status == "succ")
                        Swal.fire({
                          title: 'Success!',
                          html: 'Berhasil menghapus data.<br /><br />',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1500
                        }).then(() => {
                          loadData()
                        })
                      else
                        Swal.fire({
                          title: 'Failed!',
                          html: 'Gagal menghapus data, silakan coba lagi.<br /><br />',
                          icon: 'error',
                          showConfirmButton: false,
                          timer: 5000
                        })
                    }
                  })
              })
            })
          }
        })
      },
      columns: [
        { data: 'no', sortable: false },
        {
          data: null, sortable: false,
          render: function(data) {
            let _div = document.createElement('div'),
            _a = document.createElement('a'),
            _i = document.createElement('i')

            _i.className = "mdi mdi-pencil"
            _a.appendChild(_i)
            _a.className = "actionUbah btn-primary"
            _a.dataset.toggle = 'modal'
            _a.dataset.target = "#popup-barang"
            _a.dataset.user = data.user_id
            _div.appendChild(_a)

            _i = document.createElement('i')
            _i.className = "mdi mdi-delete"
            _a = document.createElement('a')
            _a.appendChild(_i)
            _a.className = "actionHapus btn-danger"
            _a.dataset.user = data.user_id
            _div.appendChild(_a)
            // _div.style.display = "grid"

            return _div.outerHTML
          }
        },
        { data: 'user_nama', name: 'user_nama' },
        { data: null, render: function(data) {
          let val = ''

          switch (data.user_jenis) {
            case '1':
              val = 'Dokter'
              break;
            case '2':
              val = 'Tenaga Medis'
              break;
            case '3':
              val = 'Pasien'
              break;
            default:

          }

          return val
        } },
        { data: 'user_username', name: 'user_username' },
        { data: 'user_password', name: 'user_password' }
      ],
      "dom": '<"pull-left col-md-3 col-sm-3"l><"pull-right mt-10"B>rt<"pull-left col-md-4"i><"pull-right"p>',
      oLanguage: {
  			sLengthMenu: "Menampilkan _MENU_ baris per halaman",
  			sLoadingRecords: 'Silakan Tunggu',
  			sProcessing: "<i class='mdi mdi-refresh mdi-spin'></i> Data Sedang Diproses",
  			sZeroRecords: "Data Tidak Ditemukan",
  			sSearch: "Pencarian Data",
  			sInfo: "Tampil dari _START_ Sampai _END_ Dari _TOTAL_ Baris Data",
        sInfoEmpty: "Tampil dari 0 Sampai 0 Dari 0 Baris Data",
  			oPaginate: {
  				sPrevious: "Sebelumnya",
  				sNext: "Selanjutnya"
  			}
  		},
      fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

      }
    })
  }

  function clearForm() {
    $.each($('#form-barang').find('input, textarea, select'), (i, item) => {
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'date' || item.type == 'password' || item.type == 'hidden')
        item.value = ''
      else if (item.type == 'radio' && item.checked == true)
        item.checked = false
      else if (item.type == 'select-one')
        $.each($('#'+item.id).find('option'), (i2, item2) => {
          if (item2.selected == true) item2.selected = false
        })
    })
  }

  function simpan() {
    let data = {},
        empty = []

    $.each($('#form-barang').find('input, textarea, select'), (i, item) => {
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

    if (val_email)
      Swal.fire({
        title: 'Warning!',
        html: 'Data yang Anda masukkan tidak valid!',
        icon: 'warning',
        showConfirmButton: true,
        confirmButtonColor: '#2962FF',
        allowOutsideClick: false
      }).then(() => {
        setTimeout(() => {
          $('#user_email').focus()}, 500)
      })
    else if (data.user_id == '' && empty.length > 0)
      Swal.fire({
        title: 'Warning!',
        html: 'Ada data yang belum terisi,<br />silakan isi terlebih dahulu.',
        icon: 'warning',
        showConfirmButton: true,
        confirmButtonColor: '#2962FF',
        allowOutsideClick: false
      }).then(() => {
        setTimeout(() => {
          $('#' + empty[0]).focus()}, 500)
      })
    else
      $.ajax({
        url: 'pengguna/create',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log(response)

          if (response.status == 'succ')
            Swal.fire({
              title: 'Success!',
              html: 'Berhasil menyimpan data.',
              icon: 'success',
              showConfirmButton: true,
              confirmButtonColor: '#2962FF',
              allowOutsideClick: false
            }).then(() => {
              loadData()
              clearForm()

              $('#popup-barang').find('.modal-footer .btn-secondary').click()
            })
          else
            Swal.fire({
              title: 'Failed!',
              html: 'Gagal menyimpan data, silakan coba kembali.',
              icon: 'error',
              showConfirmButton: true,
              confirmButtonColor: '#2962FF'
            })
        }
      })
  }
  </script>
</body>

</html>
