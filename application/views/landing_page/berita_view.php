<div class="content-wrapper" style="padding-top: 40px;">
	<div class="container">
		<!-- Main content -->
		<section class="content-header text-center" style="padding-top:20px">
			<h1 class="text-bold ">
				Berita Seputar Desa
			</h1>
		</section>

		<section class="content">
			<div class="row">
				<!-- <div class="col-md-12"> -->
				<?php
        $this->load->helper('text');
				$table = 'data_berita as a';
				$this->db->from($table);
				$this->db->where('a.is_deleted', '0');
				$this->db->order_by('a.created_at', 'DESC');
				$this->db->order_by("a.prioritas", "ASC");
        $list = $this->db->get()->result_array();
      ?>
				<?php foreach ($list as $ls) : ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="box box-solid">
						<div class="box-header">
							<div class="card-image">
								<img src="<?= $ls['foto']; ?>" alt="">
							</div>
						</div>

						<div class="box-body">
							<div class="caption">
								<?php  $tanggal = date("Y-m-d", strtotime($ls['created_at']));?>
								<p><?= longdate_indo($tanggal) ?></p>
								<h3 class="box-title text-bold" style="line-height: 10px;"><?= ucwords($ls['judul_berita']); ?></h3>
								<h4 class="box-title text-bold" style="line-height: 20px;"><?= character_limiter($ls['sub_judul'], 20) ?></h4>
								<p><?= character_limiter($ls['isi_berita'], 100) ?></p>

								<a href="<?= base_url('berita/detail/'.$ls['id_berita']); ?>" class="btn btn-success btn-block"
									role="button">Baca selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<!-- </div> -->
			</div>
		</section>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#lihat_semua').on('click', function () {
			$('#semua_berita').show();
			$('#hot_berita').hide();
		});
		$('#kecilkan').on('click', function () {
			$('#semua_berita').hide();
			$('#hot_berita').show();
		})
	});

</script>
