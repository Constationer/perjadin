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
          <div class="breadcrumb-item">Pegawai</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Pegawai</h4>
              </div>
              <div class="card-body">
                <table class="table" id="Pegawai-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">OPD</th>
                      <th scope="col">Golongan</th>
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
        $('#Pegawai-table').DataTable({
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
                        window.location.href = "{{route('Pegawai.create')}}"
                      }
                     }
                ],
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          ajax: '{{ route('Pegawai.getPegawai') }}',
          columns: [
            { data: 'null', name: 'rowIndex', searchable: false, orderable: false, render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            { data: 'nip', name: 'nip'},
            { data: 'nama', name: 'nama' },
            { data: 'opd_id', name: 'opd_id', render: function(data, type, row) { return row.opd.nama}},
            { data: 'golongan' , name: 'golongan'},
            { data: 'id', render: function(data, type, row) {
              return '<a href="/pegawai/' + data + '/edit" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>'
                  + '<form action="/pegawai/' + data + '" method="post" onsubmit="return confirm(\'Apakah yakin ingin menghapus data ini?\')">' +
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

