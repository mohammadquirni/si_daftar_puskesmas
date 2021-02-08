<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal-dokter.inc.php');
	include_once('includes/dokter.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Jadwal_Dokter = new Jadwal_Dokter($db);
	$Jadwal_Dokter->id_jadwal_dokter = $id;
	$Jadwal_Dokter->readOne();

	$Dokter = new Dokter($db);

?>

<!-- header -->
<?php include("header.php"); ?>

<body>
	<!-- head navbar -->
	<?php include("head-navbar.php"); ?>

	<!-- right sidebar -->
	<?php include("right-sidebar.php"); ?>

	<!-- left sidebar -->
    <?php include("left-sidebar.php"); ?>
    
	<div class="mobile-menu-overlay"></div>

	<?php
		if($_POST){
			// post jdawal dokter
			$Jadwal_Dokter->id_jadwal_dokter = $_POST["id_jadwal_dokter"];
			$Jadwal_Dokter->id_dokter = $_POST["id_dokter"];
			$Jadwal_Dokter->hari = $_POST["hari"];
			$Jadwal_Dokter->jam_mulai = $_POST["jam_mulai"];
			$Jadwal_Dokter->jam_selesai = $_POST["jam_selesai"];

			if($Jadwal_Dokter->update()){
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Dikirim")';
                echo '</script>';
				echo "<script>location.href='jadwal-dokter.php'</script>";
			} else { 
				echo '<script language="javascript">';
                echo 'alert("Data Gagal Terkirim")';
                echo '</script>';
			}
		}
	?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Update</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<!-- hidden -->
						<input type="hidden" name="id_jadwal_dokter" value="<?php echo $Jadwal_Dokter->id_jadwal_dokter; ?>">
						<div style="padding-right:15px;">
							<!-- <a href="ujian-create"> -->
								<button type="submit" class="btn btn-success float-right">Simpan</button>
							<!-- </a> -->
						</div>
						<!-- horizontal Basic Forms Start -->
						<div class="pd-20 mb-30">
							<div class="form-group">
								<label>Dokter</label>
								<div>
									<select class="custom-select col-12" name="id_dokter">
										<?php $no=1; $dokters = $Dokter->readAll(); while ($row = $dokters->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_dokter']?>" <?php if($Jadwal_Dokter->id_dokter == $row['id_dokter'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Hari</label>
									<select class="custom-select col-12" name="hari">
										<option value="Senin" <?php if($Jadwal_Dokter->hari == 'Senin' ) echo 'selected' ?>>Senin</option>
										<option value="Selasa" <?php if($Jadwal_Dokter->hari == 'Selasa' ) echo 'selected' ?>>Selasa</option>
										<option value="Rabu" <?php if($Jadwal_Dokter->hari == 'Rabu' ) echo 'selected' ?>>Rabu</option>
										<option value="Kamis" <?php if($Jadwal_Dokter->hari == 'Kamis' ) echo 'selected' ?>>Kamis</option>
										<option value="Jumat" <?php if($Jadwal_Dokter->hari == 'Jumat' ) echo 'selected' ?>>Jumat</option>
									</select>
							</div>
							<div class="form-group">
								<label>Jam Mulai</label>
								<input type="time" class="form-control" name="jam_mulai" value="<?php echo $Jadwal_Dokter->jam_mulai; ?>">
							</div>
							<div class="form-group">
								<label>Jam Selesai</label>
								<input type="time" class="form-control" name="jam_selesai" value="<?php echo $Jadwal_Dokter->jam_selesai; ?>">
							</div>
						</div>
					</form>
				</div>
				<!-- Simple Datatable End -->
			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
