<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

  public function __construct() {
    parent::__construct();
		$this->load->library('form_validation', 'session');
		$this->load->helper('url');
  }

	public function index() {
		if ($this->session->userdata('logged_in')) {
			redirect('user/');
		} else {
			$data['title'] = "Desa Kedung Pengawas";
			$this->template->landing_page('landing_page/welcome_view', $data);
		}
	}
	

}