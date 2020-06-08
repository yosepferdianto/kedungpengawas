<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Mengubah Berita : <b id="l_judul">ldshfvbdsapo</b><br>
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
								<input name="idBerita" id="idBerita" type="hidden" value="<?= $id; ?>"/>
								<div class="col-md-6">
									<label> Informasi detail :</label>
									<div class="card-box">
									<div class="row">
										<div class="col-md-3 text-right">
											<p>Id berita : </p>
											<p>Penulis berita: </p>
											<p>Dibuat pada : </p>
											<p>Diubah pada : </p>
										</div>
										<div class="col-md">
											<p id="id_berita"><?= $id?></p>
											<p id="author"></p>
											<p id="create_at"></p>
											<p id="update_at"></p>
										</div>
										</div>
									</div>
									<hr class="style1">
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
										<label>Cover Depan :</label>
										<input type="hidden" id="set_img" name="set_img">
										<div class="card-image-de" id="img_cover_berita"></div><br>
										<div class="card-image-add_">
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
													<button class="btn btn-defautl btn-flat text-red" title="Batal" type="button" onclick="re_input_img()"><i
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
		CKEDITOR.replace('editor1'); // Use textarea CKEDITOR
		// load data berita
		var idBerita = $('#idBerita').val();
		$('#modal_form_waiting').modal('show');
		loadData(idBerita);
		re_validation(); // reset form validasi

		$('#btn_kirim').on('click', function(){
			$('#modal_form_quest').modal('show');
		}); // konfirmasi
		$('#modal_form_waiting').modal({backdrop: 'static', keyboard: false}) 
	});

	$(document).on('click', '.browse', function () {
		var file = $(this).parent().parent().parent().find('.file');
		file.trigger('click');
	});
	$(document).on('change', '.file', function () {
		$(this).parent().find('#text_file').val($(this).val().replace(/C:\\fakepath\\/i, ''));
		readURL(this);
		if ($('input[name="file"]').val() !== '') {
			$('#text_file').show();
			$('#btn_batal_upload').show();
			$('#show_img').attr('src', '');
			$('#img_cover_berita').html('<img src="file:///'+$('input[name="file"]').val()+'">');
		} else {
			$('#text_file').hide();
			$('#btn_batal_upload').hide();
		}
	});

	function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
				$('#img_cover_berita').html('<img src="' + e.target.result + '">');
			}

      reader.readAsDataURL(input.files[0]);
		}
	}

	function re_input_img() {
		$('input[name="file"]').val();
		$('#text_file').hide();
		$('#btn_batal_upload').hide();

		$('#img_cover_berita').html('<img src="'+$('#get_img').val()+'">');
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

	function loadData(id) { 
		$.ajax({
			url: "<?php echo site_url('admin/berita/load_data_berita/') ?>" + id,
			type: "POST",
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				setTimeout(function(){
					if (data.status) {
						$('#modal_form_waiting').modal('hide');
						console.log(detail.isi_berita);
						$('#author').text(detail.author);
						$('#create_at').text(detail.create_date + ' | ' + detail.create_time + 'WIB');
						$('#update_at').text(detail.update_date + ' | ' + detail.update_time + 'WIB');
						$('[name="judul"]').val(detail.judul_berita);
						$('[name="sub_judul"]').val(detail.sub_judul);
						CKEDITOR.instances.editor1.setData(detail.isi_berita);
						var url_img = detail.foto;
						var set_img = window.location.origin+url_img.replace('.','');
						$('#img_cover_berita').html('<img src="'+set_img+'">');
						$('#set_img').val(url_img);
					} else {
						$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
						$('#body_msg_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				}, 1000);
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				// window.open("<?= base_url('/admin/berita') ?>", '_self');
			}
		});
	}

	function ubahberita() {
		$('#btn_kirim').html('<i class="fas fa-spinner fa-pulse"></i> <b>Kirim Berita</b>'); //change button text
		$('.modal_action_quest').html('<i class="fas fa-spinner fa-pulse fa-5x"></i><br><br>Memuat...');
		$('#btn_kirim').attr('disabled', true); //set button disable 
		re_validation();
		var dataForm = new FormData($('#form')[0]);
		dataForm.append('isi_berita', CKEDITOR.instances['editor1'].getData());
		
		$.ajax({
				url: "<?php echo site_url('admin/berita/ubahberita') ?>",
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
						// console.log(data.message);
						// load data berita
						var idBerita = $('#idBerita').val();
						loadData(idBerita);
					} else {
						// console.log(data.message);
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
							$('#pesan_kesalahan').html('<i class="icon fa fa-exclamation-circle"></i> Gagal mengubah berita, ulangi beberapa saat lagi!');
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
					$('.modal_action_status_failed').text('Error Mengubah Berita!');
					// $('.modal_action_status_failed').text(data.message);
					$('#modal_form_failed').modal('show');
					$('#btn_kirim').html('<i class="fas fa-upload"></i> <b>Kirim Berita</b>'); //change button text
					$('#btn_kirim').attr('disabled', false); //set button disable
					$('.modal_action_quest').html('Apakah berita yang anda tulis sudah benar?');
					re_validation();
					$('#form')[0].reset();
					CKEDITOR.instances.editor1.setData("");
					re_input_img();
				}
		});
	}
	
</script>


<!-- Modal Question -->
<div class="modal fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-question-circle"></i> Konfirmasi Mengubah Berita</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah berita yang anda tulis sudah benar?</h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-primary" onclick="ubahberita()"><b>Ya, ubah </b><i class="fa fa-arrow-right"></i></a>
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

<!-- Modal SUCCESS -->
<div class="modal fade" id="modal_form_waiting" role="dialog"  style="background-color: rgba(0,0,0,0.0); color: white; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
	<div class="modal-dialog modal-sm">
		<!-- <div class="modal-content"> -->
			<!-- <div class="modal-header center"> -->
				<!-- <button type="button" data-dismiss="modal"></button> -->
				<div class="text-center">
					<i class="fas fa-spinner fa-pulse fa-7x"></i>
					<h4>Memuat...</h4>
				</div>
			<!-- </div> -->
		<!-- </div> -->
	</div>
</div>
<!-- End Modal SUCCESS -->
