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
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <!-- <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../images/logo.svg" alt="logo"/></a> -->
          <!-- <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../images/logo-mini.svg" alt="logo"/></a> -->
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../../images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../../images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="../../images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-book menu-icon"></i>
              <span class="menu-title">Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="./pengguna">Pengguna</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Dokter</a></li>
                <li class="nav-item"> <a class="nav-link" href="./tenaga-medis">Tenaga Medis</a></li>
                <li class="nav-item"> <a class="nav-link" href="./pasien">Pasien</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/forms/basic_elements.html">
              <i class="mdi mdi-calendar menu-icon"></i>
              <span class="menu-title">Jadwal Kunjungan</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Dokter</h4>
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
                          <h6>Dokter</h6>
                          <a class="close" data-dismiss="modal">&times;</a>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow: auto; margin: 10px 15px">
                          <form id="form-barang" class="skin-default custom-scrollbar">
                            <!-- <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12"> -->
                              <input type="hidden" id="dokter_id" />
                              <div class="sm:col-span-12">
                                <label for="dokter_nama" class="block text-sm font-medium leading-6 text-gray-900">Nama</label>
                                <div class="mt-2">
                                  <input type="text" id="dokter_nama" name="kode_fakultas" class="form-control" />
                                </div>
                              </div>
                              <div class="sm:col-span-12">
                                <label for="dokter_jenis_kelamin" class="block text-sm font-medium leading-6 text-gray-900">Jenis Kelamin</label>
                                <div class="mt-2">
                                  <label>
                                    <input type="radio" name="dokter_jenis_kelamin" id="dokter_jenis_kelamin_L" class="" value="L" checked />
                                    <span>Laki - laki</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="dokter_jenis_kelamin" id="dokter_jenis_kelamin_P" class="" value="P" />
                                    <span>Perempuan</span>
                                  </label>
                                </div>
                              </div>
                              <div class="sm:col-span-12">
                                <label for="dokter_tanggal_lahir" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Lahir</label>
                                <div class="mt-2">
                                  <input type="date" id="dokter_tanggal_lahir" class="form-control" />
                                </div>
                              </div>
                              <div class="sm:col-span-12">
                                <label for="dokter_alamat" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                                <div class="mt-2">
                                  <textarea id="dokter_alamat" class="form-control"></textarea>
                                </div>
                              </div>
                              <div class="sm:col-span-12">
                                <label for="dokter_no_handphone" class="block text-sm font-medium leading-6 text-gray-900">No. Handphone</label>
                                <div class="mt-2">
                                  <input type="text" id="dokter_no_handphone" name="kode_fakultas" class="form-control" maxlength="13" />
                                </div>
                              </div>
                              <div class="sm:col-span-12">
                                <label for="dokter_email" class="block text-sm font-medium leading-6 text-gray-900">E-mail</label>
                                <div class="mt-2">
                                  <input type="text" id="dokter_email" name="kode_fakultas" class="form-control form-control-sm" />
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
                    <h2>Dokter</h2>

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
  <script src="plugins/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
  <script src="plugins/datatables/datatables/js/jquery.dataTables.min.js"></script>
  <script>
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
      sAjaxSource: "dokter/data",
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
              let id = $(this).attr('data-dokter')

              $.ajax({
                url: 'dokter/getData',
                type: 'GET',
                data: {
                  dokter_id: id
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

                  // console.log(response[0])

                  $.each($('[name="dokter_jenis_kelamin"]'), (i, item) => {
                    if (item.value == response[0].dokter_jenis_kelamin)
                      item.checked = true
                  })

                  // $('#modal-barang').modal('show')
                }
              })
            })

            $('#datatable').find('.actionHapus').on('click', function(e) {
              let id = $(this).attr('data-dokter')

              $.ajax({
                url: 'dokter/hapus',
                type: 'POST',
                data: { dokter_id: id },
                dataType: 'JSON',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  if (response.status == "succ")
                    loadData()
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

            _i.className = "mdi mdi-pencil"
            _a.appendChild(_i)
            _a.className = "actionUbah btn-primary"
            // _a.dataset.fancybox = ''
            _a.dataset.toggle = 'modal'
            _a.dataset.target = '#popup-barang'
            // _a.dataset.src = "#popup-barang"
            _a.dataset.dokter = data.dokter_id
            _div.appendChild(_a)

            _i = document.createElement('i')
            _i.className = "mdi mdi-delete"
            _a = document.createElement('a')
            _a.appendChild(_i)
            _a.className = "actionHapus btn-danger"
            _a.dataset.dokter = data.dokter_id
            _div.appendChild(_a)
            // _div.style.display = "grid"

            return _div.outerHTML
          }
        },
        { data: 'dokter_nama', name: 'dokter_nama' },
        { data: 'dokter_jenis_kelamin', name: 'dokter_jenis_kelamin' },
        { data: 'dokter_tanggal_lahir', name: 'dokter_tanggal_lahir' },
        { data: 'dokter_alamat', name: 'dokter_alamat' }
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
      console.log(empty)
    else
      $.ajax({
        url: 'dokter/create',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          // console.log(response)

          if (response.status == 'succ')
            (function() {
              loadData()

              $('#popup-barang').find('.modal-footer .btn-secondary').click()
            }())
        }
      })
  }
  </script>
</body>

</html>
