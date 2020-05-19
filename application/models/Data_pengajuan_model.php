<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pengajuan_model extends CI_Model
{

  var $table   = 'data_pengajuan as a';
  var $kategori   = 'kategori_pengajuan as k';

  var $user   = 'data_akun_user as u';
  var $warga   = 'data_warga as w';

  var $column_order = array('a.no_surat', 'w.nama_lengkap', 'k.nama_kategori', 'a.created_at',  null);
  var $column_search = array('a.no_surat', 'w.nama_lengkap', 'k.nama_kategori', 'a.created_at');
  var $order = array('a.created_at' => 'DESC'); // default order
  
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    $this->db->select('
    a.id_pengajuan as id_pengajuan,
    a.no_surat as no_surat,
    w.nama_lengkap as nama_lengkap,
    k.nama_kategori as nama_kategori,
    k.id_kategori_pengajuan as id_kategori,
    a.status as status,
    a.created_at as created_at,
    ');
    $this->db->from($this->table);
    $this->db->join($this->kategori, 
    'k.id_kategori_pengajuan = a.id_kategori_pengajuan', 'INNER');
    $this->db->join($this->user, 
    'u.id_akun_user = a.id_akun_user', 'INNER');
    $this->db->join($this->warga, 
    'w.id_warga = u.id_warga', 'INNER');
    $this->db->where('a.is_deleted', '0');

    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->_get_datatables_query();
    return $this->db->count_all_results();
  }

  public function getListData()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  public function getListData_user($idUser)
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);

    $this->db->where('a.id_akun_user', $idUser);
    // $this->db->limit(5);
    $query = $this->db->get();
    return $query->result();
    // var_dump($query);
    // die;
  }

  public function get_by_kategori($url)
  {
    $this->db->from($this->kategori);
    $this->db->where('k.nama_kategori', $url);
    $this->db->where('k.is_deleted', '0');
    $query = $this->db->get();
    return $query->result();
  }

  public function ket_kategori($url)
  {
    $this->db->from($this->kategori);
    $this->db->where('k.nama_kategori', $url);
    $query = $this->db->get();
    return $query->result();
  }

  public function cekNomerUrut($idKategori)
  {
    $this->db->select('a.no_urut');
    $this->db->from($this->table);
    $this->db->join($this->kategori, 
    'k.id_kategori_pengajuan = a.id_kategori_pengajuan');
    $this->db->where('k.id_kategori_pengajuan', $idKategori);
    $this->db->order_by("a.no_urut", "DESC");
    $this->db->limit(1);
    $query = $this->db->get();
    $X = $query->num_rows();
    if($X == null){
      return '000';
    } else {
      return $query->row()->no_urut;
    }
    // die();
  }

  public function save($data)
  {
    $this->db->set('id_pengajuan', 'UUID()', FALSE);
    $this->db->set('status', null);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->set('is_deleted', '0');
    
    $this->db->insert('data_pengajuan', $data);
    return $this->db->insert_id();
  }

  public function get_print($noSurat)
  {
    $this->db->from($this->table);
    $this->db->where('a.no_surat', $noSurat);
    $query = $this->db->get();
    return $query->result();
  }

  public function hapus($where, $data)
  {
    $this->db->update('data_pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

}