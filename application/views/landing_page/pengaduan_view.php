<div class="content-wrapper" style="padding-top: 40px;">
	<div class="container">

		<!-- Main content -->
		<section class="content-header text-center" style="padding-top:20px">
			<h1 class="text-bold ">
				Layanan Pengaduan Warga
			</h1>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="box box-solid box-comment">
						<div class="box-header with-border">
							<h3 class="box-title"><small><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Mohon isi laporan
									pengaduan Anda dengan lengkap dan benar!</small></h3>
						</div>

						<div class="box-body form">
							<form action="#" id="form">
								<div class="from-body">
									<div class="panel panel-default">
										<div class="panel-heading">
											<b>Identitas Pelapor</b>
										</div>
										<div class="panel-body">
											<div class="form-group">
												<div class="input-group col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
													<span class="input-group-addon">
														<i class="fa fa-user fa-lg" aria-hidden="true"></i>
													</span>
													<input name="nama_pengadu" placeholder="Ketik nama Anda..." class="form-control" type="text">
												</div>
											</div>

											<div class="form-group">
												<div class="input-group col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
													<div class="input-group-addon">
														<i class="fa fa-phone fa-lg" aria-hidden="true"></i>
													</div>
													<input type="text" name="no_telp_pengadu" class="form-control" placeholder="Nomor telepon Anda..."
														onkeypress="return numerica(event)">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Kategori Pengaduan</label>
										<select class="form-control select2" style="width: 100%;" name="select_kategori" id="select_kategori">
											<!-- <option selected="selected" disabled="disabled">-- Pilih Kategori --</option>
												<option>Layanan Publik</option>
												<option>Kesahatan</option>
												<option>Infrastruktur</option>
												<option>Pendidikan</option>
												<option>Keamanan</option>
												<option>Administasi</option>
												<option>Sembako</option>
												<option>Lainnya</option> -->
										</select>
									</div>

									<div class="form-group">
										<textarea name="isi_pengaduan" placeholder="Ketik pengaduan Anda..." class="form-control"
											style="resize: vertical; min-height: 200px;"></textarea>
									</div>

									<div class="form-group">
										<div class="panel panel-default dis_inputFile" style="display:none;">
											<div class="panel-body bg-success">
												<input type="file" name="file" id="file" class="" size="60">
												<!-- <i class="text-red">Lampiran file pengaduan.</i> -->
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="box-footer">
							<button type="button" id="btn_lampiran" class="btn btn-default pull-left text-center"
								onclick="checkLampiran()"><i class="fa fa-file"></i>&nbsp;&nbsp;Lampiran&nbsp;&nbsp;<i
									class="fas fa-angle-down"></i></button>
							<button type="button" id="btn_kirim" class="btn btn-primary pull-right" onclick="kirimPengaduan()"
								data-dismiss="modal">Kirim
								Pengaduan</button>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->

	</div>
	<!-- /.container -->
</div>

<script type="text/javascript">
	var toggle = false;

	$(document).ready(function () {
		setListKategori();
		$('[data-mask]').inputmask();
	});

	function setListKategori(id) {
		$.getJSON("pengaduan/pilihKategori", function (data) {
			$('#select_kategori').empty();
			if (id == 0) {
				$('#select_kategori').append("<option value='0' selected disabled>-- Pilih Kategori --</option>");
				$.each(data, function (key, value) {
					$('#select_kategori').append("<option value=" + value.id_kategori_pengaduan + "> " + value
						.nama_kategori + "</option>");
				});
			} else {
				$('#select_kategori').append("<option value='0' selected disabled>-- Pilih Kategori --</option>");
				$.each(data, function (key, value) {
					if (id == value.id_kategori_pengaduan) {
						$('#select_kategori').append("<option value=" + value.id_kategori_pengaduan + " selected> " + value
							.nama_kategori + "</option>");
					} else {
						$('#select_kategori').append("<option value=" + value.id_kategori_pengaduan + "> " + value
							.nama_kategori + "</option>");
					}
				});
			}
		});
	}

	function kirimPengaduan() {
		$('#btn_kirim').text('kirim...'); //change button text
		$('#btn_kirim').attr('disabled', true); //set button disable 

		var data = new FormData($('#form')[0]);

		// ajax adding data to database
		$.ajax({
			url: "<?php echo site_url('pengaduan/kirimPengaduan') ?>",
			type: "POST",
			data: data,
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
			dataType: "JSON",
			success: function (data) {

				if (data.status) //if success close modal and reload ajax table
				{
					$('.modal_action_status').text(data.message);
					$('#modal_form_sukses').modal('show');
					$('#form')[0].reset();
					setListKategori(0);
				} else {
					$('.modal_action_status_failed').text(data.message);
					$('#modal_form_failed').modal('show');
				}
				$('#btn_kirim').text('Kirim Pengaduan'); //change button text
				$('#btn_kirim').attr('disabled', false); //set button disable  

			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal_action_status_failed').text('Error Kirim Pengaduan!');
				$('#modal_form_failed').modal('show');
				// alert('Error adding / update data');
				$('#btn_kirim').text('Kirim Pengaduan'); //change button text
				$('#btn_kirim').attr('disabled', false); //set button disable   

			}
		});
	}

	function checkLampiran() {
		$('.dis_inputFile').toggle("slide");
		if (toggle == false) {
			toggle = true
			$('#btn_lampiran').html(
				'<i class="fa fa-file"></i>&nbsp;&nbsp;Lampiran&nbsp;&nbsp;<i class="fas fa-angle-up"></i>')
		} else {
			toggle = false
			$('#btn_lampiran').html(
				'<i class="fa fa-file"></i>&nbsp;&nbsp;Lampiran&nbsp;&nbsp;<i class="fas fa-angle-down"></i>')
		}
	}

</script>


<!-- Modal SUCCESS -->
<div class="modal fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-green">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h3 class="modal_action_status">Status Success!</h3>
			</div>

			<div class="modal-footer bg-success">
				<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Modal SUCCESS -->

<!-- Modal FAILED -->
<div class="modal fade" id="modal_form_failed" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-red">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h3 class="modal_action_status_failed">Status Failed!</h3>
			</div>

			<div class="modal-footer bg-danger">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Modal FAILED -->
