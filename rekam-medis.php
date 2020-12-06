<!DOCTYPE html>
<html>

<?php
	include("config.php");
	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();
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
						<h4 class="text-blue h4"><i class="dw dw-name"></i> Data Rekam Medis Pasien</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID Pasien</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr class="text-center">
									<td>10000001</td>
									<td>2582347293472</td>
									<td>Budi Wibowo</td>
									<td>
										<a class="dropdown-item link-action" href="#"><i class="dw dw-eye"></i> View</a>
										<!-- <a class="dropdown-item link-action float-left" href="#"><i class="dw dw-edit2"></i> Edit</a>
										<a class="dropdown-item link-action float-left" href="#"><i class="dw dw-delete-3"></i> Delete</a> -->
									</td>
								</tr>
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
