<?php

function url_akses()
{
  $CI = get_instance();
  if (!$CI->session->userdata('logged_in')) {
    redirect('/');
  } else {
    $url = $CI->uri->segment(3);
    // $kategori = $CI->db->get_where('kategori_pengajuan', ['nama_kategori' => $url])->row_array();
    $CI->db->from('kategori_pengajuan');
    $CI->db->where('nama_kategori', $url);
    $CI->db->where('is_deleted', '0');
    $kategori = $CI->db->count_all_results();
    echo $kategori;
    if ($kategori) {
      echo $url;
      echo "OKE";
    }else{
      echo $url;
      echo "NO";
      redirect('/');
    }
  }
}

?>