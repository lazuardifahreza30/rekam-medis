<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rekam Medis</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link href="plugins/datatables/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <style>
  .modal-footer a.btn-sm.btn-secondary {
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pengaturan</h4>
                  <p class="card-description"></p>

                  <form id="form-user" class="forms-user">
                    <div class="form-group row">
                      <label for="user_nama" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="user_nama" placeholder="Nama" readonly />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="user_email" placeholder="Email" readonly />
                      </div>
                    </div>
                    <div class="form-group row formInput-user_no_handphone">
                      <label for="user_no_handphone" class="col-sm-3 col-form-label">No. Handphone</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="user_no_handphone" placeholder="No. Handphone" readonly />
                        <a href="javaScript:;" onclick="showNoVerifikasi()" style="color: #000; font-size: 12px">Ganti No. Handphone</a>
                        <br />
                        <!-- <button type="button" class="btn btn-primary mr-2">Simpan</button> -->
                      </div>
                    </div>
                    <div class="form-group row formInput-no_verifikasi">
                      <label for="user_no_verifikasi" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="user_no_verifikasi" placeholder="No. Verifikasi" maxlength="5" />
                        <a href="javaScript:;" style="color: #000; font-size: 12px" onclick="generateNoVerifikasi()">Minta No. Verifikasi</a>
                        <br />
                        <span id="countdown_no_verifikasi" style="font-size: 12px"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-9">
                        <button type="button" class="btn btn-primary mr-2">Simpan</button>
                      </div>
                    </div>
                  </form>

                  <?php if ($user_role == 3): ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Riwayat Rekam Medis</h5>

                    <div id="modal-detail" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5>Detail Pemeriksaan</h5>
                            <a data-dismiss="modal">&times;</a>
                          </div>
                          <div class="modal-body" style="margin: 10px 15px">
                            <form>
                              <div class="form-group row">
                                <label for="jk_diagnosa" class="col-sm-4">Diagnosa</label>
                                <div class="col-sm-8">
                                  <textarea id="jk_diagnosa" class="form-control form-control-sm"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jk_resep" class="col-sm-4">Resep</label>
                                <div class="col-sm-8">
                                  <textarea id="jk_resep" class="form-control form-control-sm"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="jk_rencana_perawatan" class="col-sm-4">Rencana Perawatan</label>
                                <div class="col-sm-8">
                                  <textarea id="jk_rencana_perawatan" class="form-control form-control-sm"></textarea>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <a class="btn btn-sm btn-secondary" href="javascript:;" data-dismiss="modal"><i class="mdi mdi-recycle"></i> Kembali</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="datatable" class="table table-bordered table-striped" width="100%">
                        <thead>
                          <tr>
                            <th class="btn-primary">No.</th>
                            <th class="btn-primary">Aksi</th>
                            <th class="btn-primary">Waktu</th>
                            <th class="btn-primary">Jenis Kunjungan</th>
                            <th class="btn-primary">Keluhan</th>
                            <th class="btn-primary">Dokter</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024</span>
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
  <script src="../../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="../../js/file-upload.js"></script> -->
  <!-- End custom js for this page-->
  <script src="plugins/datatables/datatables/js/jquery.dataTables.min.js"></script>
  <script>
  var json_datatable = null
  $(document).ready(function(e) {
    loadData()

    $('.formInput-no_verifikasi').css('display', 'none')
  })

  var intervalNoVerifikasi = null
  function generateNoVerifikasi() {
    let no_verifikasi = Math.floor((Math.random() * 99999))

    $('#user_no_verifikasi').val(no_verifikasi)

    let countdown = 60;

    clearInterval(intervalNoVerifikasi)
    intervalNoVerifikasi = setInterval(function() {
      if (countdown >= 0)
        (function() {
          $('#countdown_no_verifikasi').html(countdown == 0? 'Waktu Habis, silakan minta nomor verifikasi lagi.' : countdown)

          countdown--
        }())
      else
        clearInterval(intervalNoVerifikasi)
    }, 1000)
  }

  function showNoVerifikasi() {
    $('#user_no_handphone').attr('readonly', false)
    $('.form-group.row:not(.formInput-user_no_handphone)').css('display', 'none')
  }

  function loadData() {
    json_datatable = null;

    // if (!$('#datatable'))
    //   console.log('tidak ada')

    let user_role = '<?=$user_role?>'

    if (user_role != 3)
      $.ajax({
        url: 'pengaturan/dataPribadi',
        type: 'POST',
        data: {},
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // console.log(response)

          let data = Object.entries(response.pengguna[0])
          $.each($('#form-user').find('input'), (i, item) => {
            item.value = data[i][1]
          })
        }
      })

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
        [2, "desc"]
      ],
      sAjaxSource: "pengaturan/data",
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

            json_datatable = data.aaData

            let pengguna = Object.entries(data.pengguna[0])
            $.each($('#form-user').find('input'), (i, item) => {
              if (item.type == 'text' || item.type == 'email')
                item.value = pengguna[i][1]
            })

            $('.actionDetail').on('click', function(e) {
              let id = $(this).attr('data-jk')

              $.ajax({
                url: 'pengaturan/getDetail',
                type: 'POST',
                data: { jk_id: id },
                dataType: 'JSON',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  // console.log(response)

                  let data = Object.entries(response[0])
                  $.each($('#modal-detail').find('textarea'), (i, item) => {
                    item.value = data[i][1]
                  })

                  $('#modal-detail').find('textarea').attr('readonly', true)
                  $('#modal-detail').modal('show')
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

            _i.className = "mdi mdi-eye"
            _a.appendChild(_i)
            _a.className = "actionDetail btn-primary"
            _a.dataset.jk = data.jk_id
            _div.appendChild(_a)
            // _div.style.display = "grid"

            return _div.outerHTML
          }
        },
        { data: 'jk_created_date', name: 'jk_created_date' },
        { data: 'jk_jenis', name: 'jk_jenis' },
        { data: 'jk_keluhan', name: 'jk_keluhan' },
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
  </script>
</body>

</html>
