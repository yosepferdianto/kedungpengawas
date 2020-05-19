<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Data_profil_model', 'data_profil');
    $this->load->model('Data_dusun_model', 'data_dusun');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
    $this->load->helper('tgl_indo');
  }

  public function index() {
    $data['title'] = "Berita | Desa Kedung Pengawas";
    $data['user_id'] = $this->session->userdata('id_akun_user');
    if ($this->session->userdata('logged_in')) {
      $this->template->user_page('user_page/profil_view', $data);
		} else {
      redirect('/');
    }
  }

  public function detail_data_akun()
  {
    $id_akun = $this->input->post_get('id_akun');

    $data= [];
    $status = FALSE;
    $msg    = 'Proses buka...';

    $list = $this->data_profil->get_akun_user($id_akun);
    foreach($list as $ls) {
      $data = [
        'username' => $ls->username,
        'no_telp' => $ls->no_telp,
        'email' => $ls->email,
      ];
    }

    if(empty($data)) {
      $status = FALSE;
      $msg    = 'Data tidak ada!';
    } else {
      $status = TRUE;
      $msg    = 'Proses lihat berhasil';
    }

    echo json_encode(array('dataForm' => $data, 'status' => $status, 'message' => $msg));
  }

  public function save_data_akun()
  {
    $status = FALSE;
    $msg    = "Proses simpan gagal!";

    $id_akun_user    = $this->input->post('id_akun_user');
    $username        = $this->input->post('username');
    $no_telp         = $this->input->post('no_telp');
    $email           = $this->input->post('email');

    $check_username = $this->data_profil->get_by_username($username, $id_akun_user);

    if (empty($username)) {
      $status = FALSE;
      $msg    = "Username tidak boleh kosong!";
    } else if ($check_username) {
      $status = FALSE;
      $msg    = "Username sudah terdaftar!";
    } else {
      $dataSave = [
        'username'  => strtolower($username),
        'no_telp'   => $no_telp,
        'email'     => $email,
      ];

      $status = TRUE;
      $msg   = "Proses simpan berhasil";

      $this->data_profil->update_data_akun(['id_akun_user' => $id_akun_user], $dataSave);
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function save_pass_akun()
  {
    $status = FALSE;
    $msg    = "Proses ubah password gagal!";

    $id_akun_user = $this->input->post('id_akun_user');
    $pass_lama    = $this->input->post('pass_lama');
    $pass_baru    = $this->input->post('pass');
    $ulangi_pass  = $this->input->post('ulangi_pass');
   

    $check_pass = $this->data_profil->get_by_id_and_password($id_akun_user, md5($pass_lama));
    
    if ($check_pass) {
      $dataSave = [
        'password'  => md5($ulangi_pass),
      ];

      $status = TRUE;
      $msg   = "Proses ubah kata sandi berhasil";

      $this->data_profil->update_data_akun(['id_akun_user' => $id_akun_user], $dataSave);

    } else {
      $status = FALSE;
      $msg    = "Password lama salah!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  
// -----------------------------------------------------------------

  public function detail_data_warga()
  {
    $id_warga = $this->input->post_get('id_warga');

    $data= [];
    $status = FALSE;
    $msg    = 'Proses buka...';

    $list = $this->data_profil->get_akun_warga($id_warga);
    foreach($list as $ls) {
      $data = [
        'no_nik' => $ls->nik,
        'nama_lengkap' => $ls->nama_lengkap,
        'jenis_kelamin' => $ls->jenis_kelamin,
        'tempat_lahir' => $ls->tempat_lahir,
        'tanggal_lahir' => date("d-m-Y", strtotime($ls->tanggal_lahir)),
        'kewarganegaraan' => $ls->kewarganegaraan,
        'agama' => $ls->agama,
        'pendidikan' => $ls->pendidikan,
        'status_perkawinan' => $ls->status_perkawinan,
        'pekerjaan' => $ls->pekerjaan,
        'gol_darah' => $ls->gol_darah,
      ];
    }

    if(empty($data)) {
      $status = FALSE;
      $msg    = 'Data tidak ada!';
    } else {
      $status = TRUE;
      $msg    = 'Proses lihat berhasil';
    }

    echo json_encode(array('dataForm' => $data, 'status' => $status, 'message' => $msg));
  }

  public function save_data_warga()
  {
    $status = FALSE;
    $msg    = "Proses simpan gagal!";

    $id_warga           = $this->input->post('id_warga');
    $no_nik             = $this->input->post('no_nik');
    $nama_lengkap       = $this->input->post('nama_lengkap');
    $jenis_kelamin      = $this->input->post('jenis_kelamin');
    $tempat_lahir       = $this->input->post('tempat_lahir');
    $tanggal_lahir      = $this->input->post('tanggal_lahir');
    $kewarganegaraan    = $this->input->post('kewarganegaraan');
    $agama              = $this->input->post('agama');
    $pendidikan         = $this->input->post('pendidikan');
    $status_perkawinan  = $this->input->post('status_perkawinan');
    $pekerjaan          = $this->input->post('pekerjaan');
    $gol_darah          = $this->input->post('gol_darah');

    $check_no_nik = $this->data_profil->get_no_nik($no_nik, $id_warga);

    if($check_no_nik){
      $status = FALSE;
      $msg   = "No. NIK sudah terdaftar!";
    } else {
      $dataSave = [
        'nik'               => $no_nik,
        'nama_lengkap'      => $nama_lengkap,
        'jenis_kelamin'     => $jenis_kelamin,
        'tempat_lahir'      => $tempat_lahir,
        'tanggal_lahir'     => $tanggal_lahir,
        'kewarganegaraan'   => $kewarganegaraan,
        'agama'             => $agama,
        'pendidikan'        => $pendidikan,
        'status_perkawinan' => $status_perkawinan,
        'pekerjaan'         => $pekerjaan,
        'gol_darah'         => $gol_darah,
      ];
      
      if (empty($id_warga)){
        $status = FALSE;
        $msg   = "Proses simpan gagal!";
      } else {
        $status = TRUE;
        $msg   = "Proses simpan berhasil";
        $this->data_profil->update_data_warga(['id_warga' => $id_warga], $dataSave);
      }
    }
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

// -----------------------------------------------------------------

  public function detail_data_kk_warga()
  {
    $id_kk_warga = $this->input->post_get('id_kk_warga');

    $data= [];
    $status = FALSE;
    $msg    = 'Proses buka...';

    $list = $this->data_profil->get_akun_kk_warga($id_kk_warga);
    foreach($list as $ls) {
      $data = [
        'no_kk' => $ls->no_kk,
        'nama_kk' => $ls->nama_kepala,
        'deskripsi_alamat' => $ls->deskripsi_alamat,
        'id_area' => $ls->id_area,
        'id_rw' => $ls->id_rw,
        'id_rt' => $ls->id_rt,
      ];
    }

    if(empty($data)) {
      $status = FALSE;
      $msg    = 'Data tidak ada!';
    } else {
      $status = TRUE;
      $msg    = 'Proses lihat berhasil';
    }

    echo json_encode(array('dataForm' => $data, 'status' => $status, 'message' => $msg));
  }

  public function save_data_kk_warga()
  {
    $status = FALSE;
    $msg    = "Proses simpan gagal!";

    $id_warga        = $this->input->post('id_warga');
    $id_kk_warga        = $this->input->post('id_kk_warga');
    $no_kk            = $this->input->post('no_kk');
    $nama_kk            = $this->input->post('nama_kk');
    $deskripsi_alamat   = $this->input->post('deskripsi_alamat');
    $id_area            = $this->input->post('id_area');
    $id_rw              = $this->input->post('id_rw');
    $id_rt              = $this->input->post('id_rt');
    
    $check_id_kk = $this->data_profil->get_id_kk($id_kk_warga);
    $check_no_kk = $this->data_profil->get_no_kk($no_kk, $id_kk_warga);

    if ($check_no_kk) {
      $status = FALSE;
      $msg    = "No. KK sudah terdaftar!";
    } else {
      $dataSave = [
        'no_kk'                => $no_kk,
        'nama_kepala'          => $nama_kk,
        'deskripsi_alamat'     => $deskripsi_alamat,
        'id_area'              => $id_area,
        'id_rw'                => $id_rw,
        'id_rt'                => $id_rt,
      ];

      $status = TRUE;
      $msg   = "Proses simpan berhasil";
        
      if ($check_id_kk) {
        $this->data_profil->update_data_warga(['id_warga' => $id_warga], ['no_kk' => $no_kk]);
        $this->data_profil->update_data_kk_warga(['id_kk_warga' => $id_kk_warga], $dataSave);
      } else {
        $this->data_profil->update_data_warga(['id_warga' => $id_warga], ['no_kk' => $no_kk]);
        $this->data_profil->create_data_kk_warga($dataSave);
      }
    }
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

// -------------------------------------------------------------
// SELECT DESA - RT - RW
public function pilihDusun() {
  $data = $this->data_dusun->getAllArea();
  echo json_encode($data);
}
public function pilihRw($dusunID) {
  $data = $this->data_dusun->getRW($dusunID);
  echo json_encode($data);
}
public function pilihRt($dusunID) {
  $data = $this->data_dusun->getRT($dusunID);
  echo json_encode($data);
}
// .END SELECT DESA - RT - RW



}