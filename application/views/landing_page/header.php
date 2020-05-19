<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars fa-lg"></i>
          </button>
          <a href="<?= base_url(); ?>" class="navbar-brand"><i class="fa fa-shield fa-lg"></i>&nbsp<b> Kedung Pengawas</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buat Pengajuan <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">e-KTP</a></li>
                <li><a href="#">Domisili</a></li>
                <li><a href="#">SKCK</a></li>
              </ul>
            </li> -->
            <li><a href="<?= base_url('berita'); ?>">Berita Desa</a></li>
            <!-- <li><a href="#">Panduan</a></li> -->
            <li><a href="#">Tentang Desa</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav bg-green-active">
            <li>
             
              <a href="<?= base_url('user/login'); ?>" class="text-bold">
              <?php
                $username = $this->session->userdata('username');
                if ($this->session->userdata('logged_in')) { 
                  echo '<i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i> '. strtoupper($username);
                } else {
                  echo '<i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i> MASUK';
                }
              ?> 
              </a>
           </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>