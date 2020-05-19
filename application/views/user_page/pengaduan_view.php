<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Layanan Pengaduan Warga
			<!-- <small>Buat laporan pengaduan Anda</small> -->
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-solid">
					<div class="box-header with-border">
					<h2 class="box-title"><small><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Mohon isi laporan
								pengaduan Anda dengan lengkap dan benar!</small></h2>
					</div>

					<div class="box-body form">
						<form action="#" id="form">
							<div class="from-body">

								<div class="form-group">
									<label>Kategori Pengaduan</label>
									<select class="form-control select2" style="width: 100%;" name="select_kategori" id="select_kategori">
									</select>
								</div>

								<div class="form-group">
									<textarea name="isi_pengaduan" placeholder="Ketik pengaduan Anda..." class="form-control"
										style="resize: vertical; min-height: 240px;"></textarea>
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
						<button type="button" class="btn btn-primary pull-right" id="btn_kirim">Kirim
								Pengaduan <i class="fa fa-arrow-right"></i></button>
					</div>
					<div class="box-footer">
						<small><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> <b>Nama pengadu</b> dan <b>No.telp</b> pengaduan akan sama dengan profil akun Anda. <a href="<?= base_url('/profil');?>">Ubah Profil</a></small>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-solid box-primary">
					<div class="box-header no-border">
						<h3 class="box-title"><i class="far fa-folder-open"></i><i class="fa fa-history" aria-hidden="true"></i> Riwayat Pengaduan</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<ul class="nav nav-justified text-bold text-center" id="label-pantau">
							<?php
								 $idUser = $this->session->userdata('id_akun_user');
                 $table = 'data_pengaduan as a';
								 $this->db->from($table);
								 $this->db->where('a.id_akun_user', $idUser);
                 $jml_data_semua = $this->db->get()->num_rows();
              ?>
							<li class="text-blue"><i class="far fa-folder-open"></i> <?= $jml_data_semua; ?> Pengaduan</li>
							<?php
									$this->db->from($table);
									$this->db->where('a.status', '0');
									$this->db->where('a.id_akun_user', $idUser);
                  $jml_data_menunggu = $this->db->get()->num_rows();
              ?>
							<li class="text-yellow"><i class="far fa-clock"></i> <?= $jml_data_menunggu; ?> Menunggu</li>
							<?php
									$this->db->from($table);
									$this->db->where('a.status', '1');
									$this->db->where('a.id_akun_user', $idUser);
                  $jml_data_verif = $this->db->get()->num_rows();
              ?>
							<li class="text-green"><i class="far fa-check-circle"></i> <?= $jml_data_verif; ?> Di Verifikasi</li>
						</ul>
						<br>
						<table id="table"  class="table table-striped table-bordered" cellspacing="0" width="100%">
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
	var toggle = false;
	var table;

	$(document).ready(function () {
		setListKategori();
		// $('[data-mask]').inputmask();
		getTable_pantau();
		$('#btn_kirim').on('click', function(){
			$('#modal_form_quest').modal('show'); 
		})
	});

	function getTable_pantau() {
    table = $('#table').DataTable({
			"processing": false,
			"serverSide": true,
			"searching": false,
			"scrollY": "300px",
			"scrollCollapse": true,
			"paging": true,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
		var dataForm = new FormData($('#form')[0]);
			
		$.ajax({
				url: "<?php echo site_url('pengaduan/kirimPengaduan') ?>",
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
						$('#modal_form_quest').modal('hide'); 
						$('.modal_action_status').text(data.message);
						$('#modal_form_sukses').modal('show');
						$('#form')[0].reset();
						setListKategori(0);
						table.ajax.reload(null, false);
						$('#label-pantau').load(window.location.href + " #label-pantau" );
					} else {
						$('#modal_form_quest').modal('hide'); 
						$('.modal_action_status_failed').text(data.message);
						$('#modal_form_failed').modal('show');
					}
					$('#btn_kirim').text('Kirim Pengaduan'); //change button text
					$('#btn_kirim').attr('disabled', false); //set button disable  

				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#modal_form_quest').modal('hide'); 
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
						lampiran = detail.lampiran;
						$('#lampiran').html('<a class="btn btn-primary btn-sm" href="<?= base_url(''); ?>'+ lampiran +'" target="_blank">Lihat Lampiran</a>');
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
					<div class="col-xs-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<text>Kategori: </text>
								<label id="kategori"></label>
							</div>
							<div class="panel-body" id="deskripsi">A Basic Panel asfdsad asda dsad sadas dasda dasd asdas dasd asdas das dasd asdasd asdsa asdasd asd asdas das asas dasd asdas dsad sad sad sad as da sd sa dsa d asd as ds ad as da sd asdasdsadsads d asdasd asdsa dsadas d asdasdas dsa da sdsadasd as das d asd sad</div>
							<div class="panel-heading text-bold" id="lampiran"></div>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="modal-footer">
				
			</div> -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal DETAIL -->

<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4><i class="fa fa-question-circle"></i> Konfirmasi Pengaduan Anda</h4>
		  </div>

      <div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah Anda ingin mengirim pengaduan?</h3>
      </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline btn-danger pull-left" data-dismiss="modal">Batal</button>
        <a class="btn btn-outline btn-primary" onclick="kirimPengaduan()"><b>Lanjut, Kirim </b><i class="fa fa-arrow-right"></i></a>
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
        <h4><i class="fa fa-check"></i> Proses Pengaduan berhasil</h4>
		  </div>

      <div class="modal-body text-center">
        <h3 class="modal_action_status">Status Success!</h3>
      </div>

			<div class="modal-footer">
        <!-- <a class="btn btn-outline" id="btn_print" onclick=""><b>Print Hasil </b><i class="fa fa-arrow-right"></i></a> -->
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
