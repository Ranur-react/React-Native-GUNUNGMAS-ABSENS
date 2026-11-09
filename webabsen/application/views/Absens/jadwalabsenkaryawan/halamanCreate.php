<script>
	$(function() {
		$('.datepicker').datepicker({
			autoclose: true
		});
		
		  $('#reservation').daterangepicker();

	});
	function pilihsift(e){
		console.log(e);

	}
	// $(document).on('change', '.pilihsift', function(e) {
	// 	let sift= $('.pilihsift').val()
	// 	// $('.varTabelJudul').val();
	// });
</script>
<script>
// 	let datakaryawan={};
// let i=0;

		$(document).on('click', '.btnback', function(e) {
		window.location=("<?= site_url('Absens/jadwalabsenkaryawan/index') ?>")
	});

		$(document).on('click', '.btntambah', function(e) {
		$.ajax({
			url: "<?= site_url('Absens/JadwalAbsenKaryawan/tambah') ?>",
			success: function(data) {
				$('#tampil_modal').html(data);
				$('#modal_tambah').modal('show');
			}
		});
	});
function IsiTabel() {
			$.ajax({
			url: "<?= site_url('Absens/JadwalAbsenKaryawan/TabelTMP') ?>",
			success: function(data) {
				$('.isiTabel').html(data);
				$('#modal_tambah').modal('hide');

			}
		});
}
IsiTabel() ;
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
					window.location.href = "<?= site_url('jak') ?>";
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
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<button class="btn btn-warning btnback"><i class="fa fa-backward"></i> Kembali</button>
			</div>
			<?= form_open('Absens/JadwalAbsenKaryawan/store', ['class' => 'form_create']) ?>

			<div class="box-body ">
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-4">





								<div class="form-group">
									<label>Id Jadwal</label>
									<input type="text" name="idjadwal" class="form-control" placeholder="Id Jadwal">
									<span class="error idjadwal text-red"></span>
								</div>
							    <div class="form-group">
					                <label>Rentang Tanggal</label>
					                <div class="input-group">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text"  name="rentang" class="form-control pull-right" id="reservation">
					                </div>
					                <!-- /.input group -->
				                </div>
				              <!-- /.form group -->
							
					</div>
					<div class="col-xs-4">

								
								<div class="form-group">
									<label>Shift Karyawan</label>
									<select class="form-control pilihsift" name="shift">
										<option value="">-- Pilih --</option>
										<?php foreach ($dwaktu as $d) : ?>
											<option   value="<?php echo $d['id_waktu']; ?>"><?php echo $d['ket_waktu']; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="error shift text-red"></span>
								</div>

								<div class="form-group">
									<label>Lokasi Absensi</label>
									<select class="form-control" name="lokasi">
										<option value="">-- Pilih --</option>
										<?php foreach ($dlokasi as $d) : ?>
											<option  value="<?php echo $d['id_set_lokasi']; ?>"><?php echo $d['lokasi']; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="error lokasi text-red"></span>
								</div>

								
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-1">

						<button type="button" class="btn btn-success btntambah"><i class="fa fa-plus"></i></button>

					</div>

				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8">
						<center><label>Daftar Karyawan <div class="varTabelJudul"></div>	</label></center>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-8 ">
						<div class="box box box-success">
							<div class="box-body ">
								<?= $this->session->flashdata('pesan'); ?>
								<table class="table table-bordered table-striped data-tabel">
									<thead>
										<tr>
											<th class="text-center">No.</th>
											<th>Nama Karyawan</th>
											<th>No Handphone</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody class="isiTabel">


									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
					</div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btnStore"><i class="icon-floppy-disk"></i> Simpan</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
							<?= form_close() ?>
			
					</div>
				</div>

</div>
		</div>
	</div>
</div>
<div id="tampil_modal"></div>
