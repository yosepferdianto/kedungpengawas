<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Template {

  protected $_CI;

  function __construct() {
    $this->_CI = &get_instance();
  }

  function landing_page($template, $data = null) {
    $data['_content'] = $this->_CI->load->view($template, $data, true);
    $data['_header'] = $this->_CI->load->view('landing_page/header', $data, true);
    $data['_footer'] = $this->_CI->load->view('landing_page/footer', $data, true);
    $data['_head'] = $this->_CI->load->view('landing_page/head', $data, true);
    $data['_body'] = $this->_CI->load->view('landing_page/body', $data, true);
    $this->_CI->load->view('landing_page/index', $data);
  }
// ------------------------------------------------------------------------------------------------
  function auth($template, $data = null) {
    $data['_content'] = $this->_CI->load->view($template, $data, true);
    $data['_head'] = $this->_CI->load->view('landing_page/head', $data, true);
    $data['_body'] = $this->_CI->load->view('landing_page/body', $data, true);
    $this->_CI->load->view('landing_page/index_auth', $data);
  }
// ------------------------------------------------------------------------------------------------
  function user_page($template, $data = null) {
    $data['_content'] = $this->_CI->load->view($template, $data, true);
    $data['_header'] = $this->_CI->load->view('user_page/header', $data, true);
    $data['_navigasi'] = $this->_CI->load->view('user_page/navigasi', $data, true);
    $data['_footer'] = $this->_CI->load->view('user_page/footer', $data, true);
    $data['_head'] = $this->_CI->load->view('user_page/head', $data, true);
    $data['_body'] = $this->_CI->load->view('user_page/body', $data, true);
    $this->_CI->load->view('user_page/index', $data);
  }
// ------------------------------------------------------------------------------------------------
  function admin_page($template, $data = null) {
    $data['_content'] = $this->_CI->load->view($template, $data, true);
    $data['_header'] = $this->_CI->load->view('admin_page/header', $data, true);
    $data['_navigasi'] = $this->_CI->load->view('admin_page/navigasi', $data, true);
    $data['_footer'] = $this->_CI->load->view('admin_page/footer', $data, true);
    $data['_head'] = $this->_CI->load->view('admin_page/head', $data, true);
    $data['_body'] = $this->_CI->load->view('admin_page/body', $data, true);
    $this->_CI->load->view('admin_page/index', $data);
  }
// ------------------------------------------------------------------------------------------------
  function _print($template, $data = null) {
    $data['_content'] = $this->_CI->load->view($template, $data, true);
    $data['_header'] = $this->_CI->load->view('/user_page/pengajuan/template/header', $data, true);
    $data['_head'] = $this->_CI->load->view('/user_page/pengajuan/template/head', $data, true);
    $data['_body'] = $this->_CI->load->view('/user_page/pengajuan/template/body', $data, true);
    $this->_CI->load->view('/user_page/pengajuan/template/index', $data);
  }
}
