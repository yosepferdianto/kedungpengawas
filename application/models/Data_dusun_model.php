<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dusun_model extends CI_Model
{

  var $dusun    = 'master_dusun as a';
  var $area     = 'master_area as b';
  var $rw       = 'master_rw as rw';
  var $rt       = 'master_rt as rt';
  

  // var $column_order = array('a.created_at', 'a.nama_pengadu', 'k.nama_kategori', 'a.deskripsi', 'a.status',  null);

  // var $column_order_pantau = array(null, 'a.created_at', 'a.deskripsi', 'a.status');

  // var $column_search = array('a.created_at', 'a.nama_pengadu', 'k.nama_kategori', 'a.deskripsi', 'a.status');
  // var $order = array('a.created_at' => 'DESC'); // default order
  
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // private function _get_datatables_query()
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
  //   a.updated_at as updated_at,
  //   ');
  //   $this->db->from($this->table);
  //   $this->db->join($this->kategori, 
  //   'k.id_kategori_pengaduan = a.id_kategori_pengaduan');

  //   $i = 0;

  //   foreach ($this->column_search as $item) // loop column 
  //   {
  //     if ($_POST['search']['value']) // if datatable send POST for search
  //     {

  //       if ($i === 0) // first loop
  //       {
  //         $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
  //         $this->db->like($item, $_POST['search']['value']);
  //       } else {
  //         $this->db->or_like($item, $_POST['search']['value']);
  //       }

  //       if (count($this->column_search) - 1 == $i) //last loop
  //         $this->db->group_end(); //close bracket
  //     }
  //     $i++;
  //   }

  //   if (isset($_POST['order'])) // here order processing
  //   {
  //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  //     $this->db->order_by($this->column_order_pantau[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  //   } else if (isset($this->order)) {
  //     $order = $this->order;
  //     $this->db->order_by(key($order), $order[key($order)]);
  //   }
  // }

  // function count_filtered()
  // {
  //   $this->_get_datatables_query();
  //   $query = $this->db->get();
  //   return $query->num_rows();
  // }

  // public function count_all()
  // {
  //   $this->_get_datatables_query();
  //   return $this->db->count_all_results();
  // }

  // public function getListData()
  // {
  //   $this->_get_datatables_query();
  //   if ($_POST['length'] != -1)
  //     $this->db->limit($_POST['length'], $_POST['start']);
  //   $this->db->where('a.is_deleted', '0');
  //   $query = $this->db->get();
  //   return $query->result();
  // }

  public function getAllArea()
  {
    $this->db->from($this->area);
    $query = $this->db->get();
    return $query->result();
  }
  public function getRW($dusunID)
  {
    $this->db->from($this->rw);
    $this->db->where('rw.id_area', $dusunID);
    $query = $this->db->get();
    return $query->result();
  }
  public function getRT($dusunID)
  {
    $this->db->from($this->rt);
    $this->db->where('rt.id_area', $dusunID);
    $query = $this->db->get();
    return $query->result();
  }

  // -------------------------------------------------
  public function getArea_id($id)
  {
    $this->db->from($this->area);
    $this->db->where('b.id_area', $id);
    $query = $this->db->get();
    return $query->result();
  }
  public function getRW_id($id)
  {
    $this->db->from($this->rw);
    $this->db->where('id_rw', $id);
    $query = $this->db->get();
    return $query->result();
  }
  public function getRT_id($id)
  {
    $this->db->from($this->rt);
    $this->db->where('rt.id_rt', $id);
    $query = $this->db->get();
    return $query->result();
  }

}