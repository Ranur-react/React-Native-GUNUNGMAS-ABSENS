<div class="modal fade" id="modal_edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Data</h4>
			</div>
			<?= form_open('Absens/user/update', ['class' => 'form_edit'], ['kode' => $data['id_user']]) ?>
			<div class="modal-body">
				<div class="form-group ">
					<label>Level </label>
					<input type="text" name="nama" disabled value="<?php
																	foreach ($level as $key => $value) {
																		if ($key == $data['level_user'])
																			echo $value;
																	}
																	?>" class="form-control">
				</div>
				<div class="form-group">
					<label>
						<?php
						foreach ($level as $key => $value) {
							if ($key == $data['level_user'])
								echo 'Nama ' . $value;
						}
						?>
					</label>
					<input type="text" name="nama" disabled value="<?= $nama ?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" value="<?= $data['email'];  ?>" class="form-control">
					<span class="error email text-red"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" onclick="enable_pass()" name="password" class="form-control passbox">
					<span class="error password text-red"></span>
					<span class="pass_info text-blue">Klik untuk ubah password</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btnUpdate"><i class="icon-floppy-disk"></i> Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
	$('.passbox').attr('readonly', 'true');

	function enable_pass() {
		$('.passbox').removeAttr('readonly');
		$('.pass_info').text("Panjang password minimal 8 karakter.");
	}
	$(document).on('submit', '.form_edit', function(e) {
		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			cache: false,
			beforeSend: function() {
				$('.btnUpdate').attr('disabled', 'disabled');
				$('.btnUpdate').html('<i class="fa fa-spin fa-spinner"></i> Sedang di Proses');
			},
			success: function(response) {
				$('.error').html('');
				if (response.status == false) {
					$.each(response.pesan, function(i, m) {
						$('.' + i).text(m);
					});
				} else {
					window.location.href = "<?= site_url('user') ?>";
				}
			},
			complete: function() {
				$('.btnUpdate').removeAttr('disabled');
				$('.btnUpdate').html('<i class="icon-floppy-disk"></i> Simpan');
			}
		});
		return false;
	});
</script>