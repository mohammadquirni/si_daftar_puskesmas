    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="home.php">
				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<li>
							<a href="home.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-house-1"></span><span class="mtext">Beranda</span>
							</a>
						</li>
						<?php if ($_SESSION['hak_akses'] == 'dokter'): ?>
							<!-- Dokter -->
							<li>
								<a href="rekam-medis.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-name"></span><span class="mtext">Rekam Medis</span>
								</a>
							</li>
						<?php elseif ($_SESSION['hak_akses'] == 'poli'): ?>
							<!-- Poli -->
							<li>
								<a href="jadwal-poli.php?id=<?php echo $_SESSION['id_poli']; ?>" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-wall-clock1"></span><span class="mtext">Jadwal Periksa Poli</span>
								</a>
							</li>
						<?php elseif ($_SESSION['hak_akses'] == 'administrasi'): ?>
							<!-- Administrasi -->
							<li>
								<a href="dokter.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-stethoscope"></span><span class="mtext">Dokter</span>
								</a>
							</li>
							<li>
								<a href="jadwal-dokter.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-wall-clock2"></span><span class="mtext">Jadwal Dokter</span>
								</a>
							</li>
							<li>
								<a href="poli.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-hospital"></span><span class="mtext">Poli</span>
								</a>
							</li>
							<li>
								<a href="pasien.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-user-2"></span><span class="mtext">Pasien</span>
								</a>
							</li>
							<li>
								<a href="kepala-puskesmas.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-user-11"></span><span class="mtext">Kepala Puskesmas</span>
								</a>
							</li>
							<li>
								<a href="jadwal-periksa.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-wall-clock1"></span><span class="mtext">Jadwal Periksa</span>
								</a>
							</li>
						<?php else: ?>
							<!-- Kepala Puskesmas -->
							<li>
								<a href="laporan.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-analytics-3"></span><span class="mtext">Laporan PerTahun</span>
								</a>
							</li>
							<li>
								<a href="laporan-bulan.php" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-analytics-3"></span><span class="mtext">Laporan PerBulan</span>
								</a>
							</li>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</div>