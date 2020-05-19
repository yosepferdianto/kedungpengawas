<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengajuan
      <small>Kumpulan Surat Pengajuan Warga</small>
    </h1>
    <ol class="breadcrumb">
			<button class="btn btn-add btn-primary btn-sm pull-right" onclick="add()"><i class="fa fa-cog"></i> Setting Kategori</button>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header">
        <!--  -->
      </div>
      <div class="box-body">
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <!-- <th width="1%"><i class="fa fa-hashtag"></i></th> -->
              <th>Tanggal</th>
              <th>Nama Pengadu</th>
              <th>Kategori</th>
              <th>Deskripsi Pengaduan</th>
							<th>Status</th>
              <th class="text-center" width="250px">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </section>

</div><!-- /.content-wrapper -->

<!-- <script type="text/javascript">
  var save_method; //for save method string
  var table;

  $(document).ready(function() {
    getTable();
    // reload_table();
	});

	function getTable() {
    table = $('#table').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [], //Initial no order.
      "searching": true,
      "scrollX": true,
      // "scrollY": 200,
      "paging": true,


      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('admin/pengaduan/listdata') ?>",
        "type": "POST",
        // "data": function(data) {
        //   cekAccessButton();
        // }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [-1], //last column
        "orderable": false, //set not orderable
      }, ],

    });
  }

</script> -->