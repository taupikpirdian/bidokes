<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SATSET</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body class="bg-dark text-light">

<div class="container py-5 text-center" id="login-section">
  <!-- Header -->
  <h5 class="fw-bold">SISTEM AKSES TERINTEGRASI SECARA CEPAT <br/>FEEDBACK HASIL RIKKES</h5>

  <!-- Logo -->
  <img src="{{ asset('assets/images/logo/logo.png') }}" class="my-4" style="width:180px;" alt="Logo DOKKES">

  <h3 class="fw-bold">SATSET</h3>

  <!-- Login Card -->
  <div class="card mx-auto mt-4" style="max-width:430px;">
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Login Gagal!</strong> Periksa kembali email dan password Anda.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">
        </div>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-key"></i></span>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            required autocomplete="current-password" placeholder="Masukkan password Anda">
        </div>
        <button type="submit" class="btn btn-warning w-100">Login</button>
        <a type="button" href="/" class="btn btn-danger w-100 mt-3">Halaman Cek Pemeriksaan</a>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <p class="position-fixed bottom-0 start-50 translate-middle-x mb-2 small text-light">
    Copyright © KESMAPTA DOKKES POLRI All right reserved | Version :
  </p>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
