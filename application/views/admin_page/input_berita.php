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

					<div class="box-body">

						<form action="" method="post" id="form">
							<div class="from-body">
								<div class="col-md-6">
									<!-- Judul Berita -->
									<div class="form-group">
										<label>Judul Berita :</label>
										<input name="judul" id="judul" placeholder="Masukkan judul berita..." class="form-control"
											type="text">
									</div>
									<!-- Sub Judul -->
									<div class="form-group">
										<label>Sub Judul :</label>
										<input name="sub_judul" id="sub_kudul" placeholder="Masukkan sub judul..." class="form-control"
											type="text">
									</div>

								</div>

								<div class="col-md-6">
									<!-- Upload Gambar -->
									<div class="form-group">
										<label>Cover Berita :</label>
										<div class="card-image-add">
											<input type="file" name="img[]" class="file">
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
									<label>Isi Berita :</label>
									<textarea id="editor1" name="editor1" rows="10" cols="80">
										Isi berita.......
									</textarea>
								</div>

							</div>
						</form>
					</div>

					<div class="box-footer">
						<a type="button" class="btn btn-github" href="<?= base_url('admin/berita')?>"><i
								class="fas fa-arrow-left"></i> Data Berita</a>
						<a type="button" id="btn_kirim" class="btn btn-primary pull-right" onclick="prepare()"><i
								class="fas fa-upload"></i> <b>Kirim Berita</b></a>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>

<script type="text/javascript">
	$(document).ready(function () {
		CKEDITOR.replace('editor1')

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

</script>


<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-question-circle"></i> Konfirmasi Surat Pengajuan</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah data yang anda isi sudah benar?<br>
					Jika benar silahkan lanjutkan pembuatan</h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-outline btn-primary" id="" onclick="buatPengajuan()"><b>Lanjut, buat </b><i
						class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Question -->

<!-- Modal SUCCESS -->
<div class="modal modal-success fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-check"></i> Proses Pengajuan berhasil</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_status">Status Success!</h3>
			</div>

			<div class="modal-footer">
				<a class="btn btn-outline" id="btn_print" onclick=""><b>Print Hasil </b><i class="fa fa-arrow-right"></i></a>
			</div>
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
				<h4><i class="fa fa-exclamation-triangle"></i> Pengisisn Formulir Harus Lengkap!</h4>
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
