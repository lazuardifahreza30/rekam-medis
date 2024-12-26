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
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
  #modal-detail .modal-dialog .modal-content .modal-footer button {
    transform: scale(.85);
  }
  </style>
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
                  <h4 class="card-title">Pasien</h4>
                  <p class="card-description"></p>
                  <div class="pull-right">
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-fw" data-fancybox data-src="#popup-barang"><i class="mdi mdi-plus-circle"></i> Tambah</button> -->
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-fw" data-toggle="modal" data-target="#popup-barang"><i class="mdi mdi-plus-circle"></i> Tambah</button> -->
                  </div>
                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-striped" width="100%">
                      <thead>
                        <tr class="btn-primary">
                          <th>No.</th>
                          <th>Aksi</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Tanggal Lahir</th>
                          <th>Alamat</th>
                        </tr>
                      </thead>
                    </table>
                  </div>

                  <div id="popup-barang" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6>Pasien</h6>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow: auto; margin: 10px 15px">
                          <form id="form-barang" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <input type="hidden" id="pasien_id" />
                              <div class="form-group row">
                                <label for="pasien_nama" class="control-label col-sm-4">Nama</label>
                                <div class="col-sm-6">
                                  <input type="text" id="pasien_nama" name="kode_fakultas" class="form-control form-control-sm" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pasien_jenis_kelamin" class="control-label col-sm-4">Jenis Kelamin</label>
                                <div class="col-sm-6">
                                  <label>
                                    <input type="radio" name="pasien_jenis_kelamin" id="pasien_jenis_kelamin_L" class="" value="L" checked />
                                    <span>Laki - laki</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="pasien_jenis_kelamin" id="pasien_jenis_kelamin_P" class="" value="P" />
                                    <span>Perempuan</span>
                                  </label>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pasien_tanggal_lahir" class="control-label col-sm-4">Tanggal Lahir</label>
                                <div class="col-sm-6">
                                  <input type="date" id="pasien_tanggal_lahir" class="form-control form-control-sm" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pasien_alamat" class="control-label col-sm-4">Alamat</label>
                                <div class="col-sm-6">
                                  <textarea id="pasien_alamat" class="form-control form-control-sm"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pasien_no_handphone" class="control-label col-sm-4">No. Handphone</label>
                                <div class="col-sm-6">
                                  <input type="text" id="pasien_no_handphone" name="kode_fakultas" class="form-control form-control-sm" maxlength="13" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="pasien_email" class="control-label col-sm-4">E-mail</label>
                                <div class="col-sm-6">
                                  <input type="text" id="pasien_email" name="kode_fakultas" class="form-control form-control-sm" />
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

                  <div id="modal-detail" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Riwayat Rekam Medis</h4>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="margin: 10px 15px">
                          <div class="form-group row">
                            <label class="col-sm-4 control-label">Nama Pasien</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control form-control-sm" id="pasien_nama" readonly />
                            </div>
                          </div>
                          <div class="table-responsive">
                            <table id="datatable2" class="table table-sm table-bordered table-striped" width="100%">
                              <thead>
                                <tr>
                                  <th class="btn-primary">No.</th>
                                  <th class="btn-primary">Waktu</th>
                                  <th class="btn-primary">Jenis Kunjungan</th>
                                  <th class="btn-primary">Keluhan</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-secondary btn-rounded" data-dismiss="modal"><i class="mdi mdi-recycle"></i> Kembali</button>
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
  <script src="plugins/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
  <script src="plugins/datatables/datatables/js/jquery.dataTables.min.js"></script>
  <script>
  var json_datatable = null, json_datatable2 = null
  $(document).ready(function(e) {
    loadData()
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
      sAjaxSource: "pasien/data",
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
              let id = $(this).attr('data-pasien')

              $.ajax({
                url: 'pasien/getData',
                type: 'POST',
                data: {
                  pasien_id: id
                },
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function(response) {
                  let filter = []
                  let data = Object.entries(response[0])

                  // console.log(data)

                  $.each($('#form-barang').find('input, textarea'), (i, item) => {
                    if (item.type != 'file') {
                      filter = data.filter((item2) => (item2[0] == item.id))

                      // console.log(filter)


                      if (filter.length > 0)
                        item.value = filter[0][1]

                      // if (item.type == 'radio')
                        // $('#'+item.name+'_'+filter[0][1]+'').attr('checked', true)
                    }
                  })

                  // $.each($('#mitra_bkp_id').find('option'), (i, item) => {
                  //   if (item.value == response[0].mitra_bkp_id)
                  //     item.selected = true
                  // })

                  // $('#modal-barang').modal('show')
                }
              })
            })

            $('#datatable').find('.actionDetail').on('click', function(e) {
              // $('#modal-detail').modal('show')

              $('#datatable2').DataTable()
            })

            $('#datatable').find('.actionHapus').on('click', function(e) {
              let id = $(this).attr('data-pasien')

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
                    url: 'pasien/hapus',
                    type: 'DELETE',
                    data: { pasien_id: id },
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
            // _a.dataset.fancybox = ''
            _a.dataset.toggle = 'modal'
            _a.dataset.target = '#popup-barang'
            // _a.dataset.src = "#popup-barang"
            _a.dataset.pasien = data.pasien_id
            _div.appendChild(_a)

            _i = document.createElement('i')
            _i.className = "mdi mdi-eye"
            _a = document.createElement('a')
            _a.appendChild(_i)
            _a.className = "actionDetail btn-secondary"
            _a.dataset.toggle = 'modal'
            _a.dataset.target = '#modal-detail'
            _a.dataset.pasien = data.pasien_id
            _div.appendChild(_a)

            // _i = document.createElement('i')
            // _i.className = "mdi mdi-delete"
            // _a = document.createElement('a')
            // _a.appendChild(_i)
            // _a.className = "actionHapus btn-danger"
            // _a.dataset.pasien = data.pasien_id
            // _div.appendChild(_a)
            // _div.style.display = "grid"

            return _div.outerHTML
          }
        },
        { data: 'pasien_nama', name: 'pasien_nama' },
        { data: 'pasien_jenis_kelamin', name: 'pasien_jenis_kelamin' },
        { data: 'pasien_tanggal_lahir', name: 'pasien_tanggal_lahir' },
        { data: 'pasien_alamat', name: 'pasien_alamat' }
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
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'date' || item.type == 'hidden')
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

    // console.log(data)
    // return false

    if (empty.length > 0)
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
        url: 'pasien/create',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // console.log(response)

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
