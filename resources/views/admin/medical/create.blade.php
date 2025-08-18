@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        @if($is_edit)
            <div class="col-sm-6"><h3 class="mb-0">Edit Medical</h3></div>
        @else
            <div class="col-sm-6"><h3 class="mb-0">Tambah Data</h3></div>
        @endif
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.medical.index') }}">Medical</a></li>
            @if($is_edit)
            <li class="breadcrumb-item"><a href="{{ route('dashboard.medical.edit', $data->id) }}">Edit Medical</a></li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                        <h3 class="card-title m-0">Form Edit Data</h3>
                        @else
                        <h3 class="card-title m-0">Form Tambah Data</h3>
                        @endif
                        <a href="{{ route('dashboard.medical.index') }}" class="btn btn-sm btn-secondary">
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
                        <form action="{{ route('dashboard.medical.update', $medical->id) }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ route('dashboard.medical.store') }}" method="POST">
                    @endif
                        @csrf
                        <!-- IDENTITAS PASIEN -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Pemeriksaan <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control" placeholder="Contoh: SKM/03440xxxxx" value="{{ old('nomor',$data->nomor ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Pasien" value="{{ old('name',$data->name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror" 
                                        id="gender" name="gender" required>
                                    <option value="">Pilih Role</option>
                                    <option value="L">Pria</option>
                                    <option value="P">Wanita</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="age" class="form-control" placeholder="Contoh: 34" value="{{ old('date_of_birth',$data->date_of_birth ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: Islam"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pangkat <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: AKP"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NRP/NIP <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: Islam"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: PAUR KESMAPTA"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kesatuan <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: BIDDOKKES"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control" placeholder="Masukkan alamat" value="{{ old('address',$data->address ?? '') }}" required>
                            </div>
                        </div>
                        
                        <!-- PEMERIKSAAN FISIK -->
                        <h6 class="fw-bold mt-4">Pemeriksaan Fisik</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" name="height" class="form-control" value="{{ old('height',$data->height ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Berat Badan (kg)</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight',$data->weight ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Komposisi Tubuh</label>
                            <input type="text" name="composition" class="form-control" value="{{ old('composition',$data->composition ?? '') }}">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Lingkar Perut</label>
                            <input type="text" name="lingkar_perut" class="form-control" value="{{ old('lingkar_perut',$data->lingkar_perut ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Tensi</label>
                            <input type="text" name="tension" class="form-control" placeholder="contoh: 120/80" value="{{ old('tension',$data->tension ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">PLT</label>
                            <input type="text" name="plt" class="form-control" value="{{ old('plt',$data->plt ?? '') }}">
                            </div>
                        
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Nadi</label>
                            <input type="text" name="pulse" class="form-control" value="{{ old('pulse',$data->pulse ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">VOD / VOS</label>
                            <input type="text" name="vod_vos" class="form-control" placeholder="contoh: 6/9 , 6/9" value="{{ old('vod_vos',$data->vod_vos ?? '') }}">
                            </div>
                        </div>
                        
                        <!-- PEMERIKSAAN PENUNJANG -->
                        <h6 class="fw-bold mt-4">Pemeriksaan Penunjang</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Laboratorium</label>
                            <input type="text" name="lab" class="form-control" value="{{ old('lab',$data->lab ?? 'Terlampir') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Rontgen</label>
                            <input type="text" name="rontgen" class="form-control" value="{{ old('rontgen',$data->rontgen ?? 'Terlampir') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                            <label class="form-label">Treadmill</label>
                            <input type="text" name="treadmill" class="form-control" value="{{ old('treadmill',$data->treadmill ?? 'Terlampir') }}">
                            </div>
                        </div>
                        
                        <!-- URAIAN KELAINAN -->
                        <div class="mb-3">
                            <label class="form-label">Uraian Kelainan</label>
                            <textarea name="findings" rows="3" class="form-control">{{ old('findings',$data->findings ?? 'Visus VOD 6/9 VOS 6/9 (2)') }}</textarea>
                        </div>
                        
                        <!-- NILAI -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <label class="form-label">Nilai</label>
                            <input type="text" name="score" class="form-control" value="{{ old('score',$data->score ?? '77 Baik (B)') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                            <input type="date" name="exam_date" class="form-control" value="{{ old('exam_date',$data->exam_date ?? '') }}" required>
                            </div>
                        </div>
                        
                        <!-- SARAN -->
                        <div class="mb-3">
                            <label class="form-label">Saran</label>
                            <textarea name="recommendation" rows="3" class="form-control">{{ old('recommendation',$data->recommendation ?? '') }}</textarea>
                        </div>
  

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.medical.index') }}" class="btn btn-secondary">
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
                            <li>Nama lengkap wajib diisi sesuai identitas peserta.</li>
                            <li>Alamat diisi lengkap sesuai domisili saat ini.</li>
                            <li>Bagian Pemeriksaan Fisik diisi sesuai hasil pemeriksaan (boleh dikosongkan jika belum dilakukan).</li>
                            <li>Bagian Pemeriksaan Penunjang biarkan “Terlampir” jika ada hasil terpisah.</li>
                            <li>Kolom Uraian Kelainan hanya diisi apabila ditemukan kelainan saat pemeriksaan.</li>
                            <li>Nilai diisi sesuai ketetapan (contoh : 77 Baik (B)).</li>
                            <li>Saran diisi dalam bentuk list (pisahkan dengan enter jika lebih dari satu).</li>
                            <li>Tanggal Pemeriksaan wajib diisi sesuai tanggal pelaksanaan pemeriksaan.</li>
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
        var is_edit = {!! json_encode($is_edit) !!};
        // when $is_edit == true, remove required on password and confirmation_password
        if (is_edit) {
            $('#password-label').text('Password');
            $('#password-confirmation-label').text('Konfirmasi Password');
            $('#password').attr('required', false);
            $('#password_confirmation').attr('required', false);
        }
    });
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak sama!');
            return false;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter!');
            return false;
        }
    });
</script>
@endsection