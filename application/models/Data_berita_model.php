<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_berita_model extends CI_Model
{

  var $table        = 'data_berita as a';
  var $akun_admin   = 'data_akun_admin as b';

  var $column_order = array('a.prioritas', 'a.judul_berita', 'a.isi_berita', null, 'a.created_at', null);

  var $column_search = array('a.prioritas', 'a.created_at', 'a.judul_berita', 'a.sub_judul', 'a.isi_berita', 'b.nama_lengkap', 'b.username');

  var $order = array('a.prioritas' => 'ASC'); // default order
  
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    $this->db->select('
      a.id_berita as id_berita,
      a.prioritas as prioritas,
      a.judul_berita as judul_berita,
      a.sub_judul as sub_judul,
      a.isi_berita as isi_berita,
      a.foto as foto,
      a.created_at as created_at,
      a.updated_at as updated_at,
      a.is_deleted as is_deleted,
      b.username as username,
      b.nama_lengkap as nama_lengkap
    ');
    $this->db->from($this->table);
    $this->db->join($this->akun_admin, 'b.id_akun_admin = a.id_akun_admin');
    $this->db->where('a.is_deleted', '0');

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

  public function getListData()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
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

  public function cek_prioritas()
  {
    $this->db->select('a.prioritas');
    $this->db->from($this->table);
    $this->db->order_by("a.prioritas", "DESC");
    $this->db->limit(1);
    $query = $this->db->get();
    $X = $query->num_rows();
    if($X == null){
      return '0';
    } else {
      return $query->row()->prioritas;
    }
  }

  public function save($data)
  {
    $this->db->set('id_berita', 'UUID()', FALSE);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    
    $this->db->insert('data_berita', $data);
    return $this->db->insert_id();
  }

  
  // ACTIONS MODEL


  // public function detail($id_pengaduan)
  // {
  //   $this->db->select('
  //   a.id_pengaduan as id_pengaduan,
  //   a.nama_pengadu as nama_pengadu,
  //   a.no_telp as no_telp,
  //   k.nama_kategori as nama_kategori,
  //   a.deskripsi as deskripsi,
  //   a.status as status,
  //   a.lampiran as lampiran,
  //   a.created_at as created_at,
  //   ');
  //   $this->db->from($this->table);
  //   $this->db->join($this->kategori, 
  //   'k.id_kategori_pengaduan = a.id_kategori_pengaduan');
  //   $this->db->where('a.id_pengaduan', $id_pengaduan);
  //   if (isset($_POST['order'])) // here order processing
  //   {
  //     $this->db->order_by($this->column_order_pantau[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  //   } else if (isset($this->order)) {
  //     $order = $this->order;
  //     $this->db->order_by(key($order), $order[key($order)]);
  //   }
  //   $query = $this->db->get();
  //   return $query->result();
  // }

  // public function save($data)
  // {
  //   $this->db->set('id_pengaduan', 'UUID()', FALSE);
  //   $this->db->set('created_at', 'NOW()', FALSE);
  //   $this->db->set('updated_at', 'NOW()', FALSE);

  //   $idUser = $this->session->userdata('id_akun_user');
  //   if (!$idUser){
  //     $this->db->set('id_akun_user', null);
  //   } else {
  //     $this->db->set('id_akun_user', $idUser);
  //   }
    
  //   $this->db->insert('data_pengaduan', $data);
  //   return $this->db->insert_id();
  // }

  // public function hapus($where, $data)
  // {
  //   $this->db->set('updated_at', 'NOW()', FALSE);
  //   $this->db->update('data_pengaduan', $data, $where);
  //   return $this->db->affected_rows();
  // }

}