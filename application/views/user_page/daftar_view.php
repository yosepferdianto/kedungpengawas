<div class="login-box" style="background-color:#fff;">
  <div class="login-logo" style="padding-top:10px">
    <a href="" class="text-green"></i><b>REGISTRASI</b> AKUN
    </a>
    <p class="">Warga Desa Kedung Pengawas</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body login-from">
    <!-- <p class="login-box-msg"><?= $this->session->flashdata('message'); ?></p> -->
    <form action="" method="post" id="form">
      
      <div class="step-1" style="display:">
        <div class="form-group has-feedback" id="box_username">
          <label style="color:#777"><a class="text-red">*</a> Username</label><small class="text-red pull-right" id="p_username"></small>
          <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username..."
            autofocus oninput="this.value=this.value.replace(' ','');" onkeyup="validasiusername()" autofocus/>
        </div>

        <div class=" form-group has-feedback" id="box_pass">
          <label style="color:#777"><a class="text-red">*</a> Kata sandi baru</label><small class="text-red pull-right" id="p_pass"></small>
          <input type="password" class="form-control form-control-user" name="pass" id="pass"
            placeholder="Kata sandi baru..." onkeyup="valid_pass()" />
        </div>

        <div class="form-group has-feedback" id="box_u_pass">
          <label style="color:#777"><a class="text-red">*</a> Ulang kata sandi</label><small class="text-red pull-right" id="p_ulangi_pass"></small>
          <input type="password" class="form-control form-control-user" name="ulangi_pass" id="ulangi_pass"
            placeholder="Ulang kata sandi..." onkeyup="samakan_pass()" disabled />
        </div>
      </div>

      <div class="step-2" style="display:none">
        <h4 class="text-muted text-center text-capitalize">Lengkapi data diri Anda</h4><br>
        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Nama lengkap</label><small class="text-red" id="p_nama_lengkap"></small>
          <input type="text" class="form-control form-control-user" name="nama_lengkap" id="nama_lengkap"
            placeholder="Nama lengkap..." autofocus />
        </div>

        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Jenis kelamin</label><small class="text-red" id="p_r_jk"></small>
          <div class="row">
              <div class="col-xs-4 col-xs-offset-1">
                <input type="radio" name="r_jk" value="laki-laki" tabindex="-1"> Laki-laki
              </div>
              <div class="col-xs-5">
                <input type="radio" name="r_jk" value="perempuan" tabindex="-1"> Perempuan
              </div>
          </div>
        </div>

        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Tempat lahir</label><small class="text-red" id="p_tmp_lahir"></small>
          <input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir"
            placeholder="Tempat lahir..."/>
        </div>

        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Tanggal lahir</label><small class="text-red" id="p_tgl_lahir"></small>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" placeholder="dd-mm-yyyy">
          </div>
        </div>

        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Nomor telepon</label><small class="text-red" id="p_no_telp"></small>
          <input type="text" class="form-control form-control-user" name="no_telp" id="no_telp"
            placeholder="Nomor telepon..." onkeypress="return numerica(event)"/>
        </div>

        <div class="form-group has-feedback">
          <label style="color:#777"><a class="text-red">*</a> Email</label><small class="text-red" id="p_email"></small>
          <input type="text" class="form-control form-control-user" name="email" id="email"
            placeholder="Email..."/>
        </div>
      </div>

    </form>
    <span class=" help-block" id="pesan_bawah">
      <p class="text-red"><br></p>
    </span>
    <div class="row">
      <div class="col-md-6 setuju">
        <div class="checkbox icheck">
          <label class="">
            <div><input type="checkbox" name="c_setuju" id="c_setuju" tabindex="-1"> Saya menyetujui</div>
          </label>
        </div>
      </div>
      <div class="col-md-6 pull-right">
        <button type="button" class="btn btn-flat btn-block btn-success btn-daftar" id="btn_daftar" onclick="validasidaftar()" style="display:none"><b>Daftar</b></button>
        <button type="button" class="btn btn-flat btn-block btn-success btn-daftar" id="btn_lanjut" onclick="lanjutisi()" disabled><b>Lanjut</b></button>
      </div>
      <div class="col-md-6 btnkembali" style="display:none">
        <a class="" onclick="btnkembali()"><i class="fa fa-arrow-left"></i> Kembali</a><br>
      </div>
    </div>
    <span class="help-block"><br></span>
    <div class="row">
      <div class="col-xs-8">
        Sudah punya akun? <a href="<?= base_url('user/login'); ?>" class="text-center">MASUK</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    setuju();
  });

  function validasidaftar() {
      $('#p_nama_lengkap').html('');
      $('#p_r_jk').html('');
      $('#p_tmp_lahir').html('');
      $('#p_tgl_lahir').html('');
      $('#p_no_telp').html('');
      $('#p_email').html('');

    if ($('input[name="nama_lengkap"]').val() == '') {
      $('#p_nama_lengkap').html(' Tidak boleh kosong !');
      $('input[name="nama_lengkap"]').focus();
    } else if (!$('input[name="r_jk"]').is(":checked")) {
      $('#p_r_jk').html(' Tidak boleh kosong !');
      $('input[name="r_jk"]').focus();
    } else if ($('input[name="tmp_lahir"]').val() == '') {
      $('#p_tmp_lahir').html(' Tidak boleh kosong !');
      $('input[name="tmp_lahir"]').focus();
    } else if ($('input[name="tgl_lahir"]').val() == '') {
      $('#p_tgl_lahir').html(' Tidak boleh kosong !');
      $('input[name="tgl_lahir"]').focus();
    } else if ($('input[name="no_telp"]').val() == '') {
      $('#p_no_telp').html(' Tidak boleh kosong !');
      $('input[name="no_telp"]').focus();
    }	else if ($('input[name="email"]').val() == '') {
      $('#p_email').html(' Tidak boleh kosong !');
      $('input[name="email"]').focus();
    } else {
      $('#btn_daftar').html('<i class="fas fa-spinner fa-pulse"></i> Daftar...');
		  $('#btn_kirim').attr('disabled', true);
      setTimeout(function() {
        getDaftar();
      }, 500);
    }

  }

  function getDaftar(){
    var inputDate = $('input[name="tgl_lahir"]').val().split('-');
    var tahun 	= inputDate[2];
    var bulan 	= inputDate[1];
    var tanggal = inputDate[0];
    newdate = tahun + "-" + bulan + "-" + tanggal;

    var data = {
      username      : $('input[name="username"]').val(),
      password      : $('input[name="pass"]').val(),
      nama_lengkap  : $('input[name="nama_lengkap"]').val(),
      jenis_kelamin : $('input[name="r_jk"]:checked').val(),
      tempat_lahir  : $('input[name="tmp_lahir"]').val(),
      tanggal_lahir : newdate,
      no_telp       : $('input[name="no_telp"]').val(),
      email         : $('input[name="email"]').val()
    };

    // ajax adding data to database
    $.ajax({
    	url: "<?php echo site_url('user/daftarproses') ?>",
    	type: "POST",
    	data: data,
    	dataType: "JSON",
    	success: function (data) {
    		if (data.status) {
            btnkembali();
            reloadform();
            $('.modal_action_status').html(data.message);
            $('#modal_form_sukses').modal('show');
            $('#form')[0];
        } else {
          if(data.message == 'Username sudah terpakai!') {
            btnkembali();
            $('#username').focus();
            $('.modal_action_status_failed').html(data.message);
            $('#modal_form_failed').modal('show');
            $('#btn_daftar').html('Daftar');
    		    $('#btn_daftar').attr('disabled', false);
          }else{
            $('.modal_action_status_failed').html(data.message);
            $('#modal_form_failed').modal('show');
            $('#btn_daftar').html('Daftar');
    	    	$('#btn_daftar').attr('disabled', false);
          }
          $('#btn_daftar').html('Daftar');
    		  $('#btn_daftar').attr('disabled', false);
    		}
    		$('#btn_daftar').html('Daftar');
    		$('#btn_daftar').attr('disabled', false);

    	},
    	error: function (jqXHR, textStatus, errorThrown) {
    		$('.modal_action_status_failed').html('Proses registrasi gagal!');
    		$('#modal_form_failed').modal('show');
    		$('#btn_daftar').html('Daftar'); //change button text
    		$('#btn_daftar').attr('disabled', false); //set button disable
    	}
    });
  }

  function validasiusername() {
    uncheckX();
    $('#p_username').text('');
    if ($('#username').val() != '') {
      if ($('#username').val().length >= 8) {
        $('#p_username').html('');
        $('#box_username').removeClass().addClass('form-group has-feedback');
      } else {
        $('#p_username').removeClass().addClass('pull-right text-yellow');
        $('#p_username').html('Username minimal 8 karakter');
        $('#box_username').removeClass().addClass('form-group has-warning');
      }
    } else {
      $('#p_username').removeClass().addClass('pull-right text-red');
      $('#p_username').html('Username tidak boleh kosong !');
      $('#box_username').removeClass().addClass('form-group has-feedback');
    }
  }

  function valid_pass() {
    uncheckX();
    if ($('#pass').val() != '') {
      if ($('#pass').val().length >= 6) {
        $('#p_pass').html('');
        $('#box_pass').removeClass().addClass('form-group has-success');
        $('#ulangi_pass').attr('disabled', false);

        if ($('#pass').val() == $('#ulangi_pass').val()) {
          $('#p_ulangi_pass').html('');
          $('#p_ulangi_pass').addClass('pull-right text-green');
          $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
          $('#box_u_pass').removeClass().addClass('form-group has-success');
          $('#box_pass').removeClass().addClass('form-group has-success');
        } else {
          $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
          $('#p_ulangi_pass').html('Kata sandi harus sama !');
          $('#box_u_pass').removeClass().addClass('form-group has-feedback');
          $('#box_pass').removeClass().addClass('form-group has-feedback');
        }
      } else {
        $('#p_pass').removeClass().addClass('pull-right text-yellow');
        $('#p_pass').html('Kata sandi minimal 6 karakter');
        $('#box_pass').removeClass().addClass('form-group has-warning');
        $('#p_ulangi_pass').html('');
        $('#box_u_pass').removeClass().addClass('form-group has-feedback');
        $('#ulangi_pass').attr('disabled', true);
      }
    } else {
      $('#p_pass').removeClass().addClass('pull-right text-red');
      $('#p_pass').html('Kata sandi tidak boleh kosong !');
      $('#box_pass').removeClass().addClass('form-group has-feedback');
      $('#p_ulangi_pass').html('');
      $('#box_u_pass').removeClass().addClass('form-group has-feedback');
      $('#ulangi_pass').attr('disabled', true);
      $('#ulangi_pass').val('');
    }
  }

  function samakan_pass() {
    uncheckX();
    $('#box_pass').removeClass().addClass('form-group has-feedback');
    if ($('#ulangi_pass').val() != '') {
      $('#p_pass').text('');
      $('#p_ulangi_pass').text('');
      if ($('#ulangi_pass').val() == $('#pass').val()) {
        $('#p_ulangi_pass').html('');
        $('#p_ulangi_pass').addClass('pull-right text-green');
        $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
        $('#box_u_pass').removeClass().addClass('form-group has-success');
        $('#box_pass').removeClass().addClass('form-group has-success');
      } else {
        $('#p_ulangi_pass').removeClass().addClass('pull-right text-yellow');
        $('#p_ulangi_pass').html('Kata sandi harus sama !');
        $('#box_u_pass').removeClass().addClass('form-group has-warning');
        $('#box_pass').removeClass().addClass('form-group has-feedback');
      }
    } else {
      $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
      $('#p_ulangi_pass').html('Ulangi sandi tidak boleh kosong !');
      $('#box_u_pass').removeClass().addClass('form-group has-feedback');
    }
  }

  function setuju() {
    $('#pesan_bawah').html('<br>');

    $('input[name="c_setuju"]').on('ifChecked', function () {
      // check username
      $('#pesan_bawah').html('<br>');
      if ($('#username').val() != '') {

        // check katasandi
        if ($('#pass').val() != '') {
          if ($('#pass').val().length >= 6) {
            $('#p_pass').html('');
            $('#box_pass').removeClass().addClass('form-group has-success');
            $('#ulangi_pass').attr('disabled', false);

            if ($('#pass').val() === $('#ulangi_pass').val()) {
              $('#p_ulangi_pass').html('');
              $('#p_ulangi_pass').addClass('pull-right text-green');
              $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
              $('#box_u_pass').removeClass().addClass('form-group has-success');
              $('#box_pass').removeClass().addClass('form-group has-success');
            } else {
              $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
              $('#p_ulangi_pass').html('Kata sandi harus sama !');
              $('#box_u_pass').removeClass().addClass('form-group has-error');
              $('#box_pass').removeClass().addClass('form-group has-feedback');
              $('#btn_lanjut').attr('disabled', true);
              $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian kata sandi baru anda !</p>');
            }
          } else {
            $('#p_pass').removeClass().addClass('pull-right text-yellow');
            $('#p_pass').html('Kata sandi minimal 6 karakter');
            $('#box_pass').removeClass().addClass('form-group has-warning');
            $('#p_ulangi_pass').html('');
            $('#box_u_pass').removeClass().addClass('form-group has-feedback');
            $('#ulangi_pass').attr('disabled', true);
            $('#btn_lanjut').attr('disabled', true);
            $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian kata sandi baru anda !</p>');
          }
        } else {
          $('#p_pass').removeClass().addClass('pull-right text-red');
          $('#p_pass').html('Kata sandi tidak boleh kosong !');
          $('#box_pass').removeClass().addClass('form-group has-feedback');
          $('#p_ulangi_pass').html('');
          $('#box_u_pass').removeClass().addClass('form-group has-feedback');
          $('#ulangi_pass').attr('disabled', true);
          $('#ulangi_pass').val('');

          $('#btn_lanjut').attr('disabled', true);
          $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian kata sandi baru anda !</p>');
        }

        if ($('#username').val().length >= 8) {
          $('#p_username').html('');
          $('#btn_lanjut').attr('disabled', false);
        } else {
          $('#p_username').removeClass().addClass('pull-right text-yellow');
          $('#p_username').html('Username minimal 8 karakter');
          $('#btn_lanjut').attr('disabled', true);
          $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian username anda !</p>');
        }
      } else {
        $('#p_username').removeClass().addClass('pull-right text-red');
        $('#p_username').html('Username tidak boleh kosong !');
          
        $('btn_lanjut').attr('disabled', true);
        $('#pesan_bawah').html('<p class="text-red">Perhatikan setiap pengisian !</p>');
        $('#btn_lanjut').attr('disabled', true);
      }
    });

    $('input[name="c_setuju"]').on('ifUnchecked', function () {
      $('#btn_lanjut').attr('disabled', true);
      $('#pesan_bawah').html('<p class="text-red">Setujui untuk melanjutkan!</p>');
    });
  }

  function lanjutisi() {
    if ($('#c_setuju').is(":checked")) {
      $('#pesan_bawah').html('<br>');
      if ($('#username').val() == '') {
        $('#p_username').removeClass().addClass('pull-right text-red');
        $('#p_username').html('Username tidak boleh kosong !');
        $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian username anda !</p>');
        $('#box_username').removeClass().addClass('form-group has-error');
        $('#username').focus();
      } else if ($('#pass').val() == '') {
        $('#p_pass').removeClass().addClass('pull-right text-red');
        $('#p_pass').html('Kata sandi tidak boleh kosong !');
        $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian kata sandi baru anda !</p>');
        $('#box_pass').removeClass().addClass('form-group has-error');
        $('#pass').focus();
      } else if ($('#ulangi_pass').val() == '') {
        $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
        $('#p_ulangi_pass').html('Ulangi sandi tidak boleh kosong !');
        $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian ulang kata sandi anda !</p>');
        $('#box_u_pass').removeClass().addClass('form-group has-error');
        $('#ulangi_pass').focus();
      } else {
        $('#p_username').text('');

        if ($('#username').val().length >= 8) {
          $('#p_username').html('');
          if ($('#pass').val().length >= 6) {
            $('#p_pass').html('');
            $('#box_pass').removeClass().addClass('form-group has-success');
            $('#ulangi_pass').attr('disabled', false);
            if ($('#ulangi_pass').val() === $('#pass').val()) {
              $('#p_ulangi_pass').html('');
              $('#p_ulangi_pass').addClass('pull-right text-green');
              $('#p_ulangi_pass').html('<i class="fa fa-check"></i> Kata sandi sudah sesuai');
              $('#box_u_pass').removeClass().addClass('form-group has-success');
              $('#box_pass').removeClass().addClass('form-group has-success');
              
              $('.step-1').hide();
              $('.step-2').show();
              $('.btnkembali').show();
              $('.setuju').hide();
              $('#pesan_bawah').html('<br>');
              $('#btn_lanjut').hide();
              $('#btn_daftar').show();
            } else {
              $('#p_ulangi_pass').removeClass().addClass('pull-right text-red');
              $('#p_ulangi_pass').html('Kata sandi harus sama !');
              $('#box_pass').removeClass().addClass('form-group has-feedback');
              $('#box_u_pass').removeClass().addClass('form-group has-error');
              $('#ulangi_pass').val('');
              $('#ulangi_pass').focus();
              $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian ulang kata sandi anda !</p>');
            }
          }
        } else {
          $('#p_username').removeClass().addClass('pull-right text-yellow');
          $('#p_username').html('Username minimal 8 karakter');
          $('#box_username').removeClass().addClass('form-group has-warning');
          $('#username').focus();
          $('#pesan_bawah').html('<p class="text-red">Perhatiakan bagian username anda !</p>');
        }
      }
    } else {
      if ($('#username').val() == '') {
        $('#p_username').text('Username tidak boleh kosong !');
      } else if ($('#pass').val() == '') {
        $('#p_pass').text('Kata sandi tidak boleh kosong !');
      } else if ($('#ulangi_pass').val() == '') {
        $('#p_ulangi_pass').text('Kata sandi tidak boleh kosong !');
      } else {
        $('#pesan_bawah').html('<p class="text-red">Setujui untuk melanjutkan!</p>');
        $('#p_username').text('');
      }
    }
  }

  function btnkembali() {
    $('.step-2').hide();
    $('.step-1').show();
    $('.btnkembali').hide();
    $('.setuju').show();
    $('#btn_lanjut').show();
    $('#btn_daftar').hide();
  }

  function uncheckX() {
    $('input[name="c_setuju"]').iCheck('uncheck');
    $('input[name="r_jk"]').iCheck('uncheck');
  }

  function reloadform(){
    $('input[name="username"]').val('');
    $('input[name="pass"]').val('');
    $('input[name="ulangi_pass"]').val('');
    $('input[name="nama_lengkap"]').val('');
    $('input[name="r_jk"]:checked').val('');
    $('input[name="tmp_lahir"]').val('');
    $('input[name="tgl_lahir"]').val('');
    $('input[name="no_telp"]').val('');
    $('input[name="email"]').val('');
    uncheckX();
    $('#pesan_bawah').html('<br>');

    $('#p_username').html('');
    $('#p_pass').html('');
    $('#p_ulangi_pass').html('');
    $('#p_nama_lengkap').html('');
    $('#p_r_jk').html('');
    $('#p_tmp_lahir').html('');
    $('#p_tgl_lahir').html('');
    $('#p_no_telp').html('');
    $('#p_email').html('');

    $('#box_username').removeClass().addClass('form-group has-feedback');
    $('#box_pass').removeClass().addClass('form-group has-feedback');
    $('#box_u_pass').removeClass().addClass('form-group has-feedback');
  }

</script>


<!-- Modal SUCCESS -->
<div class="modal modal-success fade" id="modal_form_sukses" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4><i class="fa fa-check"></i> Registrasi berhasil</h4>
		  </div>

      <div class="modal-body text-center">
        <h3 class="modal_action_status">Status Success!</h3>
      </div>

			<div class="modal-footer">
        <b class="text-white pull-left">Lanjutkan masuk ke akun Anda! </b><a href="<?= base_url('user/login'); ?>" class="btn btn-outline"><b>Masuk </b><i class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal SUCCESS -->

<!-- Modal FAILED -->
<div class="modal modal-danger fade" id="modal_form_failed" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
							class="fa fa-times"></i></span></button>
        <h4><i class="fa fa-times-circle"></i> Registrasi gagal</h4>
			</div>
      <div class="modal-body text-center">
        <h3 class="modal_action_status_failed">Status Failed!</h3>
      </div>

<!-- 	<div class="modal-footer bg-danger">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Daftar</button>
			</div> -->
		</div>
	</div>
</div>
<!-- End Modal FAILED -->