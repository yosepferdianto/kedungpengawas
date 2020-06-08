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
              <th class="bg-blue-active" width="7%"><i class="fa fa-hashtag"></i></th>
              <th width="20%">Berita</th>
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

    $('#btn_open_add').on('click', function(){
      // $('#modal_form_add').modal('show');

    });

	});

  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });
  $(document).on('change', '.file', function(){
    $(this).parent().find('#text_file').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    if($('input[name="img[]"]').val() !== ''){
      $('#text_file').show();
      $('#btn_batal_upload').show();
      $('#show_img').attr('src','');
    } else {
      $('#text_file').hide();
      $('#btn_batal_upload').hide();
    }
  });

  $(document).on('click', '.re_input', function(){
    $('input[name="img[]"]').val('');
    $('#text_file').hide();
    $('#btn_batal_upload').hide();
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
				"targets": [3, -1], //last column
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

  function tambah() {
		
	}

</script>

<!-- Modal Form Tambah Berita -->
<div class="modal fade" id="modal_form_add" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
				<h4><i class="fas fa-edit"></i> Buat Berita</h4>
			</div>

			<div class="modal-body">
				<div class="from-body">
					<input name="id_warga_" value="" class="form-control" type="hidden">
					<div class="row">
						<div class="col-md-6 col-sm-6">

							<!-- Judul Berita -->
							<div class="form-group">
								<label>Judul Berita :</label>
								<input name="judul" id="judul" placeholder="Masukkan judul berita..." class="form-control"
									type="text">
							</div>

              <!-- Sub Judul -->
							<div class="form-group">
								<label>Judul Berita :</label>
								<input name="sub_judul" id="sub_kudul" placeholder="Masukkan sub judul..." class="form-control"
									type="text">
							</div>
							
							<!-- Upload Gambar -->
              <div class="form-group">
                <label>Cover Berita :</label>
                <div class="card-image-add">
                  <input type="file" name="img[]" class="file">
                  <div class="input-group col-xs-12">
                    <!-- <span class="input-group-addon"><i class="fa fa-image"></i></span> -->
                    <span class="input-group-btn">
                      <button class="browse btn btn-primary btn-flat" type="button"><i class="fa fa-image"></i> Pilih Gambar</button>
                    </span>
                    <input type="text" class="form-control" id="text_file" disabled placeholder="Upload Gambar" style="display:none">
                    <span class="input-group-btn" id="btn_batal_upload" style="display:none">
                      <button class="re_input btn btn-defautl btn-flat text-red" title="Batal" type="button"><i class="fa fa-times"></i></button>
                    </span>
                  </div>
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