<header class="main-header">
	<!-- Logo -->
	<a href="<?= base_url(); ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><i class="fab fa-dochub"></i><b>KP</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><i class="fab fa-dochub"></i></i>&nbsp;<b>Kedung Pengawas</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!-- <img src="<?= base_url(); ?>assets/dist/img/user_default.png" class="user-image" alt="User Image"> -->
						<i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i>
							<?php
									$user = 'data_akun_user as a';
									$warga   = 'data_warga as w';

                  $user_id = $this->session->userdata('id_akun_user');
									$this->db->from($user);
									$this->db->join($warga,'w.id_warga = a.id_warga');
                  $this->db->where('a.id_akun_user', $user_id);
                  $name = $this->db->get()->result_array();
                ?>
						<?php foreach ($name as $nm) : ?>
						<span class="hidden-xs"><?= strtoupper($nm['username']); ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-green-active">
							<img src="<?= base_url($nm['foto']); ?>" class="img-circle">
							<p>
								<?= ucwords($nm['nama_lengkap']); ?>
								<small><?= $nm['jenis_kelamin']; ?></small>
								<?php endforeach; ?>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer bg-green" style="background: #222d32;">
							<!-- <div class="pull-left">
								<a href="#" class="btn btn-success btn-flat"
									onclick="edit_myAccount('<?php echo $this->session->userdata('user_dashboard_id'); ?>')"><i
										class="fa fa-user-o"></i> Profil</a>
							</div> -->
							<div class="pull-right">
								<a href="<?= base_url('user/logoutproses'); ?>" class="btn btn-outline btn-flat"><i
										class="fa fa-sign-out"></i> Keluar</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
			</ul>
		</div>
	</nav>
</header>
