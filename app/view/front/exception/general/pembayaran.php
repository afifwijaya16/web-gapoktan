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
							<li>/<span>Keranjang Belanja</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<div class="cart-table">
							<div class="table-header">
								<div class="photo">
									Gambar
								</div>
								<div class="name">
									Nama Produk
								</div>
								<div class="price">
									Harga /Produk
								</div>
								<div class="qty">
									Qty
								</div>
								<div class="subtotal">
									Subtotal
								</div>
							</div>

								<?php 
								$subtotal = 0;
								$totalberat = 0;
								$produk = shl_db::table("keranjang")->join("produk","produk.id_produk","keranjang.id_produk")->where("id_pelanggan", shl_session::get("id_pelanggan"))->where("status", "Done")->where("id_transaksi", $_GET['id'])->get();
								foreach ($produk as $row) { 
									$subtotalberat = $row['berat'] * $row['jumlah_pesanan'];
									$totalberat += $subtotalberat;


								if ($row['diskon'] != 0){
									$diskon = $row['harga_produk'] * $row['diskon']/100; 
									$harga = $row['harga_produk'] - $diskon;
								} else {
									$harga = $row['harga_produk'];
								}


									?> 							
							<div class="table-row">
								<div class="photo">
									<a href="#"><img src="<?=base_url();?>/resources/public/images/<?=$row['gambar_produk'];?>" alt=""></a>
								</div>
								<div class="name">
									<a href="#"><?=$row['nama_produk'];?></a>
								</div>
								<div class="price">
									<?=rupiah($harga);?>
								</div>
								<div class="qty qty-changer">
									<?=$row['jumlah_pesanan'];?>

								</div>
								<div class="subtotal">
									<?=rupiah($total=$harga * $row['jumlah_pesanan']);?>
									<?php $subtotal += $total;?>
								</div>
							</div>
						<?php };?>





						</div>
						<div class="row">
							<form action="#" method="POST" enctype="multipart/form-data">
							<div class="col-sm-6 col-md-4">
								<h2>Konfirmasi Pembayaran</h2>
															<p>Silahkan melakukan pembayaran dengan melakukan transfer pada rekening kami yang tertera di bawah ini:
												<p>
													BCA : <br>
													0231107516 an. Noni<br>

													Mandiri : <br>
													114000 7729546 an. GAPOKTAN Gading Rejo<br>
												</p>


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


							</div>
							<div class="col-md-3 total-wrapper">
								<table class="total-price">
									<tr class="total">
										<td>Sub Total</td>
										<td><?=rupiah($subtotal);?></td>
									</tr>
									<tr class="total">
										<td>Ongkir</td>
										<td><?=rupiah($ongkir=$_GET['rp'] - $subtotal);?></td>
									</tr>

									<tr class="total">
										<td>Grand Total</td>
										<td><?=rupiah($grandtotal=$subtotal+$ongkir);?></td>
									</tr>
								</table>
								<div class="cart-action">
									<div>
										<input type="submit" class="btn" value="KIRIM"> <span class="required-text">* Required Fields</span>
									</div>
								</div>
							</div>
							</form>


						</div>
					</div>
				</div>
			</main>
			<!-- /Page Content -->
<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>