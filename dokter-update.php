<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/dokter.inc.php');
	include_once('includes/user.inc.php');
	include_once('includes/poli.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID USER.');

	$Dokter = new Dokter($db);
	$Dokter->id_dokter = $id;
	$Dokter->readOne();

	$User = new User($db);
	$User->id_user = $id_user;
	$User->readOne();

	$Poli = new Poli($db);

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
			// post dokter
			$Dokter->id_dokter = $_POST["id_dokter"];
			$Dokter->id_poli = $_POST["id_poli"];
			$Dokter->id_user = $_POST["id_user"];
			$Dokter->nama = $_POST["nama"];
			$Dokter->nip = $_POST["nip"];
			$Dokter->spesialis = $_POST["spesialis"];

			// post user
			$User->id_user = $_POST["id_user"];
			$User->username = $_POST["username"];
			$User->password = $_POST["password"];
			$User->hak_akses = $_POST["hak_akses"];

			if($User->update() && $Dokter->update()){
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Dikirim")';
                echo '</script>';
				echo "<script>location.href='dokter.php'</script>";
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
						<input type="hidden" name="id_dokter" value="<?php echo $Dokter->id_dokter; ?>">
						<input type="hidden" name="id_user" value="<?php echo $User->id_user; ?>">
						<input type="hidden" name="hak_akses" value="<?php echo $User->hak_akses; ?>">
						<div style="padding-right:15px;">
							<!-- <a href="ujian-create"> -->
								<button type="submit" class="btn btn-success float-right">Simpan</button>
							<!-- </a> -->
						</div>
						<!-- horizontal Basic Forms Start -->
						<div class="pd-20 mb-30">
							<div class="form-group">
								<label>NIP</label>
								<input type="number" class="form-control" name="nip" value="<?php echo $Dokter->nip; ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="nama" value="<?php echo $Dokter->nama; ?>">
							</div>
							<div class="form-group">
								<label>Poli</label>
								<div>
									<select class="custom-select col-12" name="id_poli">
										<?php $no=1; $polis = $Poli->readAll(); while ($row = $polis->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_poli']?>" <?php if($Dokter->id_poli == $row['id_poli'] ) echo 'selected' ?>><?=$row['nama_poli']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Spesialis</label>
								<input type="text" class="form-control" name="spesialis" value="<?php echo $Dokter->spesialis; ?>">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username" value="<?php echo $User->username; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="password" value="<?php echo $User->password; ?>">
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
