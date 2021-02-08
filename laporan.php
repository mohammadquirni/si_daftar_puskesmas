<?php
	include("config.php");
	include_once("includes/laporan.inc.php");

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();

	$Laporan = new Laporan($db);
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
				<div class="row">
					<div class="col-md-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<h4 class="h4 text-blue">Laporan Jumlah Pasien Setiap Poli</h4>
							<div id="piechart"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
			<?php $no=1; $laporans = $Laporan->jumlahAll(); while ($row = $laporans->fetch(PDO::FETCH_ASSOC)) : ?>
				<?php if($row['id_poli'] == '1'): ?>
					var umum = <?=$row['jumlah']?>;
				<?php elseif($row['id_poli'] == '2'): ?>
					var ibuanak = <?=$row['jumlah']?>;
				<?php elseif($row['id_poli'] == '3'): ?>
					var gigi = <?=$row['jumlah']?>;
				<?php endif; ?>
            <?php endwhile; ?>

			var data = google.visualization.arrayToDataTable([
			['Laporan', 'Perpoli'],
			['Poli Umum', umum],
			['Poli Ibu dan Anak', ibuanak],
			['Poli Gigi', gigi]
			]);

			// Optional; add a title and set the width and height of the chart
			var options = {'title':'Jumlah Pasien Rata-Rata Perpoli'};

			// Display the chart inside the <div> element with id="piechart"
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			chart.draw(data, options);
        }
    </script>

</body>
</html>