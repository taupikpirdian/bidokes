@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Hubungi Kami</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
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
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="card-title m-0">Hubungi Kami</h3>
            </div>
        </div>
        <div class="card-body">
        <table id="example" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
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
</script>
@endsection
