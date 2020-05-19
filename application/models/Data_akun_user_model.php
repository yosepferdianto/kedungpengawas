<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_akun_user_model extends CI_Model {

  var $table   = 'data_akun_user as a';
  var $warga   = 'data_warga as w';

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_by_username_and_password($username, $password) {
    $this->db->from($this->table);
    $this->db->where('a.username', $username);
    $this->db->where('a.password', $password);
    $query = $this->db->get();
    return $query->result();
  }

  public function logout_proses($where) {
    $this->db->from($this->table);
    $this->db->where('a.id_akun_user', $where);
    $this->db->set('last_login', 'NOW()', FALSE);
    $this->db->update();
    $this->db->affected_rows();
  }

  public function get_by_username($username)
  {
    $this->db->from($this->table);
    $this->db->where('a.username', $username);
    $this->db->where('a.is_deleted', '0');
    return $this->db->count_all_results();
  }

  public function daftarbaru_akun($data)
  {
    $this->db->set('id_akun_user', 'UUID()', FALSE);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->insert('data_akun_user', $data);
    return $this->db->insert_id();
  }

  public function daftarbaru_warga($data)
  {
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->insert('data_warga', $data);
    return $this->db->insert_id();
  }

  public function get_akun_warga($idUser)
  {
    $this->db->from($this->table);
    $this->db->join($this->warga, 
    'w.id_warga = a.id_warga');
    $this->db->where('a.id_akun_user', $idUser);
    $query = $this->db->get();
    return $query->result();
  }


}