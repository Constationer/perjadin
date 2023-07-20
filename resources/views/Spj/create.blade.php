@extends('app')

@section('content')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Dashboard</div>
        <div class="breadcrumb-item">Data</div>
        <div class="breadcrumb-item">Tambah SPJ</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
          <div class="card">
            <form action="{{ route('Spj.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h4>Data SPJ</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>No ST</label>
                  <input type="text" class="form-control" name="no_st" required>
                </div>
                <div class="form-group">
                  <label>No SPPD</label>
                  <input type="text" class="form-control" name="no_sppd" required>
                </div>
                <div class="form-group">
                  <label>Pegawai</label>
                  <select class="form-control js-pegawai" name="pegawai_id" required>
                      <option value=NULL>---- Pilih Salah Satu ----</option>
                    @foreach($pegawai as $data)
                      <option value="{{ $data->id }}">{{ $data->nip }} | {{ $data->nama }} | {{ $data->opd->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tanggal Pelaksanaan</label>
                  <input type="date" class="form-control" name="tanggal_pelaksanaan" required>
                </div>
                <div class="form-group">
                  <label>Tanggal Selesai</label>
                  <input type="date" class="form-control" name="tanggal_selesai" required>
                </div>
                <div class="form-group">
                  <label>Lokasi</label>
                  <select class="form-control" name="lokasi_check" id="lokasi_check" required>
                    <option value="Dalam Kota">Dalam Kota</option>
                    <option value="Dinas Luar">Dinas Luar</option>
                  </select>
                </div>
                <div class="form-group" id="lokasiField" style="display: none;">
                  <label>Tujuan Lokasi</label>
                  <input type="text" class="form-control" name="lokasi" id="lokasi">
                </div>
                <div class="form-group">
                  <label>Kendaraan</label>
                  <select class="form-control" name="kendaraan" id="kendaraan" required>
                    <option value="Mobil">Mobil</option>
                    <option value="Pesawat">Pesawat</option>
                    <option value="Kereta Api">Kereta Api</option>
                  </select>
                </div>
                <div class="form-group" id="tiketField" style="display: none;">
                  <label>No Tiket</label>
                  <input type="text" class="form-control" name="tiket" id="tiket">
                </div>
                <div class="form-group">
                  <label>Uang Harian</label>
                  <input type="text" class="form-control" name="uang_harian" required>
                </div>
                <div class="form-group">
                  <label>Penginapan</label>
                  <select class="form-control" name="penginapan" id="penginapan" required>
                    <option value="Tidak">Tidak</option>
                    <option value="Ya">Ya</option>
                  </select>
                </div>
                <div class="form-group" id="namaHotelField" style="display: none;">
                  <label>Nama Hotel</label>
                  <input type="text" class="form-control" name="hotel" id="hotel">
                </div>
                <div class="form-group" id="uangHotelField" style="display: none;">
                  <label>Uang Hotel</label>
                  <input type="text" class="form-control" name="uang_hotel" id="uang_hotel">
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
                <a href="{{ route('Spj.index') }}"
                    class="btn btn-light-secondary me-1 mb-1">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  document.getElementById('lokasi_check').addEventListener('change', function() {
  const selectedValue = this.value;
  const lokasiField = document.getElementById('lokasiField');
  const lokasiInput = document.getElementById('lokasi');

  lokasiField.style.display = selectedValue === 'Dinas Luar' ? 'block' : 'none';

  if (selectedValue === 'Dalam Kota') {
    lokasiInput.value = 'Dalam Kota'; // Set the value of the lokasi input field to "Dalam Kota"
  } else {
    lokasiInput.value = ''; // Clear the Lokasi text input for other options
  }
});
</script>
<script>
  document.getElementById('kendaraan').addEventListener('change', function() {
  const selectedValue = this.value;
  const tiketField = document.getElementById('tiketField');
  const tiketInput = document.getElementById('tiket');

  tiketField.style.display = selectedValue !== 'Mobil' ? 'block' : 'none';

  if (selectedValue === 'Mobil') {
    tiketInput.value = '-'; // Set the value of the lokasi input field to "Dalam Kota"
  } else {
    tiketInput.value = ''; // Clear the Lokasi text input for other options
  }
});
</script>
<script>
  document.getElementById('penginapan').addEventListener('change', function() {
  const selectedValue = this.value;
  const namaHotelField = document.getElementById('namaHotelField');
  const namaHotelInput = document.getElementById('hotel');
  const uangHotelField = document.getElementById('uangHotelField');
  const uangHotelInput = document.getElementById('uang_hotel');

  namaHotelField.style.display = selectedValue !== 'Tidak' ? 'block' : 'none';
  uangHotelField.style.display = selectedValue !== 'Tidak' ? 'block' : 'none';

  if (selectedValue === 'Tidak') {
    namaHotelInput.value = '-';
    uangHotelInput.value = '0';
  } else {
    namaHotelInput.value = '';
    uangHotelInput.value = '';
  }
});
</script>
<script>
  $(document).ready(function() {
    $('.js-pegawai').select2();
});
</script>
@endpush
@endsection