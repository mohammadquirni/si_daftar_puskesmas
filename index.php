<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Beranda - SI Pendaftaran Pasien</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style-index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">

    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color:#3B90FA; ">
      <a class="navbar-brand" href="index.php">Sistem Pendaftaran Pasien</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Informasi Puskesmas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="view/view_output/tampil_daftar_poli_jadwal.php">Daftar Poli dan Jadwal</a>
              <a class="dropdown-item" href="view/view_output/tampil_daftar_dokter.php">Daftar Dokter</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pendaftaran Periksa Pasien
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="view/view_input/tampil_daftar_periksa_pasien_baru.php">Pasien Baru</a>
              <a class="dropdown-item" href="view/view_input/tampil_daftar_periksa_pasien_lama.php">Pasien Lama</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view/view_output/tentang.php">Tentang Kami</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid" style="background-color:#3B90FA; color:#FFFFFF; padding-top:60px; padding-bottom:20px;">
      <div class="row">
        <div class="col-3 text-right">
          <img class="img-fluid" src="assets/img/sulteng.png" alt="Provinsi Sulawesi Tengah" width="100" height="100"> 
        </div>
        <div class="col-6 text-center tulisan-judul">
          <h4>PEMERINTAH KOTA PALU</h4>
          <h4>DINAS KESEHATAN</h4>
          <h4>UPTD URUSAN PUSKESMAS MAMBORO</h4>
          <a>Jl. Lentora KM. 13 Kec. Palu Utara Telp (0451) 492282 - Sulawesi Tengah</a>
        </div>
        <div class="col-3 text-left">
           <img class="img-fluid" src="assets/img/puskesmas.png" alt="Provinsi Sulawesi Tengah" width="120" height="120"> 
        </div>
      </div>
    </div>

    <div class="container border" style="padding-top:20px; padding-bottom:60px;" >
      <h2><center>Pendaftaran Pasien Puskesmas</center></h2>
      <br/>
      <p>Perhatikan dan baca petunjuk pendaftaran pasien dengan teliti sebelum melakukan pendaftaran : </p>
      <table class="table table-striped table-responsive table-sm border" >
        <tr >
          <td>1. </td>
          <td>Pendaftaran dapat dilakukan 1 bulan sampai 3 hari sebelum pemeriksaan.</td>
        </tr>
        <tr>
          <td>2. </td>
          <td>Pendaftaran dilakukan melalui form yang tersedia dalam website.</td>
        </tr>
        <tr>
          <td>3. </td>
          <td>Bagi pasien yang telah mendaftar akan menerima nomor antrian untuk di bawa pada petugas loket pendaftaran di Puskesmas.</td>
        </tr>
        <tr>
          <td>4. </td>
          <td>Bagi pasien yang telah mendaftar tetapi terlambat atau tidak datang ke Puskesmas dengan sesuai nomor antrian maka nomornya akan dipindahkan petugas pada urutan nomor terakhir.</td>
        </tr>
      </table>
    </div>

    <div class="container-fluid p-3 text-center fixed-bottom" style="background-color:#3B90FA; color:#FFFFFF;">
      <h6>&copy; 165610079 - Mohammad Quirni</h6>
    </div>

  </body>
</html>

