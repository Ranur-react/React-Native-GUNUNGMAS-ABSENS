<div class="modal fade" id="modal_edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Data</h4>
			</div>
			<?= form_open('master/Kelas/update', ['id' => 'edit', 'class' => 'form_edit'], ['kode' => $data['id_kelas']]) ?>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama Kelas</label>
					<input type="text" name="nama" class="form-control" placeholder="Contoh Nama Kelas  : XIPA1" value="<?= $data['nama_kelas']; ?>">
					<span class="error nama text-red"></span>
				</div>
				<div class="form-group">
					<label>Tingkatan Kelas</label>
					<select class="form-control" name="tingkat">
						<option value="">-- Pilih Kelas --</option>
						<option value="X" <?= $data['tingkatan_kelas'] == 'X' ? 'selected' : null ?>>Tingkat Sepuluh (X)</option>
						<option value="XI" <?= $data['tingkatan_kelas'] == 'XI' ? 'selected' : null ?>>Tingkat Sebelas (XI)</option>
						<option value="XII" <?= $data['tingkatan_kelas'] == 'XII' ? 'selected' : null ?>>Tingkat Dua-Belas (XII)</option>
					</select>
					<span class="error tingkat text-red"></span>
				</div>
				<!-- <div class="form-group">
					<label>Jurusan</label>
					<select class="form-control">
						<option value="">-- Pilih Kelas --</option>
						<?php foreach ($djurus as $d) :
							if ($d['id_jurusan'] == $data['jurusan_kelas']) {
						?>
							<option value="<?= $d['id_jurusan']; ?>" selected>-<?= $d['nama_jurusan']; ?></option>
						<?php } else { ?>
							<option value="<?= $d['id_jurusan']; ?>"><?= $d['nama_jurusan']; ?></option>
						<?php } ?>
						<?php endforeach; ?>
					</select>
					<span class="error tingkat text-red"></span>
				</div> -->
				<div class="form-group">
					<label>Jurusan</label>
					<select class="form-control" name="jurusan">
						<option value="">-- Pilih Kelas --</option>
						<?php foreach ($djurus as $d) : ?>
							<option value="<?= $d['id_jurusan']; ?>" <?= $d['id_jurusan'] == $data['jurusan_kelas'] ? 'selected' : null ?>><?= $d['nama_jurusan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="error jurusan text-red"></span>
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
					window.location.href = "<?= site_url('kel') ?>";
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
