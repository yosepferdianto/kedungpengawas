<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Data_akun_user_model', 'akun_user');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
  }

  public function index() {
    if ($this->session->userdata('logged_in')) {
      $this->home();
    } else {
      $data['title'] = "Desa Kedung Pengawas";
      $this->template->landing_page('landing_page/welcome_view', $data);
    }
  }
  
  public function login() {
     //tambah validasi form login
    $this->form_validation->set_rules('username', 'Username', 'trim|required', [
      'required' => '<i class="fa fa-exclamation-triangle"></i> Username tidak boleh kosong !'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => '<i class="fa fa-exclamation-triangle"></i> Kata sandi tidak boleh kosong !'
    ]);
    //end

    if ($this->session->userdata('logged_in')) {
      // $this->home();
      redirect('user/home');
    } else if ($this->form_validation->run() == false) {
      $data['title'] = "LOGIN | Desa Kedung Pengawas";
      $this->template->auth('user_page/login_view', $data);
    } else {
      $this->loginProses();
      redirect('user/login');
    }
    // if ($this->session->userdata('logged_in')) {
    // 	$this->home();
    // } else {
    // 	$data['title'] = "LOGIN | Desa Kedung Pengawas";
    // 	$this->template->auth('user_page/login_view', $data);
    // }

  }
  
  public function home() {
    if (!$this->session->userdata('logged_in')) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-warning"></i> Mohon Login terlebih dahulu !</div>');
      redirect('user/login');
    } else {
      $data['title'] = "Home | Desa Kedung Pengawas";
      $this->template->user_page('user_page/home_view', $data);
    }
    // redirect('/');
  }

  public function loginProses() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    //query yang sama sesuai dari database 
    $q_akun_user = $this->db->get_where('data_akun_user', ['username' => $username])->row_array();

    if ($q_akun_user['id_akun_user']) {
      //jika usernya tidak is_deleted
      if ($q_akun_user['is_deleted'] == 0) {
        //cek password
        $cekpasswd = $this->akun_user->get_by_username_and_password($username, md5($password));
        if ($cekpasswd) {
          $data = [
            'id_akun_user' => $akun_user['id_akun_user'],
            'username' => $akun_user['username'],
          ];
          $this->session->set_userdata($data);
          if (!empty($data)) { //jika data tidak kosong
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('username', $cekpasswd[0]->username);
            $this->session->set_userdata('id_akun_user', $cekpasswd[0]->id_akun_user);
            echo json_encode(array("logged_in_status" => TRUE));
          } else {
            echo json_encode(array("logged_in_status" => FALSE));
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
    $id_akun = $this->session->userdata('id_akun_user');
    $this->akun_user->logout_proses($id_akun);
    // session_destroy();
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('id_akun_user');
    $this->session->unset_userdata('logged_in');
    $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> Anda berhasil logout</div>');
    redirect('/');
  }

  public function daftar() {
   if ($this->session->userdata('logged_in')) {
     redirect('/');
   } else if ($this->form_validation->run() == false) {
     $data['title'] = "Daftar Akun | Desa Kedung Pengawas";
     $this->template->auth('user_page/daftar_view', $data);
   } else {
    //  $this->loginProses();
    //  redirect('user/login');
   }
  }
   
  public function daftarproses() {
    $status   = FALSE;
    $msg     = "Proses registrasi akun gagal (EXP)";

    $username       = $this->input->post('username');
    $password       = $this->input->post('password');
    $nama_lengkap   = $this->input->post('nama_lengkap');
    $jenis_kelamin  = $this->input->post('jenis_kelamin');
    $tempat_lahir   = $this->input->post('tempat_lahir');
    $tanggal_lahir  = $this->input->post('tanggal_lahir');
    $no_telp        = $this->input->post('no_telp');
    $email          = $this->input->post('email');

    $kdnama = substr($nama_lengkap,0,3);
    $kdjk = substr($jenis_kelamin,0,1);
    $kdtgllahir = substr($tanggal_lahir,-5);

    $gen_idwarga  =  'dkp-pend'.date('Y').'/'.strtoupper($kdnama).'_'.$kdjk.'-'.$kdtgllahir.'/reg-'.date('ymdHis');

    $cekusername = $this->akun_user->get_by_username($username);

    if (empty($username)) {
      $status = FALSE;
      $msg   = "Username harus di isi!";
    } else if ($cekusername) {
      $status = FALSE;
      $msg   = "Username sudah terpakai!";
    } else if (empty($password)) {
      $status = FALSE;
      $msg   = "Kata sandi harus di isi!";
    } else if (empty($nama_lengkap)) {
      $status = FALSE;
      $msg   = "Nama lengkap harus di isi!";
    } else if (empty($jenis_kelamin)) {
      $status = FALSE;
      $msg   = "Jenis kelamin harus di pilih!";
    } else if (empty($tempat_lahir)) {
      $status = FALSE;
      $msg   = "Tempat harus di isi!";
    } else if (empty($tanggal_lahir)) {
      $status = FALSE;
      $msg   = "Tanggal lahir harus di isi!";
    } else if (strlen($no_telp) < 8) {
      $status = FALSE;
      $msg   = "Digit nomor telepon masih kurang!";
    } else if (empty($email)) {
      $status = FALSE;
      $msg   = "Email harus di isi!";
    } else {
      $data_akun_user = [
        "username"    => strtolower($username),
        "password"    => md5($password),
        "no_telp"     => $no_telp,
        "email"       => $email,
        "foto"        => 'assets/img/user_default.png', //is default
        'id_warga'    => $gen_idwarga,
        'is_deleted'  => '0',
      ];
     
      $data_warga = [
        'id_warga'      => $gen_idwarga,
        'nama_lengkap'  => strtoupper($nama_lengkap),
        'jenis_kelamin' => $jenis_kelamin,
        'tempat_lahir'  => strtoupper($tempat_lahir),
        'tanggal_lahir' => $tanggal_lahir,
        'is_deleted'    => '0',
      ];

      if (empty($data_akun_user) || empty($data_warga)) {
				$status = FALSE;
				$msg 	= 'Mohon ulangi kembali!';
			} else {
        $this->akun_user->daftarbaru_akun($data_akun_user);
        $this->akun_user->daftarbaru_warga($data_warga);
        $status = TRUE;
        $msg   = 'Terima kasih '.ucwords($nama_lengkap).',<br>Anda telah menjadi bagian dari kami.';
			}
    }

    echo json_encode(array('status' => $status, 'message' => $msg));
  }

}