<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->library('datatables');
    $this->load->model('Data_berita_model', 'data_berita');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
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
        <a class="btn btn-primary btn-sm" title="Ubah" href="'.base_url('admin/berita/ubah_berita/'.$ls->id_berita).'"><i class="fa fa-edit"></i> Ubah</a>
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

  public function tambahberita() {
    $status   = FALSE;
    $msg     = "(EXP)";

    $idAdmin = $this->session->userdata('id_akun_admin');

    $cekPrioritas = $this->data_berita->cek_prioritas();
    $prioritas  = $cekPrioritas + 1;

    $judul      = $this->input->post('judul');
    $sub_judul  = $this->input->post('sub_judul');
    $isi_berita  = $this->input->post('isi_berita');

    $url = $this->config->item('upload_url') . "./storage/upload/berita/";
    $rawFileName = $_FILES['file']['name'];
    $fileName = str_replace(' ', '-', $rawFileName);
    $formatfile	= $fileName;
    if (!empty($rawFileName)){
      $pathfileName	= $url . $fileName;
    } else {
      $pathfileName	= "./storage/img/noimage.png";
    }
    $directory = $this->config->item('upload_destination') .  "./storage/upload/berita/";

    if ($this->session->userdata('staff_desa_in') == "") {
      $status = FALSE;
      $msg   = "error_login_session";
    } else if (empty($idAdmin)) {
      $status = FALSE;
      $msg   = "id_admin_null";
    } else if (empty($judul)) {
      $status = FALSE;
      $msg   = "judul_null";
    } else if (empty($sub_judul)) {
      $status = FALSE;
      $msg   = "sub_judul_null";
		} else if (empty($isi_berita)) {
      $status = FALSE;
      $msg   = "isi_berita_null";
    } else {

      $dataBerita = [
        'id_akun_admin'   => $idAdmin,
        'prioritas'       => $prioritas,
        'judul_berita'    => $judul,
        'sub_judul'       => $sub_judul,
        'isi_berita'      => $isi_berita, 
        'foto'            => $pathfileName,
        'is_deleted'      => '0',
      ];
      
      if (empty($dataBerita)) {
				$status = FALSE;
				$msg 	= "error_input_array";
			} else {
        move_uploaded_file($_FILES["file"]["tmp_name"], trim($directory . $formatfile));
        $this->data_berita->save($dataBerita);
        $status = TRUE;
        $msg   = "Proses membuat berita berhasil";
			}
    }
    echo json_encode(array('status' => $status, 'message' => $msg));
  }

  public function load_data_berita($id) {
    $status = FALSE;
    $msg    = 'Memuat data berita...';

    $getData = $this->data_berita->getDataBerita($id);

    foreach($getData as $p) {
      $create_date = date("Y-m-d", strtotime($p->created_at));
      $create_time = date("H:i", strtotime($p->created_at));
      $update_date = date("Y-m-d", strtotime($p->updated_at));
      $update_time = date("H:i", strtotime($p->updated_at));
      $data = [
        // Created_at detail
        'create_date' => longdate_indo($create_date),
        'create_time' => $create_time,
        // Updated_at detail
        'update_date' => longdate_indo($update_date),
        'update_time' => $update_time,
        // Author detail
        'author' => ucwords($p->username),
        // Content ------------------------------------
        'judul_berita' => $p->judul_berita,
        'sub_judul' => $p->sub_judul,
        'isi_berita' => $p->isi_berita,
        'foto' => $p->foto,
        // Priority
        'prioritas' => $p->prioritas,
      ];
    }

    if(empty($data)) {
      $status = FALSE;
      $msg    = 'Gagal memuat data berita!';
    } else {
      $status = TRUE;
      $msg    = 'Memuat data berita berhasil';
    }

    echo json_encode(array('dataForm' => $data, 'status' => $status, 'message' => $msg));
    
  }

  public function ubah_berita($id) {
    $data['title'] = "Desa Kedung Pengawas";
    $data['id'] = $id;
    $url = $this->uri->segment(1);

    if ($this->session->userdata('staff_desa_in') && $url == 'admin') {
      $this->template->admin_page('admin_page/edit_berita', $data);
		} else {
      redirect('/staffadmin');
    }
  }

  public function ubahberita() {
    $status   = FALSE;
    $msg     = "(EXP)";

    $idAdmin = $this->session->userdata('id_akun_admin');

    $cekPrioritas = $this->data_berita->cek_prioritas();
    $prioritas  = $cekPrioritas + 1;

    $id_berita   = $this->input->post_get('idBerita');
    $judul      = $this->input->post_get('judul');
    $sub_judul  = $this->input->post_get('sub_judul');
    $isi_berita  = $this->input->post_get('isi_berita');
    $url_img  = $this->input->post_get('set_img');

    $url = $this->config->item('upload_url') . "./storage/upload/berita/";
    $rawFileName = $_FILES['file']['name'];
    $fileName = str_replace(' ', '-', $rawFileName);
    $formatfile	= $fileName;
    if (!empty($rawFileName)){
      $pathfileName	= $url . $fileName;
    } else {
      $pathfileName	= $url_img;
    }
    $directory = $this->config->item('upload_destination') .  "./storage/upload/berita/";

    if ($this->session->userdata('staff_desa_in') == "") {
      $status = FALSE;
      $msg   = "error_login_session";
    } else if (empty($idAdmin)) {
      $status = FALSE;
      $msg   = "id_admin_null";
    } else if (empty($judul)) {
      $status = FALSE;
      $msg   = "judul_null";
    } else if (empty($sub_judul)) {
      $status = FALSE;
      $msg   = "sub_judul_null";
		} else if (empty($isi_berita)) {
      $status = FALSE;
      $msg   = "isi_berita_null";
    } else {

      $dataBerita = [
        'id_akun_admin'   => $idAdmin,
        'prioritas'       => $prioritas,
        'judul_berita'    => $judul,
        'sub_judul'       => $sub_judul,
        'isi_berita'      => $isi_berita, 
        'foto'            => $pathfileName,
      ];
      
      if (empty($dataBerita)) {
				$status = FALSE;
				$msg 	= "error_input_array";
			} else {
        move_uploaded_file($_FILES["file"]["tmp_name"], trim($directory . $formatfile));
        $this->data_berita->update_berita(['id_berita' => $id_berita], $dataBerita);
        $status = TRUE;
        $msg   = "Proses mengubah berita berhasil";
			}
    }
    echo json_encode(array('status' => $status, 'message' => $msg));
  }

}