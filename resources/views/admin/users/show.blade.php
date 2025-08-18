@extends('layouts.admin')

@section('content-header')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Detail User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h3 class="card-title m-0">Informasi User</h3>
                        <div>
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <p class="form-control-plaintext">{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role</label>
                                <div>
                                    {{ $user->roles->pluck('name')->first() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- User Avatar Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title m-0">Avatar</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="avatar-placeholder bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 120px; height: 120px; font-size: 48px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
            </div>
            
            <!-- User Statistics Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title m-0">Statistik</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Bergabung:</span>
                        <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Terakhir Update:</span>
                        <span class="text-muted">{{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Actions Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title m-0">Aksi</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">
                            <i class="fas fa-trash"></i> Hapus User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Form -->
<form id="delete-form-{{ $user->id }}" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: none;">
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