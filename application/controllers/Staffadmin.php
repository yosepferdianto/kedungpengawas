<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffadmin extends CI_Controller {

  public function __construct() {
    parent::__construct();
		$this->load->model('Data_akun_admin_model', 'akun_admin');
		$this->load->library('form_validation', 'session');
		$this->load->helper('url');
  }

  public function index() {
   	//tambah validasi form login
		$this->form_validation->set_rules('username', 'Username', 'trim|required', [
			'required' => '<i class="fa fa-exclamation-triangle"></i> Username tidak boleh kosong !'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => '<i class="fa fa-exclamation-triangle"></i> Password tidak boleh kosong !'
		]);
		//end

    if ($this->session->userdata('staff_desa_in')) {
			$this->home();
		} else if ($this->form_validation->run() == false) {
			$data['title'] = "Staff | Desa Kedung Pengawas";
			$this->template->auth('admin_page/login_view', $data);
		} else {
			$this->loginProses();
			redirect('/staffadmin');
		}

	}
	
  public function home() {
    if (!$this->session->userdata('staff_desa_in')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-warning"></i> Mohon Login terlebih dahulu !</div>');
			redirect('staffadmin');
		} else {
			$data['title'] = "Staff | Desa Kedung Pengawas";
			$this->template->admin_page('admin_page/home_view', $data);
		}
		// redirect('/');
  }

	public function loginProses() {
    $username = $this->input->post('username');
		$password = $this->input->post('password');

		//query yang sama sesuai dari database 
		$q_akun_admin = $this->db->get_where('data_akun_admin', ['username' => $username])->row_array();

		if ($q_akun_admin['id_akun_admin']) {
			//jika usernya tidak is_deleted
			if ($q_akun_admin['is_deleted'] == 0) {
				//cek password
				$cekpasswd = $this->akun_admin->get_by_username_and_password($username, md5($password));
				if ($cekpasswd) {
					$data = [
						'id_akun_admin' => $akun_admin['id_akun_admin'],
						'username' => $akun_admin['username'],
					];
					$this->session->set_userdata($data);
					if (!empty($data)) { //jika data tidak kosong
						$this->session->set_userdata('staff_desa_in', true);
						$this->session->set_userdata('username', $cekpasswd[0]->username);
						$this->session->set_userdata('id_akun_admin', $cekpasswd[0]->id_akun_admin);
						echo json_encode(array("staff_desa_in_status" => TRUE));
					} else {
						echo json_encode(array("staff_desa_in_status" => FALSE));
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-exclamation-circle"></i> Password Salah !</div>');
					// redirect('/');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-ban"></i> Akun Anda di blokir !</div>');
				// redirect('/');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-warning"></i> Anda belum terdaftar !</div> ');
			// redirect('/');
		}
		// var_dump($akun_user);
		// die;
  }
  
  public function logoutProses() {
		$id_akun = $this->session->userdata('id_akun_admin');
		$this->akun_admin->logout_proses($id_akun);
		// session_destroy();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_akun_admin');
		$this->session->unset_userdata('staff_desa_in');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fa fa-info-circle"></i> Anda berhasil logout</div>');
		redirect('/staffadmin');
	}

}