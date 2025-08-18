@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        @if($is_edit)
            <div class="col-sm-6"><h3 class="mb-0">Edit Tentang Kami</h3></div>
        @else
            <div class="col-sm-6"><h3 class="mb-0">Tambah Tentang Kami</h3></div>
        @endif
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.about-us.index') }}">Tentang Kami</a></li>
            @if($is_edit)
            <li class="breadcrumb-item"><a href="{{ route('dashboard.about-us.edit', $aboutUs->id) }}">Edit Tentang Kami</a></li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Tambah Tentang Kami</li>
            @endif
            </ol>
        </div>
    </div>
    <!--end::Row-->
  </div>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        @if($is_edit)
                        <h3 class="card-title m-0">Form Edit Tentang Kami</h3>
                        @else
                        <h3 class="card-title m-0">Form Tambah Tentang Kami</h3>
                        @endif
                        <a href="{{ route('dashboard.about-us.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan!</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($is_edit)
                        <form action="{{ route('dashboard.about-us.update', $aboutUs->id) }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ route('dashboard.about-us.store') }}" method="POST">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" 
                                           value="{{ old('title', $aboutUs->title ?? '') }}" 
                                           placeholder="Masukkan judul" 
                                           required
                                           >
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Isi <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                           id="content" 
                                           name="content" 
                                           placeholder="Masukkan isi" 
                                           required
                                    >{{ old('content', $aboutUs->content ?? '') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.about-us.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb"></i> Petunjuk Pengisian:</h6>
                        <ul class="mb-0 small">
                            <li>Judul wajib diisi</li>
                            <li>Konten wajib diisi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endsection