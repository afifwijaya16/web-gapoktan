<?php
ob_start();
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
								<div class="remove">
									<span class="hidden-sm hidden-xs">Delete</span>
								</div>
							</div>

								<?php 
								$subtotal = 0;
								$totalberat = 0;
								$produk = shl_db::table("keranjang")->join("produk","produk.id_produk","keranjang.id_produk")->where("id_pelanggan", shl_session::get("id_pelanggan"))->where("status", "Pending")->get();
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

									<fieldset>
									<form method="get" target="<?=base_url();?>/front/general/statis/cart/?p=edit">
										<input type="hidden" name="id" value="<?=$row['id_produk'];?>">
										<input type="hidden" name="p" value="edit">
										<input type="hidden" name="id_keranjang" value="<?=$row['id_keranjang'];?>">
										<input type="hidden" class="qty-input" value="<?=$tambah=$row['jumlah_pesanan']+1;?>" name="jumlah_pesanan" data-min="0">
										<input type="submit" value="+" >

									</form>

										<input type="text" class="qty-input" value="<?=$row['jumlah_pesanan'];?>" data-min="0" readonly="readonly">

									<form method="get" target="<?=base_url();?>/front/general/statis/cart/?p=edit">
										<input type="hidden" name="id" value="<?=$row['id_produk'];?>">
										<input type="hidden" name="p" value="edit">
										<input type="hidden" name="id_keranjang" value="<?=$row['id_keranjang'];?>">
										<input type="hidden" class="qty-input" value="<?=$tambah=$row['jumlah_pesanan']-1;?>" name="jumlah_pesanan" data-min="0">
										<input type="submit" value="-" >
									</form>


									</fieldset>
								</div>
								<div class="subtotal">
									<?=rupiah($total=$harga * $row['jumlah_pesanan']);?>
									<?php $subtotal += $total;?>
								</div>
								<div class="remove">
									<a href="<?=base_url();?>/front/general/statis/cart/?p=delete&id=<?=$row['id_keranjang'];?>" class="icon icon-close-2"></a>
								</div>
							</div>
						<?php };?>





						</div>
						<div class="row">
							<form method="POST" action="<?=base_url();?>/front/general/statis/order">
							<div class="col-sm-6 col-md-4">
								<h2>Alamat Pengiriman</h2>
								<label>Kabupaten / Kecamatan</label>
                            <?=shl_form::dropdown("id_ongkir", shl_db::table("ongkir")->select("id_ongkir, concat(kabupaten,' - ',kecamatan,' - ',harga_ongkir) as nama"), "", ["class" => "form-control dashed"]);?>


									<label>Alamat Pengiriman.</label>
									<input type="text" name="alamat_pengiriman" class="form-control dashed" required="required">

                                 

							</div>
							<div class="col-md-3 total-wrapper">
								<table class="total-price">



									<tr class="total">
										<td>Grand Total</td>
										<td><?=rupiah($subtotal);?></td>
									</tr>
								</table>
								<div class="cart-action">
									<div>
										<input type="hidden" name="total_berat" value="<?=$totalberat;?>">
										<input type="hidden" name="grandtotal" value="<?=$subtotal;?>">										
										<input type="hidden" name="status_transaksi" value="Pending">
										<input type="submit" class="btn" value="Checkout">
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