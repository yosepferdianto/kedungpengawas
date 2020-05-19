<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengajuan
      <small>Kumpulan Surat Pengajuan Warga</small>
    </h1>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header">
        <!-- <button class="btn btn-primary btn-sm" onclick=""><i class="fa fa-cog"></i> Setting Kategori</button> -->
        <button class="btn btn-default btn-sm pull-right" id="refresh"><i class="fa fa-undo"></i> Refresh</button>
      </div>

      <div class="box-body">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead class="bg-blue">
            <tr>
              <th width="1%"><i class="fa fa-hashtag"></i></th>
              <th width="25%">No. Surat</th>
              <th>Atas Nama</th>
              <th>Kategori</th>
              <th>Tanggal</th>
              <th class="text-center" width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="box-footer">
        <div class="checkbox icheck">
          <label class="">
            <div><input type="checkbox" name="refresh" class="refresh" value="1"> Auto Refresh <b id="waiting">(10 detik)</b></div>
          </label>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.content-wrapper -->

<script type="text/javascript">
  var save_method; //for save method string
  var table;

  $(document).ready(function() {
    getTable();
    // reload_table();

    $('#refresh').on('click', function(){
      table.ajax.reload();
    });

    setInterval(function() {
			refresh();
		}, 10000);
	});

	function getTable() {
    table = $('#table').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [], //Initial no order.
      "searching": true,
      "scrollX": false,
      // "scrollY": 200,
      "paging": true,


      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('admin/pengajuan/listdata') ?>",
        "type": "POST",
        // "data": function(data) {
        //   cekAccessButton();
        // }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0, -1], //last column
        "orderable": false, //set not orderable
      }, ],

    });
  }

  function refresh() {
		var check = document.querySelector('.refresh').checked;
		if (check) {
			table.ajax.reload(null, false);
		}
	}

  function printHasil(no_surat, idKategori) {
		var noSurat = '?no_surat='+ no_surat;

    if (idKategori == '2'){
		  window.open("<?= base_url('pengajuan/surat_keterangan') ?>"+noSurat, '');
    } else {
      window.open("<?= base_url('pengajuan/surat_pengantar') ?>"+noSurat, '');
    }

	}

  function hapus(id_pengajuan, no_surat) {
    $('.modal_action_quest').html('<h4>No. Surat : '+ no_surat +'</h4>Apakah surat ini ingin dihapus?');
    $('#modal_form_quest').modal('show');

    $('#btn_hapus').attr('onclick', 'proses_hapus("'+id_pengajuan+'")');

  }

  function proses_hapus(id_pengajuan){
    setTimeout(function() {
      $.ajax({
        url: "<?php echo site_url('admin/pengajuan/hapus') ?>/"+id_pengajuan,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          $('#modal_form_quest').modal('hide');
          $('.modal_action_status').html(data.message);
          $('#modal_form_sukses').modal('show');
          table.ajax.reload(null, false);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $('#modal_form_quest').modal('hide'); 
          $('.modal_action_status_failed').html(data.message);
          $('#modal_form_failed').modal('show');
          table.ajax.reload(null, false);
        }
      });
    }, 100);
  }

</script>


<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4><i class="fa fa-question-circle"></i> Konfirmasi Hapus Surat Pengajuan</h4>
		  </div>

      <div class="modal-body text-center">
				<h3 class="modal_action_quest">Apakah Surat?<br>
      </div>

			<div class="modal-footer">
				<button type="button" class="btn btn-outline btn-danger pull-left" data-dismiss="modal">Batal</button>
        <a class="btn btn-outline btn-primary" id="btn_hapus" onclick=""><b>Ya, hapus </b><i class="fa fa-arrow-right"></i></a>
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
        <h4><i class="fa fa-check"></i> Proses berhasil</h4>
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
        <h4><i class="fa fa-exclamation-triangle"></i> Status Gagal!</h4>
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