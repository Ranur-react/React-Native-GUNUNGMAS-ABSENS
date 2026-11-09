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

<script>
  $(function () {
    //Timepicker
    $('.timepickerX').timepicker({
      showInputs: false,
      showMeridian: false
    })

  })
</script>

<div class="modal fade" id="modal_tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data</h4>
			</div>
			<?= form_open('Absens/WaktuAbsensi/store', ['class' => 'form_create']) ?>
			<div class="modal-body">



				<div class="form-group">
					<label>Id Waktu</label>
					<input type="text" name="idwaktu" class="form-control" placeholder="Id Set Waktu">
					<span class="error idwaktu text-red"></span>
				</div>

        <div class="form-group">
          <label>Keterangan Waktu</label>
          <input type="text" name="ketwaktu" class="form-control" placeholder="Keterangan Waktu">
          <span class="error ketwaktu text-red"></span>
        </div>


				<div class="modal-header">
				<h4 class="modal-title">Jam Masuk</h4>
			</div>
				<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Waktu Mulai</label>
                  <div class="input-group">
                    <input type="text" name="waktumulaimasuk" value="00:00" class="form-control timepickerX">
                    <span class="error waktumulaimasuk text-red"></span>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

				<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Waktu Selesai</label>
                  <div class="input-group">
                    <input type="text" name="waktuselesaimasuk" value="00:00" class="form-control timepickerX">
                    <span class="error waktuselesaimasuk text-red"></span>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Toleransi Keterlambatan</label>
                  <div class="input-group">
                    <input type="text" name="toleransi" value="00:00" class="form-control timepickerX">
                    <span class="error toleransi text-red"></span>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>


				<div class="modal-header">
				<h4 class="modal-title">Jam Pulang</h4>
				</div>
				<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Waktu Mulai</label>
                  <div class="input-group">
                    <input type="text" name="waktumulaikeluar" value="00:00" class="form-control timepickerX">
                    <span class="error waktumulaikeluar text-red"></span>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

				<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Waktu Selesai</label>
                  <div class="input-group">
                    <input type="text" name="waktuselesaikeluar" value="00:00" class="form-control timepickerX">
                    <span class="error waktuselesaikeluar text-red"></span>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
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
					window.location.href = "<?= site_url('wa') ?>";
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
