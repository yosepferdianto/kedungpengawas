<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <?php 
        if($this->uri->segment(1) == 'staffadmin'){
          echo '<li class="active"><a href="'.base_url('/staffadmin').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('/staffadmin').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';
        }
      ?>
      <li class="header">Data Layanan Warga</li>
      <?php 
        if($this->uri->segment(2) == 'pengaduan'){
          echo '<li class="active"><a href="'.base_url('admin/pengaduan').'"><i class="fa fa-circle-o text-red"></i> <span>Data Pengaduan</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('admin/pengaduan').'"><i class="fa fa-circle-o text-red"></i> <span>Data Pengaduan</span></a></li>';
        }
      ?>
      <?php 
        if($this->uri->segment(2) == 'pengajuan'){
          echo '<li class="active"><a href="'.base_url('admin/pengajuan').'"><i class="fa fa-circle-o text-yellow"></i> <span>Data Pengajuan</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('admin/pengajuan').'"><i class="fa fa-circle-o text-yellow"></i> <span>Data Pengajuan</span></a></li>';
        }
      ?>
      <?php 
        if($this->uri->segment(2) == 'berita'){
          echo '<li class="active"><a href="'.base_url('admin/berita').'"><i class="fa fa-circle-o text-aqua"></i> <span>Data Berita</span></a></li>';
        }else{
          echo '<li><a href="'.base_url('admin/berita').'"><i class="fa fa-circle-o text-aqua"></i> <span>Data Berita</span></a></li>';
        }
      ?>
      <!-- <li><a href="<?= base_url('admin/pengaduan'); ?>"><i class="fa fa-circle-o text-red"></i> <span>Data Pengaduan</span></a></li> -->
      <!-- <li><a href="<?= base_url('admin/pengajuan'); ?>"><i class="fa fa-circle-o text-yellow"></i> <span>Data Pengajuan</span></a></li> -->
      <!-- <li><a href="<?= base_url('admin/berita'); ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Data Berita</span></a></li> -->

      <li class="header">Master Data</li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-folder text-orange"></i> <span>Master Penduduk</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= base_url('admin/data_keluarga'); ?>"><i class="fa fa-circle-o"></i> Data Kartu Keluarga</a></li>
            <li><a href="<?= base_url('admin/data_perorangan'); ?>"><i class="fa fa-circle-o"></i> Data Perorangan</a></li>
          </ul>
      </li>

      <li class="treeview hide">
          <a href="#">
            <i class="fa fa-folder text-orange"></i> <span>Master Pengurus</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin/data_dusun'); ?>"><i class="fa fa-circle-o"></i> Data Dusun</a></li>
            <li><a href="<?= base_url('admin/data_area'); ?>"><i class="fa fa-circle-o"></i> Data Area</a></li>
            <li><a href="<?= base_url('admin/data_rw'); ?>"><i class="fa fa-circle-o"></i> Data RW</a></li>
            <li><a href="<?= base_url('admin/data_rt'); ?>"><i class="fa fa-circle-o"></i> Data RT</a></li>
          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-folder text-orange"></i> <span>Master Akun</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= base_url('admin/data_akun_warga'); ?>"><i class="fa fa-circle-o"></i> Data Akun Warga</a></li>
            <li><a href="<?= base_url('admin/data_akun_staff'); ?>"><i class="fa fa-circle-o"></i> Data Akun Staff</a></li>
          </ul>
      </li>

      <li class="header text-center"></li>
      <li><a href="<?= base_url('admin/profile'); ?>"><i class="fa fa-id-card"></i> <span>Profil Saya</span></a></li>
      <!-- <li><a href="<?= base_url(''); ?>"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>