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


<div class="modal fade" id="modal_edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Data</h4>
			</div>
			<?= form_open('Absens/WaktuAbsensi/update', ['id' => 'edit', 'class' => 'form_edit'], ['kode' => $data['id_waktu']]) ?>
			<div class="modal-body">
				<div class="form-group">
					<label>Id Waktu</label>
					<input type="text" name="idwaktu" class="form-control" placeholder="Id Waktu" value="<?= $data['id_waktu'] ?>">
					<span class="error idwaktu text-red"></span>
				</div>

        <div class="form-group">
          <label>Keterangan Waktu</label>
          <input type="text" name="ketwaktu" class="form-control"  value="<?= $data['ket_waktu'] ?>">
          <span class="error ketwaktu text-red"></span>
        </div>

				<div class="modal-header">
				<h4 class="modal-title">Jam Masuk</h4>
			</div>
				<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Waktu Mulai</label>
                  <div class="input-group">
                    <input type="text" name="waktumulaimasuk" class="form-control timepickerX" value="<?= $data['waktu_mulai_masuk'] ?>">
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
                    <input type="text" name="waktuselesaimasuk" class="form-control timepickerX" value="<?= $data['waktu_selesai_masuk'] ?>">
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
                    <input type="text" name="toleransi" class="form-control timepickerX" value="<?= $data['toleransi'] ?>">
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
                    <input type="text" name="waktumulaikeluar" class="form-control timepickerX" value="<?= $data['waktu_mulai_keluar'] ?>">
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
                    <input type="text" name="waktuselesaikeluar" class="form-control timepickerX" value="<?= $data['waktu_selesai_keluar'] ?>">
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
					window.location.href = "<?= site_url('wa') ?>";
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