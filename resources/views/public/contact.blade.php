@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white d-flex align-items-center" style="background-color: #4d0f10;">
                <i class="bi bi-clipboard-check-fill me-2 fs-4"></i>
                <h4 class="mb-0">Form Pelaporan Masyarakat</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('public.report.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label fw-semibold">Nama Pelapor <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control @error('reporter_name') is-invalid @enderror" id="reporter_name" name="reporter_name" value="{{ old('reporter_name') }}" placeholder="Masukan nama lengkap" required>
                            @error('reporter_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp_pelapor" class="form-label fw-semibold">Nomor HP Pelapor <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-telephone-fill"></i></span>
                            <input type="text" class="form-control @error('reporter_phone') is-invalid @enderror" id="reporter_phone" name="reporter_phone" value="{{ old('reporter_phone') }}" placeholder="Contoh: 08123456789" required>
                            @error('reporter_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="masalah" class="form-label fw-semibold">Masalah yang Dilaporkan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-chat-left-text-fill"></i></span>
                            <textarea class="form-control @error('issue') is-invalid @enderror" id="issue" name="issue" rows="5" placeholder="Jelaskan secara detail masalah yang ingin Anda laporkan" required>{{ old('issue') }}</textarea>
                            @error('issue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn text-white fw-semibold" style="background-color: #4d0f10;">
                            <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer" style="background-color: #f8f9fa;">
                <div class="d-flex align-items-center text-muted">
                    <i class="bi bi-info-circle-fill me-2 text-secondary"></i>
                    <small>Catatan: Laporan Anda akan segera ditindaklanjuti oleh petugas kami.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection