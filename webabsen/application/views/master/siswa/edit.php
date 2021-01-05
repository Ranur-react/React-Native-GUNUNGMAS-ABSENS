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
			<?= form_open('master/Siswa/update', ['id' => 'edit', 'class' => 'form_edit'], ['kode' => $data['id_siswa']]) ?>
			<div class="modal-body">
				<div class="form-group">
					<label>NISN</label>
					<input type="text" name="nisn" class="form-control" placeholder="Contoh : 9912345678" value="<?= $data['nisn_siswa'] ?>">
					<span class="error nisn text-red"></span>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Contoh : Jhon Doe" value="<?= $data['nama_siswa'] ?>">
					<span class="error nama text-red"></span>
				</div>
				<div class="form-group">
					<label>Jurusan</label>
					<select class="form-control" name="jurusan">
						<option value="">-- Pilih Kelas --</option>
						<?php foreach ($djurus as $d) : ?>
							<option <?= $data['jurusan_siswa'] == $d['id_jurusan'] ? "selected" : "" ?> value="<?= $d['id_jurusan']; ?>"><?= $d['nama_jurusan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="error jurusan text-red"></span>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $data['tempatlahir_siswa'] ?>">
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<div class="input-group date">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="text" name="tanggal_lahir" class="form-control pull-right datepicker" data-date-format="dd-mm-yyyy" value="<?= format_biasa($data['tanggallahir_siswa']) ?>" placeholder="Tanggal Lahir">
					</div>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label><br>
					<label>
						<input type="radio" name="jenis_kelamin" class="minimal" value="L" <?= $data['jenkel_siswa'] == "L" ? "checked" : "" ?>>
						Laki-laki
					</label>&nbsp;
					<label>
						<input type="radio" name="jenis_kelamin" class="minimal" value="P" <?= $data['jenkel_siswa'] == "P" ? "checked" : "" ?>>
						Perempuan
					</label>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<select class="form-control" name="agama">
						<option value="">-- Pilih --</option>
						<?php foreach ($agama as $a) { ?>
							<option value="<?= $a ?>" <?= $a == $data['agama_siswa'] ? 'selected' : null ?>><?= $a ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="Alamat Lengkap"><?= $data['alamat_siswa'] ?></textarea>
				</div>
				<div class="form-group">
					<label>No.Hp</label>
					<input type="text" name="nohp" class="form-control" placeholder="No.Hp" value="<?= $data['hp_siswa'] ?>">
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
					window.location.href = "<?= site_url('siw') ?>";
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
