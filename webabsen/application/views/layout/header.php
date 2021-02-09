<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="navbar-header">
			<a href="<?= site_url() ?>" class="navbar-brand"><b>Sistem Absensi</b> Konter Gunung Mas</a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<i class="fa fa-bars"></i>
			</button>
		</div>
		<?php $this->load->view('layout/navbar') ?>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown messages-menu">
					<a href="#" style="padding-top: 5px; padding-bottom: 0px; text-align: right">
		Level Akses : <br> [<?= (level() == '1' or level() == '2') ? role() : role() ?> ]

					</a>
				</li>

				<li class="dropdown user user-menu" style="border-left: 1px solid #0aabcc">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?= foto() ?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?= user() ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="<?= foto() ?>" class="img-circle" alt="User Image">
							<p>
								<?= user() . ' - ' . role() ?>
								<small><?= bergabung() ?></small>
							</p>
						</li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?= site_url('profil') ?>" class="btn btn-default btn-flat">Profil</a>
							</div>
							<div class="pull-right">
								<a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat">Logout</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>