<div class="modal fade" id="modal_tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data</h4>
			</div>
			<?= form_open('master/Kelas/store', ['class' => 'form_create']) ?>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Kelas</label>
					<input type="text" name="nama" class="form-control" placeholder="Contoh Nama Kelas  : XIPA1">
					<span class="error nama text-red"></span>
				</div>
				<div class="form-group">
					<label>Tingkatan Kelas</label>
					<select class="form-control" name="tingkat">
						<option value="">-- Pilih Kelas --</option>
						<option value="X">Tingkat Sepuluh (X)</option>
						<option value="XI">Tingkat Sebelas (XI)</option>
						<option value="XII">Tingkat Dua-Belas (XII)</option>
					</select>
					<span class="error tingkat text-red"></span>
				</div>
				<div class="form-group">
					<label>Jurusan</label>
					<select class="form-control" name="jurusan">
						<option value="">-- Pilih Kelas --</option>
						<?php foreach ($djurus as $d) : ?>
							<option value="<?= $d['id_jurusan']; ?>"><?= $d['nama_jurusan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="error jurusan text-red"></span>
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
					window.location.href = "<?= site_url('kel') ?>";
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
