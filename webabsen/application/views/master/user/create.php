<div class="modal fade" id="modal_tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah User</h4>
			</div>
			<?= form_open('master/user/store', ['class' => 'form_create']) ?>
			<div class="modal-body">
				<div class="form-group ">
					<label>Level</label>
					<select class="form-control" name="level" id="level">
						<option value="">-- Pilih Level --</option>
						<?php foreach ($level as $key => $value) { ?>
							<option value="<?= $key ?>"><?= $value ?></option>
						<?php } ?>
					</select>
					<span class="error level text-red"></span>
				</div>
				<div class="form-group tampil" style="display: none">
					<label class="labelName">Guru</label>
					<select class="form-control select2" id="kode" name="kode" style="width: 100%"></select>
					<span class="error kode text-red"></span>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control">
					<span class="error email text-red"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<span class="error password text-red"></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btnStore"><i class="icon-floppy-disk"></i> Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.select2').select2();

		$("#level").change(function() {
			var level = $("#level").val();
			$.ajax({
				type: "POST",
				url: "<?= site_url('master/user/get_select') ?>",
				data: "&level=" + level,
				dataType: "json",
				success: function(resp) {
					$(".tampil").css({
						"display": resp.display
					});
					$(".labelName").text(resp.label);
					$("#kode").html(resp.data);
				}
			});
		});
	});
	$(document).on('submit', '.form_create', function(e) {
		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			cache: false,
			beforeSend: function() {
				$('.btnStore').attr('disabled', 'disabled');
				$('.btnStore').html('<i class="fa fa-spin fa-spinner"></i> Sedang di Proses');
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
				$('.btnStore').removeAttr('disabled');
				$('.btnStore').html('<i class="icon-floppy-disk"></i> Simpan');
			}
		});
		return false;
	});
</script>