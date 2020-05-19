<div class="content-wrapper">
	<section class="content-header">
		<?php
			$this->load->helper('text');
			$table = 'data_berita as a';
			$this->db->from($table);
      $this->db->where('a.id_berita', $id);
      $list = $this->db->get()->result_array();
    ?>
		<?php foreach ($list as $ls) : ?>
      <h1 class="text-bold">
					<small>
						<a href="<?= base_url('berita')?>"><i class="fa fa-arrow-left"></i> Berita Desa</a> <i class="fa fa-angle-right"></i> <b><u><?= ucwords($ls['judul_berita']); ?></u></b>
					</small>
				</h1>
    
	</section>

	<section class="content">
			<div class="col">
				<div class="box box-solid" style="padding:0 10px">
					<div class="box-header">
						<?php  $tanggal = date("Y-m-d", strtotime($ls['created_at']));?>
						<small><i class="fa fa-calendar" aria-hidden="true"></i> <?= longdate_indo($tanggal) ?>
						<h3 class="text-bold" style="margin-top:5px;">
							<i class="fa fa-circle-o"></i> <?= ucwords($ls['judul_berita']); ?>
						</h3>
					</div>

					<div class="box-body">
							<div class="card-image-detail">
								<img src="<?= base_url($ls['foto']); ?>" alt="">
							</div>
							<div class="caption">
								<h3 class="box-title text-bold" style="margin-top:10px;line-height: 20px;"><?= ucwords($ls['sub_judul']); ?></h3>
								<?= $ls['isi_berita']; ?>
							</div>
						</div>

					<div class="box-footer">
					
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<!-- /.content -->
</div>
