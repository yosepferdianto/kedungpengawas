<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Surat Pengajuan
			<small><?= ucwords($ket).'&nbsp;'.strtoupper($this->uri->segment(3)) ?></small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<div class="col-md-12">
							<h3 class="box-title text-bold">Formulir <?= ucwords($ket).'&nbsp;'.strtoupper($this->uri->segment(3)) ?>
								<br><small><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Mohon isi formulir ini dengan
									lengkap dan benar!</small></h3>
									<a href="<?= base_url('pengajuan')?>" type="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-history" aria-hidden="true"></i> Riwayat Pengajuan</a>
						</div>
					</div>

					<div class="box-body">
						<div class="panel panel-default col-md-12" style="padding-top: 8px;">
							<b>PERHATIAN !</b>
							<ul style="padding-left: 20px">
								<li>Mohon isi formulir ini dengan benar!</li>
								<li>Setelah formulir ini diisi, harap diserahkan kembali ke Kantor Desa/Kelurahan.</li>
							</ul>
						</div>
						<form action="" method="post" id="form">
							<div class="from-body">
								<div class="col-md-6">
									<!-- Tujuan -->
									<?php echo $extra; ?>
									<input name="tujuan" value="<?= $nama_kategori ?>" class="form-control" type="hidden">
									<!-- Nama Lengkap -->
									<div class="form-group">
										<label><a class="text-red">*</a> Nama Lengkap :</label>
										<input name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap..." class="form-control" type="text">
									</div>
									<!-- Jenis Kelamin -->
									<div class="form-group">
										<label><a class="text-red">*</a>Jenis Kelamin :</label><br>
										<label style="margin-right:20px;"><input type="radio" class="form-control" name="jenis_kelamin" value="laki-laki" tabindex="-1"/> Laki-laki</label>
										<label><input type="radio" class="form-control" name="jenis_kelamin" value="perempuan" tabindex="-1"/> Perempuan</label>
									</div>
									<!-- Tempat Lahir -->
									<div class="form-group">
										<label><a class="text-red">*</a> Tempat Lahir :</label>
										<input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir"
											placeholder="Tempat lahir..." />
									</div>
									<!-- Tanggal Lahir -->
									<div class="form-group">
										<label><a class="text-red">*</a> Tanggal Lahir :</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir"
												placeholder="dd-mm-yyyy">
										</div>
									</div>
									<!-- Kewarganegaraan -->
									<div class="form-group">
										<label><a class="text-red">*</a> Kewarganegaraan :</label>
										<select class="form-control select2min" style="width: 100%;" name="kewarganegaraan"
											id="kewarganegaraan">
											<option value="Indonesia" selected>Indonesia (WNI)</option>
											<option value="Asing">Asing (WNA)</option>
										</select>
									</div>
									<!-- Agama -->
									<div class="form-group">
										<label><a class="text-red">*</a> Agama :</label>
										<select class="form-control select2min" style="width: 100%;" name="agama" id="agama">
											<option value="-" disabled selected>-- Pilih Agama --</option>
											<option value="Islam">Islam</option>
											<option value="Kristen">Kristen</option>
											<option value="Katholik">Katholik</option>
											<option value="Hindu">Hindu</option>
											<option value="Budha">Budha</option>
											<option value="Khonghucu">Khonghucu</option>
											<option value="Lainnya">Lainnya</option>
										</select>
									</div>
									<!-- Status Perkawinan -->
									<div class="form-group">
										<label><a class="text-red">*</a> Status Perkawinan :</label>
										<select class="form-control select2min" style="width: 100%;" name="status_perkawinan"
											id="status_perkawinan">
											<option value="-" disabled selected>-- Pilih Status Perkawinan --</option>
											<option value="Belum Kawin">Belum Kawin</option>
											<option value="Kawin">Kawin</option>
											<option value="Cerai Hidup">Cerai Hidup</option>
											<option value="Cerai Mati">Cerai Mati</option>
										</select>
									</div>
									<!-- Pekerjaan -->
									<div class="form-group">
										<label><a class="text-red">*</a> Pekerjaan :</label>
										<input name="pekerjaan" placeholder="Pekerjaan..." class="form-control" type="text">
									</div>
								</div>

								<div class="col-md-6">
									<!-- Nomor KK -->
									<div class="form-group">
										<label><a class="text-red">*</a> Nomor KK :</label>
										<input type="text" name="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga..."
											onkeypress="return numerica(event)" maxlength="16">
									</div>
									<!-- Nomor NIK -->
									<div class="form-group">
										<label><a class="text-red">*</a> Nomor NIK :</label>
										<input type="text" name="no_nik" class="form-control" placeholder="Nomor NIK Anda..."
											onkeypress="return numerica(event)" maxlength="16">
									</div>

									<!-- Alamat Lengkap-->
									<div class="form-group">
										<label><a class="text-red">*</a> Alamat Rumah :</label>
										<label class="text-bold"><i> ( Alamat rumah di Desa Kedung Pengawas )</i></label>
										<label class="pull-right">Kode Pos : 17610</label><br>
										<div class="panel panel-default col-md-12" style="padding: 10px;">
											<!-- Desa -->
											<div class="form-group">
												<select class="select2" style="width: 100%;" name="select_dusun" id="select_dusun">
												</select>
											</div>
											<!-- RT/RW -->
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon text-bold">
														RT :
													</div>
													<select class="select2min" style="width: 100%;" name="select_rt" id="select_rt"
														placeholder="RT.."></select>
													<div class="input-group-addon text-bold">
														RW :
													</div>
													<select class="select2min" style="width: 100%;" name="select_rw" id="select_rw"
														placeholder="RW.."></select>
												</div>
											</div>
											<!-- Alamat -->
											<div class="form-group">
												<textarea name="alamat_rumah" placeholder="Masukkan nama jalan, nomor rumah..." class="form-control"
													style="resize: vertical; max-height: 100px; min-height: 100px;" maxlength=""></textarea>
											</div>
										</div>

									</div>

								</div>

							</div>
						</form>
					</div>

					<div class="box-footer">
						<a type="button" id="btn_kirim" class="btn btn-primary pull-right" onclick="prepare()">Buat Pengajuan</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>

<script type="text/javascript">
	var toggle = false;

	$(document).ready(function () {
		listDusun();
		populateRTRW();
		// $('#modal_form_sukses').modal('show');
		// printHasil('002/0505-SDF-002/SKCK/KP/V/2020');
	});

	function listDusun(id_request) {
		$.ajax({
			url: "<?php echo site_url('pengajuan/pilihDusun') ?>",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				if (data) {
					$('#select_dusun').append("<option value='0' selected disabled>-- Pilih Lokasi Dusun --</option>");
					$.each(data, function (key, value) {
						$('#select_dusun').append("<option value=" + value.id_area + "> " + value
							.nama_area + "</option>");
					});
				} else {
					$('#select_dusun').append("<option value='0' selected disabled>-- Pilih Lokasi Dusun --</option>");
					$.each(data, function (key, value) {
						if (value.id_area === id_request) {
							$('#select_dusun').append("<option value=" + value.id_area + " selected> " + value
								.nama_area + "</option>");
						} else {
							$('#select_dusun').append("<option value=" + value.id_area + "> " + value
								.nama_area + "</option>");
						}
					});
				}
			}
		});
	}

	function populateRTRW() {
		$('#select_rw').empty();
		$('#select_rw').html('<option value="" selected disabled>- Pilih RW -</option>');
		$('#select_rt').empty();
		$('#select_rt').html('<option value="" selected disabled>- Pilih RT -</option>');
		$('#select_dusun').on('change', function () { // Kabupaten
			var dusunID = $(this).val();
			$('#select_rw').empty();
			if (dusunID) {
				// RW
				$.ajax({
					url: "<?php echo site_url('pengajuan/pilihRw') ?>/" + dusunID,
					type: 'GET',
					dataType: "JSON",
					success: function (data) {
						if (data) {
							$('#select_rw').html('<option value="" selected disabled>- Pilih RW -</option>');
							$(data).each(function () {
								var option = $('<option />');
								option.attr('value', this.id_rw).text(this.keterangan);
								$('#select_rw').append(option);
							});
						} else {
							$('#select_rw').html('<option value="">RW not available</option>');
						}
					}
				});
				// RT
				$.ajax({
					url: "<?php echo site_url('pengajuan/pilihRt') ?>/" + dusunID,
					type: 'GET',
					dataType: "JSON",
					success: function (data) {
						if (data) {
							$('#select_rt').html('<option value="" selected disabled>- Pilih RT -</option>');
							$(data).each(function () {
								var option = $('<option />');
								option.attr('value', this.id_rt).text(this.keterangan);
								$('#select_rt').append(option);
							});
						} else {
							$('#select_rt').html('<option value="">RT not available</option>');
						}
					}
				});
			} else {
				$('#select_rw').empty();
				$('#select_rw').html('<option value="" selected disabled>- Pilih RW -</option>');
				$('#select_rt').empty();
				$('#select_rt').html('<option value="" selected disabled>- Pilih RT -</option>');
			}
		});
	}

	function prepare(){
		$('#modal_form_quest').modal('show');
	}

	function buatPengajuan() {
		$('#btn_kirim').text('Memuat...'); //change button text
		$('#btn_kirim').attr('disabled', true); //set button disable
		$('#modal_form_quest').modal('hide');

		$.ajax({
			url: "<?php echo site_url('pengajuan/add_suratPengantar') ?>",
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function (data) {
				var dataform = data.dataForm;
				console.log(dataform);
				if (data.status) //if success close modal and reload ajax table
				{
					reloadForm();
					$('#modal_form_quest').modal('hide');
					$('.modal_action_status').html(data.message);
					$('#modal_form_sukses').modal('show');
					$('#form')[0].reset();
					printHasil(dataform.no_surat);
				} else {
					$('#modal_form_quest').modal('hide');
					$('.modal_action_status_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
				$('#btn_kirim').text('Buat Pengajuan'); //change button text
				$('#btn_kirim').attr('disabled', false); //set button disable  

			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal_action_status_failed').text('Error Kirim Pengajuan!');
				$('#modal_form_failed').modal('show');
				$('#modal_form_quest').modal('hide');
				// alert('Error adding / update data');
				$('#btn_kirim').text('Kirim Pengajuan'); //change button text
				$('#btn_kirim').attr('disabled', false); //set button disable   
			}
		});
	}

	function printHasil(no_surat) {
		var noSurat = '?no_surat='+ no_surat;

		$('#btn_print').click(function(){
			window.open("<?= base_url('pengajuan/surat_pengantar') ?>"+noSurat, '');
  	});
	}

	function reloadForm(){
		$('input[name="jenis_tujuan"]').iCheck('uncheck');
		$('input[name="jenis_kelamin"]').iCheck('uncheck');
		$('input[name="no_kk"]').val('');
		$('input[name="no_nik"]').val('');
		$('input[name="nama_lengkap"]').val('');
		$('input[name="tmp_lahir"]').val('');
		$('input[name="tgl_lahir"]').val('');
		$('input[name="kewarganegaraan"]').val('');
		$('#agama').append("<option value='-' selected disabled>-- Pilih Agama --</option>");
		$('#status_perkawinan').append("<option value='' selected disabled>-- Pilih Status Perkawinan --</option>");
		$('input[name="pekerjaan"]').val('');
		listDusun(0);
		populateRTRW();
	}
</script>

<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4><i class="fa fa-question-circle"></i> Konfirmasi Surat Pengajuan</h4>
		  </div>

      <div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah data yang anda isi sudah benar?<br>
				Jika benar silahkan lanjutkan pembuatan</h3>
      </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline btn-danger pull-left" data-dismiss="modal">Batal</button>
        <a class="btn btn-outline btn-primary" id="" onclick="buatPengajuan()"><b>Lanjut, buat </b><i class="fa fa-arrow-right"></i></a>
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
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
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
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
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
