@extends('app')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">Dashboard</div>
          <div class="breadcrumb-item">Data</div>
          <div class="breadcrumb-item">SPJ</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Surat Pertanggung Jawaban</h4>
              </div>
              <div class="card-body">
                <table class="table" id="Spj-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">No ST</th>
                      <th scope="col">No SPPD</th>
                      <th scope="col">Nama Pegawai</th>
                      <th scope="col">NIK</th>
                      <th scope="col">Golongan</th>
                      <th scope="col">OPD</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Lokasi</th>
                      <th scope="col">Uang Harian</th>
                      <th scope="col">Kendaraan</th>
                      <th scope="col">No Tiket</th>
                      <th scope="col">Nama Hotel</th>
                      <th scope="col">Uang Hotel</th>
                      <th scope="col" style="nowrap">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @push('dataTable')
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script>
      $(function() {
        $('#Spj-table').DataTable({
          "language": {
              "search": "Cari:",
              "lengthMenu": "Tampilkan _MENU_ data per halaman",
              "zeroRecords": "Tidak Ada Data yang Cocok",
              "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
              "infoEmpty": "Tidak Ada Data yang Tersedia",
              "infoFiltered": "(disaring dari _MAX_ jumlah data)"
          },
          "pageLength": 10,
          scrollX: true,
          processing: true,
          serverSide: true,
          dom: 'Blfrtip',
          buttons: [
                     {
                      text: '<i class="fas fa-plus"></i> Add Data',
                      className: 'btn btn-primary mb-2',
                      action: function ( e, dt, node, config ) {
                        window.location.href = "{{route('Spj.create')}}"
                      }
                     }
                ],
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          ajax: '{{ route('Spj.getSpj') }}',
          columns: [
            { data: 'null', name: 'rowIndex', searchable: false, orderable: false, render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            { data: 'no_st', name: 'nip'},
            { data: 'no_sppd', name: 'nama' },
            { data: 'pegawai_id', name: 'pegawai_id', render: function(data, type, row) { return row.pegawai.nama}},
            { data: 'pegawai_id' , name: 'pegawai_id', render: function(data, type, row) { return row.pegawai.nip}},
            { data: 'pegawai_id' , name: 'pegawai_id', render: function(data, type, row) { return row.pegawai.golongan}},
            { data: 'opd' , name: 'opd', render: function(data, type, row) { return row.pegawai.opd.nama}},
            { data: 'tanggal' , name: 'tanggal'},
            { data: 'tujuan' , name: 'tujuan'},
            { data: 'uang_harian' , name: 'uang_harian'},
            { data: 'kendaraan' , name: 'kendaraan'},
            { data: 'tiket' , name: 'tiket'},
            { data: 'hotel' , name: 'hotel'},
            { data: 'uang_hotel' , name: 'uang_hotel'},
            { data: 'id', render: function(data, type, row) {
              return '<a href="/spj/' + data + '/edit" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>'
                  + '<form action="/spj/' + data + '" method="post" onsubmit="return confirm(\'Apakah yakin ingin menghapus data ini?\')">' +
                      '@method("delete")' +
                      '@csrf' +
                      '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>' +
                      '</form>';
                  }
            }
          ],
          order: []
        });
      });
  </script>
  @endpush
  @endsection

