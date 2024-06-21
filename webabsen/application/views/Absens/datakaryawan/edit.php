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
<div class="modal fade" id="modal_edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Data</h4>
			</div>
			<?= form_open('Absens/DataKaryawan/update', ['id' => 'edit', 'class' => 'form_edit'], ['kode' => $data['id_karyawan']]) ?>
			<div class="modal-body">

				<div class="form-group">
					<label>Id Karyawan</label>
					<input type="text" name="idkaryawan" class="form-control"  value="<?= $data['id_karyawan'] ?>">
					<span class="error idkaryawan text-red"></span>
				</div>

				<div class="form-group">
					<label>Nama Karyawan</label>
					<input type="text" name="namakaryawan" class="form-control"  value="<?= $data['nama_karyawan'] ?>">
					<span class="error namakaryawan text-red"></span>
				</div>

				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control"  value="<?= $data['email'] ?>">
					<span class="error email text-red"></span>
				</div>

				<div class="form-group">
					<label>Nomor Handphone</label>
					<input type="text" name="nohp" class="form-control"  value="<?= $data['nohp'] ?>">
					<span class="error nohp text-red"></span>
				</div>

				
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" ><?= $data['alamat'] ?></textarea>
					<span class="error alamat text-red"></span>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btnUpdate"><i class="icon-floppy-disk"></i> Update</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<script>
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
					window.location.href = "<?= site_url('dk') ?>";
				}
			},
			complete: function() {
				$('.btnUpdate').removeAttr('disabled');
				$('.btnUpdate').html('<i class="icon-floppy-disk"></i> Update');
			}
		});
		return false;
	});
</script>
