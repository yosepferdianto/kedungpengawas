<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Data_pengaduan_model', 'data_pengaduan');
    $this->load->model('Data_akun_user_model', 'akun_user');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
    $this->load->helper('tgl_indo');
  }

  public function index() {
    $data['title'] = "Pengaduan | Desa Kedung Pengawas";
    if ($this->session->userdata('logged_in')) {
      $this->template->user_page('user_page/pengaduan_view', $data);
		} else {
      $this->template->landing_page('landing_page/pengaduan_view', $data);
    }
  }

  public function pilihKategori() {
    $data = $this->data_pengaduan->getAllKategori();
    echo json_encode($data);
  }

  public function kirimPengaduan() {
    $status   = FALSE;
    $msg     = "Proses kirim pengaduan gagal (EXP)";

    if ($this->session->userdata('logged_in')) {
      $idUser = $this->session->userdata('id_akun_user');
      $synUser = $this->akun_user->get_akun_warga($idUser);
      foreach ($synUser as $syn) {
        $namaPengadu   = $syn->nama_lengkap;
        $noTelp        = $syn->no_telp;
      }
    } else {
      $namaPengadu   = $this->input->post('nama_pengadu');
      $noTelp        = $this->input->post('no_telp_pengadu');  
    }

    $kategori  = $this->input->post('select_kategori');
    $isi       = $this->input->post('isi_pengaduan');

    $url = $this->config->item('upload_url') . "./storage/upload/pengaduan/";
    $rawFileName = $_FILES['file']['name'];
    $fileName = str_replace(' ', '-', $rawFileName);
    $formatfile	= date('YmdHis') . $fileName;
    if (!empty($rawFileName)){
      $pathfileName	= $url . date('YmdHis') . $fileName;
    } else {
      $pathfileName	= null;
    }
    $directory = $this->config->item('upload_destination') .  "./storage/upload/pengaduan/";

    if (empty($namaPengadu)) {
      $status = FALSE;
      $msg   = "Proses kirim pengaduan gagal. Nama anda harus di isi!";
    } else if (empty($noTelp)) {
      $status = FALSE;
      $msg   = "Proses kirim pengaduan gagal. Nomor telepon anda harus di isi!";
    } else if (strlen($noTelp) < 8) {
      $status = FALSE;
      $msg   = "Proses kirim pengaduan gagal. Digit nomor telepon anda masih kurang!";
    } else if (empty($kategori)) {
      $status = FALSE;
      $msg   = "Proses kirim pengaduan gagal. Kategori harus dipilih!";
    } else if (empty($isi)) {
      $status = FALSE;
      $msg   = "Proses kirim pengaduan gagal. Isi laporan pengaduan anda harus terisi!";
		} else {

      $dataPengaduan = [
        'nama_pengadu'           => $namaPengadu,
        'no_telp'                => $noTelp,
        'id_kategori_pengaduan'  => $kategori,
        'deskripsi'              => $isi,
        'lampiran'               => $pathfileName, 
        'status'                 => '0',
        'is_deleted'             => '0',
      ];
      
      if (empty($dataPengaduan)) {
				$status = FALSE;
				$msg 	= "Proses kirim pengaduan gagal. Silahkan ulangi kembali!";
			} else {
        move_uploaded_file($_FILES["file"]["tmp_name"], trim($directory . $formatfile));
        $this->data_pengaduan->save($dataPengaduan);
        $status = TRUE;
        $msg   = "Proses kirim pengaduan berhasil. Terima kasih telah memberikan laporan pengaduan.";
			}
    }
    echo json_encode(array('status' => $status, 'message' => $msg));
  }

  public function pantauPengaduan()
  {
    $idUser = $this->session->userdata('id_akun_user');
    $list = $this->data_pengaduan->pengaduanUser($idUser);
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));
      $row = array();

      $row[]  = '<div class="text-center">
        <a class="btn btn-primary btn-sm" title="Lihat" onclick="detail(' . "'" . $ls->id_pengaduan . "'" . ')">LIHAT</a>
        </div>';
      $row[]   = '' . longdate_indo($tanggal) . '<br>' . $waktu . ' WIB';
      $row[]   = $ls->nama_kategori;
      if ($ls->status != 1) {
        $row[]  = "<div style='font-size:16px;'><span class='badge bg-yellow'><i class='fa fa-clock'></i> MENUNGGU</span></div>";
      } else {
        $row[]  = "<div style='font-size:16px;'><span class='badge bg-green'><i class='fa fa-check-circle'></i> DIVERIFIKASI</span></div>";
      };

      $data[] = $row;
    }
    // var_dump($list);
    // die;
    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_pengaduan->count_all_user($idUser),
      "recordsFiltered" => $this->data_pengaduan->count_filtered_user($idUser),
    );
    //output to json format
    echo json_encode($output);
    // die;
  }

  public function detail()
  {
    $id_pengaduan = $this->input->post_get('id_pengaduan');

    $status = FALSE;
    $msg    = 'Proses buka...';

    $getPrint = $this->data_pengaduan->detail($id_pengaduan);
    foreach($getPrint as $p) {
      $tanggal = date("Y-m-d", strtotime($p->created_at));
      $waktu = date("H:i", strtotime($p->created_at));
      $data = [
        'tanggal' => longdate_indo($tanggal),
        'waktu' => $waktu,
        'nama_pengadu' => ucwords($p->nama_pengadu),
        'no_telp' => $p->no_telp,
        'kategori' => ucwords($p->nama_kategori),
        'deskripsi' => $p->deskripsi,
        'status' => $p->status,
        'lampiran' => $p->lampiran,
      ];
    }

    if(empty($data)) {
      $status = FALSE;
      $msg    = 'Gagal dibuka!';
    } else {
      $status = TRUE;
      $msg    = 'Proses lihat pengaduan berhasil';
    }

    echo json_encode(array('dataForm' => $data, 'status' => $status, 'message' => $msg));
  }

}