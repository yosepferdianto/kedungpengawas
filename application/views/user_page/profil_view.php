<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<i class="fa fa-user-circle-o" aria-hidden="true"></i> Profil Akun
		</h1>
	</section>

	<section class="content" id="load-data">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-success">


					<div class="box-body bg-green-gradient">
						<div class="text-center">
							<?php
								$this->load->helper('text');
								$this->load->helper('tgl_indo');
								$user = 'data_akun_user as u';
								$warga   = 'data_warga as w';
								$keluarga   = 'data_kk_warga as k';
								$area   = 'master_area as area';
								$rt   = 'master_rt as rt';
								$rw   = 'master_rw as rw';

								$this->db->select('
									u.id_akun_user as id_akun_user,
									u.id_warga as id_warga,
									k.id_kk_warga as id_kk_warga,
									u.foto as foto,
									u.username as username,
									u.no_telp as no_telp,
									u.email as email,
									w.nik as nik,
									w.nama_lengkap as nama_lengkap,
									w.jenis_kelamin as jenis_kelamin,
									w.tempat_lahir as tempat_lahir,
									w.tanggal_lahir as tanggal_lahir,
									w.kewarganegaraan as kewarganegaraan,
									w.agama as agama,
									w.pendidikan as pendidikan,
									w.status_perkawinan as status_perkawinan,
									w.pekerjaan as pekerjaan,
									w.gol_darah as gol_darah,
									k.no_kk as no_kk,
									k.nama_kepala as nama_kepala,
									k.deskripsi_alamat as deskripsi_alamat,
									area.nama_area as nama_area,
									rt.keterangan as ket_rt,
									rw.keterangan as ket_rw,
								');
								$this->db->from($user);
								$this->db->join($warga,'w.id_warga = u.id_warga', 'left');
								$this->db->join($keluarga,'k.no_kk = w.no_kk', 'left');
								$this->db->join($area,'area.id_area = k.id_area', 'left');
								$this->db->join($rt,'rt.id_rt = k.id_rt', 'left');
								$this->db->join($rw,'rw.id_rw = k.id_rw', 'left');
								$this->db->where('u.id_akun_user', $user_id);
								$list = $this->db->get()->result_array();
							?>
							<?php foreach ($list as $nm) : ?>
							<img class="profile-user-img img-responsive img-circle" src="<?= base_url($nm['foto']); ?>">
							<h3 class="profile-username text-center"><?= ucwords($nm['nama_lengkap']); ?></h3>
							<p><i class="fa fa-at"></i> <?= $nm['username'];?></p>
						</div>
					</div>

					<div class="box-body text-muted">
						<b><i class="fas fa-phone fa-lg fa-fw"></i> <?= $nm['no_telp'];?></b>
						<hr class="style1">
						<b><i class="fas fa-envelope fa-lg fa-fw"></i> <?= $nm['email'];?></b>
					</div>

					<div class="box-footer">
						<a type="button" class="btn btn-default btn-block btn-sm" onclick="edit_akun('<?= $nm['id_akun_user']?>')"><i class="fa fa-cog"></i> Pengaturan
							Akun</a>
					</div>
				</div>
			</div>

			<div class="col-md-9">
				<div class="nav-tabs-custom tab-success">
					<ul class="nav nav-tabs">
						<li class="pull-left header"><i class="fa fa-id-card"></i> Identitas</li>
						<li class="active"><a href="#personal" data-toggle="tab" aria-expanded="true"><b>Pribadi</b></a>
						</li>
						<li class=""><a href="#kk" data-toggle="tab" aria-expanded="false"><b>Keluarga</b></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="personal">
							<div class="row">
								<div class="col-md-12" style="padding: 20px 20px;">
									<dl class="dl-horizontal">
										<dt>Nomer NIK :</dt>
										<dd><?= $nm['nik'];?></dd>
										<hr class="style1">
										<dt>Nama Lengkap :</dt>
										<dd><?= strtoupper($nm['nama_lengkap']);?></dd>
										<hr class="style1">
										<dt>Jenis Kelamin :</dt>
										<dd><?= ucwords($nm['jenis_kelamin']);?></dd>
										<hr class="style1">
										<dt>Tempat, tanggal Lahir :</dt>
										<dd><?= ucwords($nm['tempat_lahir']);?>, <?= date("d-m-Y", strtotime($nm['tanggal_lahir']));?></dd>
										<hr class="style1">
										<dt>Kewarganegaraan :</dt>
										<dd><?= ucwords($nm['kewarganegaraan']);?></dd>
										<hr class="style1">
										<dt>Agama :</dt>
										<dd><?= ucwords($nm['agama']);?></dd>
										<hr class="style1">
										<dt>Pendidikan :</dt>
										<dd><?= ucwords($nm['pendidikan']);?></dd>
										<hr class="style1">
										<dt>Status Perkawinan :</dt>
										<dd><?= ucwords($nm['status_perkawinan']);?></dd>
										<hr class="style1">
										<dt>Pekerjaan :</dt>
										<dd><?= ucwords($nm['pekerjaan']);?></dd>
										<hr class="style1">
										<dt>Golongan Darah :</dt>
										<dd><?= $nm['gol_darah'];?></dd>
										<hr class="style1">
										<dt>Alamat Rumah :</dt>

										<?php 
											if(empty($nm['nama_area'])){
												$area = '';	
											} else {
												if(empty($nm['deskripsi_alamat'])){
													$alamat = '';
												} else {
													$alamat = '<dd>'.$nm['deskripsi_alamat'].'</dd>';
												}

												$area = $nm['nama_area'].', ';

												if(empty($nm['ket_rt'])){
													$rt = '';
												} else {
													$rt = 'RT '.$nm['ket_rt'];
												}
												if(empty($nm['ket_rw'])){
													$rw = '';	
												} else {
													$rw = ' / RW '.$nm['ket_rw'];
												}
												
												echo $alamat.'
												<dd>'.$area.$rt.$rw.'</dd>
												<dd>Desa Kedung Pengawas - Kode Pos 17610</dd>
												<dd>Kecamatan Babelan, Kabupaten Bekasi, Provinsi Jawa Barat</dd>
												';
											}
										?>
									</dl>
									<a type="button" class="btn btn-default btn-sm pull-right"
										onclick="edit_pribadi('<?= $nm['id_warga']?>')"><i class="fa fa-edit"></i> Ubah
										Data Pribadi</a>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="kk">
							<div class="row">
								<div class="col-md-12" style="padding: 20px 20px;">
									<dl class="dl-horizontal">
										<dt>Nomer KK :</dt>
										<dd><?= $nm['no_kk'];?></dd>
										<hr class="style1">
										<dt>Nama Kepala Keluarga :</dt>
										<dd><?= $nm['nama_kepala'];?></dd>
										<hr class="style1">
										<dt>Alamat Rumah :</dt>
										<dd><?= $nm['nama_area'];?>, <?= $nm['deskripsi_alamat'];?></dd>
										<hr class="style1">
										<dt>RT/RW :</dt>
										<dd><?= $nm['ket_rt'];?> / <?= $nm['ket_rw'];?></dd>
										<?php endforeach; ?>
										<hr class="style1">
										<dt>Kode Pos :</dt>
										<dd>17610</dd>
										<hr class="style1">
										<dt>Desa/Kelurahan :</dt>
										<dd>Kedung Pengawas</dd>
										<hr class="style1">
										<dt>Kecamatan :</dt>
										<dd>Babelan</dd>
										<hr class="style1">
										<dt>Kabupaten/Kota :</dt>
										<dd>Bekasi</dd>
										<hr class="style1">
										<dt>Provinsi :</dt>
										<dd>Jawa Barat</dd>
									</dl>
									<a type="button" class="btn btn-default btn-sm pull-right"
										onclick="edit_kk('<?= $nm['id_warga']?>','<?= $nm['id_kk_warga']?>')"><i class="fa fa-edit"></i> Ubah
										Data Keluarga</a>
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
			</div>
		</div>
	</section>

</div>

<script type="text/javascript">
	var method = "";

	$(document).ready(function () {
		$('#nama_lengkap').keyup(function () {
			this.value = this.value.toUpperCase();
		});
		$('#nama_kk').keyup(function () {
			this.value = this.value.toUpperCase();
		});
	});

	function validasiusername() {
    $('#p_username').text('');
    if ($('#username').val() != '') {
      if ($('#username').val().length >= 8) {
        $('#p_username').html('');
        $('#box_username').removeClass().addClass('form-group has-feedback');
      } else {
        $('#p_username').removeClass().addClass('pull-right text-yellow');
        $('#p_username').html('Username minimal 8 karakter');
        $('#box_username').removeClass().addClass('form-group has-warning');
      }
    } else {
      $('#p_username').removeClass().addClass('pull-right text-red');
      $('#p_username').html('Username tidak boleh kosong !');
      $('#box_username').removeClass().addClass('form-group has-error');
    }
  }

	function edit_akun(id){
		$('#p_username').html('');
		$('#box_username').removeClass().addClass('form-group has-feedback');
		$('input[name="id_akun_user"]').val(id);
		idAkun = 'id_akun=' + id;

		$.ajax({
			url: "<?php echo site_url('profil/detail_data_akun') ?>",
			type: "POST",
			data: idAkun,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				console.log(detail);
				if (data.status) {
					$('#modal_form_edit_akun').modal('show');
					$('input[name="username"]').val(detail.username);
					$('input[name="no_telp"]').val(detail.no_telp);
					$('input[name="email"]').val(detail.email);
				} else {
					$('.modal_action_status_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal_action_status_failed').text('Error simpan!');
				$('#modal_form_failed').modal('show');
			}
		});

		$('#btn_ubah_kata_sandi').on('click', function(){
				$('#modal_form_edit_pass').modal('show');
				$('#pass_lama').val('');
				$('#p_pass_lama').html('');
				$('#box_pass_lama').removeClass().addClass('form-group has-feedback');
				eye_pass_lama();
				$('#pass').val('');
				eye_pass_baru();
				$('#ulangi_pass').val('');
				eye_ulang_pass_baru();
				$('#btn_update_pass').attr('disabled', true);
		});
	}

	function edit_pribadi(id_warga) {
		$('input[name="id_warga_"]').val(id_warga);
		idWarga = 'id_warga=' + id_warga;

		$.ajax({
			url: "<?php echo site_url('profil/detail_data_warga') ?>",
			type: "POST",
			data: idWarga,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				// console.log(detail);
				if (data.status) {
					$('#modal_form_edit_pribadi').modal('show');
					$('input[name="id_warga"]').val(detail.id_warga);
					$('input[name="no_nik"]').val(detail.no_nik);
					$('input[name="nama_lengkap"]').val(detail.nama_lengkap.toUpperCase());
					if (detail.jenis_kelamin === 'laki-laki') {
						$('input[name="jenis_kelamin"][value=laki-laki]').iCheck('check');
					} else {
						$('input[name="jenis_kelamin"][value=perempuan]').iCheck('check');
					}
					$('input[name="tmp_lahir"]').val(detail.tempat_lahir);
					$('input[name="tgl_lahir"]').val(detail.tanggal_lahir);
					$('input[name="tgl_lahir"]').attr("placeholder", detail.tanggal_lahir);
					$('#kewarganegaraan').val(detail.kewarganegaraan);
					$('#kewarganegaraan').trigger('change');
					$('#agama').val(detail.agama);
					$('#agama').trigger('change');
					$('input[name="pendidikan"]').val(detail.pendidikan);
					$('#status_perkawinan').val(detail.status_perkawinan);
					$('#status_perkawinan').trigger('change');
					$('input[name="pekerjaan"]').val(detail.pekerjaan);
					$('#gol_darah').val(detail.gol_darah);
					$('#gol_darah').trigger('change');
					// console.log($r);
				} else {
					$('.modal_action_status_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal_action_status_failed').text('Error Kirim Pengajuan!');
				$('#modal_form_failed').modal('show');
			}
		});
	}

	function edit_kk(id_warga, id_kk_warga) {
		$('input[name="id_warga"]').val(id_warga);
		$('input[name="id_kk_warga"]').val(id_kk_warga);
		idKKWarga = 'id_kk_warga=' + id_kk_warga;

		$.ajax({
			url: "<?php echo site_url('profil/detail_data_kk_warga') ?>",
			type: "POST",
			data: idKKWarga,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				console.log(detail);
				if (data.status) {
					$('#modal_form_edit_keluarga').modal('show');
					$('input[name="no_kk"]').val(detail.no_kk);
					$('input[name="nama_kk"]').val(detail.nama_kk.toUpperCase());
					$('#alamat_rumah').val(detail.deskripsi_alamat);
					listDusun(detail.id_area, detail.id_rw, detail.id_rt);
				} else {
					if(data.message == 'Data tidak ada!') {
						$('#modal_form_edit_keluarga').modal('show');
						listDusun();
					} else {
						$('.modal_action_status_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.modal_action_status_failed').text('Error simpan!');
				$('#modal_form_failed').modal('show');
			}
		});
	}

	function prepare(method) {
		
		if(method === 'edit_pribadi') {
			$('#modal_form_quest').modal('show');
			$('.header_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Simpan Data Pribadi');
		} else if(method === 'edit_kk'){
			$('#modal_form_quest').modal('show');
			$('.header_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Simpan Data Keluarga');
		} else {
			if ($('#username').val() !== '') {
				if ($('#username').val().length >= 8) {
					$('#modal_form_quest').modal('show');
					$('.header_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Simpan Data Akun');
				}
			}
		}

		$('#btn_to_method').on('click', function(){
			save_pribadi(method);
		});
	}

	function save_pribadi(method) {
		$('#btn_simpan').html('<i class="fas fa-spinner"></i>'); //change button text
		$('#btn_simpan').attr('disabled', true); //set button disable
		$('#modal_form_quest').modal('hide');

		var dataForm = "";
		var url = "";

		var inputDate = $('input[name="tgl_lahir"]').val().split('-');
		var tahun = inputDate[2];
		var bulan = inputDate[1];
		var tanggal = inputDate[0];
		newdate = tahun + "-" + bulan + "-" + tanggal;

		if (method === 'edit_pribadi') {
		 	var url = "<?php echo site_url('profil/save_data_warga') ?>";
			var dataForm = {
				id_warga: $('input[name="id_warga_"]').val(),
				no_nik: $('input[name="no_nik"]').val(),
				nama_lengkap: $('input[name="nama_lengkap"]').val(),
				jenis_kelamin: $('#jenis_kelamin:checked').val(),
				tempat_lahir: $('#tmp_lahir').val(),
				tanggal_lahir: newdate,
				kewarganegaraan: $('#kewarganegaraan').val(),
				agama: $('#agama').val(),
				pendidikan: $('#pendidikan').val(),
				status_perkawinan: $('#status_perkawinan').val(),
				pekerjaan: $('#pekerjaan').val(),
				gol_darah: $('#gol_darah').val(),
			};
		} else if(method === 'edit_kk') {
			var url = "<?php echo site_url('profil/save_data_kk_warga') ?>";
			var dataForm = {
				id_warga: $('input[name="id_warga"]').val(),
				id_kk_warga: $('input[name="id_kk_warga"]').val(),
				no_kk: $('input[name="no_kk"]').val(),
				nama_kk: $('input[name="nama_kk"]').val(),
				deskripsi_alamat: $('#alamat_rumah').val(),
				id_area: $('#select_dusun').val(),
				id_rw: $('#select_rw').val(),
				id_rt: $('#select_rt').val()
			};
		} else{
			var url = "<?php echo site_url('profil/save_data_akun') ?>";
			var dataForm = {
				id_akun_user: $('input[name="id_akun_user"]').val(),
				username: $('input[name="username"]').val(),
				no_telp: $('input[name="no_telp"]').val(),
				email: $('input[name="email"]').val(),
			};
		}

		$.ajax({
			type: "POST",
			url: url,
			data: dataForm,
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					$('#modal_form_edit_akun').modal('hide');
					$('#modal_form_edit_pribadi').modal('hide');
					$('#modal_form_edit_keluarga').modal('hide');
					$('#modal_form_quest').modal('hide');
					$('.modal_action_status').html(data.message);
					$('#modal_form_sukses').modal('show');
					$('#load-data').load(window.location.href + " #load-data");
				} else {
					if(data.message == 'Username tidak boleh kosong!'){
						$('#p_username').removeClass().addClass('pull-right text-red');
						$('#p_username').html('Username tidak boleh kosong !');
						$('#box_username').removeClass().addClass('form-group has-error');
					} else if(data.message == 'Username sudah terdaftar!'){
						$('#p_username').removeClass().addClass('pull-right text-red');
						$('#p_username').html('Username sudah terdaftar !');
						$('#box_username').removeClass().addClass('form-group has-error');
					} else {
						$('#modal_form_quest').modal('hide');
						$('.modal_action_status_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				}
				$('#modal_form_quest').modal('hide');
				$('#btn_simpan').html('<i class="fas fa-save"></i> Simpan');
				$('#btn_simpan').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#modal_form_edit_akun').modal('hide');
				$('#modal_form_edit_pribadi').modal('hide');
				$('#modal_form_edit_keluarga').modal('hide');
				$('#modal_form_quest').modal('hide');
				$('.modal_action_status_failed').text('Error Kirim Pengajuan!');
				$('#modal_form_failed').modal('show');
				$('#btn_simpan').html('<i class="fas fa-save"></i> Simpan');
				$('#btn_simpan').attr('disabled', false);
			}
		});
	}

	// ----------------------------------------------------
	function listDusun(request, id_rw, id_rt) {
		$.ajax({
			url: "<?php echo site_url('profil/pilihDusun') ?>",
			type: "GET",
			dataType: "JSON",
			success: function (data) {
				$('#select_dusun').val(request);
				$('#select_dusun').on('change', function() {
					if ($(this).val() === request ) {
						populateRTRW(id_rw, id_rt);	
					} else {
						populateRTRW();
					}
				});

				if (request == null) {
					$('#select_dusun').append("<option value='' selected>-- Pilih Lokasi Dusun --</option>");
					$.each(data, function(key, value) {
						$('#select_dusun').append("<option value=" + value.id_area + "> " + value.nama_area + "</option>");
					});
				} else {
					$('#select_dusun').append("<option value=''>-- Pilih Lokasi Dusun --</option>");
					$.each(data, function(key, value) {
						if (request == value.id_area) {
							setTimeout(function() {
								populateRTRW(id_rw, id_rt);	
							}, 500);
							$('#select_dusun').append("<option value=" + value.id_area + " selected> " + value.nama_area + "</option>");
						} else {
							$('#select_dusun').append("<option value=" + value.id_area + "> " + value.nama_area + "</option>");
						}
					});
				}
			}
		});
	}

	function populateRTRW(idrw, idrt) {
		// $('#select_dusun').on('change', function() {
			var dusunID = $('#select_dusun').val();
			console.log(dusunID);
			if (dusunID) {
				// RW
				$.ajax({
					url: "<?php echo site_url('profil/pilihRw') ?>/" + dusunID,
					type: 'GET',
					dataType: "JSON",
					success: function (data) {
						$('#select_rw').empty();
						if (idrw == null) {
							$('#select_rw').append("<option value='' selected>-- Pilih RW --</option>");
							$.each(data, function(key, value) {
								$('#select_rw').append("<option value=" + value.id_rw + "> " + value.keterangan + "</option>");
							});
						} else {
							$('#select_rw').append("<option value=''>-- Pilih RW --</option>");
							$.each(data, function(key, value) {
								if (idrw == value.id_rw) {
									$('#select_rw').append("<option value=" + value.id_rw + " selected> " + value.keterangan + "</option>");
								} else {
									$('#select_rw').append("<option value=" + value.id_rw + "> " + value.keterangan + "</option>");
								}
							});
						}
					}
				});
				// RT
				$.ajax({
					url: "<?php echo site_url('profil/pilihRt') ?>/" + dusunID,
					type: 'GET',
					dataType: "JSON",
					success: function (data) {
						$('#select_rt').empty();
						if (idrt == null) {
							$('#select_rt').append("<option value='' selected>-- Pilih RW --</option>");
							$.each(data, function(key, value) {
								$('#select_rt').append("<option value=" + value.id_rt + "> " + value.keterangan + "</option>");
							});
						} else {
							$('#select_rt').append("<option value=''>-- Pilih RW --</option>");
							$.each(data, function(key, value) {
								if (idrt == value.id_rt) {
									$('#select_rt').append("<option value=" + value.id_rt + " selected> " + value.keterangan + "</option>");
								} else {
									$('#select_rt').append("<option value=" + value.id_rt + "> " + value.keterangan + "</option>");
								}
							});
						}
					}
				});
			} else {
				$('#select_rw').empty();
				$('#select_rw').html('<option value="" selected disabled>- Pilih RW -</option>');
				$('#select_rt').empty();
				$('#select_rt').html('<option value="" selected disabled>- Pilih RT -</option>');
			}
		// });
	}

	function eye_pass_lama(){
		var passwordField = $('#pass_lama');  
		var passwordFieldType = passwordField.attr('type');
		if(passwordField.val() != ''){
			if(passwordFieldType == 'password')  
			{  
				passwordField.attr('type', 'text');  
				$('.btn_eye_pass_lama').html('<i class="fas fa-eye-slash"></i>');  
			} else {  
				passwordField.attr('type', 'password');  
				$('.btn_eye_pass_lama').html('<i class="fas fa-eye"></i>');  
			}
		} else{
			passwordField.attr('type', 'password');  
			$('.btn_eye_pass_lama').html('<i class="fas fa-eye"></i>');  
		}
	}

	function eye_pass_baru(){
		var passwordField = $('#pass');  
		var passwordFieldType = passwordField.attr('type');
		if(passwordField.val() != ''){
			if(passwordFieldType == 'password')  
			{  
				passwordField.attr('type', 'text');  
				$('.btn_eye_pass_baru').html('<i class="fas fa-eye-slash"></i>');  
			} else {  
				passwordField.attr('type', 'password');  
				$('.btn_eye_pass_baru').html('<i class="fas fa-eye"></i>');  
			}
		} else{
			passwordField.attr('type', 'password');  
			$('.btn_eye_pass_baru').html('<i class="fas fa-eye"></i>');
			$('#p_pass').removeClass().addClass('pull-right text-red');
      $('#p_pass').html('');
      $('#box_pass').removeClass().addClass('form-group has-feedback');
      $('#p_ulangi_pass').html('');
      $('#box_u_pass').removeClass().addClass('form-group has-feedback');
      $('#ulangi_pass').attr('disabled', true);
      $('#ulangi_pass').val('');
		}
	}

	function eye_ulang_pass_baru(){
		var passwordField = $('#ulangi_pass');  
		var passwordFieldType = passwordField.attr('type');
		if(passwordField.val() != ''){
			if(passwordFieldType == 'password')  
			{  
				passwordField.attr('type', 'text');  
				$('.btn_eye_ulang_pass_baru').html('<i class="fas fa-eye-slash"></i>');  
			} else {  
				passwordField.attr('type', 'password');  
				$('.btn_eye_ulang_pass_baru').html('<i class="fas fa-eye"></i>');  
			}
		} else{
			passwordField.attr('type', 'password');  
			$('.btn_eye_ulang_pass_baru').html('<i class="fas fa-eye"></i>');  
		}
	}

	function valid_pass() {
    if ($('#pass').val() != '') {
      if ($('#pass').val().length >= 6) {
        $('#p_pass').html('');
        $('#box_pass').removeClass().addClass('form-group has-success');
        $('#ulangi_pass').attr('disabled', false);

        if ($('#pass').val() == $('#ulangi_pass').val()) {
          $('#p_ulangi_pass').html('');
          $('#p_ulangi_pass').addClass('pull-right text-green');
          $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
          $('#box_u_pass').removeClass().addClass('form-group has-success');
          $('#box_pass').removeClass().addClass('form-group has-success');
        } else {
          $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
          $('#p_ulangi_pass').html('Kata sandi harus sama !');
          $('#box_u_pass').removeClass().addClass('form-group has-feedback');
          $('#box_pass').removeClass().addClass('form-group has-feedback');
        }
      } else {
        $('#p_pass').removeClass().addClass('pull-right text-yellow');
        $('#p_pass').html('Kata sandi minimal 6 karakter');
        $('#box_pass').removeClass().addClass('form-group has-warning');
        $('#p_ulangi_pass').html('');
        $('#box_u_pass').removeClass().addClass('form-group has-feedback');
        $('#ulangi_pass').attr('disabled', true);
      }
    } else {
      $('#p_pass').removeClass().addClass('pull-right text-red');
      $('#p_pass').html('Kata sandi tidak boleh kosong !');
      $('#box_pass').removeClass().addClass('form-group has-feedback');
      $('#p_ulangi_pass').html('');
      $('#box_u_pass').removeClass().addClass('form-group has-feedback');
      $('#ulangi_pass').attr('disabled', true);
      $('#ulangi_pass').val('');
    }
  }

	function samakan_pass() {
    $('#box_pass').removeClass().addClass('form-group has-feedback');
    if ($('#ulangi_pass').val() != '') {
      $('#p_pass').text('');
      $('#p_ulangi_pass').text('');
      if ($('#ulangi_pass').val() === $('#pass').val()) {
				$('#btn_update_pass').attr('disabled', false);
        $('#p_ulangi_pass').html('');
        $('#p_ulangi_pass').addClass('pull-right text-green');
        $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
        $('#box_u_pass').removeClass().addClass('form-group has-success');
        $('#box_pass').removeClass().addClass('form-group has-success');
      } else {
				$('#btn_update_pass').attr('disabled', true);
        $('#p_ulangi_pass').removeClass().addClass('pull-right text-yellow');
        $('#p_ulangi_pass').html('Kata sandi harus sama !');
        $('#box_u_pass').removeClass().addClass('form-group has-warning');
        $('#box_pass').removeClass().addClass('form-group has-feedback');
      }
    } else {
			$('#btn_update_pass').attr('disabled', true);
      $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
      $('#p_ulangi_pass').html('Ulangi sandi tidak boleh kosong !');
      $('#box_u_pass').removeClass().addClass('form-group has-feedback');
    }
  }

	function prepare_pass(){
		if ($('input[name="pass_lama"]').val() !== '' && $('#pass').val() !== '' && $('#ulangi_pass').val() !== ''){
			if ($('#pass').val() == $('#ulangi_pass').val()) {
				$('#modal_form_quest_pass').modal('show');
			}
		}
	}

	function update_pass(){
		var url = "<?php echo site_url('profil/save_pass_akun') ?>";
		var dataForm = {
			id_akun_user: $('input[name="id_akun_user"]').val(),
			pass_lama: $('input[name="pass_lama"]').val(),
			pass: $('input[name="pass"]').val(),
			ulangi_pass: $('input[name="ulangi_pass"]').val(),
		};

		$.ajax({
			type: "POST",
			url: url,
			data: dataForm,
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					$('#modal_form_edit_pass').modal('hide');
					$('#modal_form_quest_pass').modal('hide');
					$('.modal_action_status').html(data.message);
					$('#modal_form_sukses').modal('show');
					$('#load-data').load(window.location.href + " #load-data");
				} else {
					if(data.message == 'Password lama salah!'){
						$('#modal_form_quest_pass').modal('hide');
						$('#p_pass_lama').removeClass().addClass('pull-right text-red');
						$('#p_pass_lama').html('Periksa kembali kata sandi lama Anda!');
						$('#box_pass_lama').removeClass().addClass('form-group has-error');
						$('#pass_lama').val('');
					} else {
						$('#modal_form_quest_pass').modal('hide');
						$('.modal_action_status_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				}
				$('#modal_form_quest').modal('hide');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#modal_form_edit_akun').modal('hide');
				$('#modal_form_edit_pribadi').modal('hide');
				$('#modal_form_edit_keluarga').modal('hide');
				$('#modal_form_quest').modal('hide');
				$('.modal_action_status_failed').text('Error Kirim Pengajuan!');
				$('#modal_form_failed').modal('show');
			}
		});
	}

</script>


<!-- Modal Edit Data Akun -->
<div class="modal fade" id="modal_form_edit_akun" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-green-gradient">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fas fa-cog"></i> Pengaturan Akun Anda</h4>
				<img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/img/user_default.png'); ?>">
				<h5 class="text-center"><?= $nm['nama_lengkap']?></h5>
			</div>

			<div class="modal-body">
				<div class="from-body">
					<input name="id_akun_user" value="" class="form-control" type="hidden">
					<div class="row">
					
						<div class="col-lg-8 col-lg-offset-2">
							<!-- Username -->
							<div class="form-group has-feedback" id="box_username">
								<label>Username</label><small class="text-red" id="p_username"></small>
								<input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username..."
									autofocus oninput="this.value=this.value.replace(' ','');" onkeyup="validasiusername()" />
							</div>

							<div class="form-group has-feedback">
								<label>Nomor telepon</label><small class="text-red" id="p_no_telp"></small>
								<input type="text" class="form-control form-control-user" name="no_telp" id="no_telp"
									placeholder="Nomor telepon..." onkeypress="return numerica(event)"/>
							</div>

							<div class="form-group has-feedback">
								<label>Email</label><small class="text-red" id="p_email"></small>
								<input type="text" class="form-control form-control-user" name="email" id="email"
									placeholder="Email..."/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<a class="btn btn-default btn-sm pull-left" id="btn_ubah_kata_sandi"><i class="fas fa-lock"></i> Ubah Kata Sandi !</a>
						<a class="btn btn-primary pull-right" id="btn_simpan" onclick="prepare('<?= $nm['username']?>')"><i class="fas fa-save"></i> Simpan</a>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal Edit Data Akun -->

<!-- Modal Edit Password -->
<div class="modal fade" id="modal_form_edit_pass" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fas fa-cog"></i> Ubah Kata Sandi</h4>
			</div>

			<div class="modal-body">
				<div class="from-body">
					<input name="id_akun_user" value="" class="form-control" type="hidden">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">

							<div class=" form-group has-feedback" id="box_pass_lama">
								<label style="color:#777"><a class="text-red">*</a> Kata sandi lama</label><small class="text-red pull-right" id="p_pass_lama"></small>
								<div class="input-group">
									<input type="password" class="form-control form-control-user" name="pass_lama" id="pass_lama"
										placeholder="Masukkan Kata sandi lama...">
									<span class="input-group-btn">
										<button type="button" class="btn btn-default btn-flat btn_eye_pass_lama" onclick="eye_pass_lama()" tabindex="-1"><i class="fas fa-eye"></i></button>
									</span>
								</div>
							</div>
							<hr class="style1">

							<div class=" form-group has-feedback" id="box_pass">
								<label style="color:#777"><a class="text-red">*</a> Kata sandi baru</label><small class="text-red pull-right" id="p_pass"></small>
								<div class="input-group">
									<input type="password" class="form-control form-control-user" name="pass" id="pass"
										placeholder="Kata sandi baru..." onkeyup="valid_pass()"/>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default btn-flat btn_eye_pass_baru" onclick="eye_pass_baru()" tabindex="-1"><i class="fas fa-eye"></i></button>
									</span>
								</div>
							</div>

							<div class="form-group has-feedback" id="box_u_pass">
								<label style="color:#777"><a class="text-red">*</a> Ulangi kata sandi baru</label><small class="text-red pull-right" id="p_ulangi_pass"></small>
								<div class="input-group">
									<input type="password" class="form-control form-control-user" name="ulangi_pass" id="ulangi_pass"
									placeholder="Ulangi kata sandi baru..." onkeyup="samakan_pass()" disabled/>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default btn-flat btn_eye_ulang_pass_baru" onclick="eye_ulang_pass_baru()" tabindex="-1"><i class="fas fa-eye"></i></button>
									</span>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<a class="btn btn-warning pull-right" id="btn_update_pass" onclick="prepare_pass()" disabled>Ubah Kata Sandi <i class="fa fa-arrow-right"></i></a>
						<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal Edit Password -->

<!-- Modal Question Ubah Pass-->
<div class="modal modal-warning fade" id="modal_form_quest_pass" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-question-circle"></i> Konfirmasi Ubah Kata Sandi!</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah Anda yakin untuk mengubah kata sandi?</h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-success" onclick="update_pass()"><b>Ya, Ubah</b> <i
						class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Question Ubah Pass -->

<!-- Modal Edit Data Pribadi -->
<div class="modal fade" id="modal_form_edit_pribadi" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fas fa-edit"></i> Data Pribadi Anda</h4>
			</div>

			<div class="modal-body">
				<div class="from-body">
					<input name="id_warga_" value="" class="form-control" type="hidden">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<!-- Nomor NIK -->
							<div class="form-group">
								<label>Nomor NIK :</label>
								<input type="text" name="no_nik" id="no_nik" class="form-control" placeholder="Nomor NIK Anda..."
									onkeypress="return numerica(event)" maxlength="16">
							</div>
							<!-- Nama Lengkap -->
							<div class="form-group">
								<label>Nama Lengkap :</label>
								<input name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap..." class="form-control"
									type="text">
							</div>
							<!-- Jenis Kelamin -->
							<div class="form-group">
								<label>Jenis Kelamin :</label><br>
								<label style="margin-left:30px;margin-right:30px;margin-top:5px;">
									<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="laki-laki" tabindex="-1" />
									Laki-laki
								</label>
								<label>
									<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="perempuan" tabindex="-1" />
									Perempuan
								</label>
							</div>
							<!-- Tempat Lahir -->
							<div class="form-group">
								<label>Tempat Lahir :</label>
								<input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir"
									placeholder="Tempat lahir..." />
							</div>
							<!-- Tanggal Lahir -->
							<div class="form-group">
								<label>Tanggal Lahir :</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" id="datepicker" id="tgl_lahir" name="tgl_lahir"
										placeholder="dd-mm-yyyy">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<!-- Kewarganegaraan -->
							<div class="form-group">
								<label>Kewarganegaraan :</label>
								<select class="form-control select2min" style="width: 100%;" name="kewarganegaraan" id="kewarganegaraan"
									placeholder="-- Kewarganegaraan --">
									<option value="" disabled>-- Kewarganegaraan --</option>
									<option value="indonesia">Indonesia (WNI)</option>
									<option value="asing">Asing (WNA)</option>
								</select>
							</div>
							<!-- Agama -->
							<div class="form-group">
								<label>Agama :</label>
								<select class="form-control select2min" style="width: 100%;" name="agama" id="agama">
									<option value="" disabled selected>-- Pilih Agama --</option>
									<option value="islam">Islam</option>
									<option value="kristen">Kristen</option>
									<option value="katholik">Katholik</option>
									<option value="hindu">Hindu</option>
									<option value="budha">Budha</option>
									<option value="khonghucu">Khonghucu</option>
									<option value="lainnya">Lainnya</option>
								</select>
							</div>
							<!-- Pendidikan -->
							<div class="form-group">
								<label>Pendidikan :</label>
								<input name="pendidikan" id="pendidikan" placeholder="Pendidikan..." class="form-control" type="text">
							</div>
							<!-- Status Perkawinan -->
							<div class="form-group">
								<label>Status Perkawinan :</label>
								<select class="form-control select2min" style="width: 100%;" name="status_perkawinan"
									id="status_perkawinan">
									<option value="" selected disabled>-- Pilih Status Perkawinan --</option>
									<option value="belum_kawin">Belum Kawin</option>
									<option value="kawin">Kawin</option>
									<option value="cerai_hidup">Cerai Hidup</option>
									<option value="cerai_mati">Cerai Mati</option>
								</select>
							</div>
							<!-- Pekerjaan -->
							<div class="form-group">
								<label>Pekerjaan :</label>
								<input name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan..." class="form-control" type="text">
							</div>
							<!-- Golongan Darah -->
							<div class="form-group">
								<label>Golongan Darah :</label>
								<select class="form-control select2min" style="width: 30%;" name="gol_darah" id="gol_darah">
									<option value="" selected disabled>-- Pilih --</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="AB">AB</option>
									<option value="O">O</option>
								</select>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="modal-footer">
				<a class="btn btn-primary" id="btn_simpan" onclick="prepare('edit_pribadi')"><i class="fas fa-save"></i> Simpan</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal Edit Data Pribadi -->

<!-- Modal Edit Data Keluarga -->
<div class="modal fade" id="modal_form_edit_keluarga" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fas fa-edit"></i> Data Keluarga Anda</h4>
			</div>

			<div class="modal-body">
				<div class="from-body">
					<input name="id_warga" value="" class="form-control" type="hidden">
					<input name="id_kk_warga" value="" class="form-control" type="hidden">
					<!-- Nomor KK -->
					<div class="form-group">
						<label>Nomor KK :</label>
						<input type="text" name="no_kk" id="no_kk" class="form-control" placeholder="Nomor KK Anda..."
							onkeypress="return numerica(event)" maxlength="16">
					</div>
					<!-- Nama KK -->
					<div class="form-group">
						<label>Nama Kepala Keluarga :</label>
						<input name="nama_kk" id="nama_kk" placeholder="Nama Kepala Keluarga..." class="form-control" type="text">
					</div>
					<!-- ALAMAT RUMAH -->
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
								<textarea name="alamat_rumah" id="alamat_rumah" placeholder="Keterangan nama jalan dan nomor rumah..." class="form-control"
									style="resize: vertical; max-height: 100px; min-height: 100px;" maxlength=""></textarea>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<a class="btn btn-primary" id="btn_simpan" onclick="prepare('edit_kk')"><i class="fas fa-save"></i> Simpan</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal Edit Data Keluarga -->

<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4 class="header_quest">...</h4>
			</div>

			<div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah data yang anda isi sudah benar?<br>
					Jika benar, silahkan simpan perubahan</h3>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-success" id="btn_to_method"><b>Simpan</b> <i
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
				<h4><i class="fa fa-check"></i> Proses Simpan Data Berhasil</h4>
			</div>

			<!-- <div class="modal-body text-center">
				<h3 class="modal_action_status">Status Success!</h3>
			</div> -->

			<!-- <div class="modal-footer">
				<a class="btn btn-outline" id="btn_print" onclick=""><b>Print Hasil </b><i class="fa fa-arrow-right"></i></a>
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
				<h4><i class="fa fa-exclamation-triangle"></i> Proses Gagal!</h4>
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