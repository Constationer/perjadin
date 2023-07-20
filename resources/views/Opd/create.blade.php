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
        <div class="breadcrumb-item">Tambah OPD</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
          <div class="card">
            <form action="{{ route('Opd.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h4>Data Organisasi Perangkat Daerah</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Organisasi Perangkat Daerah</label>
                  <input type="text" class="form-control" name="nama" required>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
                <a href="{{ route('Opd.index') }}"
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