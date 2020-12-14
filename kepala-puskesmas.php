<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/kepala-puskesmas.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $Kepala_Puskesmas = new Kepala_Puskesmas($db);
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
						<h4 class="text-blue h4"><i class="dw dw-user-11"></i> Data Kepala Puskesmas</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID</th>
                                    <th>NIP</th>
									<th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $kepala_puskesmass = $Kepala_Puskesmas->readAll(); while ($row = $kepala_puskesmass->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_kepala_puskesmas']?></td>
                                    <td><?=$row['nip']?></td>
                                    <td><?=$row['nama']?></td>
                                    <td><?=$row['username']?></td>
                                    <td><?=$row['password']?></td>
									<td>
										<a class="dropdown-item link-action" href="kepala-puskesmas-update.php?id=<?php echo $row['id_kepala_puskesmas']; ?>"><i class="dw dw-edit-1"></i> Edit</a>
										<!-- <a class="dropdown-item link-action float-left" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item link-action float-left" href="#"><i class="dw dw-delete-3"></i> Delete</a> -->
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
