<!-- <div class="content-wrapper" > -->
<div class="content-wrapper" style="padding-top: 30px;">
	<section class="content">
		<div class="book">
			<div class="page">
				<input name="no_surat" id="no_surat" value="<?= $no_surat ?>" class="form-control" type="hidden">

				<div class="row">
					<table class="table no-border no-padding" style="margin-bottom:10px">
						<tbody>
							<tr>
								<td width="22%" class="text-right" rowspan="2">
									<img src="<?= base_url(); ?>assets/img/logo_kab_bekasi.png" height="110" width="100">
								</td>
								<td class="text-center" width="">
									<div style="padding-top:10px;padding-right:30px">
										<p style="font-size: 18pt;line-height: 20px;"><b>PEMERINTAH KABUPATEN BEKASI</b></p>
										<p style="font-size: 18pt;line-height: 20px;"><b>KECAMATAN BABELAN</b></p>
										<p style="font-size: 24pt;line-height: 20px;"><b>DESA KEDUNG PENGAWAS</b></p>
										<p style="font-size: 9pt;line-height: 10px;">Alamat : Jl. Raya Kedung Pengawas 1 No. 1 Kedepos 17610</p>
										<p style="font-size: 9pt;line-height: 0px;" class="text-blue text-bold">Desakedungpengawas153@gmail.com</p>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="row">
					<div class="line"></div>
				</div>

				<div class="row">
					<div class="text-center">
						<text style="font-size: 14px;">
							<strong><u>SURAT KETERANGAN DOMISILI</u></strong><br>
							NOMOR : <?= $no_surat ?>
						</text>
					</div>
				</div>
				<br>

				<div class="row">
					<div class="col-md-12">
						<table class="table no-border">
							<tbody>
								<tr>
									<td class="text-justify">
										<p>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang
											bertanda tangan
											dibawah ini Kepala Desa kedung Pengawas
											Kecamatan
											Babelan
											Kabupaten Bekasi,
											dengan ini menerangakan bahwa:</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<table class="table no-border">
							<tbody>
								<tr>
									<td width="135">
										<p>Nama</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="nama">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Tempat/Tgl lahir</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="ttl">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>No. KTP</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="nik">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Jenis Kelamin</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="jk">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Agama</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="agama">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Kewarganegaraan</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="warganegara">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Status Perkawinan</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="status">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Pekerjaan</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="" id="pekerjaan">
										<p></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Alamat Sebelum</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="">
										<text id="desc_alamat_sebelum"></text><br>
										<p><text id="_desa"></text><text id="_kec"></text><text id="_kab"></text><text id="_prov"></text><text id="_pos"></text></p>
									</td>
								</tr>
								<tr>
									<td width="135">
										<p>Alamat Sekarang</p>
									</td>
									<td width="10">
										<p>:</p>
									</td>
									<td width="">
										<text id="nama_dusun"></text><text id="ket_rt"></text><text id="ket_rw"></text><br>
										<text id="desc_alamat_sekarang"></text>
										<p>Kedung Pengawas, Kec. Babelan, Kab. Bekasi - Jawa Barat, 17610</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<table class="table no-border">
							<tbody>
								<tr>
									<td class="text-justify">
										<p>Benar nama tersebut diatas berdomisili sementara di <text id="nama_dusun_"></text><text id="ket_rt_"></text><text id="ket_rw_"></text>
											Desa Kedung Pengawas Kecamatan
											Babelan Kabupaten Bekasi. Berdasarkan penelitian maupun laporan dan keterangan Domisili ini
											berlaku
											selama
											enam bulan sejak tanggal perngeluaran dan di berikan untuk keperluan : <strong><em>Untuk
													Administrasi
													Kependudukan&hellip;&hellip;&hellip;&hellip;&hellip;</em></strong></p>
									</td>
								</tr>
								<tr>
									<td class="text-justify">
										<p>Demikian Surat Keterangan Domisili ini dibuat dengan sebenarnya dan kepada yang berkepentingan
											agar
											mengetahui sebagaimana mestinya.</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<text class="pull-right">Kedung Pengawas, <?= $tgl_surat ?></text>
						<table class="table no-border text-center">
							<tbody>
								<tr>
									<td width="246">
										<t>Tanda Tangan</t>
										<p>Yang Bersangkutan,</p>
									</td>
									<td width="96">
										<p>&nbsp;</p>
									</td>
									<td width="264">
										<p>A/N Kepala Desa Kedung Pengawas</p>
									</td>
								</tr>
								<tr>
									<td width="246">
										<p>&nbsp;</p>
									</td>
									<td width="96">
										<p>&nbsp;</p>
										<p>&nbsp;</p>
									</td>
									<td width="246">
										<p>&nbsp;</p>
									</td>
								</tr>
								<tr>
									<td width="246" id="signature">
										
									</td>
									<td width="96">
										<p>&nbsp;</p>
									</td>
									<td width="264">
										<p>
											<strong><u>&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</u></strong>
										</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
	var nama_dusun;
	var ket_RT;
	var ket_RW;

	$(document).ready(function () {
		var noSurat = $('#no_surat').val();
		printHasil(noSurat);
	});

	function printHasil(noSurat) {
		var no_surat = noSurat;
		// console.log(no_surat);
		$.ajax({
			url: "<?php echo site_url('pengajuan/print_suratKeterangan') ?>",
			type: "POST",
			data: 'no_surat=' + no_surat,
			success: function (data) {
				// console.log(data.dataform);
				var dataObj = jQuery.parseJSON(data);
				var input = JSON.parse(dataObj.dataForm);
				console.log(input);
				var alamatSebelum = input.alamat_sebelum;  
				var alamatSekarang = input.alamat_sekarang;  

				if (dataObj.status) {
					$('.modal_action_status').html(data.message);
					$('#modal_form_sukses').modal('show');
					$('#nama').html('<p>'+ input.nama_lengkap +'</p>');
					$('#ttl').html('<p>'+ input.tmp_lahir +',&nbsp;'+ input.tgl_lahir +'</p>');
					$('#nik').html('<p>'+ input.no_nik +'</p>');
					$('#jk').html('<p>'+ input.jenis_kelamin +'</p>');
					$('#agama').html('<p>'+ input.nama_lengkap +'</p>');
					$('#warganegara').html('<p>'+ input.kewarganegaraan +'</p>');
					$('#status').html('<p>'+ input.setatus_perkawinan +'</p>');
					$('#pekerjaan').html('<p>'+ input.pekerjaan +'</p>');

					// $('#alamat_sebelum').html('<text>'+ alamatSekarang.dusun +', RT '+ alamatSekarang.RT +' / RW '+ alamatSekarang.RW +'</text><p>'+ alamatSekarang.deskripsi +'</p>');
					get_provinsi(alamatSebelum.provinsi);
					get_kab(alamatSebelum.provinsi, alamatSebelum.kabupaten);
					get_kec(alamatSebelum.kabupaten, alamatSebelum.kecamatan);
					get_desa(alamatSebelum.kecamatan, alamatSebelum.desa)
					$('#_pos').html(', '+alamatSebelum.kode_pos);
					$('#desc_alamat_sebelum').html(alamatSebelum.deskripsi);

					$('#desc_alamat_sekarang').html(alamatSekarang.deskripsi);
					get_nama_dusun(alamatSekarang.dusun);
					get_ket_rt(alamatSekarang.RT);
					get_ket_rw(alamatSekarang.RW);

					$('#signature').html('<p><strong><u>'+ input.nama_lengkap +'</u></strong></p>');
				} else {
					$('.modal_action_status_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}

			},
			error: function (jqXHR, textStatus, errorThrown) {
				window.close();
			}
		});
	}

	function get_nama_dusun(id_dusun) {
		$.getJSON("<?= base_url('pengajuan/getArea_id') ?>/" + id_dusun, function(data) {
			$.each(data, function(key, value) {
				$('#nama_dusun').append(this.nama_area + ', ');
				$('#nama_dusun_').append(this.nama_area + ', ');
			});
		});
	}
	function get_ket_rt(id_rt) {
		$.getJSON("<?= base_url('pengajuan/getRt_id') ?>/" + id_rt, function(data) {
			$.each(data, function(key, value) {
				$('#ket_rt').append('RT '+ this.keterangan + ' ');
				$('#ket_rt_').append('RT '+ this.keterangan + ' ');
			});
		});
	}
	function get_ket_rw(id_rw) {
		$.getJSON("<?= base_url('pengajuan/getRw_id') ?>/" + id_rw, function(data) {
			$.each(data, function(key, value) {
				$('#ket_rw').append('/ RW ' + this.keterangan);
				$('#ket_rw_').append('/ RW ' + this.keterangan);
			});
		});
	}

	function get_provinsi(id_prov) {
		$.ajax({
			type: 'GET',
			url: 'http://dev.farizdotid.com/api/daerahindonesia/provinsi',
			success: function (data) {
				// var dataObj = JSON.parse(data.provinsi);
				// console.log(dataObj);
				// var datprov = dataObj = dataObj.semuaprovinsi;
				
				if (id_prov != null) {
					$.each(data.provinsi, function (key, value) {
						if (value.id == id_prov) {
							$('#_prov').append(' - '+value.nama);
						} else {
							$('#_prov').append('');
						}
					});
				} else {
					$.each(datprov, function (key, value) {
						$('#_prov').append('');
					});
				}
			}
		});
	}
	function get_kab(id_prov, id_kab) {
		$.ajax({
			type: 'GET',
			url: 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + id_prov,
			success: function (data) {
				// var dataObj = jQuery.parseJSON(data);
				// var datakab = dataObj.kabupatens;
				if (id_kab != null) {
					$.each(data.kota_kabupaten, function (key, value) {
						if (value.id == id_kab) {
							$('#_kab').append(', '+value.nama);
						} else {
							$('#_kab').append('');
						}
					});
				} else {
					$.each(datakab, function (key, value) {
						$('#_kab').append('');
					});
				}
			}
		});
	}
	function get_kec(id_kab, id_kec) {
		$.ajax({
			type: 'GET',
			url: 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' + id_kab,
			success: function (data) {
				// var dataObj = jQuery.parseJSON(data);
				// var datakec = dataObj.kecamatans;

				if (id_kec != null) {
					$.each(data.kecamatan, function (key, value) {
						if (value.id == id_kec) {
							$('#_kec').append(', Kec. '+value.nama);
						} else {
							$('#_kec').append('');
						}
					});
				} else {
					$.each(datakab, function (key, value) {
						$('#_kec').append('');
					});
				}
			}
		});
	}
	function get_desa(id_kec, id_desa) {
		$.ajax({
			type: 'GET',
			url: 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=' + id_kec,
			success: function (data) {
				// var dataObj = jQuery.parseJSON(data);
				// var datades = dataObj.desas;

				if (id_desa != null) {
					$.each(data.kelurahan, function (key, value) {
						if (value.id == id_desa) {
							$('#_desa').append(value.nama);
						} else {
							$('#_desa').append('');
						}
					});
				} else {
					$.each(datades, function (key, value) {
						$('#_desa').append('');
					});
				}
			}
		});
	}

	function printDiv() {
		window.print();
	}

	
</script>
