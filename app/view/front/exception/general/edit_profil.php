<?php
ob_start();
$id = shl_session::get("id_pelanggan");
$pelanggan = shl_db::table("pelanggan")->where("id_pelanggan", $id)->single();
?>	
			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Edit Profil</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="form-card">
							<h3>Edit Profil</h3>
							<form class="account-create" action="#" method="POST">
								<label>Nama<span class="required">*</span></label>
								<input type="text" name="nama" class="form-control input-lg" value="<?=$pelanggan['nama'];?>">
								<label>Nomor Telepon<span class="required">*</span></label>
								<input type="number" name="telepon" class="form-control" value="<?=$pelanggan['telepon'];?>">
								<label>E-mail<span class="required">*</span></label>
								<input type="text" name="email" class="form-control input-lg" value="<?=$pelanggan['email'];?>">
								<label>Password<span class="required">*</span></label>
								<input type="password" name="password" class="form-control input-lg" value="<?=$pelanggan['password'];?>">
								<div>
									<button class="btn btn-lg">Simpan</button><span class="required-text">* Required Fields</span></div>

							</form>
						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>