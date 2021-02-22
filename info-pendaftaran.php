<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/jadwal-periksa.inc.php');

    $config = new Config(); $db = $config->getConnection();

    $Jadwal_Periksa = new Jadwal_Periksa($db);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Info Pendaftaran - SI Pendaftaran Pasien</title>
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
          <a>Puskesmas Mamboro</a>
        </div>

        <div class="card-body">
            <div class="form-row">
            <?php $no=1; $jadwal_Periksas = $Jadwal_Periksa->infoPendaftaran(); while ($row = $jadwal_Periksas->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="form-group col-md-12">
                    <label>No Antrian</label>
                    <input type="text" class="form-control bg-light" value="<?=$row['nomor_antrian']?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control bg-light" value="<?=$row['nama_pasien']?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label>Tanggal Periksa</label>
                    <input type="text" class="form-control bg-light" value="<?=$row['tgl_periksa']?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label>Poli</label>
                    <input type="text" class="form-control bg-light" value="<?=$row['nama_poli']?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <button onclick="window.print()" class="btn btn-info btn-block">Cetak</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </div>

        <div class="card-footer text-center bg-primary" style="color:#FFFFFF; font-size: 14px;">
          <a>&copy; 165610079 - Mohammad Quirni</a>
        </div>
        
      </div>
    </div>
  </body>
</html>

