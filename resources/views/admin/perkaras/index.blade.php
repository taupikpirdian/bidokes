@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Perkara</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Perkara</li>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
@endsection
@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="card-title m-0">Data Perkara</h3>
                <a href="{{ route('dashboard.perkaras.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
        <table id="example" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Instansi</th>
                <th>No Pengaduan</th>
                <th>Tanggal Pengaduan</th>
                <th>Nama Pelapor</th>
                <th>Kategori</th>
                <th>Dibuat Tanggal</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
           
            </tbody>
        </table>
        </div>  
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
      $('#example').DataTable();
    });

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
          ajax: "{{ route('dashboard.perkaras.datatable') }}",
          columns: [
              {
                  data: 'DT_RowIndex',
                  orderable: false
              },
              {
                  data: 'polres',
                  name: 'polres'
              },
              {
                  data: 'nomor',
                  name: 'nomor'
              },
              {
                  data: 'reporter_date',
                  name: 'reporter_date'
              },
              {
                  data: 'reporter_name',
                  name: 'reporter_name'
              },
              {
                  data: 'category',
                  name: 'category'
              },
              {
                  data: 'created_at',
                  name: 'created_at'
              },
              {
                  data: 'created_by',
                  name: 'created_by'
              },
              {
                  data: 'action',
                  orderable: false
              }
          ],
          order: [
              [6, 'desc']
          ]
    });

    function destroy(id) {
        var url = "{{ route('dashboard.perkaras.destroy', ':id') }}".replace(':id', id);
        callDataWithAjax(url, 'POST', {
            _method: "DELETE"
        }).then((data) => {
            Swal.fire({
                title: 'Success',
                text: `Data perkara berhasil dihapus`,
                icon: 'success',
                confirmButtonText: 'OK'
            });
            setTimeout(function() {
                location.reload();
            }, 500);
        }).catch((xhr) => {
            alert('Error: ' + xhr.responseText);
        })
    }
</script>
@endsection
