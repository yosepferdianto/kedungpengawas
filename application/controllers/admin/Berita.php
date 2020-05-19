<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->library('datatables');
    $this->load->model('Data_berita_model', 'data_berita');
    $this->load->helper('tgl_indo');
    if (!$this->session->userdata('staff_desa_in')) {
      redirect('/staffadmin', 'refresh');
    }
  }

  public function index() {
    $data['title'] = "Desa Kedung Pengawas";
    $url = $this->uri->segment(1);

    if ($this->session->userdata('staff_desa_in') && $url == 'admin') {
      $this->template->admin_page('admin_page/data_berita_view', $data);
		} else {
      redirect('/staffadmin');
    }
  }

  public function listData()
  {
    $list = $this->data_berita->getListData();
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $row = array();

      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));

      $row[]   = '<h3 class="text-bold text-blue"># '.$ls->prioritas.'</h3>';
      $row[]   = '<b>'.$ls->judul_berita.'</b><br><small>'.$ls->sub_judul.'</small><br><hr class="style1">
      <a class="btn btn-sm btn-primary pull-right" title="Lihat" onclick="lihatBerita(' . "'" . $ls->id_berita . "'" . ')"><i class="fa fa-info-circle"></i> Lihat Berita</a>';
      $row[]   = $ls->isi_berita;
      $row[]   = ' <div class="card-image-table"><img src="'.base_url($ls->foto).'" alt=""></div>';
      $row[]   = longdate_indo($tanggal).'<br>'.$waktu.' WIB<hr class="style1-ms-0">'.'Pembuat : @'.$ls->username.'<br>('.$ls->nama_lengkap.')';
      //add html for action
      $row[] = '<div class="text-center">
        <a class="btn btn-primary btn-sm" title="Ubah" onclick="edit(' . "'" . $ls->id_berita . "'" . ')"><i class="fa fa-edit"></i> Ubah</a>
        <a class="btn btn-default btn-sm text-red" title="Hapus" onclick="hapus(' . "'" . $ls->id_berita . "'" . ')"><i class="fa fa-trash"></i> Hapus</a>
      </div>';

      $data[] = $row;
    }

    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_berita->count_all(),
      "recordsFiltered" => $this->data_berita->count_filtered(),
    );
    //output to json format
    echo json_encode($output);
  }

  public function buat_berita() {
    $data['title'] = "Desa Kedung Pengawas";
    $url = $this->uri->segment(1);

    if ($this->session->userdata('staff_desa_in') && $url == 'admin') {
      $this->template->admin_page('admin_page/input_berita', $data);
		} else {
      redirect('/staffadmin');
    }
  }

}