@extends('layouts.admin')

@section('content-header')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Detail Perkara</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.perkaras.index') }}">Perkara</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h3 class="card-title m-0">Informasi Perkara</h3>
                        <div>
                            <a href="{{ route('dashboard.perkaras.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Polres</label>
                                <p class="form-control-plaintext">{{ $perkara->polres->name ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Polsek</label>
                                <p class="form-control-plaintext">{{ $perkara->polsek->name ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor Lapor</label>
                                <p class="form-control-plaintext">{{ $perkara->nomor ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pelapor</label>
                                <p class="form-control-plaintext">{{ $perkara->reporter_name ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Pelapor</label>
                                <p class="form-control-plaintext">{{ $perkara->reporter_address ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">No. HP Pelapor</label>
                                <p class="form-control-plaintext">{{ $perkara->reporter_phone ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Isi Laporan</label>
                                <p class="form-control-plaintext">{{ $perkara->issue ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori Laporan</label>
                                <p class="form-control-plaintext">{{ $perkara->category->name ?? "-" }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Lapor</label>
                                <p class="form-control-plaintext">{{ $perkara->reporter_date ?? "-" }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Form -->
<form id="delete-form-{{ $perkara->id }}" action="{{ route('dashboard.perkaras.destroy', $perkara->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data user akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endsection