<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_profil_model extends CI_Model {

  var $akun   = 'data_akun_user as a';
  var $warga   = 'data_warga as w';
  var $keluarga   = 'data_kk_warga as k';

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function get_by_id_and_password($id_akun_user, $password) {
    $this->db->from($this->akun);
    $this->db->where('a.id_akun_user', $id_akun_user);
    $this->db->where('a.password', $password);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_akun_user($id_akun)
  {
    $this->db->from($this->akun);
    $this->db->where('a.id_akun_user', $id_akun);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_by_username($username, $id_akun)
  {
    $this->db->from($this->akun);
    $this->db->where('a.username', $username);
    $this->db->where('a.id_akun_user !=', $id_akun);
    $this->db->where('a.is_deleted', '0');
    return $this->db->count_all_results();
  }

  public function update_data_akun($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_akun_user', $data, $where);
    return $this->db->affected_rows();
  }

  public function get_akun_warga($id_warga)
  {
    $this->db->from($this->warga);
    $this->db->where('w.id_warga', $id_warga);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_akun_kk_warga($id_kk_warga)
  {
    $this->db->from($this->keluarga);
    $this->db->where('k.id_kk_warga', $id_kk_warga);
    $query = $this->db->get();
    return $query->result();
  }

  public function update_data_warga($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_warga', $data, $where);
    return $this->db->affected_rows();
  }

  public function get_no_nik($no_nik, $id_warga)
  {
    $this->db->from($this->warga);
    $this->db->where('w.nik', $no_nik);
    $this->db->where('w.id_warga !=', $id_warga);
    $this->db->where('w.is_deleted', '0');
    return $this->db->count_all_results();
  }
  
  public function get_id_kk($id_kk_warga)
  {
    $this->db->from($this->keluarga);
    $this->db->where('k.id_kk_warga', $id_kk_warga);
    return $this->db->count_all_results();
  }
  
  public function get_no_kk($no_kk, $id_kk_warga)
  {
    $this->db->from($this->keluarga);
    $this->db->where('k.no_kk', $no_kk);
    $this->db->where('k.id_kk_warga !=', $id_kk_warga);
    $this->db->where('k.is_deleted', '0');
    return $this->db->count_all_results();
  }
  
  public function update_data_kk_warga($where, $data)
  {
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->update('data_kk_warga', $data, $where);
    return $this->db->affected_rows();
  }

  public function create_data_kk_warga($data)
  {
    $this->db->set('id_kk_warga', 'UUID()', FALSE);
    $this->db->set('created_at', 'NOW()', FALSE);
    $this->db->set('updated_at', 'NOW()', FALSE);
    $this->db->set('is_deleted', '0');
    
    $this->db->insert('data_kk_warga', $data);
    return $this->db->insert_id();
  }
  
}