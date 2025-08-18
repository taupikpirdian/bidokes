@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Tentang Kami</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
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
                <h3 class="card-title m-0">Tentang Kami</h3>
                <a href="{{ route('dashboard.about-us.create') }}" class="btn btn-primary btn-sm">Tambah</a>
            </div>
        </div>
        <div class="card-body">
        <table id="example" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($aboutUs as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- limit 100 character --}}
                <td>{!! Str::limit($item->content, 100) !!}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('dashboard.about-us.show', $item->id) }}" type="button" class="btn btn-sm btn-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('dashboard.about-us.edit', $item->id) }}" type="button" class="btn btn-sm btn-warning" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="deleteData('{{ $item->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
            </tr>
            @endforeach
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

    function destroy(id) {
        var url = "{{ route('dashboard.about-us.destroy', ':id') }}".replace(':id', id);
        callDataWithAjax(url, 'POST', {
            _method: "DELETE"
        }).then((data) => {
            Swal.fire({
                title: 'Success',
                text: `Data user berhasil dihapus`,
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
