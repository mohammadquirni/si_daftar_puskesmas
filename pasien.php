<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/pasien.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $Pasien = new Pasien($db);
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
						<h4 class="text-blue h4"><i class="dw dw-user-2"></i> Data Pasien</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>NIK</th>
									<th>Nama</th>
                                    <th>TTL</th>
                                    <th>Jenis Kelamin</th>
									<th>G.Darah</th>
                                    <th>Alamat</th>
									<th>Telp</th>
									<th>KK</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $pasiens = $Pasien->readAll(); while ($row = $pasiens->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['nik']?></td>
                                    <td><?=$row['nama']?></td>
                                    <td><?=$row['tempat_lahir']?>, <?=$row['tgl_lahir']?></td>
                                    <td><?=$row['jenis_kelamin']?></td>
									<td><?=$row['gol_darah']?></td>
                                    <td><?=$row['alamat']?></td>
									<td><?=$row['no_telpon']?></td>
									<td><?=$row['kepala_keluarga']?></td>
									<!-- <td>
										<a class="dropdown-item link-action" href="pasien-detail.php?id=<?php echo $row['id_pasien']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-eye"></i> Detail</a> | 
										<a class="dropdown-item link-action" href="pasien-update.php?id=<?php echo $row['id_pasien']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-edit-1"></i> Edit</a> | 
										<a class="dropdown-item link-action" href="pasien-delete.php?id=<?php echo $row['id_pasien']; ?>&&id_user=<?php echo $row['id_user']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td> -->
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
