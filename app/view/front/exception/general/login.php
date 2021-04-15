<?php
ob_start();
?>	
			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Login</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="form-card">
							<h3>Login Akun</h3>
							<?=$pesan;?>
							<form class="account-create" action="<?=base_url();?>/front/general/statis/login" method="POST">
								<label>E-mail<span class="required">*</span></label>
								<input type="text" name="email"  maxlength="35" class="form-control input-lg">
								<label>Password<span class="required">*</span></label>
								<input type="password" name="password"  maxlength="25" class="form-control input-lg">
								<div>
									<button class="btn btn-lg">Login</button><span class="required-text">* Required Fields</span></div>
								<div class="back">or <a href="<?=base_url();?>/front/general/statis/registrasi">Registrasi <i class="icon icon-undo"></i></a></div>
							</form>
						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>