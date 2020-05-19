<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_akun_admin_model extends CI_Model {

  var $table   = 'data_akun_admin as a';

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
    $this->db->where('a.id_akun_admin', $where);
    $this->db->set('last_login', 'NOW()', FALSE);
    $this->db->update();
    $this->db->affected_rows();
  }

}