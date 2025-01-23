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
  <link rel="stylesheet" href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
  <link href="plugins/bootstrap-icons-1.5.0/bootstrap-icons.css" rel="stylesheet" />
  <link href="plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <style>

  #datatable thead tr th:not(:nth-child(3)) {
    vertical-align: middle;
  }

  .datepicker.datepicker-dropdown {
    padding: 8px;
  }

  .datepicker-days .table-condensed thead tr th,
  .datepicker-days .table-condensed tbody tr td {
    padding: 5px;
  }

  .actionDiagnosa, .actionDetail {
    padding: 5px;
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
                  <h4 class="card-title">Kunjungan</h4>
                  <p class="card-description"></p>
                  <div class="pull-right">
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-fw" data-fancybox data-src="#popup-barang"><i class="mdi mdi-plus-circle"></i> Tambah</button> -->
                  <?php if ($user_role == 3): ?>
                    <button type="button" class="btn btn-sm btn-primary btn-fw tambahData" data-toggle="modal" data-target="#modal-kunjungan"><i class="mdi mdi-plus-circle"></i> Tambah</button>
                  <?php else: ?>
                    <button type="button" class="btn btn-sm btn-primary btn-fw searchData" data-toggle="modal" data-target="#modal-pencarian"><i class="mdi mdi-search-web"></i> Pencarian</button>
                  <?php endif; ?>
                  </div>
                  <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-striped" width="100%">
                      <thead>
                        <tr>
                          <th class="btn-primary">No.</th>
                          <th class="btn-primary">Aksi</th>
                          <th class="btn-primary">No. Antrian</th>
                          <th class="btn-primary">Waktu</th>
                          <th class="btn-primary">Pasien</th>
                          <th class="btn-primary">Dokter</th>
                        </tr>
                      </thead>
                    </table>
                  </div>

                  <div id="modal-pencarian" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Pencarian</h4>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="margin: 10px 15px">
                          <form id="form-pencarian" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <div class="form-group row">
                                <label for="s_pasien_nama" class="control-label col-sm-4">Nama Pasien</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control form-control-sm freetext" id="s_pasien_nama" placeholder="Nama Pasien" />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="s_jk_created_date" class="control-label col-sm-4">Tanggal Kunjungan</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control form-control-sm datepicker" id="s_jk_created_date" value="<?=date("d-m-Y")?>" />
                                </div>
                              </div>

                            <!-- </div> -->
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-secondary btn-rounded" data-dismiss="modal"><i class="mdi mdi-recycle"></i> Kembali</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="modal-kunjungan" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Kunjungan</h4>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="margin: 10px 15px">
                          <form id="form-kunjungan" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <input type="hidden" id="jk_id" />
                              <input type="hidden" id="jk_pasien_id" value="{{ $pasien_id }}" />
                              <div class="form-group row">
                                <label for="jk_jenis" class="control-label col-sm-4">Jenis Kunjungan</label>
                                <div class="col-sm-6">
                                  <select id="jk_jenis" class="select2 form-control form-control-sm">
                                    <option value=''>--- Pilih Salah Satu ---</option>
                                    <option value='1'>Kunjungan Sehat</option>
                                    <option value='2'>Kunjungan Sakit</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jk_dokter_id" class="control-label col-sm-4">Dokter</label>
                                <div class="col-sm-6">
                                  <select id="jk_dokter_id" class="select2 form-control form-control-sm">
                                    <option value=''>--- Pilih Salah Satu ---</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jk_keluhan" class="control-label col-sm-4">Keluhan</label>
                                <div class="col-sm-6">
                                  <textarea id="jk_keluhan" class="form-control form-control-sm" placeholder="contoh: Flu dalam jangka waktu lama"></textarea>
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

                  <div id="modal-diagnosa" class="modal fade">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4>Kunjungan</h4>
                          <a data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="margin: 10px 15px; max-height: 380px; overflow: auto">
                          <form id="form-diagnosa" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <input type="hidden" id="jk2_id" />
                              <div class="form-group row formInput-jk_diagnosa">
                                <label for="jk_diagnosa" class="control-label col-sm-3">Diagnosa</label>
                                <div class="col-sm-7">
                                  <textarea id="jk_diagnosa" class="form-control form-control-sm" placeholder="Diagnosa"></textarea>
                                </div>
                              </div>
                              <div class="form-group row formInput-jk_resep">
                                <label for="jk_resep" class="control-label col-sm-3">Resep</label>
                                <div class="col-sm-7">
                                  <textarea id="jk_resep" class="form-control form-control-sm" placeholder="Resep"></textarea>
                                </div>
                              </div>
                              <div class="form-group row formInput-jk_rencana_perawatan">
                                <label for="jk_rencana_perawatan" class="control-label col-sm-3">Rencana Perawatan</label>
                                <div class="col-sm-7">
                                  <textarea id="jk_rencana_perawatan" class="form-control form-control-sm" placeholder="Rencana Perawatan"></textarea>
                                </div>
                              </div>

                            <!-- </div> -->
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-primary btn-rounded simpanDiagnosa" onclick="simpanDiagnosa()"><i class="mdi mdi-content-save"></i> Simpan</button>
                          <button type="button" class="btn btn-sm btn-secondary btn-rounded" data-dismiss="modal"><i class="mdi mdi-recycle"></i> Batal</button>
                        </div>
                      </div>
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
  <script src="plugins/jquery/jquery-3.5.1.min.js"></script>
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <!--
  <script src="js/hoverable-collapse.js"></script>
 -->
  <script src="js/off-canvas.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->

  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="plugins/select2/dist/js/select2.min.js"></script>
  <script src="plugins/moment/moment.js"></script>
  <script src="plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="plugins/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
  <script src="plugins/datatables/datatables/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function(e) {
    loadData()
    loadDokter()

    $('.select2').select2()
    $('.datepicker').datepicker({
      "autoclose": true,
      "format": "dd-mm-yyyy",
      "todayHighlight": true
    })
    $('.datetimepicker').datetimepicker({
      "allowInputToggle": true,
      "showClose": true,
      "showClear": true,
      "showTodayButton": true,
      "format": "DD-MM-YYYY HH:mm",
      "minDate": new Date(),
      "disabledHours": [1, 2, 3, 4, 5, 6, 23],
      // "daysOfWeekDisabled": [0]
   })
   $('#modal-diagnosa').find('textarea').wysihtml5({
      "font-styles": false,
      "emphasis": true,
      "lists": true,
      "html": false,
      "blockquote": false
    })
    $('.wysihtml5-toolbar').find('span.glyphicon.glyphicon-list').addClass('bi bi-list-ul')
    $('.wysihtml5-toolbar').find('span.glyphicon.glyphicon-th-list').addClass('bi bi-list-ol')
    $('.wysihtml5-toolbar').find('span.glyphicon.glyphicon-indent-left').addClass('bi bi-text-indent-left')
    $('.wysihtml5-toolbar').find('span.glyphicon.glyphicon-indent-right').addClass('bi bi-text-indent-right')

    $('.tambahData').on('click', function(e) {
      let id = $('#jk_id').val()

      if (id != '')
        clearForm()
    })
  })

  function loadDokter() {
    $.ajax({
      type: "POST",
      url: '/kunjungan/dataDokter',
      data: {},
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // console.log(response)

        let _option = document.createElement('option')

        $.each(response, (i, item) => {
          if (i > 0)
            _option = document.createElement('option')

          _option.innerText = item.dokter_nama
          _option.value = item.dokter_id

          $('#jk_dokter_id').append(_option)
        })
      }
    })
  }

  var timeSearch = null
  function loadData() {
    json_datatable = null;

    var table = $('#datatable').DataTable();

    table.destroy();
    table.clear();
    table.draw();

    let user_role_id = '<?=$user_role?>',
        dokter_id = '<?=$dokter_id?>'

    var timer = null;
    var table = $('#datatable').DataTable({
      initComplete: function() {
        $('#datatable').find('td').addClass('border border-slate-300')
        $('#datatable').find('.paginate_button.current').css('color', '#fff !important')

        // $('#form-search').find('input').on('keyup', function(e) {
        //   clearTimeout(timeSearch)
        //   timeSearch = setTimeout(function() {
        //     if (e.target.value != '')
        //       loadData()
        //   }, 1500)
        // })
      },
      bFilter: true,
      processing: true,
      serverSide: true,
      searching: false,
      lengthChange: true,
      order: [
        [2, "desc"]
      ],
      sAjaxSource: "kunjungan/data",
      fnServerData: function(sSource, aoData, fnCallback) {
        // let s_data = customize({
        //   role: 'search',
        //   target: 'form-search'
        // })
        //

        let s_data = []

        $.each($('#form-pencarian').find('input'), (i, item) => {
          s_data.push({ name: 'sType_'+i, value: item.className.replace('form-control form-control-sm', '').trim() })
          s_data.push({ name: 'sSearch_'+i, value: item.value })
        })

        $.each(s_data, (i, item) => aoData.push(item))

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

            $('#form-pencarian').find('input.freetext').on('keyup', function(e) {
              clearTimeout(timeSearch)
              timeSearch = setTimeout(function() {
                if (e.target.value != '')
                  loadData()
              }, 1500)
            })

            $('#form-pencarian').find('input.datepicker').on('change', function(e) {
              loadData()
            })

            $('#datatable').find('.actionDiagnosa').on('click', function(e) {
              let id = $(this).attr('data-jk')

              $('#jk2_id').val(id)
              $('#modal-diagnosa').find('.simpanDiagnosa').css('display', 'block')
              $('#modal-diagnosa').modal('show')
            })

            $('#datatable').find('.actionHapus').on('click', function(e) {
              let id = $(this).attr('data-jk')

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
                    url: 'kunjungan/hapus',
                    type: 'DELETE',
                    data: { jk_id: id },
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

            $('.actionDetail').on('click', function(e) {
              let id = $(this).attr('data-jk')

              // $('#modal-diagnosa').find('textarea').attr('readonly', true)

              $.ajax({
                url: 'kunjungan/getData',
                type: 'POST',
                data: { jk_id: id },
                dataType: 'JSON',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  // console.log(response)

                  let data = Object.entries(response[0])
                  $.each($('#modal-diagnosa').find('textarea'), (i, item) => {
                    $('#'+item.id).data("wysihtml5").editor.setValue(data[i][1], true)
                    $('#'+item.id).data("wysihtml5").editor.disable()
                  })

                  $('#modal-diagnosa').find('.simpanDiagnosa').css('display', 'none')
                  $('#modal-diagnosa').modal('show')
                }
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

            // _i.className = "mdi mdi-pencil"
            // _a.appendChild(_i)
            // _a.className = "actionUbah btn-primary"
            // _a.dataset.toggle = 'modal'
            // _a.dataset.target = "#modal-kunjungan"
            // _a.dataset.user = data.jk_id
            // _div.appendChild(_a)

            if (data.jk_diagnosa == null && user_role_id == 1 && data.jk_dokter_id == dokter_id)
              (function() {
                _i = document.createElement('i')
                _i.className = "mdi mdi-pencil"
                _a = document.createElement('a')
                _a.appendChild(_i)
                _a.className = "actionDiagnosa btn-primary"
                _a.dataset.jk = data.jk_id
                _div.appendChild(_a)
              }())
            else if (data.jk_diagnosa != null)
              (function() {
                _i = document.createElement('i')
                _i.className = "mdi mdi-eye"
                _a = document.createElement('a')
                _a.appendChild(_i)
                _a.className = "actionDetail btn-secondary"
                _a.dataset.jk = data.jk_id
                _div.appendChild(_a)
              }())

            // _i = document.createElement('i')
            // _i.className = "mdi mdi-delete"
            // _a = document.createElement('a')
            // _a.appendChild(_i)
            // _a.className = "actionHapus btn-danger"
            // _a.dataset.jk = data.jk_id
            // _div.appendChild(_a)
            // _div.style.display = "grid"

            return _div.outerHTML
          }
        },
        { data: 'jk_no_antrian', name: 'jk_no_antrian' },
        { data: 'jk_created_date', name: 'jk_created_date' },
        { data: 'pasien_nama', name: 'pasien_nama' },
        { data: 'dokter_nama', name: 'dokter_nama' }

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
    $.each($('#form-kunjungan').find('select, input, textarea'), (i, item) => {
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'hidden')
        item.value = ''
      else if (item.type == 'select-one')
        $('#' + item.id).val('').trigger('change')
    })
  }

  function simpan() {
    let data = {},
        empty = []

    $.each($('#form-kunjungan').find('select, input, textarea'), (i, item) => {
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'hidden')
        data[item.id] = item.value
      else if (item.type == 'select-one')
        data[item.id] = $('#' + item.id + ' :selected').val()

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    data['jk_created_date'] = '<?=date("Y-m-d H:i:s")?>'

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
          if (empty[0] == 'jk_dokter_id')
            $('#' + empty[0]).select2('open')
          else
            $('#' + empty[0]).focus()}, 500)
      })
    else
      $.ajax({
        url: 'kunjungan/create',
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
              clearForm()

              $('#modal-kunjungan').find('.modal-footer .btn-secondary').click()
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

  function simpanDiagnosa() {
    let data = {},
        empty = []

    $.each($('#form-diagnosa').find('input, textarea'), (i, item) => {
      if (item.type == 'text' || item.type == 'textarea' || item.type == 'hidden')
        data[item.id] = item.value

      if (data[item.id] == '' && item.type != 'hidden')
        empty.push(item.id)
    })

    data['jk_id'] = data['jk2_id']

    delete data['jk2_id']

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
        url: 'kunjungan/create',
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
              // clearForm()

              $('#modal-diagnosa').find('.modal-footer .btn-secondary').click()
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
