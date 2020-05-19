<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {
  
// __construct-------------------------------------------------
  public function __construct() {
    parent::__construct();
    $this->load->model('Data_pengajuan_model', 'data_pengajuan');
    $this->load->model('Data_dusun_model', 'data_dusun');
    $this->load->library('form_validation', 'session');
    $this->load->helper('url');
    $this->load->helper('tgl_indo');
  }
// -------------------------------------------------------------
// -------------------------------------------------------------
// INDEX VALIDASI
  public function surat($url) {
    $data['title'] = "Pengajuan | Desa Kedung Pengawas";
    
    $url = $this->uri->segment(3);
    $kategori = $this->data_pengajuan->get_by_kategori($url);
    $list = $this->data_pengajuan->ket_kategori($url);
    foreach ($list as $ls){
      $data['ket'] = $ls->keterangan;
      $data['nama_kategori'] =  $ls->nama_kategori;
      $data['extra'] = $ls->extra;
    }

    if ($this->session->userdata('logged_in') && $kategori) {
      if ($url == 'domisili'){
        $this->template->user_page('user_page/pengajuan/input_domisili_view', $data);
      } else {
        $this->template->user_page('user_page/pengajuan/input_view', $data);
      }
    } else {
      redirect('/', 'refresh');
    }
  }
// .END INDEX VALIDASI
// -------------------------------------------------------------

  public function index()
  {
    $data['title'] = "Pengajuan | Desa Kedung Pengawas";
    
    if ($this->session->userdata('logged_in')) {
      $this->template->user_page('user_page/pengajuan/data_pengajuan_view', $data);
    } else {
      redirect('/', 'refresh');
    }
  }

  public function listData()
  {
    $idUser = $this->session->userdata('id_akun_user');
    $list = $this->data_pengajuan->getListData_user($idUser);
    $data = array();
    $no = $_POST['start'];
    
    foreach ($list as $ls) {
      $no++;
      $tanggal = date("Y-m-d", strtotime($ls->created_at));
      $waktu = date("H:i", strtotime($ls->created_at));
      $row = array();
      
      $row[]   = '<b>' . $ls->no_surat . '</b>';
      $row[]   = ucwords($ls->nama_lengkap);
      $row[]   = strtoupper($ls->nama_kategori);
      $row[]   = '' . longdate_indo($tanggal) . '<br>' . $waktu . ' WIB';
      //add html for action
      $row[] = '<div class="text-center">
      <a class="btn btn-social-icon btn-primary" title="Lihat" onclick="printHasil(' . "'" . $ls->no_surat . "'" . ',' . "'" . $ls->id_kategori . "'" . ')"><i class="fa fa-info-circle"></i></a>
        
      <a class="btn btn-social-icon btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus(' . "'" . $ls->id_pengajuan . "'" . ',' . "'" . $ls->no_surat . "'" . ')"><i class="fa fa-trash"></i></a>
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

// ADD SURAT PENGANTAR (KTP & SKCK)
  public function add_suratPengantar() {
    $status   = FALSE;
    $msg     = "Proses buat pengajuan gagal (EXP)";
    $dataForm = [];
    $dataInsert = [];

    $idUser = $this->session->userdata('id_akun_user');

    $tujuan      = $this->input->post('tujuan');
    $jenis_tujuan = $this->input->post('jenis_tujuan');
    $no_kk      = $this->input->post('no_kk');
    $no_nik     = $this->input->post('no_nik');
    $nama_lengkap  = $this->input->post('nama_lengkap');
    $jenis_kelamin  = $this->input->post('jenis_kelamin');
    $tmp_lahir  = $this->input->post('tmp_lahir');
    $tgl_lahir  = $this->input->post('tgl_lahir');
    $kewarganegaraan  = $this->input->post('kewarganegaraan');
    $agama    = $this->input->post('agama');
    $status_perkawinan  = $this->input->post('status_perkawinan');
    $pekerjaan  = $this->input->post('pekerjaan');

    // alamat sekarang
    $dusun = $this->input->post('select_dusun');
    $rw = $this->input->post('select_rw');
    $rt = $this->input->post('select_rt');
    $alamat_sekarang = $this->input->post('alamat_rumah');

    $list = $this->data_pengajuan->ket_kategori($tujuan);
    foreach ($list as $ls){
      $idKategori = $ls->id_kategori_pengajuan;
      $kdJenis    = $ls->nama_kategori;
    }
    $queryNoUrut = $this->data_pengajuan->cekNomerUrut($idKategori);

    $subNoUrut      = substr($queryNoUrut, 0,3);
    $hitungrUrut    = $subNoUrut + 1;
    
    $noUrut         = str_pad($hitungrUrut, 3, "0", STR_PAD_LEFT);
    $namaSingkatan  = substr($nama_lengkap,0,3);
    $kodeJenis      = substr($kdJenis,0,4);
    $bulanRomawi    = bulan_romawi(date('m'));

    $genNoSurat     = $noUrut.'/'.date('dm').'-'.strtoupper($namaSingkatan).'-'. $noUrut.'/'.strtoupper($kodeJenis).'/'.'KP'.'/'.$bulanRomawi.'/'.date('Y');

    // echo $genNoSurat;
    if (empty($tujuan)) {
      $status = FALSE;
      $msg   = "Buat pengajuan tidak bisa di akses, coba ulangi beberapa saat lagi!";
    } else if (empty($no_kk)) {
      $status = FALSE;
      $msg   = "Nomor KK harus di isi!";
    } else if (strlen($no_kk) < 16) {
      $status = FALSE;
      $msg   = "Nomor KK harus 16 Digit!";
    } else if (empty($no_nik)) {
      $status = FALSE;
      $msg   = "Nomor NIK harus di isi!";
    } else if (strlen($no_nik) < 16 ) {
      $status = FALSE;
      $msg   = "Nomor NIK harus 16 Digit!";
    } else if (empty($nama_lengkap)) {
      $status = FALSE;
      $msg   = "Nama Lengkap harus di isi!";
    } else if (empty($jenis_kelamin)) {
      $status = FALSE;
      $msg   = "Jenis Kelamin harus di pilih!";
    } else if (empty($tmp_lahir)) {
      $status = FALSE;
      $msg   = "Tempat Lahir harus di isi!";
    } else if (empty($tgl_lahir)) {
      $status = FALSE;
      $msg   = "Tanggal Lahir harus di isi!";
    } else if (empty($kewarganegaraan)) {
      $status = FALSE;
      $msg   = "Kewarganegaraan harus di isi!";
    } else if (empty($agama)) {
      $status = FALSE;
      $msg   = "Agama harus di disi!";
    } else if (empty($status_perkawinan)) {
      $status = FALSE;
      $msg   = "Status Perkawinan harus di isi!";
    } else if (empty($pekerjaan)) {
      $status = FALSE;
      $msg   = "Pekerjaan harus di isi!";
    } else if (empty($dusun) && empty($rw) && empty($rt) && empty($alamat_sebelum) ) {
      $status = FALSE;
      $msg   = "Alamat rumah harus di isi dengan lengkap!";
    } else {

      $dataForm = [
          "tujuan"             => $tujuan,
          "jenis_tujuan"       => $jenis_tujuan,
          "no_kk"              => $no_kk,
          "no_nik"             => $no_nik,
          "nama_lengkap"       => strtoupper($nama_lengkap),
          "jenis_kelamin"      => ucwords($jenis_kelamin),
          "tmp_lahir"          => ucwords($tmp_lahir),
          "tgl_lahir"          => $tgl_lahir,
          "kewarganegaraan"    => ucwords($kewarganegaraan),
          "agama"              => ucwords($agama),
          "setatus_perkawinan" => ucwords($status_perkawinan),
          "pekerjaan"          => ucwords($pekerjaan),
          "alamat_rumah" => [
              "dusun" => $dusun,
              "RW" => $rw,
              "RT" => $rt,
              "kode_pos" => '17610',
              "deskripsi" => $alamat_sekarang,
            ],
      ];

      $jsonForm = json_encode($dataForm);

      $dataInsert = [
        "id_kategori_pengajuan" => $idKategori,
        "no_urut"               => $noUrut,
        "no_surat"              => $genNoSurat,
        'id_akun_user'          => $idUser,
        'form_pengajuan'        => $jsonForm
      ];

      if (!empty($dataInsert)) {
        $this->data_pengajuan->save($dataInsert);
        $status = TRUE;
        $msg   = 'Terima kasih '.ucwords($nama_lengkap).',<br>Anda telah berhasil membuat surat pengajuan.';
			} else {
        $status = FALSE;
        $msg   = "Buat pengajuan tidak bisa di akses, coba ulangi beberapa saat lagi!";
			}
    }

    echo json_encode(array('dataForm' => $dataInsert, 'status' => $status, 'message' => $msg));
  }
// .END ADD SURAT PENGANTAR (KTP & SKCK)

// SHOW HASIL SURAT PENGANTAR (KTP & SKCK)
  public function surat_pengantar() {
    $noSurat = $this->input->post_get('no_surat');
    $data['title'] =  " Surat Pengajuan | Desa Kedung Pengawas";
    $data['no_surat'] = $noSurat;
    $getPrint = $this->data_pengajuan->get_print($noSurat);
    foreach($getPrint as $p) {
      $tanggal = date("Y-m-d", strtotime($p->created_at));
      $data['tgl_surat'] = date_indo($tanggal);
    }
    $this->template->_print('user_page/pengajuan/views/print_domisili', $data);
  }
// .END SHOW HASIL SURAT PENGANTAR (KTP & SKCK)



// ADD SURAT KETERANGAN (DOMISILI)
  public function add_suratKeterangan() {
    $status   = FALSE;
    $msg     = "Proses buat pengajuan gagal (EXP)";
    $dataForm = [];
    $dataInsert = [];

    $idUser = $this->session->userdata('id_akun_user');

    $tujuan      = $this->input->post('tujuan');
    $no_kk      = $this->input->post('no_kk');
    $no_nik     = $this->input->post('no_nik');
    $nama_lengkap  = $this->input->post('nama_lengkap');
    $jenis_kelamin  = $this->input->post('jenis_kelamin');
    $tmp_lahir  = $this->input->post('tmp_lahir');
    $tgl_lahir  = $this->input->post('tgl_lahir');
    $kewarganegaraan  = $this->input->post('kewarganegaraan');
    $agama    = $this->input->post('agama');
    $status_perkawinan  = $this->input->post('status_perkawinan');
    $pekerjaan  = $this->input->post('pekerjaan');

    // alamat sebelum
    $provinsi = $this->input->post('select_provinsi');
    $kabupaten = $this->input->post('select_kabkota');
    $kecamatan = $this->input->post('select_kecamatan');
    $desa = $this->input->post('select_desa');
    $kode_pos = $this->input->post('kode_pos');
    $alamat_sebelum = $this->input->post('alamat_sebelum');

    // alamat sekarang
    $dusun = $this->input->post('select_dusun');
    $rw = $this->input->post('select_rw');
    $rt = $this->input->post('select_rt');
    $alamat_sekarang = $this->input->post('alamat_sekarang');

    $list = $this->data_pengajuan->ket_kategori($tujuan);
    foreach ($list as $ls){
      $idKategori = $ls->id_kategori_pengajuan;
      $kdJenis    = $ls->nama_kategori;
    }
    $queryNoUrut = $this->data_pengajuan->cekNomerUrut($idKategori);

    $subNoUrut      = substr($queryNoUrut, 0,3);
    $hitungrUrut    = $subNoUrut + 1;
    
    $noUrut         = str_pad($hitungrUrut, 3, "0", STR_PAD_LEFT);
    $namaSingkatan  = substr($nama_lengkap,0,3);
    $kodeJenis      = substr($kdJenis,0,3);
    $bulanRomawi    = bulan_romawi(date('m'));

    $genNoSurat     = $noUrut.'/'. strtoupper($kodeJenis).'-'.date('dm').'-'.strtoupper($namaSingkatan).'-'. $noUrut.'/'.'PEM'.'/'.'KP'.'/'.$bulanRomawi.'/'.date('Y');

    // echo $genNoSurat;
    if (empty($tujuan)) {
      $status = FALSE;
      $msg   = "Buat pengajuan tidak bisa di akses, coba ulangi beberapa saat lagi!";
    } else if (empty($no_kk)) {
      $status = FALSE;
      $msg   = "Nomor KK harus di isi!";
    } else if (strlen($no_kk) < 16) {
      $status = FALSE;
      $msg   = "Nomor KK harus 16 Digit!";
    } else if (strlen($no_kk) > 16) {
      $status = FALSE;
      $msg   = "Nomor KK harus 16 Digit!";
    } else if (empty($no_nik)) {
      $status = FALSE;
      $msg   = "Nomor NIK harus di isi!";
    } else if (strlen($no_nik) < 16 ) {
      $status = FALSE;
      $msg   = "Nomor NIK harus 16 Digit!";
    } else if (strlen($no_nik) > 16) {
      $status = FALSE;
      $msg   = "Nomor KK harus 16 Digit!";
    } else if (empty($nama_lengkap)) {
      $status = FALSE;
      $msg   = "Nama Lengkap harus di isi!";
    } else if (empty($jenis_kelamin)) {
      $status = FALSE;
      $msg   = "Jenis Kelamin harus di pilih!";
    } else if (empty($tmp_lahir)) {
      $status = FALSE;
      $msg   = "Tempat Lahir harus di isi!";
    } else if (empty($tgl_lahir)) {
      $status = FALSE;
      $msg   = "Tanggal Lahir harus di isi!";
    } else if (empty($kewarganegaraan)) {
      $status = FALSE;
      $msg   = "Kewarganegaraan harus di isi!";
    } else if (empty($agama)) {
      $status = FALSE;
      $msg   = "Agama harus di disi!";
    } else if (empty($status_perkawinan)) {
      $status = FALSE;
      $msg   = "Status Perkawinan harus di isi!";
    } else if (empty($pekerjaan)) {
      $status = FALSE;
      $msg   = "Pekerjaan harus di isi!";
    } else if (empty($dusun) && empty($rw) && empty($rt) && empty($alamat_sebelum) ) {
      $status = FALSE;
      $msg   = "Alamat Sebelum harus di isi dengan lengkap!";
    } else if (empty($provinsi) && empty($kabupaten) && empty($kecamatan) && empty($desa) && empty($kode_pos) && empty($alamat_sekarang)) {
      $status = FALSE;
      $msg   = "Alamat Sekarang harus di isi dengan lengkap!";
    } else {

      $dataForm = [
          "tujuan"             => $tujuan,
          "no_kk"              => $no_kk,
          "no_nik"             => $no_nik,
          "nama_lengkap"       => strtoupper($nama_lengkap),
          "jenis_kelamin"      => ucwords($jenis_kelamin),
          "tmp_lahir"          => ucwords($tmp_lahir),
          "tgl_lahir"          => $tgl_lahir,
          "kewarganegaraan"    => ucwords($kewarganegaraan),
          "agama"              => ucwords($agama),
          "setatus_perkawinan" => ucwords($status_perkawinan),
          "pekerjaan"          => ucwords($pekerjaan),
          "alamat_sebelum" => [
              "provinsi" => $provinsi,
              "kabupaten" => $kabupaten,
              "kecamatan" => $kecamatan,
              "desa" => $desa,
              "kode_pos" => $kode_pos,
              "deskripsi" => $alamat_sebelum,
            ],
          "alamat_sekarang" => [
              "dusun" => $dusun,
              "RW" => $rw,
              "RT" => $rt,
              "deskripsi" => $alamat_sekarang,
            ],
      ];

      $jsonForm = json_encode($dataForm);

      $dataInsert = [
        "id_kategori_pengajuan" => $idKategori,
        "no_urut"               => $noUrut,
        "no_surat"              => $genNoSurat,
        'id_akun_user'          => $idUser,
        'form_pengajuan'        => $jsonForm
      ];

      if (!empty($dataForm)) {
        $this->data_pengajuan->save($dataInsert);
        $status = TRUE;
        $msg   = 'Terima kasih '.ucwords($nama_lengkap).',<br>Anda telah berhasil membuat surat pengajuan.';
			} else {
        $status = FALSE;
        $msg   = "Buat pengajuan tidak bisa di akses, coba ulangi beberapa saat lagi!";
			}
    }

    echo json_encode(array('dataForm' => $dataInsert, 'status' => $status, 'message' => $msg));
  }
// .END ADD SURAT KETERANGAN (DOMISILI)

// SHOW HASIL SURAT KETERANGAN (DOMISILI)
  public function surat_keterangan() {
    $noSurat = $this->input->post_get('no_surat');
    $data['title'] =  " Surat Pengajuan | Desa Kedung Pengawas";
    $data['no_surat'] = $noSurat;
    $getPrint = $this->data_pengajuan->get_print($noSurat);
    foreach($getPrint as $p) {
      $tanggal = date("Y-m-d", strtotime($p->created_at));
      $data['tgl_surat'] = date_indo($tanggal);
    }
    $this->template->_print('user_page/pengajuan/views/print_domisili', $data);
  }
// .END SHOW HASIL SURAT KETERANGAN (DOMISILI)

// LOAD FORM PRINT SURAT KETERANGAN (DOMISILI)
  public function print_suratKeterangan() {
    $status = FALSE;
    $msg    = 'Proses buka hasil...';

    $noSurat = $this->input->post('no_surat');

    $getPrint = $this->data_pengajuan->get_print($noSurat);
    foreach($getPrint as $p) {
      $formPengajuan = $p->form_pengajuan;
    }

    if (empty($noSurat)) {
      $status = FALSE;
      $msg    = 'Nomor surat tidak ada!';
    } else if(empty($formPengajuan)) {
      $status = FALSE;
      $msg    = 'Data surat error!';
    } else {
      if($this->session->userdata('logged_in') == false) {
        $status = FALSE;
        $msg    = 'Anda belum masuk akun!';
      } else {
        $status = TRUE;
         $msg    = 'Proses lihat surat berhasil buka';
      }

      if ($this->session->userdata('staff_desa_in')){
        $status = TRUE;
        $msg    = 'Proses lihat surat berhasil buka';
      }
      
    }

    echo json_encode(array('dataForm' => $formPengajuan, 'status' => $status, 'message' => $msg));

    // $enc =  json_encode($formPengajuan);
    // $rjson = str_replace(array("\t","\n"), "", $enc);
    // $xjson = json_decode($rjson); 
  }
// .END LOAD FORM PRINT  SURAT KETERANGAN (DOMISILI)

// SHOW PDF SURAT KETERANGAN (DOMISILI)
  public function pdf() {
    $noSurat = $this->input->post_get('no_surat');
    $data['title'] =  " Surat Pengajuan | Desa Kedung Pengawas";
    $data['no_surat'] = $noSurat;
    $getPrint = $this->data_pengajuan->get_print($noSurat);
    foreach($getPrint as $p) {
      $tanggal = date("Y-m-d", strtotime($p->created_at));
     
    }
    if($tanggal){
      $data['tgl_surat'] = date_indo($tanggal);
    } else {
      $data['tgl_surat'] = "";
    }

     $this->load->view('user_page/pengajuan/views/domisili_pdf', $data);
  }
// .END SHOW PDF SURAT KETERANGAN (DOMISILI)

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
  public function getArea_id($id) {
    $data = $this->data_dusun->getArea_id($id);
    echo json_encode($data);
  }
  public function getRw_id($id) {
    $data = $this->data_dusun->getRW_id($id);
    echo json_encode($data);
  }
  public function getRt_id($id) {
    $data = $this->data_dusun->getRT_id($id);
    echo json_encode($data);
  }
// .END SELECT DESA - RT - RW

}