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
					<li><a href="<?= site_url('lam') ?>">Laporan Absensi Mingguan</a></li>
					<li><a href="#">Laporan Absensi Bulanan</a></li>
					<li><a href="#">Laporan Absensi Tahunan</a></li>
					<li><a href="#">Laporan Data Karyawan</a></li>
				</ul>
			</li>
			
			<!-- <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-archive"></i> Pembelajaran<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Materi</a></li>
					<li><a href="#">Kumpulan Soal</a></li>
					<li><a href="#">Tugas</a></li>
					<li><a href="#">Quis & Ujian</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="icon-bubbles5"></i> Diskusi</a></li>
		<?php } else if (level() == 2) { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-database-menu"></i> Rombel <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Rombel Guru</a></li>
					<li><a href="#">Rombel Siswa</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="icon-archive"></i> Materi</a></li>
			<li><a href="#"><i class="icon-file-presentation2"></i> Tugas</a></li>
			<li><a href="#"><i class="icon-graduation2"></i> Quis & Ujian</a></li>
			<li><a href="#"><i class="icon-bubbles5"></i> Diskusi</a></li>
		<?php } else if (level() == 3) { ?>
			<li><a href="#"><i class="icon-database-menu"></i> Rombel</a></li>
			<li><a href="#"><i class="icon-archive"></i> Materi</a></li>
			<li><a href="#"><i class="icon-file-presentation2"></i> Tugas</a></li>
			<li><a href="#"><i class="icon-graduation2"></i> Quis & Ujian</a></li>
			<li><a href="#"><i class="icon-bubbles5"></i> Diskusi</a></li>
		<?php } ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog5"></i> Pengaturan <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#">Profil</a></li>
				<li><a href="#">Ganti Password</a></li>
			</ul>
		</li> -->
	</ul>
</div>