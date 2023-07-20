@extends('app')

@section('content')

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-3 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total OPD</h4>
              </div>
              <div class="card-body">
                {{ $total_opd }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Pegawai</h4>
              </div>
              <div class="card-body">
                {{ $total_pegawai }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total SPJ</h4>
              </div>
              <div class="card-body">
                {{ $total_spj }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Overlap</h4>
              </div>
              <div class="card-body">
                {{ $total_overlap }}
              </div>
            </div>
          </div>
        </div>                  
      </div>
      <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
          <div class="card">
            <div class="card-header">
              <h4>Data SPJ Bulanan</h4>
            </div>
            <div class="card-body">
              <canvas id="monthlyChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4>Data Overlap</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody><tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Total Overlap</th>
                  </tr>
                  @foreach($overlap as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->total_overlap }}</td>
                  </tr>
                  @endforeach
                </tbody></table>
              </div>
            </div>
            <div class="card-footer text-right">
              <nav class="d-inline-block">
                <ul class="pagination mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @push('script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var monthlyTotals = @json($monthlyTotals);

    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(monthlyTotals),
            datasets: [{
                label: 'Total SPJ',
                data: Object.values(monthlyTotals),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

  @endpush
@endsection