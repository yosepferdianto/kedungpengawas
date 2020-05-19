<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->model('Data_pengaduan_model', 'data_pengaduan');
    // $this->load->model('Data_akun_user_model', 'akun_user');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
    $this->load->helper('tgl_indo');
  }

  public function index() {
    $data['title'] = "Berita | Desa Kedung Pengawas";
    if ($this->session->userdata('logged_in')) {
      $this->template->user_page('user_page/berita_view', $data);
		} else {
      $this->template->landing_page('landing_page/berita_view', $data);
    }
  }

  public function detail($id) {
    $data['title'] = "Berita | Desa Kedung Pengawas";
    $data['id'] = $id;
    if ($this->session->userdata('logged_in')) {
      $this->template->user_page('user_page/berita_detail_view', $data);
		} else {
      $this->template->landing_page('landing_page/berita_detail_view', $data);
    }
  }

}