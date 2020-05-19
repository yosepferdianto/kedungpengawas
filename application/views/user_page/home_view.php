<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
	</section>
	<section class="content">
		<!-- <div class="row">
			<div class="col-sm-6 col-lg-4">
				<button class="btn btn-block btn-github pull-right">Buat Pengaduan</button>
			</div>
		</div><br> -->
		<div class="box box-default">
			<div class="box-header with-border">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
				<h3 class="box-title"><i class="fa fa-info-circle"></i> Pantau Pengaduan Anda</h3>
			</div>
			
			<div class="box-body">
				<div class="row">
					<!-- ./col -->
					<div class="col-lg-4 col-md-4 col-sm-4">
						<!-- small box -->
						<div class="small-box bg-primary">
							<div class="inner">
								<?php
									$idUser = $this->session->userdata('id_akun_user');
									$table = 'data_pengaduan as a';
									$this->db->from($table);
									$this->db->where('a.id_akun_user', $idUser);
									$jml_data_semua = $this->db->get()->num_rows();
								?>
								<h3><?= $jml_data_semua; ?></h3>

								<p>Total Pengaduan</p>
							</div>
							<div class="icon">
								<i class="far fa-folder-open"></i>
							</div>
							<!-- <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-4 col-md-4 col-sm-4">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<?php
									$this->db->from($table);
									$this->db->where('a.status', '0');
									$this->db->where('a.id_akun_user', $idUser);
									$jml_data_menunggu = $this->db->get()->num_rows();
								?>
								<h3><?= $jml_data_menunggu; ?></h3>

								<p>Menunggu Verifikasi</p>
							</div>
							<div class="icon">
								<i class="far fa-clock"></i>
							</div>
							<!-- <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-4 col-md-4 col-sm-4">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<?php
									$this->db->from($table);
									$this->db->where('a.status', '1');
									$this->db->where('a.id_akun_user', $idUser);
									$jml_data_menunggu = $this->db->get()->num_rows();
								?>
								<h3><?= $jml_data_menunggu; ?></h3>

								<p>Di Verifikasi</p>
							</div>
							<div class="icon">
								<i class="far fa-check-circle"></i>
							</div>
							<!-- <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>

		<div class="row">

			<div class="col-md-6">
				<div class="box box-solid box-primary">
					<div class="box-header no-border">
						<h3 class="box-title"><i class="far fa-folder-open"></i><i class="fa fa-history" aria-hidden="true"></i> Riwayat Pengaduan</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<a class="btn btn-github btn-sm btn-block" href="<?= base_url(''); ?>pengaduan"><i class="fa fa-plus"></i> Buat Pengaduan</a>
						<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead class="">
								<tr>
									<th class="text-center" style="width: 50px;">Detail</th>
									<th>Tanggal</th>
									<th>Kategori</th>
									<th class="text-center" style="width: 108px;">Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

					</div>
					<!-- /.box-body -->

					<!-- <div class="box-footer bg-green text-center">
						<button type="button" class="btn btn-outline btn-success"><i class="fa fa-folder"></i> Lihat semua pengaduan saya</button>
					</div> -->
				</div>
			</div>
		</div>

	</section>
</div>

<script type="text/javascript">
	var table;

	$(document).ready(function () {
		getTable_pantau();
	});

	function getTable_pantau() {
		table = $('#table').DataTable({
			"processing": false,
			"serverSide": true,
			"searching": false,
			"scrollY": "200px",
			"scrollCollapse": true,
			"paging": false,
			// "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"bInfo" : false,

			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('pengaduan/pantauPengaduan') ?>",
				"type": "POST",
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-1, -2, -4], //last column
				"orderable": false, //set not orderable
			}, ],

		});
	}

	function detail(id) {
		id_pengaduan = 'id_pengaduan='+id;

		$.ajax({
			url: "<?php echo site_url('pengaduan/detail') ?>",
			type: "POST",
			data: id_pengaduan,
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				if (data.status)
				{	
					$('#modal_form_info').modal('show'); 
					$('#tgl_wkt').html(detail.tanggal + ' | Jam : '+ detail.waktu +' WIB');
					$('#nama_pengadu').html(detail.nama_pengadu);
					$('#no_tlp').html(detail.no_telp);
					$('#kategori').html(detail.kategori);
					$('#deskripsi').html(detail.deskripsi);
					if(detail.lampiran != null){
						$('#lampiran').html('Lampiran : <button class="btn btn-primary btn-sm" onclick="openlampiran()">Lihat Lampiran</button>');
					} else {
						$('#lampiran').html('<text class="text-muted">Lampiran tidak tersedia.</text>');
					}
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

</script>

<!-- Modal DETAIL -->
<div class="modal fade" id="modal_form_info" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
				<h4><i class="fa fa-info-circle"></i> Informasi Detail Pengaduan Anda</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Tanggal</label>
					<label>:</label>
					<text id="tgl_wkt"></text>
				</div>
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Nama Pengadu</label>
					<label>:</label>
					<text id="nama_pengadu"></text>
				</div>
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">No. Telp</label>
					<label>:</label>
					<text id="no_tlp"></text>
				</div>
				<div class="row">
					<label class="col-xs-3 col-xs-offset-1">Kategori</label>
					<label>:</label>
					<text id="kategori"></text>
				</div>
				<div class="row">
					<label class="col-xs-4 col-xs-offset-1">Deskripsi Pengaduan :</label>
				</div>
				<div class="row">
					<div class="panel panel-default col-xs-10 col-xs-offset-1">
						<div class="panel-body" id="deskripsi">A Basic Panel asfdsad asda dsad sadas dasda dasd asdas dasd asdas das dasd asdasd asdsa asdasd asd asdas das asas dasd asdas dsad sad sad sad as da sd sa dsa d asd as ds ad as da sd asdasdsadsads d asdasd asdsa dsadas d asdasdas dsa da sdsadasd as das d asd sad</div>
						<div class="panel-body text-bold" id="lampiran"></div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal DETAIL -->

<!-- Modal FAILED -->
<div class="modal modal-danger fade" id="modal_form_failed" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
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
