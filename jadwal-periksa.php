<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/jadwal-periksa.inc.php');
	include_once('includes/pasien.inc.php');
	include_once('includes/poli.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$Jadwal_Periksa = new Jadwal_Periksa($db);
	$Pasien = new Pasien($db);
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
									<th>Pasien</th>
									<th>Poli</th>
                                    <th>Tgl Periksa</th>
									<th>Gejala</th>
									<th>Berat Badan</th>
									<th>Nomor Antrian</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwal_Periksas = $Jadwal_Periksa->readAll(); while ($row = $jadwal_Periksas->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_jadwal_periksa']?></td>
                                    <td><?=$row['nama_pasien']?></td>
                                    <td><?=$row['nama_poli']?></td>
                                    <td><?=$row['tgl_periksa']?></td>
									<td><?=$row['gejala_penyakit']?></td>
									<td><?=$row['berat_badan']?></td>
									<td><?=$row['nomor_antrian']?></td>
									<td>
										<!-- <a class="dropdown-item link-action" href="jadwal-periksa-detail.php?id=<?php echo $row['id_jadwal_periksa']; ?>"><i class="dw dw-eye"></i> Detail</a> |  -->
										<!-- <a class="dropdown-item link-action" href="jadwal-periksa-update.php?id=<?php echo $row['id_jadwal_periksa']; ?>"><i class="dw dw-edit-1"></i> Edit</a> |  -->
										<a class="dropdown-item link-action" href="jadwal-periksa-delete.php?id=<?php echo $row['id_jadwal_periksa']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
                                <?php endwhile; ?>
							</tbody>
						</table>
					</div>
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
