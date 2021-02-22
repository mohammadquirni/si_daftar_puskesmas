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

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Jadwal_Dokter = new Jadwal_Dokter($db);
	$Jadwal_Dokter->id_poli = $id;

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

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-stethoscope"></i> Data Jadwal Dokter</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>

					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID</th>
									<th>Dokter</th>
									<th>Poli</th>
                                    <th>Jadwal</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwal_dokters = $Jadwal_Dokter->readAllPoli(); while ($row = $jadwal_dokters->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_jadwal_dokter']?></td>
                                    <td><?=$row['nama_dokter']?></td>
                                    <td><?=$row['nama_poli']?></td>
                                    <td><?=$row['hari']?>, <?=$row['jam_mulai']?> - <?=$row['jam_selesai']?></td>
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
