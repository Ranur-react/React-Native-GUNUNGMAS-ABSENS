<script>
	$(function() {
		$('.data-tabel23').DataTable({
			'ordering': false,
		});

		//Date picker
		$('#datepicker35').datepicker({
			autoclose: true
		})
		$('#datepicker36').datepicker({
			autoclose: true
		})
	})
</script>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-xs-2">
						<button class="btn btn-primary btncetak"><i class="fa fa-print"></i> Cetak Laporan</button>
					</div>
					<div class="col-xs-6"></div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Tanggal Awal</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" onchange="IsiTabel()" class="form-control pull-right datepicker35" value="<?= date('m/d/Y') ?>" id="datepicker35">
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Date Akhir</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" onchange="IsiTabel()" class="form-control pull-right datepicker36" value="<?= date('m/d/Y') ?>" id="datepicker36">
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div>
				<!-- Date -->

			</div>
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel23">
					<thead>
						<tr>
							<th class="text-center">No. </th>
							<th>Nama Karyawan</th>
							<th>Lokasi</th>
							<th>Hadir</th>
							<th>Sakit</th>
							<th>Alfa</th>
							<th>Kehadiran Seharunya</th>
							<th>Terlambat</th>
						</tr>
					</thead>
					<tbody class="isiTabel">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function formatDate(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2)
			month = '0' + month;
		if (day.length < 2)
			day = '0' + day;

		return [year, month, day].join('-');
	}

	IsiTabel();

	function IsiTabel() {
		$.ajax({
			type: "post",
			url: "<?= site_url('Absens/LaporanAbsenMingguan/TabelPeriode') ?>",
			data: "&awal=" + $('.datepicker35').val() + "&akhir=" + $('.datepicker36').val(),
			cache: false,
			success: function(data) {
				$('.isiTabel').html(data);

			}
		});
	}
	$(document).on('click', '.btncetak', function(e) {

		let kode = $('.datepicker35').val() + "/" + $('.datepicker36').val();
		let date1 = formatDate($('.datepicker35').val());
		let date2 = formatDate($('.datepicker36').val());

		setTimeout(function() {

			window.location.href = '<?= site_url('Absens/LaporanAbsenMingguan/cetak/') ?>' + date1 + "/" + date2;
		}, 100);

	});
</script>
