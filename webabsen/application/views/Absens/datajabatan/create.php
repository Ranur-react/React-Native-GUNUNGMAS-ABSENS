<script>
	$(function() {
		$('.datepicker').datepicker({
			autoclose: true
		});
		$('input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		})
	});
</script>
<div class="modal fade" id="modal_tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data</h4>
			</div>
			<?= form_open('Absens/GajiKaryawan/store', ['class' => 'form_create']) ?>
			<div class="modal-body">

				<div class="form-group">
					<label>Id Jabatan</label>
					<input type="text" name="id" class="form-control" placeholder="Id Jabatan">
					<span class="error id text-red"></span>
				</div>

				<div class="form-group">
					<label>Nama Jabatan</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama Jabatan">
					<span class="error nama text-red"></span>
				</div>

				<div class="form-group">
					<label>Gaji Pokok / bulan</label>
					<input type="text" name="gapok" class="form-control" placeholder="900000">
					<span class="error gapok text-red"></span>
				</div>

				<div class="form-group">
					<label>Tunjangan Disiplin</label>
					<input type="text" name="tunjangan" class="form-control" placeholder="500000">
					<span class="error nohp text-red"></span>
				</div>

				<div class="form-group">
					<label>Potongan Disiplin /hari</label>
					<textarea type="text" name="potongan" class="form-control" placeholder="10000"></textarea>
					<span class="error potongan text-red"></span>
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
					window.location.href = "<?= site_url('dk') ?>";
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