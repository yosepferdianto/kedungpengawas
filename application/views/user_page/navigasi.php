<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <?php 
        if($this->uri->segment(1) == 'user'){
          echo '<li class="active"><a href="'.base_url('/user').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/user').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';
        }
      ?>
      <li class="header">Layanan</li>
      <?php 
        if($this->uri->segment(1) == 'pengaduan'){
          echo '<li class="active"><a href="'.base_url('/pengaduan').'"><i class="fa fa-comment"></i> <span>Buat Pengaduan</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/pengaduan').'"><i class="fa fa-comment"></i> <span>Buat Pengaduan</span></a></li>';
        }
      ?>
      <?php 
        if($this->uri->segment(1) == 'pengajuan' && $this->uri->segment(2) == 'surat'){
          echo '<li class="active treeview menu-open">';
        }else{
          echo '<li class="treeview">';
        }
      ?>
          <a href="#">
            <i class="fa fa-edit"></i> <span>Surat Pengajuan</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php
							$table = 'kategori_pengajuan as a';
						
							$this->db->from($table);
              $this->db->where('a.is_deleted', '0');
              $list = $this->db->get()->result_array();
            ?>
            <?php foreach ($list as $ls) : ?>
              <?php 
                if($this->uri->segment(3) == $ls['nama_kategori']){
                  echo '<li class="active"><a href="'.base_url($ls['url']).'"><i class="fa fa-circle-o"></i> <span>'.strtoupper($ls['nama_kategori']).'</span></a></li>';
                }else{
                  echo '<li><a href="'.base_url($ls['url']).'"><i class="fa fa-circle-o"></i> <span>'.strtoupper($ls['nama_kategori']).'</span></a></li>';
                }
              ?>
            <?php endforeach; ?>
          </ul>
      </li>
      <?php 
        if($this->uri->segment(1) == 'pengajuan' && $this->uri->segment(2) == ''){
          echo '<li class="active"><a href="'.base_url('/pengajuan').'"><i class="fa fa-history"></i> <span>Riwayat Pengajuan</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/pengajuan').'"><i class="fa fa-history"></i> <span>Riwayat Pengajuan</span></a></li>';
        }
      ?>
      <?php 
        if($this->uri->segment(1) == 'berita'){
          echo '<li class="active"><a href="'.base_url('/berita').'"><i class="fa fa-newspaper"></i> <span>Berita Desa</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/berita').'"><i class="fa fa-newspaper"></i> <span>Berita Desa</span></a></li>';
        }
      ?>
      <li class="header"></li>
      <?php 
        if($this->uri->segment(1) == 'profil'){
          echo '<li class="active"><a href="'.base_url('/profil').'"><i class="far fa-id-card"></i> <span>Profil Saya</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/profil').'"><i class="far fa-id-card"></i> <span>Profil Saya</span></a></li>';
        }
      ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>