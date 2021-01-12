<!DOCTYPE html>
<html lang="en">

  <?php
    include("config.php");
    include_once('includes/jadwal-dokter.inc.php');
    include_once('includes/dokter.inc.php');
    include_once('includes/poli.inc.php');

    $config = new Config(); $db = $config->getConnection();

    $Jadwal_Dokter = new Jadwal_Dokter($db);
	  $Dokter = new Dokter($db);
	  $Poli = new Poli($db);
  ?>

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
              <a class="dropdown-item" href="daftar-poli-jadwal.php">Daftar Poli dan Jadwal</a>
              <a class="dropdown-item" href="daftar-dokter.php">Daftar Dokter</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pendaftaran Periksa Pasien
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <!-- <a class="dropdown-item" href="view/view_input/tampil_daftar_periksa_pasien_baru.php">Pasien Baru</a> -->
              <a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#daftar_pasien_baru">
                <i class='fa fa-user-edit text-primary'></i>Pasien Baru</a>
              <a class="dropdown-item text-primary" href="pasien-lama.php">
                <i class='fa fa-user-edit text-primary'></i>Pasien Lama</a>
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

  <div class="main-container">
    <div class="container border" style="background-color:#FFFFFF; padding-top:20px; padding-bottom:100px;">
      <h2><center>Daftar Jadwal Dokter</center></h2>
      <br/>
        <div class="table-responsive">
          <table class="table table-bordered table-sm table-hover table-striped" style="text-align: center;">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Dokter</th>
                <th>Nama Poli</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php $no=1; $jadwal_dokters = $Jadwal_Dokter->readAll(); while ($row = $jadwal_dokters->fetch(PDO::FETCH_ASSOC)) : ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$row['nama_dokter']?></td>
                <td><?=$row['nama_poli']?></td>
                <td><?=$row['hari']?>, <?=$row['jam_mulai']?> - <?=$row['jam_selesai']?></td>
              </tr>
              <?php 
                $no++;
                endwhile; 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    
    <div class="container-fluid p-3 text-center fixed-bottom" style="background-color:#3B90FA; color:#FFFFFF;">
      <h6>&copy; 165610079 - Mohammad Quirni</h6>
    </div>
    
</body>
</html>