<?php $urls = $this->uri->segment(1) ?>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
	<ul class="nav navbar-nav">
		<li class="<?= $urls == "welcome" ? "active" : null ?>"><a href="<?= site_url('Home') ?>"><i class="icon-home4"></i> Home</a></li>

		<?php if (level() == 1) { ?>

			<li class="dropdown <?= $urls == "wa" || $urls == "jr" || $urls == "kel" || $urls == "mp" || $urls == "siw" || $urls == "gr" || $urls == "user" ? "active" : null ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-stack2"></i> Master Data <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li class="<?= $urls == "wa" ? "active" : null ?>">
						<a href="<?= site_url('wa') ?>">Set Waktu Absensi</a>
					</li>
					<li class="<?= $urls == "jr" ? "active" : null ?>">
						<a href="<?= site_url('la') ?>">Set Lokasi Absensi</a>
					</li>
					<li class="<?= $urls == "gaj" ? "active" : null ?>">
						<a href="<?= site_url('gaj') ?>">Set Gaji & Jabatan Karyawan</a>
					</li>
					<li class="<?= $urls == "kel" ? "active" : null ?>">
						<a href="<?= site_url('dk') ?>">Data Karyawan</a>
					</li>
					<li class="<?= $urls == "kel" ? "active" : null ?>">
						<a href="<?= site_url('jak') ?>">Set Jadwal Absensi Karyawan</a>
					</li>



				</ul>
			</li>

			<li class="dropdown <?= $urls == "am" || $urls == "ap" || $urls == "kel" || $urls == "mp" || $urls == "siw" || $urls == "gr" || $urls == "user" ? "active" : null ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-archive"></i> Data Absensi <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li class="<?= $urls == "am" ? "active" : null ?>">
						<a href="<?= site_url('am') ?>">Data Absensi Masuk</a>
					</li>
					<li class="<?= $urls == "ap" ? "active" : null ?>">
						<a href="<?= site_url('ap') ?>">Data Absensi Pulang</a>
					</li>


				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-database-menu"></i> Laporan <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?= site_url('lah') ?>">Laporan Absensi Harian</a></li>
					<li><a href="<?= site_url('lam') ?>">Laporan Absensi per Periode Tanggal</a></li>
					<li><a href="<?= site_url('lab') ?>">Laporan Absensi Bulanan</a></li>
					<li><a href="<?= site_url('lat') ?>">Laporan Absensi Tahunan</a></li>
					<li><a href="<?= site_url('lk') ?>">Laporan Data Karyawan</a></li>
				</ul>
			</li>

		<?php } else if (level() == 2) { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-database-menu"></i> Laporan Pimpinan <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?= site_url('lah') ?>">Laporan Absensi Harian</a></li>
					<li><a href="<?= site_url('lam') ?>">Laporan Absensi per Periode Tanggal</a></li>
					<li><a href="<?= site_url('lab') ?>">Laporan Absensi Bulanan</a></li>
					<li><a href="<?= site_url('lat') ?>">Laporan Absensi Tahunan</a></li>
					<li><a href="<?= site_url('lk') ?>">Laporan Data Karyawan</a></li>
				</ul>
			</li>
		<?php } else if (level() == 3) { ?>


		<?php } // else if (level() == 2) { 
		?>
	</ul>
</div>