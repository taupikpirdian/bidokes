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
      <form onsubmit="event.preventDefault();showSurat();">
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control" placeholder="Masukkan Nomor Pemeriksaan">
        </div>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-calendar"></i></span>
          <input type="text" class="form-control" placeholder="Masukkan Tanggal Lahir">
        </div>
        <button type="submit" class="btn btn-warning w-100">Cek Pemeriksaan</button>
        <a type="button" href="{{ route('dashboard.index') }}" class="btn btn-danger w-100 mt-3">Halaman Login</a>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <p class="position-fixed bottom-0 start-50 translate-middle-x mb-2 small text-light">
    Copyright © KESMAPTA DOKKES POLRI All right reserved | Version :
  </p>
</div>


<!-- Surat Section (hidden by default) -->
<div class="container py-5 bg-white" id="surat-section" style="display:none; color: black">
  <div class="text-center">
    <h6 class="mb-0">KEPOLISIAN NEGARA REPUBLIK INDONESIA</h6>
    <h6 class="mb-3">DAERAH JAWA BARAT<br>BIDANG KEDOKTERAN DAN KESEHATAN</h6>

    <h5 class="fw-bold text-decoration-underline">SURAT KETERANGAN MEDIS</h5>
    <p>Nomor : SKM/0344000000/III/2025/Biddokkes</p>
  </div>

  <table class="table table-sm table-noborder">
    <tr>
      <td>Nama</td>
      <td>: dr. RADEN ANGGA ANGGRAWAN HERMAYA</td>
      <td>Umur</td>
      <td>: 34</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>: PRIA</td>
      <td>Agama</td>
      <td>: Islam</td>
    </tr>
    <tr>
      <td>Pangkat</td>
      <td>: AKP</td>
      <td>NRP/NIP</td>
      <td>: 90070344</td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td>: PAUR KESMAPTA</td>
      <td>Kesatuan</td>
      <td>: BIDDOKKES</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td colspan="3">: BANDUNG</td>
    </tr>
  </table>

  <p class="fw-bold">Pemeriksaan Fisik :</p>
  <table class="table table-sm table-noborder">
    <tr>
      <td>Tinggi Badan</td>
      <td>: 184 Cm</td>
      <td>Berat Badan</td>
      <td>: 105 Kg</td>
    </tr>
    <tr>
      <td>Komposisi Tubuh</td>
      <td>: OW 22 Kg</td>
      <td>Lingkar Perut</td>
      <td>: -</td>
    </tr>
    <tr>
      <td>Tensi</td>
      <td>: 120 / 80 mmHg</td>
      <td>PLT</td>
      <td>: -</td>
    </tr>
    <tr>
      <td>Nadi</td>
      <td>: 77 x/mnt</td>
      <td>VOD / VOS</td>
      <td>: 6/9, 6/9</td>
    </tr>
  </table>

  <p class="fw-bold">Pemeriksaan Penunjang</p>
  <table class="table table-sm table-noborder">
    <tr>
      <td>Laboratorium</td>
      <td>: Terlampir</td>
      <td>Rontgen</td>
      <td>: Terlampir</td>
      <td>Treadmill</td>
      <td>: Terlampir</td>
    </tr>
  </table>

  <p class="fw-bold">Uraian Kelainan :</p>
  <p>Visus VOD 6/9 VOS 6/9 (2)</p>

  <p class="fw-bold">Nilai :</p>
  <p>77 Baik (B)</p>

  <p class="fw-bold">Saran :</p>
  <ol>
    <li>Minum air putih 8 gelas / 2 liter per hari</li>
    <li>Olahraga dan istirahat yang cukup</li>
    <li>Pertahankan kondisi Kesehatan yang sudah baik</li>
  </ol>

  <br>
  <table class="table table-noborder w-100">
    <tr>
      <td style="width:60%"></td>
      <td class="text-center">
        Bandung, 18 Maret 2025<br>Dokter Pemeriksa<br><br><br><br>
        <strong>dr. MEGA WIRA SUSWANTI</strong><br>
        KOMISARIS POLISI NRP 88090985
      </td>
    </tr>
  </table>
</div>

<script>
  function showSurat(){
    // hide login
    document.getElementById('login-section').style.display = 'none';
    // show surat
    document.getElementById('surat-section').style.display = 'block';
  }
</script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
