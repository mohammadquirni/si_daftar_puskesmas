<!DOCTYPE html>
<html>

<?php
	include("config.php");

	$config = new Config(); $db = $config->getConnection();

	if ($_POST) {
		include_once 'includes/login.inc.php';
		$login = new Login($db);
    $login->nik = $_POST['nik'];
    $login->nama = $_POST['nama'];
		if ($login->login()) {
			echo "<script>location.href='pasien-lama-daftar.php'</script>";
		} else {
			echo "<script>alert('NIK tidak terdaftar!');</script>";
		}
	}
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

    <div class="container mt-8">
      <div class="card" style="border:0; box-shadow: 12px 16px 30px 14px #888888;">
        <div class="card-header card-header-xl text-center bg-primary" style="font-size: 16px; color: #FFFFFF;">
          <img class="img-fluid" src="assets/img/sulteng.png" alt="Provinsi Sulawesi Tengah" width="75" height="75"> 
          <br/>
          <a>Pendaftaran Periksa Pasien Lama</a>
          <br/>
          <a>Puskesmas Mamboro</a>
        </div>

        <div class="card-body">
          <form role="form" action="" method="POST">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label>NIK</label>
                <input type="password" class="form-control bg-light" name="nik" placeholder="Masukkan NIK">
              </div>
              <div class="form-group col-md-12">
                <label>Nama</label>
                <input type="password" class="form-control bg-light" name="nama" placeholder="Masukkan Nama">
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

