@extends('layouts.admin')

@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Detail Konten</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('dashboard.about-us.index') }}">Konten</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
            <h3 class="card-title">Informasi Konten</h3>
            <div class="card-tools">
                <a href="{{ route('dashboard.about-us.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">Juduk</th>
                            <td>: {{ $aboutUs->title }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal & Waktu</th>
                            <td>: {{ $aboutUs->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Konten</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $aboutUs->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection