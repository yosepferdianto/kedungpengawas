<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pengaduan_model extends CI_Model
{

  var $table   = 'data_pengaduan as a';
  var $kategori   = 'kategori_pengaduan as k';

  var $column_order = array(null, 'a.created_at', 'a.nama_pengadu', 'k.nama_kategori', 'a.deskripsi', 'a.status',  null);

  var $column_order_pantau = array(null, 'a.created_at', 'a.deskripsi', 'a.status');

  var $column_order_kategori = array('k.level', 'k.nama_kategori', null);

  var $column_search = array('a.created_at', 'a.nama_pengadu', 'k.nama_kategori', 'a.deskripsi', 'a.status');

  var $column_search_kategori = array('k.nama_kategori');

  var $order = array('a.created_at' => 'DESC'); // default order

  var $order_kategori = array('k.level' => 'ASC');
  
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    $this->db->select('
    a.id_pengaduan as id_pengaduan,
    a.nama_pengadu as nama_pengadu,
    a.no_telp as no_telp,
    k.nama_kategori as nama_kategori,
    a.deskripsi as deskripsi,
    a.status as status,
    a.lampiran as lampiran,
    a.created_at as created_at,
    a.updated_at as updated_at,
    a.is_deleted as is_deleted,
    ');
    $this->db->from($this->table);
    $this->db->join($this->kategori, 
    'k.id_kategori_pengaduan = a.id_kategori_pengaduan');
    // $this->db->where('a.is_deleted', '0');
    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          $this->db->group_start();
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

  private function _get_datatables_kategori()
  {
    $this->db->select('*');
    $this->db->from($this->kategori);
    $this->db->where('k.is_deleted', '0');
    $i = 0;

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order_kategori[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order_kategori)) {
      $order = $this->order_kategori;
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

  function count_filtered_kategori()
  {
    $this->_get_datatables_kategori();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all_kategori()
  {
    $this->_get_datatables_kategori();
    return $this->db->count_all_results();
  }
  
  // -----------------------------------------------------------

  public function getListData()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $this->db->where('a.is_deleted', '0');
    $query = $this->db->get();
    return $query->result();
  }

  public function getListData_kategori()
  {
    $this->_get_datatables_kategori();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  public function getListData_hapus()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $this->db->where('a.is_deleted', '1');
    $query = $this->db->get();
    return $query->result();
  }

  public function getAllKategori()
  {
    $this->db->from($this->kategori);
    $this->db->order_by("level", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  public function pengaduanUser($idUser)
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $this->db->where('a.is_deleted', '0');
    $this->db->where('a.id_akun_user', $idUser);
    // $this->db->limit(5);
    $query = $this->db->get();
    return $query->result();
    // var_dump($query);
    // die;
  }

  function count_filtered_user($idUser)
  {
    $this->_get_datatables_query();
    $this->db->where('a.id_akun_user', $idUser);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all_user($idUser)
  {
    $this->_get_datatables_query();
    $this->db->where('a.id_akun_user', $idUser);
    return $this->db->count_all_results();
  }


  public function detail($id_pengaduan)
  {
    $this->db->select('
    a.id_pengaduan as id_pengaduan,
    a.nama_pengadu as nama_pengadu,
    a.no_telp as no_telp,
    k.nama_kategori as nama_kategori,
    a.deskripsi as deskripsi,
    a.status as status,
    a.lampiran as lampiran,
    a.created_at as created_at,
    ');
    $this->db->from($this->table);
    $this->db->join($this->kategori, 
    'k.id_kategori_pengaduan = a.id_kategori_pengaduan');
    $this->db->where('a.id_pengaduan', $id_pengaduan);
    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order_pantau[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function save($data)
  {
    $this->db->set('id_pengaduan', 'UUID()', FALSE);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);

    $idUser = $this->session->userdata('id_akun_user');
    if (!$idUser){
      $this->db->set('id_akun_user', null);
    } else {
      $this->db->set('id_akun_user', $idUser);
    }
    
    $this->db->insert('data_pengaduan', $data);
    return $this->db->insert_id();
  }

  public function verifikasi($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_pengaduan', $data, $where);
    return $this->db->affected_rows();
  }

  public function hapus($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_pengaduan', $data, $where);
    return $this->db->affected_rows();
  }

  public function re_hapus($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_pengaduan', $data, $where);
    return $this->db->affected_rows();
  }

  public function add_kategori($data)
  {
    $this->db->set('id_kategori_pengaduan', 'UUID()', FALSE);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->set('is_deleted', '0');
    
    $this->db->insert('kategori_pengaduan', $data);
    return $this->db->insert_id();
  }

  public function update_kategori($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('kategori_pengaduan', $data, $where);
    return $this->db->affected_rows();
  }

}