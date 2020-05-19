<div class="login-box">
	<div class="login-logo" style="padding-top:10px">
		<a href="" style="color:#fff;"></i><b>MASUK</b> AKUN
		</a>
		<p style="color: #fff" class="">Warga Desa Kedung Pengawas</p>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body login-from">
		<p class="login-box-msg"><?= $this->session->flashdata('message'); ?></p>
		<form action="" method="post">
			<div class="form-group has-feedback">
				<label style="color:#777">Username</label>
				<?= form_error('username', '<small class="text-red pl-3">', '</small>'); ?>
				<input type="text" class="form-control form-control-user active" name="username" id="username"
					placeholder="Username..." value="<?= set_value('username'); ?>" autofocus />

			</div>
			<div class=" form-group has-feedback">
				<label style="color:#777">Kata sandi</label>
				<?= form_error('password', '<small class="text-red pl-3">', '</small>'); ?>
				<input type="password" class="form-control form-control-user" name="password" placeholder="Kata sandi..."
					value="<?= set_value('password'); ?>" />

			</div>
			<span class=" help-block"></span><br>
			<div class="row">
				<div class="text-center col-md-12">
					<button type="submit" class="btn btn-flat btn-block btn-success btn-lg"><b>Masuk</b></button><br>
					<!-- <button type="reset" class="btn text-red btn-default btn-sm pull-left"><i class="fa fa-undo"></i> Batal</button> -->
				</div>
				<!-- /.col -->
			</div>
		</form>
		<a href="<?= base_url('user/daftar'); ?>" class="btn btn-flat btn-block btn-github">REGISTRASI AKUN</a>
	</div>
	<!-- /.login-box-body -->
	<!-- <br>
	<a href="<?= base_url('/'); ?>" class="btn btn-success"><i class="icon fa fa-arrow-left"></i> Kembali</a> -->
</div>



