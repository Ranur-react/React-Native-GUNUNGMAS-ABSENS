<style type="text/css">
	.foto{
		width: 80px;
		height: 80px; 
		border-radius: 50%
	}
</style>

<script>
	$(function() {


		    //Date picker
    $('#datepicker35').datepicker({
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
			<div class="col-xs-2">
								          <div class="form-group">
					                <label>Pilih Tanggal</label>
					                <div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" onchange="IsiTabel()" class="form-control pull-right datepicker35" value="<?= date('m/d/Y')?>" id="datepicker35">
					                </div>
					                <!-- /.input group -->
					              </div>
					              <!-- /.form group -->
					</div>
					</div>
					</div>

			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Nama Karyawan</th>
							<th>Tanggal Masuk</th>
							<th>Waktu Masuk</th>
							<th>Foto Masuk</th>
							<th>Waktu Pulang</th>
							<th>Foto Pulang</th>
							<th>Keterangan</th>
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
			url: "<?= site_url('Absens/LaporanAbsenHarian/TabelPeriode') ?>",
			data: "&awal="+ $('.datepicker35').val(),
			cache: false,
			success: function(data) {
				$('.isiTabel').html(data);

			}
		});
}
	
	$(document).on('click', '.btncetak', function(e) {

		let kode=$('.datepicker35').val();
let date1= formatDate($('.datepicker35').val());

                    	    setTimeout(function() {
						 		
                                window.location.href = '<?= site_url('Absens/LaporanAbsenHarian/cetak/')?>'+date1;
                            }, 100);

	});

</script>

