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
                <div class="card-body dashboard-tabs p-0">

                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Pasien</small>
                            <h5 id="total_pasien" class="mr-2 mb-0"></h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Kunjungan</small>
                            <h5 id="total_kunjungan" class="mr-2 mb-0"></h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Kunjungan (bulan ini)</small>
                            <h5 id="total_kunjungan_bulan_ini" class="mr-2 mb-0"></h5>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Grafik Kunjungan</p>
                  <canvas id="pieChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bar chart</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Kunjungan terakhir</p>
                  <div class="table-responsive">
                    <table id="datatable" class="table table-sm table-striped">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pasien</th>
                            <th>Waktu</th>
                            <th>Keluhan</th>
                        </tr>
                      </thead>
                    </table>
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
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script>
  var json_datatable = null
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
      // ordering: false,
      serverSide: true,
      searching: false,
      lengthChange: true,
      order: [
        [1, "desc"]
      ],
      sAjaxSource: "/data",
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

            $('#total_pasien').html(data.total.pasien)
            $('#total_kunjungan').html(data.total.kunjungan)
            $('#total_kunjungan_bulan_ini').html(data.total.kunjungan_bulan_ini)

            var doughnutPieData = {
              datasets: [{
                data: [data.total.kunjungan_sehat, data.total.kunjungan_sakit],
                backgroundColor: [
                  'rgba(0, 255, 0, 0.5)',
                  'rgba(255, 255, 0, 0.5)',
                  'rgba(255, 206, 86, 0.5)',
                  'rgba(75, 192, 192, 0.5)',
                  'rgba(153, 102, 255, 0.5)',
                  'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                  'rgba(0, 255, 0,1)',
                  'rgba(255, 255, 0, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
              }],

              // These labels appear in the legend and in the tooltips when hovering different arcs
              labels: [
                'Kunjungan Sehat',
                'Kunjungan Sakit',
              ]
            };
            var doughnutPieOptions = {
              responsive: true,
              animation: {
                animateScale: true,
                animateRotate: true
              }
            };
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d")
            var pieChart = new Chart(pieChartCanvas, {
              type: 'pie',
              data: doughnutPieData,
              options: doughnutPieOptions
            })

            var data = {
              labels: ["September", "Oktober", "Nopember", "Desember"],
              datasets: [{
                label: 'Jumlah Kunjugan',
                data: [0, 0, 0, data.total.kunjungan_bulan_ini],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: false
              }]
            }

            var options = {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              },
              legend: {
                display: false
              },
              elements: {
                point: {
                  radius: 0
                }
              }
            }

            var barChartCanvas = $("#barChart").get(0).getContext("2d")
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: data,
              options: options
            })
          }
        })
      },
      columns: [
        { data: 'no', sortable: false },
        { data: 'pasien_nama', name: 'pasien_nama', sortable: false },
        { data: 'jk_created_date', name: 'jk_created_date', sortable: false },
        { data: 'jk_keluhan', name: 'jk_keluhan', sortable: false }
      ],
      "dom": '<"pull-left col-md-3 col-sm-3"><"pull-right mt-10"B>rt<"pull-left col-md-4"><"pull-right">',
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
        url: 'barang/create',
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
              $('.fancybox-button.fancybox-close-small').click()
            }())
        }
      })
  }
  </script>
</body>

</html>
