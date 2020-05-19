d<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Pengaduan
			<small>Kumpulan Laporan Pengaduan Warga</small>
		</h1>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header">
				<button class="btn btn-github btn-sm" onclick="kategori()"><i class="fa fa-cog"></i> Kelola Kategori</button>
				<button class="btn btn-default btn-sm pull-right" id="refresh"><i class="fa fa-undo"></i> Refresh</button>
			</div>

			<div class="box-body">
				<table id="table" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
					<thead class="bg-blue">
						<tr>
							<th class="text-center bg-blue-active"><i class="fa fa-hashtag"></i></th>
							<th>Tanggal Pengaduan</th>
							<th>Nama Pengadu</th>
							<th>Kategori</th>
							<th>Deskripsi Pengaduan</th>
							<th>Status Verifikasi</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<div class="box-footer">
				<div class="checkbox icheck">
					<label class="">
						<div><input type="checkbox" name="refresh" class="refresh" value="1"> Auto Refresh <b id="waiting">(10
								detik)</b></div>
					</label>
				</div>
			</div>

		</div>

		<div class="box box-solid box-danger">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-trash" aria-hidden="true"></i> Data Yang Dihapus</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>

			<div class="box-body">
				<table id="table_hapus" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
					<thead class="bg-red">
						<tr>
							<th class="text-center"><i class="fa fa-hashtag"></i></th>
							<th>Tanggal Pengaduan</th>
							<th>Nama Pengadu</th>
							<th>Kategori</th>
							<th>Deskripsi Pengaduan</th>
							<th>Tanggal Hapus</th>
							<th class="text-center" width="15%">Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

		</div>
	</section>

</div><!-- /.content-wrapper -->

<script type="text/javascript">
	var save_method; //for save method string
	var table;
	var table_hapus;
	var table_kategori;

	$(document).ready(function () {
		getTable();

		$('#refresh').on('click', function () {
			table.ajax.reload();
		});

		setInterval(function () {
			refresh();
		}, 10000);
	});

	function getTable() {
		table = $('#table').DataTable({	
			"processing": true,
			"serverSide": true,
			"searching": true,
			"scrollX": false,
			// "scrollY": 200,
			"paging": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('admin/pengaduan/listdata') ?>",
				"type": "POST",
				// "data": function(data) {
				//   cekAccessButton();
				// }
			},

			//Set column definition initialisation properties.
			"columnDefs": [
				{
				"targets": [0, -1], //last column
				"orderable": false, //set not orderable
				},
				{
					"targets": -3,
        	"render": function ( data, type, row ) {
					return data.length > 30 ?
						data.substr( 0, 30 ) +'<a>....</a>' :
						data;
        	},
				},
			],

		});

		table_hapus = $('#table_hapus').DataTable({	
			"processing": true,
			"serverSide": true,
			"searching": true,
			"scrollX": false,
			// "scrollY": 200,
			"paging": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('admin/pengaduan/listData_hapus') ?>",
				"type": "POST",
				// "data": function(data) {
				//   cekAccessButton();
				// }
			},

			//Set column definition initialisation properties.
			"columnDefs": [
				{
				"targets": [0, -1], //last column
				"orderable": false, //set not orderable
				},
				{
					"targets": -3,
        	"render": function ( data, type, row ) {
					return data.length > 30 ?
						data.substr( 0, 30 ) +'<a>....</a>' :
						data;
        	},
				},
			],

		});

		table_kategori = $('#table_kategori').DataTable({	
			"processing": false,
			"serverSide": true,
			"searching": false,
			"scrollCollapse": true,
			"paging": false,
			"bInfo" : false,
    
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('admin/pengaduan/listData_kategori') ?>",
				"type": "POST",
			},

			//Set column definition initialisation properties.
			"columnDefs": [
				{
				"targets": [-1], //last column
				"orderable": false, //set not orderable
				}
			],

		});
	}

	function refresh() {
		var check = document.querySelector('.refresh').checked;
		if (check) {
			table.ajax.reload(null, false);
		}
	}

	function detail(id) {
		id_pengaduan = 'id_pengaduan=' + id;

		$.ajax({
			url: "<?php echo site_url('admin/pengaduan/detail') ?>",
			type: "POST",
			data: id_pengaduan,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				if (data.status) {
					$('#modal_form_quest').modal('hide');
					$('#modal_form_info').modal('show');

					$('#tgl_wkt').html(detail.tanggal + ' | Jam : ' + detail.waktu + ' WIB');
					$('#nama_pengadu').html(detail.nama_pengadu);
					$('#no_tlp').html(detail.no_telp);
					$('#kategori').html(detail.kategori);
					$('#deskripsi').html(detail.deskripsi);
					if (detail.status == 1) {
						$('#status').html(
							'<span class="badge bg-green"><i class="fa fa-check-circle fa-fw"></i> DIVERIFIKASI</span>');
					} else {
						$('#status').html('<span class="badge bg-yellow"><i class="fa fa-clock fa-fw"></i> MENUNGGU</span>');
					}
					if (detail.lampiran != null) {
						lampiran = detail.lampiran;
						$('#lampiran').html('<a class="btn btn-primary btn-sm" href="<?= base_url(); ?>' + lampiran + '" target="_blank">Lihat Lampiran <a>');
					} else {
						$('#lampiran').html('<text class="text-muted">Lampiran tidak tersedia.</text>');
					}
					if (detail.status == 1) {
						$('#btn_setujui').hide();
					} else {
						$('#btn_setujui').show();
						$('#btn_setujui').on('click', function () {
							verifikasi(id);
						});
					}
					
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
			}
		});
	}

// Fungsi Verifikasi
	function verifikasi(id) {
		id_pengaduan = 'id_pengaduan=' + id;

		$.ajax({
			url: "<?php echo site_url('admin/pengaduan/detail') ?>",
			type: "POST",
			data: id_pengaduan,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				if (data.status) {
					$('#modal_form_info').modal('hide');
					$('#modal_form_quest').modal('show');
					$('#header_msg_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Verifikasi Pengaduan');
					$('#body_msg_quest').html('<b>Apakah Anda setuju dengan pengaduan ini?</b>');
					$('#btn_yes').html('<b>Ya, Setuju <i class="fa fa-check"></i></b>');

					$('#tgl_wkt_').html(detail.tanggal + ' | Jam : ' + detail.waktu + ' WIB');
					$('#nama_pengadu_').html(detail.nama_pengadu);
					$('#kategori_').html(detail.kategori);
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
			}
		});

		$('#btn_detail').on('click', function () {
			detail(id);
		});

		$('#btn_yes').attr('onclick', 'proses_verifikasi("'+id+'")');

	}
	// Proses Verifikasi
	function proses_verifikasi(id) {
		id_pengaduan = 'id_pengaduan=' + id;
		$('#btn_yes').html('<b>Ya, Setuju <i class="fas fa-spinner fa-pulse"></i></b>');
		$('#btn_yes').attr('onclick', '');

		setTimeout(function() {
			$.ajax({
				url: "<?php echo site_url('admin/pengaduan/verifikasi') ?>",
				type: "POST",
				data: id_pengaduan,
				dataType: "JSON",
				success: function (data) {
					var detail = data.dataForm;
					if (data.status) {
						$('#modal_form_quest').modal('hide');
						$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Verifikasi Pengaduan Berhasil');
						$('#modal_form_sukses').modal('show');
						table.ajax.reload(null, false);
					} else {
						$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Verifikasi pengajuan!');
						$('#body_msg_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Verifikasi pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				}
			});
		}, 100);
	}
// .END Fungsi Verifikasi

// Fungsi Hapus
	function hapus(id) {
		id_pengaduan = 'id_pengaduan=' + id;
		var proses = '';

		$.ajax({
			url: "<?php echo site_url('admin/pengaduan/detail') ?>",
			type: "POST",
			data: id_pengaduan,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				if (data.status) {
					$('#modal_form_info').modal('hide');
					$('#modal_form_quest').modal('show');
					$('#header_msg_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Hapus Pengaduan');
					$('#body_msg_quest').html('<b>Apakah Anda ingin hapus pengaduan ini?</b>');
					$('#btn_yes').html('<b>Ya, Hapus ! <i class="fa fa-check"></i></b>');
					proses = 'hapus';

					$('#tgl_wkt_').html(detail.tanggal + ' | Jam : ' + detail.waktu + ' WIB');
					$('#nama_pengadu_').html(detail.nama_pengadu);
					$('#kategori_').html(detail.kategori);
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
			}
		});

		$('#btn_detail').on('click', function () {
			detail(id);
		});

		$('#btn_yes').attr('onclick', 'proses_hapus("'+id+'")');

	}
	// Proses Hapus
	function proses_hapus(id){
		id_pengaduan = 'id_pengaduan=' + id;
		$('#btn_yes').html('<b>Ya, Hapus ! <i class="fas fa-spinner fa-pulse"></i></b>');
		$('#btn_yes').attr('onclick', '');

		setTimeout(function() {
			$.ajax({
				url: "<?php echo site_url('admin/pengaduan/hapus') ?>",
				type: "POST",
				data: id_pengaduan,
				dataType: "JSON",
				success: function (data) {
					var detail = data.dataForm;
					if (data.status) {
						$('#modal_form_quest').modal('hide');
						$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Hapus Pengaduan Berhasil');
						$('#modal_form_sukses').modal('show');
						table.ajax.reload();
						table_hapus.ajax.reload();
					} else {
						$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Hapus pengajuan!');
						$('#body_msg_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Hapus pengajuan!');
					$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
					$('#modal_form_failed').modal('show');
				}
			});
		}, 100);
	}
// .END Fungsi Hapus

// Fungsi Kembalikan data Hapus
	function kembalikan(id) {
		id_pengaduan = 'id_pengaduan=' + id;
		var proses = '';

		$.ajax({
			url: "<?php echo site_url('admin/pengaduan/detail') ?>",
			type: "POST",
			data: id_pengaduan,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				if (data.status) {
					$('#modal_form_info').modal('hide');
					$('#modal_form_quest').modal('show');
					$('#header_msg_quest').html('<i class="fa fa-question-circle"></i> Konfirmasi Kembalikan Pengaduan Yang Di Hapus');
					$('#body_msg_quest').html('<b>Ingin kembalikan data yang di hapus ini?</b>');
					$('#btn_yes').html('<b>Ya, Kembalikan ! <i class="fa fa-refresh"></i></b>');
					proses = 'kembali';

					$('#tgl_wkt_').html(detail.tanggal + ' | Jam : ' + detail.waktu + ' WIB');
					$('#nama_pengadu_').html(detail.nama_pengadu);
					$('#kategori_').html(detail.kategori);
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi detail pengajuan!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
			}
		});

		$('#btn_detail').on('click', function () {
			detail(id);
		});

		$('#btn_yes').attr('onclick', 'proses_kembalikan("'+id+'")');

	}
	// Proses Kembalikan data Hapus
	function proses_kembalikan(id){
		id_pengaduan = 'id_pengaduan=' + id;
		$('#btn_yes').html('<b>Ya, Kembalikan ! <i class="fas fa-spinner fa-pulse"></i></b>');
		$('#btn_yes').attr('onclick', '');

		setTimeout(function() {
			$.ajax({
				url: "<?php echo site_url('admin/pengaduan/kembalikan') ?>",
				type: "POST",
				data: id_pengaduan,
				dataType: "JSON",
				success: function (data) {
					var detail = data.dataForm;
					if (data.status) {
						$('#modal_form_quest').modal('hide');
						$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Data Pengaduan Berhasil Di Kembalikan');
						$('#modal_form_sukses').modal('show');
						table.ajax.reload();
						table_hapus.ajax.reload();
					} else {
						$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Kembalikan Pengajuan Yang Di Hapus!');
						$('#body_msg_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Gagal Kembalikan Pengajuan Yang Di Hapus!');
					$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
					$('#modal_form_failed').modal('show');
				}
			});
		}, 100);
	}
// .END Fungsi Kembalikan data Hapus

	function kategori(){
		$('#modal_form_kategori').modal('show');
		table_kategori.ajax.reload();
	}

	function tambah_kategori() {
		var dataForm = {
			kategori_baru: $('#kategori_baru').val(),
		};
		$('#btn_tambah_kategori').html('<i class="fas fa-spinner fa-pulse"></i> Tambah');

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('admin/pengaduan/add_kategori') ?>",
			data: dataForm,
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Tambah Kategori Berhasil');
					$('#modal_form_sukses').modal('show');
					table_kategori.ajax.reload();
					$('#kategori_baru').val('');
					$('#btn_tambah_kategori').html('<i class="fa fa-plus"></i> Tambah');
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tambah Kategori Gagal!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
					$('#kategori_baru').val('');
					$('#btn_tambah_kategori').html('<i class="fa fa-plus"></i> Tambah');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tambah Kategori Gagal!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				$('#kategori_baru').val('');
				$('#btn_tambah_kategori').html('<i class="fa fa-plus"></i> Tambah');
			}
		});

	}

	function edit_kategori(id, nama){
		$('#modal_form_kategori_update').modal('show');
		$('#id_kategori').val(id);
		$('#kategori_baru_').val(nama);
		
		$('#btn_edit_kategori').click(function () {
			$('#btn_edit_kategori').html('Ubah <i class="fas fa-spinner fa-pulse"></i>' );

			setTimeout(function() {
				proses_edit_kategori();
			}, 100);
		});
	}

	function proses_edit_kategori(){
		var dataForm = {
			kategori_baru: $('#kategori_baru_').val(),
			id_kategori_pengaduan: $('#id_kategori').val()
		};

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('admin/pengaduan/edit_kategori') ?>",
			data: dataForm,
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					$('#modal_form_kategori_update').modal('hide');
					$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Ubah Kategori Berhasil');
					$('#modal_form_sukses').modal('show');
					table_kategori.ajax.reload();
					$('#btn_edit_kategori').html('Ubah <i class="fa fa-arrow-right"></i>');
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Ubah Kategori Gagal!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
					table_kategori.ajax.reload();
					$('#btn_edit_kategori').html('Ubah <i class="fa fa-arrow-right"></i>');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#modal_form_kategori_update').modal('hide');
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Ubah Kategori Gagal!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				table_kategori.ajax.reload();
				$('#btn_edit_kategori').html('Ubah <i class="fa fa-arrow-right"></i>');
			}
		});
	}

	function hapus_kategori(id){
		id_kategori_pengaduan = 'id_kategori_pengaduan=' + id;

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('admin/pengaduan/hapus_kategori') ?>",
			data: id_kategori_pengaduan,
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					$('#header_msg_sukses').html('<i class="fa fa-check-circle"></i> Hapus Kategori Berhasil');
					$('#modal_form_sukses').modal('show');
					table_kategori.ajax.reload();
				} else {
					$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Hapus Kategori Gagal!');
					$('#body_msg_failed').html(data.message);
					$('#modal_form_failed').modal('show');
					table_kategori.ajax.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Hapus Kategori Gagal!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				table_kategori.ajax.reload();
			}
		});
	}

</script>

<!-- Modal DETAIL -->
<div class="modal fade" id="modal_form_info" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-info-circle"></i> Informasi Detail Pengaduan</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Tanggal</label>
					<label>:</label>
					<text id="tgl_wkt"></text>
				</div>
				<hr class="style1">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Nama Pengadu</label>
					<label>:</label>
					<text id="nama_pengadu"></text>
				</div>
				<hr class="style1">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">No. Telp</label>
					<label>:</label>
					<text id="no_tlp"></text>
				</div>
				<hr class="style1">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Status</label>
					<label>:</label>
					<text id="status"></text>
				</div>
				<hr class="style1">

				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<text>Kategori: </text>
								<label id="kategori"></label>
							</div>
							<div class="panel-body" id="deskripsi">A Basic Panel asfdsad asda dsad sadas dasda dasd asdas dasd asdas
								das dasd asdasd asdsa asdasd asd asdas das asas dasd asdas dsad sad sad sad as da sd sa dsa d asd as ds
								ad as da sd asdasdsadsads d asdasd asdsa dsadas d asdasdas dsa da sdsadasd as das d asd sad</div>
							<div class="panel-heading text-bold" id="lampiran"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<a class="btn btn-success btn-sm" title="Setujui" id="btn_setujui" style="display:none">Setujui <i class="fa fa-arrow-right"></i></a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal DETAIL -->

<!-- Modal Question -->
<div class="modal" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4 id="header_msg_quest">...</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Tanggal</label>
					<label>:</label>
					<text id="tgl_wkt_"></text>
				</div>
				<hr class="style1">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Nama Pengadu</label>
					<label>:</label>
					<text id="nama_pengadu_"></text>
				</div>
				<hr class="style1">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Kategori</label>
					<label>:</label>
					<text id="kategori_"></text>
				</div>
				<hr class="style1">
				<div class="text-center">
					<h3 id="body_msg_quest">...</h3>
				</div>
			</div>
			

			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
				<a class="btn btn-primary" title="Lihat" id="btn_detail"><i class="fa fa-info-circle"></i> Detail</a>
				<a class="btn btn-success" title="Ya" id="btn_yes"></a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Question -->

<!-- Modal Kategori -->
<div class="modal fade" id="modal_form_kategori" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-info-circle"></i> Kategori Pengaduan</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="form-group">
							<label class="text-muted"> Tambah Kategori</label>
							<div class="input-group">
								<input type="text" class="form-control form-control-user" name="kategori_baru" id="kategori_baru" placeholder="Nama Kategori baru...">
								<div class="input-group-btn">
									<button type="button" class="btn btn-success" onclick="tambah_kategori()" id="btn_tambah_kategori"><i class="fa fa-plus"></i> Tambah</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="style2">
				<h4 class="text-bold">Data kategori Pengaduan</h4>
				<table id="table_kategori" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
					<thead class="bg-blue">
						<tr>
							<th class="text-center"><i class="fa fa-hashtag"></i></th>
							<th>Nama kategori</th>
							<th class="text-center"><i class="fa fa-bolt"></i> Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_form_kategori_update" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-edit"></i> Ubah Kategori Pengaduan</h4>
			</div>

			<div class="modal-body">
				<input id="id_kategori" value="" class="form-control" type="hidden">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="form-group">
							<label class="text-muted"> Nama Kategori</label>
							<input type="text" class="form-control form-control-user" name="kategori_baru_" id="kategori_baru_" placeholder="Nama Kategori baru..." autofocus/>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<a class="btn btn-success" id="btn_edit_kategori">Ubah <i class="fa fa-arrow-right"></i></a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal Kategori -->

<!-- Modal FAILED -->
<div class="modal modal-danger fade" id="modal_form_failed" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
				<h4 id="header_msg_failed">...</h4>
			</div>

			<div class="modal-body text-center">
				<h3 id="body_msg_failed">...</h3>
			</div>

			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<!-- End Modal FAILED -->

<!-- Modal SUCCESS -->
<div class="modal modal-success fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4 id="header_msg_sukses"></h4>
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
