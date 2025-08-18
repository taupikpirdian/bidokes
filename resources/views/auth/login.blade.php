<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - SI SOPINTAS 110</title>
  <link href="{{ asset('vendor/bootstrap-5.3.0/bootstrap.min.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"/>
  <style>
    html, body {
      height: 100%;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      display: flex;
      flex-direction: column;
      position: relative;
      background-image: url('{{ asset('assets/images/bg/bgheader.webp') }}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      z-index: -1;
    }
    .login-container {
      max-width: 450px;
      margin: 80px auto;
      padding: 2rem;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
      position: relative;
      z-index: 10;
    }
    .header-banner {
      background-color: #4d0f10;
      color: white;
      padding: 1rem;
      border-radius: 8px 8px 0 0;
      margin: -2rem -2rem 1.5rem -2rem;
      text-align: center;
    }
    .logo-container {
      text-align: center;
      margin-bottom: 1.5rem;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1.5rem;
    }
    .logo-container img {
      height: 80px;
    }
    .title {
      font-weight: 600;
      text-align: center;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }
    .title .text-warning {
      color: #ffc107 !important;
    }
    .footer-link {
      font-size: 0.9rem;
      text-align: center;
      margin-top: 2rem;
      background-color: #f8f9fa;
      padding: 1rem;
      border-radius: 0 0 8px 8px;
      margin: 2rem -2rem -2rem -2rem;
      border-top: 1px solid #dee2e6;
    }
    .input-group-text {
      background-color: #4d0f10;
      color: white;
      border-color: #4d0f10;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="header-banner">
      <h6 class="fw-semibold mb-0">SISTEM SINERGI OPERASIONAL PELAYANAN DAN INTRUKSI TANGGAP SIAGA 110</h6>
      <h4 class="fw-bold text-warning mb-0">(SI SOPINTAS 110)</h4>
      <p class="mb-0">BIRO OPS POLDA SUMATERA SELATAN</p>
    </div>
    
    <div class="logo-container">
      <img src="{{ asset('assets/images/logo/logoops.png') }}" alt="Logo OPS POLRI" />
      <img src="{{ asset('assets/images/logo/logopolda.png') }}" alt="Logo Sumsel" />
    </div>
    
    <div class="title">Silahkan Login untuk Mengakses Sistem</div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i>
      <strong>Login Gagal!</strong> Periksa kembali email dan password Anda.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email Address</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">
        </div>
        @error('email')
        <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-4">
        <label for="password" class="form-label fw-semibold">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            required autocomplete="current-password" placeholder="Masukkan password Anda">
        </div>
        @error('password')
        <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-lg" style="background-color: #4d0f10; color: white;">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </div>
    </form>

    <div class="text-center mt-3">
      <a href="/" class="btn btn-outline-secondary">
        <i class="bi bi-house-door-fill me-1"></i>Back to Home
      </a>
    </div>

    <div class="footer-link">
      <h6 class="fw-bold mb-2">Link Terkait</h6>
      <ul class="list-unstyled mb-0">
        <li><a href="https://sumsel.polri.go.id/" target="_blank" class="text-decoration-none">https://sumsel.polri.go.id/</a></li>
        <li><a href="https://sumsel.polri.go.id/satwil" target="_blank" class="text-decoration-none">https://sumsel.polri.go.id/satwil</a></li>
      </ul>
    </div>
  </div>

  <script src="{{ asset('vendor/bootstrap-5.3.0/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
