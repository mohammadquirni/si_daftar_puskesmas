<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/pasien.inc.php');
    include_once('includes/poli.inc.php');
    include_once('includes/jadwal-periksa.inc.php');

	session_start();
	if (!isset($_SESSION['nik'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $Pasien = new Pasien($db);
    $Poli = new Poli($db);
    $Jadwal_Periksa = new Jadwal_Periksa($db);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Masuk Sistem - SI Pendaftaran Pasien</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style-login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  </head>
  <body>

  <?php
		if($_POST){
			// post jadwal periksa
			$Jadwal_Periksa->id_jadwal_periksa = $_POST["id_jadwal_periksa"];
      $Jadwal_Periksa->id_pasien = $_POST["id_pasien"];
      $Jadwal_Periksa->nomor_antrian = $_POST["nomor_antrian"];
      $Jadwal_Periksa->tgl_periksa = $_POST["tgl_periksa"];
			$Jadwal_Periksa->id_poli = $_POST["id_poli"];
      $Jadwal_Periksa->gejala_penyakit = $_POST["gejala_penyakit"];
      $Jadwal_Periksa->berat_badan = $_POST["berat_badan"];
      $Jadwal_Periksa->tinggi_badan = $_POST["tinggi_badan"];

			if($Jadwal_Periksa->insert()){
				echo '<script language="javascript">';
        echo 'alert("Data Berhasil Terkirim")';
        echo '</script>';
			} else { 
				echo '<script language="javascript">';
        echo 'alert("Data Gagal Terkirim")';
        echo '</script>';
			}
		}
	?>

    <div class="container mt-8">
      <div class="card" style="border:0; box-shadow: 12px 16px 30px 14px #888888;">
        <div class="card-header card-header-xl text-center bg-primary" style="font-size: 16px; color: #FFFFFF;">
          <img class="img-fluid" src="assets/img/sulteng.png" alt="Provinsi Sulawesi Tengah" width="75" height="75"> 
          <br/>
          <a>Puskesmas Mamboro</a>
          <br/>
          <a>Selamat datang, <?php echo ucwords($_SESSION['nama']); ?></a>
        </div>

        <div class="card-body">
          <form method="POST">
            <div class="form-row">
              <!-- hidden form -->
              <input type="hidden" name="id_jadwal_periksa" value="<?php echo $Jadwal_Periksa->getNewId(); ?>">
							<input type="hidden" name="id_pasien" value="<?php echo ($_SESSION['id_pasien']); ?>">
              <div class="form-group col-md-12">
                <label>No Antrian</label>
                <input type="text" class="form-control bg-light" name="nomor_antrian" value="<?php echo $Jadwal_Periksa->getNewAntrian(); ?>">
              </div>
              <div class="form-group col-md-12">
                <label>Tanggal Periksa</label>
                <input type="text" class="form-control bg-light" name="tgl_periksa" value="<?php echo date("Y-m-d"); ?>">
              </div>
              <div class="form-group col-md-12">
                <label>Poli</label>
                <select class="form-control bg-light" name="id_poli">
									<option selected disabled>Choose...</option>
										<?php $no=1; $polis = $Poli->readAll(); while ($row = $polis->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_poli']?>"><?=$row['nama_poli']?></option>
										<?php endwhile; ?>
								</select>
              </div>
              <div class="form-group col-md-12">
                <label>Gejala Penyakit</label>
                <input type="text" class="form-control bg-light" name="gejala_penyakit">
              </div>
              <div class="form-group col-md-12">
                <label>Berat Badan</label>
                <input type="number" class="form-control bg-light" name="berat_badan">
              </div>
              <div class="form-group col-md-12">
                <label>Tinggi Badan</label>
                <input type="number" class="form-control bg-light" name="tinggi_badan">
              </div>
              <div class="form-group col-md-12">
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-info btn-block">Daftar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="card-footer text-center bg-primary" style="color:#FFFFFF; font-size: 14px;">
          <a>&copy; 165610079 - Mohammad Quirni</a>
        </div>
        
      </div>
    </div>
  </body>
</html>

