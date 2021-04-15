<?php
ob_start();
?>	
			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Registrasi</span></li>

						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="form-card">
							<h3>Buat Akun</h3>
							<?php if (!empty($_GET['nt'])) { ?> 
							<p>Anda Berhasil Melakukan Registrasi silahkan buka email anda dan verifikasi sebelum <a href="<?=base_url();?>/front/general/statis/login">Login </a></p>
							<?php };?>
							<form class="account-create" action="#" method="POST">
								<label>Nama<span class="required">*</span></label>
								<input type="text" name="nama" class="form-control input-lg" maxlength="25" required="required">
								<label>Nomor Telepon<span class="required">*</span></label>
								<input type="number" maxlength="13" name="telepon" class="form-control" required="required">
								<label>E-mail<span class="required">*</span></label>
								<input type="email" maxlength="35"  name="email" class="form-control input-lg" required="required">
								<label>Password<span class="required">*</span></label>
								<input type="password" name="password" class="form-control input-lg" maxlength="25" required="required"sss>
								<div>
									<button class="btn btn-lg btn-primary">Registrasi</button><span class="required-text">* Required Fields</span></div>
								<div class="back">or <a href="<?=base_url();?>/front/general/statis/login">Login <i class="icon icon-undo"></i></a></div>
							</form>
						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>