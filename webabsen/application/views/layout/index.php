<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title . ' | ' . title() ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php $this->load->view('layout/asstes') ?>
</head>

<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		<?php $this->load->view('layout/header') ?>
		<div class="content-wrapper">
			<?php $this->load->view('layout/content-header') ?>
			<section class="content">
				{content}
			</section>
		</div>
		<?php $this->load->view('layout/footer') ?>
	</div>
</body>

</html>
