<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SI SOPINTAS 110</title>
  <link href="{{ asset('vendor/bootstrap-5.3.0/bootstrap.min.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"/>
  <style>
     html, body {
        height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
    }
    main {
        flex: 1; /* Mengisi ruang kosong di antara header dan footer */
    }
    .nav-link {
      font-weight: 500;
      font-size: 1.1rem;
    }
    .hero-section {
      background-image: url('https://via.placeholder.com/1200x300'); /* ganti dengan gambar kantor */
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 4rem 2rem;
      text-align: center;
    }
    .hero-section h1 {
      font-size: 2rem;
      font-weight: bold;
    }
    .content-section {
      padding: 2rem;
    }
    footer {
      background-color: #f8f9fa;
      padding: 1.5rem;
    }
  </style>
</head>
<body>
  <header style="height: 160px; background-color: #4d0f10;">
    <div class="container-fluid h-100">
      <div class="row h-100 align-items-center text-white">
        
        <!-- Logo Kiri -->
        <div class="col-2 d-flex justify-content-center align-items-center">
          <img src="{{ asset('assets/images/logo/logoops.png') }}" alt="Logo OPS POLRI" style="max-height: 100px; height: auto;">
        </div>
  
        <!-- Gambar Tengah dengan Teks -->
        <div class="col-8 position-relative h-100">
          <img src="{{ asset('assets/images/bg/bgheader.webp') }}" alt="Gedung Polda" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 1; opacity: 0.6;"/>
          <div class="position-relative text-center text-white h-100 d-flex flex-column justify-content-center" style="z-index: 2;">
            <h6 class="fw-semibold mb-0">SISTEM SINERGI OPERASIONAL PELAYANAN DAN INTRUKSI TANGGAP SIAGA 110</h6>
            <h4 class="fw-bold text-warning mb-0">(SI SOPINTAS 110)</h4>
            <p class="mb-0">BIRO OPS POLDA SUMATERA SELATAN</p>
          </div>
        </div>
  
        <!-- Logo Kanan -->
        <div class="col-2 d-flex justify-content-center align-items-center">
          <img src="{{ asset('assets/images/logo/logopolda.png') }}" alt="Logo Sumsel" style="max-height: 100px; height: auto;">
        </div>
  
      </div>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">OPS POLRI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <section class="content-section bg-white">
    <div class="container">
      @yield('content')
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light text-center py-3 mt-auto border-top">
    <div class="container">
      <h6 class="fw-bold">Link Terkait</h6>
      <ul class="list-unstyled mb-1">
        <li><a href="https://sumsel.polri.go.id/" target="_blank" class="text-decoration-none">https://sumsel.polri.go.id/</a></li>
        <li><a href="https://sumsel.polri.go.id/satwil" target="_blank" class="text-decoration-none">https://sumsel.polri.go.id/satwil</a></li>
      </ul>
    </div>
  </footer>

  <script src="public/vendor/bootstrap-5.3.0/bootstrap.bundle.min.js"></script>
</body>
</html>
