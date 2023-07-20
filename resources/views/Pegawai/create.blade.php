@extends('app')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Dashboard</div>
        <div class="breadcrumb-item">Data</div>
        <div class="breadcrumb-item">Tambah Pegawai</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
          <div class="card">
            <form action="{{ route('Pegawai.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h4>Data Pegawai</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" name="nip">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                  <label>OPD</label>
                  <select class="form-control" name="opd_id">
                    @foreach($opd as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Golongan</label>
                  <select class="form-control" name="golongan">
                      <option value="III/A">III/A</option>
                      <option value="III/B">III/B</option>
                      <option value="III/C">III/C</option>
                      <option value="III/D">III/D</option>
                  </select>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
                <a href="{{ route('Pegawai.index') }}"
                    class="btn btn-light-secondary me-1 mb-1">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection