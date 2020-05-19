<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->library('datatables');
    $this->load->model('Data_pengajuan_model', 'data_pengajuan');
    $this->load->helper('tgl_indo');
    if (!$this->session->userdata('staff_desa_in')) {
      redirect('/staffadmin', 'refresh');
    }
  }

  public function index() {
    $data['title'] = "Desa Kedung Pengawas";
    $url = $this->uri->segment(1);

    if ($this->session->userdata('staff_desa_in') && $url == 'admin') {
      $this->template->admin_page('admin_page/data_pengajuan_view', $data);
		} else {
      redirect('/staffadmin');
    }
  }

  public function listData()
  {
    $list = $this->data_pengajuan->getListData();
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $row = array();
      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));

      $row[] = '<div class="text-center">
      <a class="btn btn-social-icon btn-primary" href="javascript:void(0)" title="Lihat" onclick="printHasil(' . "'" . $ls->no_surat . "'" . ',' . "'" . $ls->id_kategori . "'" . ')"><i class="fa fa-info-circle"></i></a>
      </div>';
      $row[]   = '<b>' . $ls->no_surat . '</b>';
      $row[]   = ucwords($ls->nama_lengkap);
      $row[]   = strtoupper($ls->nama_kategori);
      $row[]   = '' . longdate_indo($tanggal) . '<br>' . $waktu . ' WIB';
      //add html for action
      $row[] = '<div class="text-center">				
      <a class="btn btn-default text-red" title="Hapus" onclick="hapus(' . "'" . $ls->id_pengajuan . "'" . ',' . "'" . $ls->no_surat . "'" . ')"><i class="fa fa-trash"></i> Hapus</a>
      </div>';

      $data[] = $row;
    }
    // var_dump($list);
    // die;
    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_pengajuan->count_all(),
      "recordsFiltered" => $this->data_pengajuan->count_filtered(),
    );
    //output to json format
    echo json_encode($output);
    // die;
  }

  public function hapus($id_pengajuan)
  {
    $status = FALSE;
    $msg    = "Proses hapus pengajuan gagal!";

    if (!empty($id_pengajuan)){
      $status = TRUE;
      $msg   = "Proses hapus pengajuan berhasil";
      
      $data = [
        'is_deleted' => '1',
      ];
      $this->data_pengajuan->hapus(['id_pengajuan' => $id_pengajuan], $data);
    } else {
      $status = FALSE;
      $msg    = "No. Surat belum ada!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));
  }

  // public function surat_pengantar() {
  //   $noSurat = $this->input->post_get('no_surat');
  //   $data['title'] =  " Surat Pengajuan | Desa Kedung Pengawas";
  //   $data['no_surat'] = $noSurat;
  //   $getPrint = $this->data_pengajuan->get_print($noSurat);
  //   foreach($getPrint as $p) {
  //     $tanggal = date("Y-m-d", strtotime($p->created_at));
  //     $data['tgl_surat'] = date_indo($tanggal);
  //   }
  //   $this->template->print('user_page/pengajuan/views/print_domisili', $data);
  // }

  // public function surat_keterangan() {
  //   $noSurat = $this->input->post_get('no_surat');
  //   $data['title'] =  " Surat Pengajuan | Desa Kedung Pengawas";
  //   $data['no_surat'] = $noSurat;
  //   $getPrint = $this->data_pengajuan->get_print($noSurat);
  //   foreach($getPrint as $p) {
  //     $tanggal = date("Y-m-d", strtotime($p->created_at));
  //     $data['tgl_surat'] = date_indo($tanggal);
  //   }
  //   $this->template->print('user_page/pengajuan/views/print_domisili', $data);
  // }

}