<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // $this->load->library('datatables');
    $this->load->model('Data_pengaduan_model', 'data_pengaduan');
    $this->load->helper('tgl_indo');
    #1. Default date, dengan format (’5 September 2017’). date_indo('Y-m-d')
    #2. Short date, dengan format (‘5/09/2017’). shortdate_indo('Y-m-d')
    #3. Medium date, dengan format (‘5-Sep-2017’). mediumdate_indo('Y-m-d')
    #4. Long date, dengan format (‘Selasa, 5 September 2017’). longdate_indo('Y-m-d')
    if (!$this->session->userdata('staff_desa_in')) {
      redirect('/staffadmin', 'refresh');
    }
  }

  public function index() {
    $data['title'] = "Desa Kedung Pengawas";
    $url = $this->uri->segment(1);

    if ($this->session->userdata('staff_desa_in') && $url == 'admin') {
      $this->template->admin_page('admin_page/data_pengaduan_view', $data);
		} else {
      redirect('/staffadmin');
    }
  }

  public function listData()
  {
    $list = $this->data_pengaduan->getListData();
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));
      $row = array();
      $row[]   = '<a class="btn btn-social-icon btn-primary" title="Lihat" onclick="detail(' . "'" . $ls->id_pengaduan . "'" . ')"><i class="fa fa-info-circle"></i></a>';
      $row[]   = '' . longdate_indo($tanggal) . '<br>' . $waktu . ' WIB';
      $row[]   = ucwords($ls->nama_pengadu);
      $row[]   = $ls->nama_kategori;
      $row[]   = $ls->deskripsi;
    
      if ($ls->status == 1) {
        $row[]  = "<div style='font-size:16px;'><span class='badge bg-green'><i class='fa fa-check-circle fa-fw'></i> DIVERIFIKASI</span></div>";
      } else {
        $row[]  = "<div style='font-size:16px;'><span class='badge bg-yellow'><i class='fa fa-clock fa-fw'></i> MENUNGGU</span></div>";
      };

      //add html for action
      if ($ls->status != 1) {
        $row[] = '<div class="text-center"> 
        <a class="btn btn-success btn-block" title="Verifikasi" onclick="verifikasi(' . "'" . $ls->id_pengaduan . "'" . ')">
        <i class="fa fa-check"></i> Setujui</a>
        </div>';
      } else {
        $row[] = '<div class="text-center">
        <a class="btn btn-default btn-block text-red" title="Hapus" onclick="hapus(' . "'" . $ls->id_pengaduan . "'" . ')"><i class="fa fa-trash"></i> Hapus</a>
        </div>';
      };

      $data[] = $row;
    }
    // var_dump($list);
    // die;
    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_pengaduan->count_all(),
      "recordsFiltered" => $this->data_pengaduan->count_filtered(),
    );
    //output to json format
    echo json_encode($output);
    // die;
  }

  public function listData_hapus()
  {
    $list = $this->data_pengaduan->getListData_hapus();
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));
      $tanggal_update = date("Y-m-d", strtotime($ls->updated_at));
      $waktu_update = date("H:i", strtotime($ls->updated_at));
      $row = array();
      $row[]   = '<a class="btn btn-social-icon btn-primary" title="Lihat" onclick="detail(' . "'" . $ls->id_pengaduan . "'" . ')"><i class="fa fa-info-circle"></i></a>';
      $row[]   = longdate_indo($tanggal) . '<br>' . $waktu . ' WIB';
      $row[]   = ucwords($ls->nama_pengadu);
      $row[]   = $ls->nama_kategori;
      $row[]   = $ls->deskripsi;
      $row[]   = longdate_indo($tanggal_update) . '<br>' . $waktu_update . ' WIB';
    
      $row[] = '<div class="text-center"> 
         <a class="btn btn-warning btn-block" title="Kembalikan" onclick="kembalikan(' . "'" . $ls->id_pengaduan . "'" . ')">
          <i class="fa fa-refresh"></i> Kembalikan
        </a>
      </div>';


      $data[] = $row;
    }
    // var_dump($list);
    // die;
    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_pengaduan->count_all(),
      "recordsFiltered" => $this->data_pengaduan->count_filtered(),
    );
    //output to json format
    echo json_encode($output);
    // die;
  }

  public function listData_kategori()
  {
    $list = $this->data_pengaduan->getListData_kategori();
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $row = array();
      $row[]   = '<div class="text-center text-bold">'.$ls->level.
      '</div>';
      $row[]   = '<b>'.$ls->nama_kategori.'</b>';
      $row[] = '<div class="text-center"> 
         <a class="btn btn-primary btn-sm" title="Ubah" onclick="edit_kategori(' . "'" . $ls->id_kategori_pengaduan . "'" . ',' . "'" . $ls->nama_kategori . "'" . ')">
          <i class="fa fa-edit"></i> Ubah</a>

          <a class="btn btn-default btn-sm text-red" title="Hapus" onclick="hapus_kategori(' . "'" . $ls->id_kategori_pengaduan . "'" . ')">
          <i class="fa fa-trash"></i> Hapus</a>
      </div>';

      $data[] = $row;
    }

    $output = array(
      "data" => $data,
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->data_pengaduan->count_all(),
      "recordsFiltered" => $this->data_pengaduan->count_filtered(),
    );

    echo json_encode($output);
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

  public function verifikasi()
  {
    $status = FALSE;
    $msg    = "Proses verifikasi tidak bisa!";

    $id_pengaduan = $this->input->post_get('id_pengaduan');
    
    if (!empty($id_pengaduan)) {
      $dataSave = [
        'status'  => '1',
      ];

      $status = TRUE;
      $msg   = "Proses verifikasi berhasil";

      $this->data_pengaduan->verifikasi(['id_pengaduan' => $id_pengaduan], $dataSave);

    } else {
      $status = FALSE;
      $msg    = "ID Pengaduan tidak ada, mohon ulangi kembali!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function hapus()
  {
    $status = FALSE;
    $msg    = "Proses hapus tidak bisa!";

    $id_pengaduan = $this->input->post_get('id_pengaduan');
    
    if (!empty($id_pengaduan)) {
      $dataSave = [
        'is_deleted'  => '1',
      ];

      $status = TRUE;
      $msg   = "Proses hapus berhasil";

      $this->data_pengaduan->hapus(['id_pengaduan' => $id_pengaduan], $dataSave);

    } else {
      $status = FALSE;
      $msg    = "ID Pengaduan tidak ada, mohon ulangi kembali!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function kembalikan()
  {
    $status = FALSE;
    $msg    = "Proses hapus tidak bisa!";

    $id_pengaduan = $this->input->post_get('id_pengaduan');
    
    if (!empty($id_pengaduan)) {
      $dataSave = [
        'is_deleted'  => '0',
      ];

      $status = TRUE;
      $msg   = "Proses hapus berhasil";

      $this->data_pengaduan->re_hapus(['id_pengaduan' => $id_pengaduan], $dataSave);

    } else {
      $status = FALSE;
      $msg    = "ID Pengaduan tidak ada, mohon ulangi kembali!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function add_kategori()
  {
    $status = FALSE;
    $msg    = "Proses tambah kategori tidak bisa!";

    $kategori_baru = $this->input->post_get('kategori_baru');

    if (!empty($kategori_baru)) {
      $urutan = $this->data_pengaduan->count_filtered_kategori();
      $level = $urutan + 1;

      $dataSave = [
        'nama_kategori'  => ucwords($kategori_baru),
        'level'  => $level,
      ];

      $status = TRUE;
      $msg   = "Proses tambah kategori berhasil";

      $this->data_pengaduan->add_kategori($dataSave);

    } else {
      $status = FALSE;
      $msg    = "Mohon masukkan nama kategori!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function edit_kategori()
  {
    $status = FALSE;
    $msg    = "Proses hapus kategori tidak bisa!";

    $id_kategori_pengaduan = $this->input->post('id_kategori_pengaduan');
    $kategori_baru = $this->input->post('kategori_baru');
    
    if (empty($id_kategori_pengaduan)) {
      $status = FALSE;
      $msg    = "ID Kategori tidak ada, mohon ulangi kembali!";
    } else if(empty($kategori_baru)) {
      $status = FALSE;
      $msg    = "Mohon masukkan nama kategori!";
    } else {
      $dataSave = [
        'nama_kategori'  => ucwords($kategori_baru),
      ];

      $status = TRUE;
      $msg   = "Proses hapus kategori berhasil";

      $this->data_pengaduan->update_kategori(['id_kategori_pengaduan' => $id_kategori_pengaduan], $dataSave);

    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }

  public function hapus_kategori()
  {
    $status = FALSE;
    $msg    = "Proses hapus kategori tidak bisa!";

    $id_kategori_pengaduan = $this->input->post_get('id_kategori_pengaduan');
    
    if (!empty($id_kategori_pengaduan)) {
      $dataSave = [
        'is_deleted'  => '1',
        'level'  => '0',
      ];

      $status = TRUE;
      $msg   = "Proses hapus kategori berhasil";

      $this->data_pengaduan->update_kategori(['id_kategori_pengaduan' => $id_kategori_pengaduan], $dataSave);

    } else {
      $status = FALSE;
      $msg    = "ID Kategori tidak ada, mohon ulangi kembali!";
    }
    
    echo json_encode(array("status" => $status, 'message' => $msg));

  }
}