@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        @if($is_edit)
            <div class="col-sm-6"><h3 class="mb-0">Edit Perkaras</h3></div>
        @else
            <div class="col-sm-6"><h3 class="mb-0">Tambah Perkaras</h3></div>
        @endif
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.perkaras.index') }}">Perkaras</a></li>
            @if($is_edit)
            <li class="breadcrumb-item"><a href="{{ route('dashboard.perkaras.edit', $perkara->id) }}">Edit Perkaras</a></li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Tambah Perkaras</li>
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
                        <h3 class="card-title m-0">Form Edit Perkaras</h3>
                        @else
                        <h3 class="card-title m-0">Form Tambah Perkaras</h3>
                        @endif
                        <a href="{{ route('dashboard.perkaras.index') }}" class="btn btn-sm btn-secondary">
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
                        <form action="{{ route('dashboard.perkaras.update', $perkara->id) }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ route('dashboard.perkaras.store') }}" method="POST">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6" id="polres-row">
                                <div class="mb-3">
                                    <label for="polres_id" class="form-label">Polres <span class="text-danger">*</span></label>
                                    <select class="form-select select2 @error('polres_id') is-invalid @enderror" id="polres_id" name="polres_id">
                                        <option value="">Pilih Polres</option>
                                        @foreach($polres as $polres)
                                            <option value="{{ $polres->id }}" {{ old('polres_id', $perkara->polres_id ?? '') == $polres->id ? 'selected' : '' }}>
                                                {{ $polres->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('polres_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6" id="polsek-row">
                                <div class="mb-3">
                                    <label for="polsek_id" class="form-label">Polsek </label>
                                    <select class="form-select select2 @error('polsek_id') is-invalid @enderror" id="polsek_id" name="polsek_id">
                                        <option value="">Pilih Polsek</option>
                                    </select>
                                    @error('polsek_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomor" class="form-label">Nomor Lapor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nomor') is-invalid @enderror" 
                                           id="nomor" name="nomor" 
                                           value="{{ old('nomor', $perkara->nomor ?? '') }}" 
                                           placeholder="Masukkan nomor lapor" 
                                           required
                                           >
                                    @error('nomor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reporter_name" class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                                    <input type="reporter_name" class="form-control @error('reporter_name') is-invalid @enderror" 
                                           id="reporter_name" 
                                           name="reporter_name" 
                                           value="{{ old('reporter_name', $perkara->reporter_name ?? '') }}" 
                                           placeholder="Masukkan nama pelapor" 
                                           required
                                    >
                                    @error('reporter_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reporter_address" class="form-label">Alamat Pelapor <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control @error('reporter_address') is-invalid @enderror" 
                                           id="reporter_address" 
                                           name="reporter_address" 
                                           value="{{ old('reporter_address', $perkara->reporter_address ?? '') }}" 
                                           placeholder="Masukkan alamat pelapor" 
                                           required
                                    >{{ old('reporter_address', $perkara->reporter_address ?? '') }}</textarea>
                                    @error('reporter_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reporter_phone" class="form-label">No. HP Pelapor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('reporter_phone') is-invalid @enderror" 
                                           id="reporter_phone" 
                                           name="reporter_phone" 
                                           value="{{ old('reporter_phone', $perkara->reporter_phone ?? '') }}" 
                                           placeholder="Masukkan no. hp pelapor" 
                                           required
                                    >
                                    @error('reporter_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="issue" class="form-label">Isi Laporan <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control @error('issue') is-invalid @enderror" 
                                           id="issue" 
                                           name="issue" 
                                           value="{{ old('issue', $perkara->issue ?? '') }}" 
                                           placeholder="Masukkan isi laporan" 
                                           required
                                    >{{ old('issue', $perkara->issue ?? '') }}</textarea>
                                    @error('issue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori Laporan <span class="text-danger">*</span></label>
                                    <select class="form-select select2 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $perkara->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="reporter_date" class="form-label">Tanggal Lapor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('reporter_date') is-invalid @enderror" 
                                           id="reporter_date" 
                                           name="reporter_date" 
                                           value="{{ old('reporter_date', $reporterDate ?? '') }}" 
                                           placeholder="Masukkan tanggal lapor" 
                                           required
                                    >
                                    @error('reporter_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="reporter_date" class="form-label">Jam Lapor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('reporter_date') is-invalid @enderror" 
                                           id="reporter_time" 
                                           name="reporter_time" 
                                           value="{{ old('reporter_time', $reporterTime ?? '') }}" 
                                           placeholder="Masukkan jam lapor" 
                                           required
                                    >
                                    @error('reporter_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.perkaras.index') }}" class="btn btn-secondary">
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
                            <li>Nomor laporan wajib diisi</li>
                            <li>Nama pelapor wajib diisi</li>
                            <li>Alamat wajib diisi</li>
                            <li>No. HP wajib diisi</li>
                            <li>Isi laporan wajib diisi</li>
                            <li>Kategori laporan wajib diisi</li>
                            <li>Tanggal lapor wajib diisi</li>
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
    var perkara = {!! json_encode($perkara) !!};
    $(document).ready(function() {
        $('#institution-row').hide();
        var is_edit = {!! json_encode($is_edit) !!};
        var role = {!! json_encode($role) !!};
        // hide all
        $('#polres-row').hide();
        $('#polsek-row').hide();
        if (role == 'polda' || role == 'admin') {
            $('#polres_id').attr('required', true);
            // $('#polsek_id').attr('required', true);
            // show polres
            $('#polres-row').show();
            // show polsek
            $('#polsek-row').show();
        } else if (role == 'polres') {
            // $('#polsek_id').attr('required', true);
            // show polsek
            // $('#polsek-row').show();
        }

        if(is_edit) {
            // trigger option polres_id
            $('#polres_id').trigger('change');
        }
    });

    // on change polres
    $('#polres_id').change(function() {
        let polres_id = $(this).val();
        let polsek_id = ""
        if(perkara){
            polsek_id = perkara.polsek_id;
        }
        if (polres_id) {
            getDataPolsek(polres_id, polsek_id)
        } else {
            $('#polsek_id').empty();
            $('#polsek_id').append('<option value="">Pilih Polsek</option>');
        }
    });

    function getDataPolsek(polres_id, polsek_id = ""){
        $.ajax({
            url: '/dashboard/users/polsek/' + polres_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#polsek_id').empty();
                $('#polsek_id').append('<option value="">Pilih Polsek</option>');
                $.each(data, function(key, value) {
                    $('#polsek_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                if(polsek_id){
                    $('#polsek_id').val(polsek_id);
                }
            }
        });
    }

$('#reporter_date').datepicker({
    format: 'yyyy-mm-dd',
    @if(env('ENABLE_START_DATE', false))
    startDate: new Date(),
    @endif
});

$('#reporter_time').timepicker({
    timeFormat: 'HH:mm',
    interval: 60,
    minTime: '01:00am',
    maxTime: '11:00pm',
    defaultTime: '09',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>
@endsection