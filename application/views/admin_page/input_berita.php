<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Membuat Berita
			<!-- <small</small> -->
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<!-- <div class="box-header with-border">

					</div> -->

					<div class="box-body form">

						<div class="alert alert-danger" role="alert" style="display:none;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times"></i></button>
							<div id="pesan_kesalahan"><i class="icon fa fa-exclamation-circle"></i> Pesan kesalahan!</div>
						</div>

						<form action="#" id="form">
							<div class="from-body">
								<div class="col-md-6">
									<!-- Judul Berita -->
									<div class="form-group has-feedback" id="box_judul">
										<label id="p_judul"><a class="text-red">*</a> Judul Berita :</label>
										<input name="judul" id="judul" placeholder="Masukkan judul berita..." class="form-control"
											type="text">
									</div>
									<!-- Sub Judul -->
									<div class="form-group has-feedback" id="box_sub_judul">
										<label id="p_sub_judul"><a class="text-red">*</a> Sub Judul :</label>
										<input name="sub_judul" id="sub_judul" placeholder="Masukkan sub judul..." class="form-control"
											type="text">
									</div>

								</div>

								<div class="col-md-6">
									<!-- Upload Gambar -->
									<div class="form-group">
										<label>Cover Berita :</label>
										<div class="card-image-add">
											<input type="file" name="file" class="file">
											<div class="input-group col-xs-12">
												<!-- <span class="input-group-addon"><i class="fa fa-image"></i></span> -->
												<span class="input-group-btn">
													<button class="browse btn btn-primary btn-flat" type="button"><i class="fa fa-image"></i>
														Pilih Gambar</button>
												</span>
												<input type="text" class="form-control" id="text_file" disabled placeholder="Upload Gambar"
													style="display:none">
												<span class="input-group-btn" id="btn_batal_upload" style="display:none">
													<button class="re_input btn btn-defautl btn-flat text-red" title="Batal" type="button"><i
															class="fa fa-times"></i></button>
												</span>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<hr class="style1">
									<label id="p_isi_berita"><a class="text-red">*</a> Isi Berita :</label>
									<div class="card-textarea">
										<textarea id="editor1" rows="10" cols="80">
										</textarea>
									</div>
								</div>

							</div>
						</form>
					</div>

					<div class="box-footer">
						<a type="button" class="btn btn-github" href="<?= base_url('admin/berita')?>"><i
								class="fas fa-arrow-left"></i> Data Berita</a>
						<a type="button" id="btn_kirim" class="btn btn-primary pull-right"><i
								class="fas fa-upload"></i> <b>Kirim Berita</b></a>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>

<script type="text/javascript">
	$(document).ready(function () {
		CKEDITOR.replace('editor1');
		re_validation();
		$('#btn_kirim').on('click', function(){
			$('#modal_form_quest').modal('show');
			// Validasi Input
		});
	});

	$(document).on('click', '.browse', function () {
		var file = $(this).parent().parent().parent().find('.file');
		file.trigger('click');
	});
	$(document).on('change', '.file', function () {
		$(this).parent().find('#text_file').val($(this).val().replace(/C:\\fakepath\\/i, ''));
		if ($('input[name="img[]"]').val() !== '') {
			$('#text_file').show();
			$('#btn_batal_upload').show();
			$('#show_img').attr('src', '');
		} else {
			$('#text_file').hide();
			$('#btn_batal_upload').hide();
		}
	});

	$(document).on('click', '.re_input', function () {
		$('input[name="img[]"]').val('');
		$('#text_file').hide();
		$('#btn_batal_upload').hide();
	});

	function tambahberita() {
		$('#btn_kirim').html('<i class="fas fa-spinner fa-pulse"></i> <b>Kirim Berita</b>'); //change button text
		$('.modal_action_quest').html('<i class="fas fa-spinner fa-pulse fa-5x"></i><br><br>Memuat...');
		$('#btn_kirim').attr('disabled', true); //set button disable 
		re_validation();
		var dataForm = new FormData($('#form')[0]);
		dataForm.append('isi_berita', CKEDITOR.instances['editor1'].getData());

		$.ajax({
				url: "<?php echo site_url('admin/berita/tambahberita') ?>",
				type: "POST",
				data: dataForm,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function (data) {
					if (data.status) //if success close modal and reload ajax table
					{
						$('.alert').hide();
						re_validation();
						$('#modal_form_quest').modal('hide'); 
						$('.modal_action_status').text(data.message);
						$('#modal_form_sukses').modal('show');
						$('#form')[0].reset();
						CKEDITOR.instances.editor1.setData("")
					} else {
						console.log(data.message);
						$('.alert').show();
						$('#modal_form_quest').modal('hide'); 
						// validasi pesan kesalahan
						if(data.message == 'error_login_session'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Ada kesalahan pada sesi login!');
						} else if(data.message == 'id_admin_null'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Ada kesalahan pada sesi login!');
						} else if(data.message == 'judul_null'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Pengisian berita harus dilengkapi, mohon isi judul berita!');
							$('#box_judul').removeClass().addClass('form-group has-error');
							$('#p_judul').html('<a class="text-red">*</a> Judul berita harus terisi!');
						} else if(data.message == 'sub_judul_null'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Pengisian berita harus dilengkapi, mohon isi sub judul berita!');
							$('#box_sub_judul').removeClass().addClass('form-group has-error');
							$('#p_sub_judul').html('<a class="text-red">*</a> Sub Judul harus terisi!');
						} else if(data.message == 'isi_berita_null'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Pengisian berita harus dilengkapi, mohon isi berita dengan lengkap!');
							$('.card-textarea').css("border", "#dd4b39 solid 1px");
							$('#p_isi_berita').css("color", "#dd4b39");
							$('#p_isi_berita').html('<a class="text-red">*</a> Isi Berita harus terisi!');
						} else if(data.message == 'error_input_array'){
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Gagal membuat berita, ulangi beberapa saat lagi!');
						} else {
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Pesan kesalahan!');
						}
					}
					$('#btn_kirim').html('<i class="fas fa-upload"></i> <b>Kirim Berita</b>'); //change button text
					$('#btn_kirim').attr('disabled', false); //set button disable
					$('.modal_action_quest').html('Apakah berita yang anda tulis sudah benar?');
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#modal_form_quest').modal('hide'); 
					$('.modal_action_status_failed').text('Error Membuat Berita!');
					// $('.modal_action_status_failed').text(data.message);
					$('#modal_form_failed').modal('show');
					$('#btn_kirim').html('<i class="fas fa-upload"></i> <b>Kirim Berita</b>'); //change button text
					$('#btn_kirim').attr('disabled', false); //set button disable
					$('.modal_action_quest').html('Apakah berita yang anda tulis sudah benar?');
					re_validation();
				}
		});
	}

	function re_validation() {
		$('#box_judul').removeClass().addClass('form-group has-feedback');
		$('#p_judul').html('<a class="text-red">*</a> Judul Berita :');

		$('#box_sub_judul').removeClass().addClass('form-group has-feedback');
		$('#p_sub_judul').html('<a class="text-red">*</a> Sub Judul :');

		$('.card-textarea').css("border", "#ddd solid 1px");
		$('#p_isi_berita').css("color", "black");
		$('#p_isi_berita').html('<a class="text-red">*</a> Isi Berita :');
	}

	
</script>


<!-- Modal Question -->
<div class="modal fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-question-circle"></i> Konfirmasi Buat Berita</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah berita yang anda tulis sudah benar?</h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-primary" onclick="tambahberita()"><b>Ya, buat </b><i class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Question -->

<!-- Modal SUCCESS -->
<div class="modal modal-success fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header center">
				<!-- <button type="button" data-dismiss="modal"></button> -->
				<div class="text-center">
					<i class="far fa-check-circle fa-10x"></i>
					<h4 class="modal_action_status"></h4>
					<button type="button" class="btn btn-outline" data-dismiss="modal">Oke</button>
				</div>

			</div>

			<!-- <div class="modal-body text-center">
				<h3 class="modal_action_status">Status Success!</h3>
			</div> -->

			<!-- <div class="modal-footer">
				<a class="btn btn-outline" id="" onclick=""><b>Ok</b></a>
			</div> -->
		</div>
	</div>
</div>
<!-- End Modal SUCCESS -->

<!-- Modal FAILED -->
<div class="modal modal-danger fade" id="modal_form_failed" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-exclamation-triangle"></i> Pengisian Harus Lengkap!</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_status_failed">Status Failed!</h3>
			</div>

			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<!-- End Modal FAILED -->
