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
							<li><a href="#"><i class="icon icon-home"></i></a></li>
							<li>/<span>Profile Saya</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="form-card">
							<h3>Profil Saya</h3>
								<label>Nama<span class="required">*</span></label>
								<b><?=$pelanggan['nama'];?></b><br>
								
								<label>Nomor Telepon<span class="required">*</span></label>
								<b><?=$pelanggan['telepon'];?></b><br>

								<label>E-mail<span class="required">*</span></label>
								<b><?=$pelanggan['email'];?></b><br>

								<div><a href="<?=base_url();?>/front/general/statis/edit_profil"><button class="btn btn-lg">Edit Profil</button></a></div>

						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>