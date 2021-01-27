<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/jadwal-dokter.inc.php');
	include_once('includes/dokter.inc.php');
	include_once('includes/poli.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$Jadwal_Dokter = new Jadwal_Dokter($db);
	$Dokter = new Dokter($db);
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
			// post jdawal dokter
			$Jadwal_Dokter->id_jadwal_dokter = $_POST["id_jadwal_dokter"];
			$Jadwal_Dokter->id_dokter = $_POST["id_dokter"];
			$Jadwal_Dokter->hari = $_POST["hari"];
			$Jadwal_Dokter->jam_mulai = $_POST["jam_mulai"];
			$Jadwal_Dokter->jam_selesai = $_POST["jam_selesai"];

			if($Jadwal_Dokter->insert()){
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

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-stethoscope"></i> Data Jadwal Dokter</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div style="padding-right:15px;">
                        <!-- <a href="create"> -->
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button>
                        <!-- </a> -->
                    </div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID</th>
									<th>Dokter</th>
									<th>Poli</th>
                                    <th>Jadwal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwal_dokters = $Jadwal_Dokter->readAll(); while ($row = $jadwal_dokters->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_jadwal_dokter']?></td>
                                    <td><?=$row['nama_dokter']?></td>
                                    <td><?=$row['nama_poli']?></td>
                                    <td><?=$row['hari']?>, <?=$row['jam_mulai']?> - <?=$row['jam_selesai']?></td>
									<td>
										<!-- <a class="dropdown-item link-action" href="jadwal-dokter-detail.php?id=<?php echo $row['id_jadwal_dokter']; ?>"><i class="dw dw-eye"></i> Detail</a> |  -->
										<a class="dropdown-item link-action" href="jadwal-dokter-update.php?id=<?php echo $row['id_jadwal_dokter']; ?>"><i class="dw dw-edit-1"></i> Edit</a> | 
										<a class="dropdown-item link-action" href="jadwal-dokter-delete.php?id=<?php echo $row['id_jadwal_dokter']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
                                <?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

				<!-- Modal Create-->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <form method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- hidden form -->
									<input type="hidden" name="id_jadwal_dokter" value="<?php echo $Jadwal_Dokter->getNewId(); ?>">
									<!-- hidden form -->
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Dokter<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<select class="custom-select col-12" name="id_dokter">
												<option selected disabled>Choose...</option>
												<?php $no=1; $dokters = $Dokter->readAll(); while ($row = $dokters->fetch(PDO::FETCH_ASSOC)) : ?>
													<option value="<?=$row['id_dokter']?>"><?=$row['nama']?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Hari<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<select class="custom-select col-12" name="hari">
												<option selected disabled>Choose...</option>
												<option value="Senin">Senin</option>
												<option value="Selasa">Selasa</option>
												<option value="Rabu">Rabu</option>
												<option value="Kamis">Kamis</option>
												<option value="Jum'at">Jum'at</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Jam Mulai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="time" class="form-control" name="jam_mulai" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Jam Selesai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="time" class="form-control" name="jam_selesai" required>
										</div>
									</div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
