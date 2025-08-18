@extends('layouts.admin')

@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Laporan Masyarakat</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Laporan Masyarakat</li>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Laporan Masyarakat</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- responsive --}}
            <div class="table-responsive">
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelapor</th>
                            <th>No HP</th>
                            <th>Masalah</th>
                            <th>Tanggal & Waktu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
      var dataTable = $("#example").DataTable({
        //   "scrollX": true,
          processing: true,
          serverSide: true,
          autoWidth: true,
          orderCellsTop: true,
          fixedHeader: true,
        //   sDom: 'lrtip',
          fixedColumns: {
              right: 1,
              left: 0,
          },
          ajax: "{{ route('dashboard.public-reports.datatable') }}",
          columns: [
              {
                  data: 'DT_RowIndex',
                  orderable: false
              },
              {
                  data: 'reporter_name',
                  name: 'reporter_name'
              },
              {
                  data: 'reporter_phone',
                  name: 'reporter_phone'
              },
              {
                  data: 'issue',
                  name: 'issue'
              },
              {
                  data: 'created_at',
                  name: 'created_at'
              },
              {
                  data: 'action',
                  orderable: false
              }
          ],
          order: [
              [4, 'asc']
          ]
      });
    });

</script>
@endsection