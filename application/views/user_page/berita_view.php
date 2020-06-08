<div class="content-wrapper">
	<section class="content-header text-center">
		<h1 class="text-bold">
			Berita Seputar Desa
    </h1>
    <hr class="style1">
	</section>

	<section class="content">
		<div class="row">
      <div class="col-md-12">
      <?php
        $this->load->helper('text');
				$table = 'data_berita as a';
				$this->db->from($table);
        $this->db->where('a.is_deleted', '0');
        $list = $this->db->get()->result_array();
      ?>
      <?php foreach ($list as $ls) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="box box-solid">
            <div class="box-header">
            <div class="card-image">
                <img src="<?= $ls['foto']; ?>" alt="" >
              </div>
            </div>

            <div class="box-body">
              <div class="caption">
                <?php  $tanggal = date("Y-m-d", strtotime($ls['created_at']));?>
                <p><?= longdate_indo($tanggal) ?></p>
                <h3 class="box-title text-bold" style="line-height: 10px;"><?= ucwords($ls['judul_berita']); ?></h3>
                <h4 class="text-bold" style="line-height: 20px;"><?= character_limiter($ls['sub_judul'], 20); ?></h4>
                <h6><?= strip_tags(character_limiter($ls['isi_berita'], 60)) ?></h6>
              </div>
            </div>

            <div class="box-footer">
              <a href="<?= base_url('berita/detail/'.$ls['id_berita']); ?>" class="btn btn-success btn-block" role="button">Baca selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
	</section>
</div>
