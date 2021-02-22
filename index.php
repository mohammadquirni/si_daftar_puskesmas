<!DOCTYPE html>
<html lang="en">
  <?php
    include("config.php");
    include_once('includes/pasien.inc.php');
    include_once('includes/poli.inc.php');
    include_once('includes/jadwal-periksa.inc.php');

    $config = new Config(); $db = $config->getConnection();

    $Pasien = new Pasien($db);
    $Poli = new Poli($db);
    $Jadwal_Periksa = new Jadwal_Periksa($db);
  ?>

  <head>
    <title>Beranda - SI Pendaftaran Pasien</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- add to homescreen -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">

    <link rel="stylesheet" href="assets/css/style-index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">

  <?php
		if($_POST){
      // post pasien
      $Pasien->id_pasien = $_POST["id_pasien"];
      $Pasien->nik = $_POST["nik"];
      $Pasien->nama = $_POST["nama"];
      $Pasien->tempat_lahir = $_POST["tempat_lahir"];
      $Pasien->jenis_kelamin = $_POST["jenis_kelamin"];
      $Pasien->alamat = $_POST["alamat"];
      $Pasien->no_telpon = $_POST["no_telpon"];
      $Pasien->gol_darah = $_POST["gol_darah"];
      $Pasien->kepala_keluarga = $_POST["kepala_keluarga"];
      $Pasien->tgl_lahir = $_POST["tgl_lahir"];

      // post jadwal periksa
			$Jadwal_Periksa->id_jadwal_periksa = $_POST["id_jadwal_periksa"];
      $Jadwal_Periksa->id_pasien = $_POST["id_pasien"];
      $Jadwal_Periksa->nomor_antrian = $_POST["nomor_antrian"];
      $Jadwal_Periksa->tgl_periksa = $_POST["tgl_periksa"];
			$Jadwal_Periksa->id_poli = $_POST["id_poli"];
      $Jadwal_Periksa->gejala_penyakit = $_POST["gejala_penyakit"];
      $Jadwal_Periksa->berat_badan = $_POST["berat_badan"];
      $Jadwal_Periksa->tinggi_badan = $_POST["tinggi_badan"];

			if($Pasien->insert() && $Jadwal_Periksa->insert()){
				echo '<script language="javascript">';
        echo 'alert("Data Berhasil Terkirim")';
        echo '</script>';
        echo "<script>location.href='info-pendaftaran.php'</script>";
			} else { 
				echo '<script language="javascript">';
        echo 'alert("Data Gagal Terkirim")';
        echo '</script>';
			}
		}
	?>

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
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login Admin</a>
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
        <tr>
          <td>1. </td>
          <td>Pendaftaran dilakukan melalui form yang tersedia dalam website.</td>
        </tr>
        <tr>
          <td>2. </td>
          <td>Bagi pasien yang telah mendaftar akan menerima nomor antrian untuk di bawa pada petugas loket pendaftaran di Puskesmas.</td>
        </tr>
        <tr>
          <td>3. </td>
          <td>Bagi pasien yang telah mendaftar tetapi terlambat atau tidak datang ke Puskesmas dengan sesuai nomor antrian maka nomornya akan dipindahkan petugas pada urutan nomor terakhir.</td>
        </tr>
      </table>
    </div>

    <div class="container-fluid p-3 text-center fixed-bottom" style="background-color:#3B90FA; color:#FFFFFF;">
      <h6>&copy; 165610079 - Mohammad Quirni</h6>
    </div>

    <?php include("modal/daftar_periksa_pasien_baru.php"); ?>

    <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
          navigator.serviceWorker.register('service-worker.js')
            .then(reg => {
              console.log('Service worker registered!', reg);
            })
            .catch(err => {
              console.log('Service worker registration failed: ', err);
            });
        });
      }
    </script>

  </body>
</html>

