<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dasbboard
		</h1>
	</section>
	<section class="content">

		<div class="box box-default">
			<div class="box-header with-border">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
				<h3 class="box-title"><i class="fas fa-comment-dots"></i> Data Pengaduan Warga</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<!-- ./col -->
					<div class="col-sm-6 col-lg-4">
						<!-- small box -->
						<div class="small-box bg-primary">
							<div class="inner">
								<?php
                  $table = 'data_pengaduan as a';
                  $this->db->from($table);
                  $jml_data_semua = $this->db->get()->num_rows();
                ?>
								<h3><?= $jml_data_semua; ?></h3>

								<p>SEMUA DATA PENGADUAN</p>
							</div>
							<div class="icon">
								<i class="fa fa-file-alt"></i>
							</div>
							<!-- <a href="<?= base_url('admin/pengaduan'); ?>" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
					<!-- ./col -->
					<div class="col-sm-6 col-lg-4">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<?php
									$this->db->from($table);
									$this->db->where('a.status', '0');
                  $jml_data_menunggu = $this->db->get()->num_rows();
                ?>
								<h3><?= $jml_data_menunggu; ?></h3>

								<p>PENGADUAN BELUM DIVERIFIKASI</p>
							</div>
							<div class="icon">
								<i class="fa fa-clock"></i>
							</div>
							<!-- <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
					<!-- ./col -->
					<div class="col-sm-6 col-lg-4">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<?php
									$this->db->from($table);
									$this->db->where('a.status', '1');
                  $jml_data_verif = $this->db->get()->num_rows();
                ?>
								<h3><?= $jml_data_verif; ?></h3>

								<p>PENGADUAN SUDAH DIVERIFIKASI</p>
							</div>
							<div class="icon">
								<i class="far fa-check-circle"></i>
							</div>
							<!-- <a href="#" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a> -->
						</div>
					</div>
					<!-- ./col -->
				</div>
			</div>
			<!-- /.box-body -->
		</div>

	</section>
</div>
