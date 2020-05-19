<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Surat Keterangan Domisili</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet"
		href="<?= base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css">
	<style>
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #FAFAFA;
			font: 12pt "TimesNewRoman";
		}

		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.page {
			width: 210mm;
			min-height: 297mm;
			padding: 5mm 20mm 0mm 20mm;
			margin: 10mm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.subpage {
			padding: 1cm;
			border: 5px red solid;
			height: 257mm;
			outline: 2cm #FFEAEA solid;
		}

		@page {
			size: A4;
			margin: 0;
		}

		@media print {

			html,
			body {
				width: 210mm;
				height: 297mm;
			}

			.page {
				margin: 0;
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}

		.line {
			border: 0;
			border-top: 3px double #000;
			border-bottom: 1px solid #000;
			padding: 0;
			margin: 0;
			margin-bottom: 7px;
		}

		tr td {
			padding: 0 !important;
			margin: 0 !important;
		}

		/* body {
			font-family: "Times New Roman", Times, serif;
			} */

	</style>
</head>

<body>
	<div class="book">
		<div class="page">
			<input name="no_surat" id="no_surat" value="<?= $no_surat ?>" class="form-control" type="hidden">

			<table class="no-border no-margin no-padding">
				<tbody>
					<tr>
						<td width="" class="text-right" rowspan="2">
							<img src="<?= base_url(); ?>assets/img/logo_kab_bekasi.png" height="118" width="110">
						</td>
						<td class="text-center" width="80%">
							<text style="font-size: 18pt;"><b>PEMERINTAH KABUPATEN BEKASI</b></text>
							<text style="font-size: 18pt;"><b>KECAMATAN BABELAN</b></text><br>
							<text style="font-size: 24pt;"><b>DESA KEDUNG PENGAWAS</b></text><br>
						</td>
					</tr>
					<tr>
						<td class="text-center">
							<text style="font-size: 9pt;">Alamat : Jl. Raya Kedung Pengawas 1 No. 1 Kedepos 17610</text><br>
							<text style="font-size: 9pt;" class="text-blue text-bold">Desakedungpengawas153@gmail.com</text>
						</td>
					</tr>
				</tbody>
			</table>
			<br>

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
									<p><text id="_desa"></text><text id="_kec"></text><text id="_kab"></text><text id="_prov"></text><text
											id="_pos"></text></p>
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
									<p>Benar nama tersebut diatas berdomisili sementara di Kp. Kedaung RT 007 RW 002 Desa Kedung
										Pengawas
										Kecamatan
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
						$('#nama').html('<p>' + input.nama_lengkap + '</p>');
						$('#ttl').html('<p>' + input.tmp_lahir + ',&nbsp;' + input.tgl_lahir + '</p>');
						$('#nik').html('<p>' + input.no_nik + '</p>');
						$('#jk').html('<p>' + input.jenis_kelamin + '</p>');
						$('#agama').html('<p>' + input.nama_lengkap + '</p>');
						$('#warganegara').html('<p>' + input.kewarganegaraan + '</p>');
						$('#status').html('<p>' + input.setatus_perkawinan + '</p>');
						$('#pekerjaan').html('<p>' + input.pekerjaan + '</p>');

						// $('#alamat_sebelum').html('<text>'+ alamatSekarang.dusun +', RT '+ alamatSekarang.RT +' / RW '+ alamatSekarang.RW +'</text><p>'+ alamatSekarang.deskripsi +'</p>');
						get_provinsi(alamatSebelum.provinsi);
						get_kab(alamatSebelum.provinsi, alamatSebelum.kabupaten);
						get_kec(alamatSebelum.kabupaten, alamatSebelum.kecamatan);
						get_desa(alamatSebelum.kecamatan, alamatSebelum.desa)
						$('#_pos').html(', ' + alamatSebelum.kode_pos);
						$('#desc_alamat_sebelum').html(alamatSebelum.deskripsi);

						$('#desc_alamat_sekarang').html(alamatSekarang.deskripsi);
						get_nama_dusun(alamatSekarang.dusun);
						get_ket_rt(alamatSekarang.RT);
						get_ket_rw(alamatSekarang.RW);

						$('#signature').html('<p><strong><u>' + input.nama_lengkap + '</u></strong></p>');
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
			$.getJSON("getArea_id/" + id_dusun, function (data) {
				$.each(data, function (key, value) {
					$('#nama_dusun').append(this.nama_area + ', ');
				});
			});
		}

		function get_ket_rt(id_rt) {
			$.getJSON("getRt_id/" + id_rt, function (data) {
				$.each(data, function (key, value) {
					$('#ket_rt').append('RT ' + this.keterangan + ' ');
				});
			});
		}

		function get_ket_rw(id_rw) {
			$.getJSON("getRw_id/" + id_rw, function (data) {
				$.each(data, function (key, value) {
					$('#ket_rw').append('/ RW ' + this.keterangan);
				});
			});
		}

		function get_provinsi(id_prov) {
			$.ajax({
				type: 'GET',
				url: 'http://dev.farizdotid.com/api/daerahindonesia/provinsi',
				success: function (data) {
					var dataObj = jQuery.parseJSON(data);
					var datprov = dataObj = dataObj.semuaprovinsi;

					if (id_prov != null) {
						$.each(datprov, function (key, value) {
							if (value.id == id_prov) {
								$('#_prov').append(' - ' + value.nama);
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
				url: 'http://dev.farizdotid.com/api/daerahindonesia/provinsi/' + id_prov + '/kabupaten',
				success: function (data) {
					var dataObj = jQuery.parseJSON(data);
					var datakab = dataObj.kabupatens;
					if (id_kab != null) {
						$.each(datakab, function (key, value) {
							if (value.id == id_kab) {
								$('#_kab').append(', ' + value.nama);
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
				url: 'http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/' + id_kab + '/kecamatan',
				success: function (data) {
					var dataObj = jQuery.parseJSON(data);
					var datakec = dataObj.kecamatans;

					if (datakec != null) {
						$.each(datakec, function (key, value) {
							if (value.id == id_kec) {
								$('#_kec').append(', Kec. ' + value.nama);
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
				url: 'http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/' + id_kec + '/desa',
				success: function (data) {
					var dataObj = jQuery.parseJSON(data);
					var datades = dataObj.desas;

					if (datades != null) {
						$.each(datades, function (key, value) {
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

	</script>

</body>

</html>
