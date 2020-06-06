<div class="content-wrapper" style="padding-top: 30px;">
	<!-- <section class="content-header"> -->
	<div class="jumbotron bg-black-gradient">
		<div class="container text-center">
			<h1><b>Selamat datang</b></h1>
			<p><b>Layanan online desa Kedung Pengawas</b></p>
			<p><a class="btn btn-dropbox btn-lg" href="<?= base_url('user/daftar');?>" role="button">Bergabung</a></p>
		</div>
	</div>
	<!-- </section> -->

	<div class="container">
		<!-- <div class="text-center">
			<h2>Layanan Pengaduan Warga</h2>
		</div> -->

		<div class="col-md-6 col-md-offset-3">
			<div class="row">
				<div class="small-box bg-green">
					<div class="inner text-center">
						<p><strong>JUMLAH PENGADUAN SEKARANG</strong></p>
						<?php
						 			$table = 'data_pengaduan as a';
									$this->db->from($table);
                  $jml_data_menunggu = $this->db->get()->num_rows();
                ?>
						<h3><?= $jml_data_menunggu; ?></h3>
						<!-- <button type="button" class="btn btn-block btn-default bg-navy" data-dismiss="modal">Kirim
							Pengaduan</button> -->
					</div>
					<a href="<?= base_url('pengaduan'); ?>" class="small-box-footer">
						<h4>Buat Pengaduan<i class="fa fa-arrow-circle-right fa-lg fa-fw"></i></h4>
					</a>
				</div>
			</div>
		</div>

	</div>
</div>


<div class="content-wrapper" style="background-color: white; 	padding-top: 0;">
	<div class="container">
		<div class="col-md-12" id="hot_berita">
			<div class="row">
				<div class="text-center">
					<h2>Berita Seputar Desa</h2>
				</div>
				<?php
					$this->load->helper('text');
					$this->load->helper('tgl_indo');
					$table = 'data_berita as a';	
					$this->db->from($table);
					$this->db->where('a.is_deleted', '0');
					$this->db->order_by('a.prioritas', 'ASC');
					$this->db->limit(3);
					$query = $this->db->get();
					$list = $query->result_array();
				?>
				<?php foreach ($list as $ls) : ?>
					<?php
						$tanggal = date("Y-m-d", strtotime($ls['created_at']));
						if($ls['id_berita']){
							echo '
							<div class="col-sm-6 col-md-4">
								<div class="thumbnail">
									<div class="card-image">
											<img src="'.$ls['foto'].'" alt="" >
									</div>
									<div class="caption">
										<p>'.longdate_indo($tanggal).'</p>
										<h3 class="box-title text-bold" style="line-height: 10px;">'.ucwords($ls['judul_berita']).'</h3>
										<h4 class="box-title text-bold" style="line-height: 20px;">'.character_limiter($ls['sub_judul'], 20).'</h4>
										<p>'.character_limiter($ls['isi_berita'], 100).'</p>
			
										<a href="'. base_url('berita/detail/'.$ls['id_berita']).'" class="btn btn-success btn-block"
											role="button">Baca selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>';
						} else {
							
						}

					?>
				
				<?php endforeach; ?>
			</div>

			<div class="text-center" style="margin-bottom: 20px;">
				<?php 
					$this->db->from($table);
					$this->db->where('a.is_deleted', '0');
					$query_entri = $this->db->get();
					$entri = $query_entri->num_rows();
					if($entri > 3){
						echo '<a type="button" id="lihat_semua" class="btn btn-github">Lihat semua berita</a>';
					}else{
						echo '';
					}
				?>
			</div>
		</div>

		<!-- SEMUA BERITA -->
		<div class="col-md-12" id="semua_berita" style="display:none;">
			<div class="row">
				<div class="text-center">
					<h2>Berita Seputar Desa</h2>
				</div>
				<?php
					$table = 'data_berita as a';
					$this->db->from($table);
					$this->db->where('a.is_deleted', '0');
					$this->db->order_by("a.prioritas", "ASC");
					$list = $this->db->get()->result_array();
				?>
				<?php foreach ($list as $ls) : ?>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<div class="card-image">
                <img src="<?= $ls['foto']; ?>" alt="" >
						</div>
						<div class="caption">
							<?php  $tanggal = date("Y-m-d", strtotime($ls['created_at']));?>
							<p><?= longdate_indo($tanggal) ?></p>
							<h3 class="box-title text-bold" style="line-height: 10px;"><?= ucwords($ls['judul_berita']); ?></h3>
							<h4 class="box-title text-bold" style="line-height: 20px;"><?= character_limiter($ls['sub_judul'], 20) ?></h4>
							<p><?= character_limiter($ls['isi_berita'], 100) ?></p>

							<a href="<?= base_url('berita/detail/'.$ls['id_berita']); ?>" class="btn btn-success btn-block"	role="button">Baca selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			<div class="text-center" style="margin-bottom: 20px;">
				<a type="button" id="kecilkan">
					<h1><i class="fa fa-angle-up"></i></h1>
				</a>
			</div>
		</div>
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
