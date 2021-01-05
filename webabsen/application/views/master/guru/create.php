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
			<?= form_open('master/Guru/store', ['class' => 'form_create']) ?>
			<div class="modal-body">
				<div class="form-group">
					<label>NIP</label>
					<input type="text" name="nip" class="form-control" placeholder="NIP">
					<span class="error nip text-red"></span>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="namaguru" class="form-control" placeholder="Nama">
					<span class="error namaguru text-red"></span>
				</div>
				<div class="form-group">
					<label>Bidang Studi</label>
					<select class="form-control" name="bidangstudi">
						<option value="">-- Pilih --</option>
						<?php foreach ($dbidangstudi as $d) : ?>
							<option value="<?php echo $d['idmapel']; ?>"><?php echo $d['namamapel']; ?></option>
						<?php endforeach; ?>

					</select>
					<span class="error bidangstudi text-red"></span>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="tempatlahir" class="form-control" placeholder="Tempat Lahir">
					<span class="error tempatlahir text-red"></span>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<div class="input-group date">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="text" name="tanggallahir" class="form-control pull-right datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Lahir">
					</div>
					<span class="error tanggallahir text-red"></span>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label><br>
					<label>
						<input type="radio" name="jeniskelamin" class="minimal" value="L">
						Laki-laki
					</label>&nbsp;
					<label>
						<input type="radio" name="jeniskelamin" class="minimal" value="P">
						Perempuan
					</label><br>
					<span class="error jeniskelamin text-red"></span>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<select class="form-control" name="agama">
						<option value="">-- Pilih --</option>
						<?php foreach ($agama as $a) { ?>
							<option value="<?= $a ?>"><?= $a ?></option>
						<?php } ?>
					</select>
					<span class="error agama text-red"></span>
				</div>
				<div class="form-group">
					<label>Alamat Lengkap</label>
					<textarea name="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
					<span class="error alamat text-red"></span>
				</div>
				<div class="form-group">
					<label>No.Hp</label>
					<input type="text" name="nohp" class="form-control" placeholder="No.Hp">
					<span class="error nohp text-red"></span>
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
					window.location.href = "<?= site_url('gr') ?>";
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
