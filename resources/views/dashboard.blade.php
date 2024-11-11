<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Aplikasi MBKM</title>

        <link href="plugins/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" />
        <link href="plugins/jquery-custom-scrollbar/jquery.custom-scrollbar.css" rel="stylesheet" />
        <link href="plugins/datatables/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />

        <link href="plugins/tailwindcss/tailwind.min.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <div class="mx-auto">
          <div class="content">
            <div class="breadcumb">

              <h4 class="title">Fakultas</h4>
            </div>
            <div class="main">
              <h5 class="font-bold"></label></h5>
              <div class="flex items-center justify-end gap-x-6">
                <button type="button" class="rounded-md bg-indigo-600 px-3 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" data-fancybox data-src="#popup-barang">Add</button>
              </div>
              <table id="datatable" class="border-collapse border border-slate-400" width="100%">
                <thead>
                  <tr>
                    <th class="border border-slate-300">#</th>
                    <th class="border border-slate-300">Kode</th>
                    <th class="border border-slate-300">Nama</th>
                    <th class="border border-state-300">Aksi</th>
                  </tr>
                </thead>
                <!-- <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody> -->
              </table>

              <div id="popup-barang" style="display: none">
                <h2>Fakultas</h2>
                <form id="form-barang" class="skin-default custom-scrollbar">
                  <div class="mt-10 grid grid-cols-12 gap-x-6 gap-y-2 sm:grid-cols-12">
                    <input type="hidden" id="id_fakultas" />
                    <div class="sm:col-span-12">
                      <label for="kode_fakultas" class="block text-sm font-medium leading-6 text-gray-900">Kode</label>
                      <div class="mt-2">
                        <input type="text" id="kode_fakultas" name="kode_fakultas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                      </div>
                    </div>
                    <div class="sm:col-span-12">
                      <label for="nama_fakultas" class="block text-sm font-medium leading-6 text-gray-900">Nama</label>
                      <div class="mt-2">
                        <input type="text" id="nama_fakultas" name="nama_fakultas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                      </div>
                    </div>

                  </div>
                </form>
                <div class="flex items-center justify-end gap-x-6" style="position: relative; top: 25px">
                  <button type="button" class="rounded-md bg-indigo-600 px-3 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="simpan()">Simpan</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      <!-- <script src="../plugins/tailwindcss-3.3.5/lib/index.js"></script> -->

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

            $('#datatable').find('.actionUbah').on('click', function(e) {
              let id = $(this).attr('data-barang')

              $.ajax({
                url: 'barang/getData',
                type: 'GET',
                data: {
                  id_fakultas: id
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

            $('#datatable').find('.actionHapus').on('click', function(e) {
              let id = $(this).attr('data-barang')

              $.ajax({
                url: 'barang/hapus',
                type: 'POST',
                data: { id_fakultas: id },
                dataType: 'JSON',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  if (response.status == "succ")
                    loadData()

                  // $('#modal-barang').modal('hide')
                }
              })
            })

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
          sAjaxSource: "barang/data",
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
              }
            })
          },
          columns: [
            { data: 'no', sortable: false },
            { data: 'kode_fakultas', name: 'kode_fakultas' },
            { data: 'nama_fakultas', name: 'nama_fakultas' },
            {
              data: null, sortable: false,
              render: function(data) {
                let _div = document.createElement('div'),
                    _a = document.createElement('a'),
                    _i = document.createElement('i')

                _i.className = "fa fa-edit"
                _a.appendChild(_i)
                _a.className = "actionUbah rounded-md"
                _a.dataset.fancybox = ''
                _a.dataset.src = "#popup-barang"
                _a.dataset.barang = data.id_fakultas
                _div.appendChild(_a)

                _i = document.createElement('i')
                _i.className = "fa fa-trash"
                _a = document.createElement('a')
                _a.appendChild(_i)
                _a.className = "actionHapus rounded-md"
                _a.dataset.barang = data.id_fakultas
                _div.appendChild(_a)
                // _div.style.display = "grid"

                return _div.outerHTML
              }
            }
          ],
          "dom": '<"pull-left col-md-1 col-sm-1"l><"pull-right mt-10"B>rt<"pull-left col-md-4"i><"pull-right"p>',
          oLanguage: {
      			sLengthMenu: "Menampilkan _MENU_ baris per halaman",
      			sLoadingRecords: 'Silakan Tunggu',
      			sProcessing: "<i class='fa fa-refresh fa-spin'></i> Data Sedang Diproses",
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
          if (item.type == 'text' || item.type == 'textarea' || item.type == 'hidden')
            data[item.id] = item.value
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
