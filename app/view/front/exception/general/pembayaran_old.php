<?php
ob_start();
$bayar = shl_db::table("transaksi")->where("id_transaksi", $_GET['id'])->single();
$id = shl_session::get("id_pelanggan");
$pelanggan = shl_db::table("pelanggan")->where("id_pelanggan", $id)->single();
?>	
			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Pembayaran</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
					<div class="col-sm-6">	
						<div class="form-card">
							<h3>Form Bukti Transfer</h3>
							<h5><?=$pesan;?></h5>
							<form class="account-create" action="#" method="POST" enctype="multipart/form-data">
	
														
														<div class="form-group col-lg-12">
															<label class="font-weight-bold text-dark text-2">Nama </label> <br>
															<b><?=$pelanggan['nama'];?></b>
														</div>

														<div class="form-group col-lg-12">
															<label class="font-weight-bold text-dark text-2">Nominal Transfer </label> <br>
															<b><?=rupiah($_GET['rp']);?></b>
														</div>

														<div class="form-group col-lg-12">
															<label class="font-weight-bold text-dark text-2">Rekening Pembayaran</label>
															<select class="form-control" name="metode_pembayaran">
																<option>BCA</option>
																<option>BNI</option>
																<option>Mandiri</option>
															</select>	
														</div>
	
														<div class="form-group col-lg-12">
															<label class="font-weight-bold text-dark text-2">Upload Bukti Transfer/Pembayaran </label>
															<input type="file" name="bukti_transfer" class="form-control" required="required">
														</div>
								<div>
									<button class="btn btn-lg">Kirim</button><span class="required-text">* Required Fields</span>
								</div>
							</form>
						</div>
					</div>

					<div class="col-sm-6">	
						<div class="form-card">
							<h3>PEMBAYARAN</h3>
							<p>Silahkan melakukan pembayaran dengan melakukan transfer pada rekening kami yang tertera di bawah ini:
												<p>
													BCA : <br>
													0231107516 an. Robby Hidayat <br>

													Mandiri : <br>
													114000 7729546 an. CV Karya Jaya Security<br>
												</p>
							

						</div>
					</div>

					</div>
				</div>
			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>