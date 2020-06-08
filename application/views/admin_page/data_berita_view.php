<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Berita
      <small>Kumpulan Informasi Berita</small>
    </h1>
    <!-- <ol class="breadcrumb">
			<button class="btn btn-add btn-primary btn-sm pull-right" onclick="add()"><i class="fa fa-cog"></i> Setting Kategori</button>
    </ol> -->
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header">
        <a class="btn btn-add btn-success" id="btn_open_add" href="<?= base_url('admin/berita/buat_berita') ?>" onclick=""><i class="fa fa-plus"></i> Buat Berita</a>
      </div>

      <div class="box-body">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead class="bg-blue">
            <tr>
              <!-- <th class="bg-blue-active" width="7%"><i class="fa fa-hashtag"></i></th> -->
              <th width="20%">Judul Berita</th>
              <th width="20%">Isi Berita</th>
							<th width="23%">Cover Berita</th>
              <th width="20%">Informasi</th>
              <th class="text-center" width="10%">Aksi</th>
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
  var table;

  $(document).ready(function() {
    getTable();
	});

  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });

	function getTable() {
    table = $('#table').DataTable({	
			"processing": true,
			"serverSide": true,
			"searching": true,
			// "scrollX": true,
			"paging": true,
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('admin/berita/listdata') ?>",
				"type": "POST",
				// "data": function(data) {
				//   cekAccessButton();
				// }
			},

			// Set column definition initialisation properties.
			"columnDefs": [
				{
				"targets": [2, -1], //last column
				"orderable": false, //set not orderable
				},
				{
					"targets": -4,
        	"render": function ( data, type, row ) {
					return data.length > 130 ?
						data.substr( 0, 130 ) +'<a>....</a>' :
						data;
        	},
				},

			],

		});
  }

  function lihatBerita(id) {
		  window.open("<?= base_url('berita/detail/') ?>"+id, '');
	}

  function pre_delete(id) {
    $('#set_idBerita').val(id);
    $('#pesan_waiting').text('Memuat Data');
    $('#modal_form_waiting').modal('show');
		$.ajax({
			url: "<?php echo site_url('admin/berita/load_data_berita/') ?>" + id,
			type: "POST",
			dataType: "JSON",
			success: function (data) {
				var detail = data.dataForm;
				setTimeout(function(){
					if (data.status) {
						$('#modal_form_waiting').modal('hide');
            $('#modal_form_quest').modal('show');

            $('#set_judul').text(detail.judul_berita);
            $('#set_sub_judul').text(detail.sub_judul);
            var htmlIsi = detail.isi_berita;
            var strIsi = htmlIsi.replace(/<[^>]+>/g, '');
            // $('#set_isi_berita').text(strIsi);
            if(strIsi.length > 155)
              $('#set_isi_berita').text(strIsi.substring(0,150) + '.....');

						$('#set_author').text(detail.author);
						$('#set_create_at').text(detail.create_date + ' | ' + detail.create_time + 'WIB');
						$('#set_update_at').text(detail.update_date + ' | ' + detail.update_time + 'WIB');
            
						var url_img = detail.foto;
						var set_img = window.location.origin+url_img.replace('.','');
						$('#set_img').attr('src', set_img);
					} else {
						$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi data berita!');
						$('#body_msg_failed').html(data.message);
						$('#modal_form_failed').modal('show');
					}
				}, 100);
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#header_msg_failed').html('<i class="fa fa-exclamation-triangle"></i> Tidak bisa membuka informasi data berita!');
				$('#body_msg_failed').html('Mohon ulangi beberapa saat lagi');
				$('#modal_form_failed').modal('show');
				// window.open("<?= base_url('/admin/berita') ?>", '_self');
			}
		});
	}

  function get_delete() {
    $('#modal_form_quest').modal('hide');
    $('#pesan_waiting').text('Proses Hapus');
    $('#modal_form_waiting').modal('show');
    
    var dataID = {
      id_berita : $('#set_idBerita').val(),
    };

    $.ajax({
      url: "<?php echo site_url('admin/berita/hapusberita') ?>",
      data: dataID,
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        setTimeout(function(){
		  	  if (data.status) {
            $('#modal_form_waiting').modal('hide');
            $('.modal_action_status').html(data.message);
            $('#modal_form_sukses').modal('show');
            table.ajax.reload(null, false);
          } else {
            $('#modal_form_waiting').modal('hide');
            $('.modal_action_status_failed').html(data.message);
            $('#modal_form_failed').modal('show');
            table.ajax.reload(null, false);
          }
        }, 1000);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        $('#modal_form_waiting').modal('hide');
        $('.modal_action_status_failed').html('Hapus Berita Gagal<br><h4>Mohon ulangi beberapa saat lagi!</h4>');
        $('#modal_form_failed').modal('show');
        table.ajax.reload(null, false);
      }
    });
  }

</script>

<!-- Modal Question -->
<div class="modal modal-warning fade" id="modal_form_quest" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span> Batal</button>
        <h4><i class="fa fa-trash"></i> Konfirmasi Hapus Berita</h4>
		  </div>

      <div class="modal-body">
        <input name="set_idBerita" id="set_idBerita" type="hidden"/>
        <h3 class="text-center text-bold">Apakah Anda ingin menghapus berita ini ? <a class="btn btn-danger" onclick="get_delete()"><b>Ya, Hapus </b><i class="fas fa-exclamation-triangle"></i></a></h3>
        <div class="thumbnail">
				  <div class="card-image">
					  <img id="set_img" src="">
					</div>

					<div class="caption">
						<h3 id="set_judul" class="box-title text-bold" style="line-height: 10px;">Judul Berita</h3>
						<h4 id="set_sub_judul" class="box-title text-bold" style="line-height: 20px;">Sub Judul Berita</h4>
            <p><div id="set_isi_berita">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor</div></p>
            <hr class="style1">
            <p>Penulis berita : <i class="fa fa-user"></i> <b id="set_author">Admin</b></p>
            <p>Dibuat pada : <b id="set_created_at"> Senin, 08 Juni 2020 | 14:56 WIB</b></p>
            <p>Diperbarui pada : <b id="set_updated_at"> Senin, 08 Juni 2020 | 14:56 WIB</b></p>
					</div>
				</div>
        
      </div>

			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
			</div> -->
		</div>
	</div>
</div>
<!-- End Modal Question -->

<!-- Modal Waiting -->
<div class="modal" id="modal_form_waiting" role="dialog"  style="background-color: rgba(0,0,0,0.0); color: white; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
	<div class="modal-dialog modal-sm">
				<div class="text-center">
					<i class="fas fa-spinner fa-pulse fa-7x"></i>
					<h4 id="pesan_waiting">Memuat...</h4>
				</div>
	</div>
</div>
<!-- End Modal Waiting -->

<!-- Modal SUCCESS -->
<div class="modal modal-success fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header center">
				<!-- <button type="button" data-dismiss="modal"></button> -->
				<div class="text-center">
					<i class="far fa-check-circle fa-10x"></i>
					<h3 class="modal_action_status text-bold"></h3>
					<button type="button" class="btn btn-outline" data-dismiss="modal">Oke</button>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- End Modal SUCCESS -->

<!-- Modal FAILED -->
<div class="modal modal-danger fade" id="modal_form_failed" role="dialog">
  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header center">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle fa-10x"></i>
            <h3 class="modal_action_status_failed text-bold"></h3>
            <button type="button" class="btn btn-outline" data-dismiss="modal">Oke</button>
        </div>
      </div>
		</div>
	</div>
</div>
<!-- End Modal FAILED -->