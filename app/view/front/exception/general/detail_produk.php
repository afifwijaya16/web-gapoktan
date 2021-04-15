<?php
ob_start();
$pro = shl_db::table("produk")->select("produk.*,users.nama_industri, users.telepon, users.name")->join("users","users.id_users","produk.id_users")->where("id_produk",url_segment(5))->single();
if ($pro['diskon'] != 0){
	$diskon = $pro['harga_produk'] * $pro['diskon']/100; 
	$harga = $pro['harga_produk'] - $diskon; 
} else {
	$harga = $pro['harga_produk'];
};


$data['klik'] =  $pro['klik'] + 1;
$update = shl_db::table("produk")->where("id_produk", $pro['id_produk'])->update($data);




?>	
			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>Detail Produk</span></li>
						</ul>
					</div>
				</div>

				<div class="block product-block">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<!-- Product Gallery -->
								<div class="main-image">
									<img src="<?=base_url();?>/resources/public/images/<?=$pro['gambar_produk'];?>" class="zoom" alt="" data-zoom-image="<?=base_url();?>/resources/public/images/<?=$pro['gambar_produk'];?>" />
									<div class="dblclick-text"><span>Double click for zoom</span></div>
									<a href="images/products/large/product-gallery-1.jpg" class="zoom-link"><i class="icon icon-zoomin"></i></a>
								</div>

								<!-- /Product Gallery -->
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="product-info-block classic">

									<div class="product-name-wrapper">
										<h1 class="product-name"><?=$pro['nama_produk'];?></h1>
										<div class="product-labels">
											<span class="product-label sale">DIJUAL</span>
										</div>
									</div>
									<div class="product-availability">Stok: <span><?=$pro['stok'];?></span></div>
									
									<div class="product-availability">Diskon: <span><?=$pro['diskon'];?>%</span></div>
									<div class="product-availability">Berat: <span><?=$pro['berat'];?> Gram</span></div>

									<div class="product-actions">
										<div class="row">
											<div class="col-md-6">
											</div>
											<div class="col-md-6">
												<div class="price">
													<span class="special-price"><span><?=rupiah($harga);?>,-</span></span>
												</div>
												<div class="actions">
													<?php  if (!empty(shl_session::get("id_pelanggan"))) { ?> 
													<a href="<?=base_url()."/front/general/statis/cart/?p=tambah&id=".$pro['id_produk'];?>&price=<?=$harga;?>">
													<button class="btn btn-lg btn-loading"><i class="icon icon-cart"></i><span>Beli</span></button>
													<a href="#" class="btn btn-lg product-details"><i class="icon icon-external-link"></i></a>
													</a>
													<?php } else { ?> 

													Silahkan Melakukan Registrasi dan Login sebelum berbelanja! <a href="<?=base_url();?>/front/general/statis/registrasi">Registrasi</a>

													<?php };?>


												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="block">
					<div class="tabaccordion">
						<div class="container">
							<!-- Nav tabs -->
							<ul class="nav-tabs product-tab" role="tablist">
								<li><a href="#Tab1" role="tab" data-toggle="tab">Deskripsi</a></li>
								<li><a href="#Tab2" role="tab" data-toggle="tab">Form Komentar</a></li>
								<li><a href="#Tab3" role="tab" data-toggle="tab">Komentar</a></li>
								<li><a href="#Tab4" role="tab" data-toggle="tab">Testimoni</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane" id="Tab1">
									<p><?=$pro['deskripsi_produk'];?></p>

								</div>
								<div role="tabpanel" class="tab-pane" id="Tab2">
										<?php  if (!empty(shl_session::get("id_pelanggan"))) { ?> 

									<form method="POST" class="contact-form white" action="#">

									<div class="table-responsive">	

										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<td></td>
													<td class="text-center">1 star</td>
													<td class="text-center">2 star</td>
													<td class="text-center">3 star</td>
													<td class="text-center">4 star</td>
													<td class="text-center">5 star</td>
												</tr>
											</thead>
											<tbody>

												<tr>
													<td><strong>Rating</strong></td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality1" type="radio"  name="rating" value="1"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality2" type="radio"  name="rating" value="2"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality3" type="radio"  name="rating" value="3"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality4" type="radio"  name="rating" value="4"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
													<td class="text-center">
														<label class="radio">
															<input id="vote-quality5" type="radio"  name="rating" value="5"><span class="outer"><span class="inner"></span></span>
														</label>
													</td>
												</tr>
											</tbody>
										</table>


									</div>
									<h3>Ajukan Pertanyaan/Komentar/Review anda</h3>
										<label>Review<span class="required">*</span></label>
										<textarea class="form-control input-lg" name="komentar"></textarea>
										<div>
											<button class="btn btn-lg">Submit Review</button>
										</div>
										<div class="required-text">* Required Fields</div>
									</form>
									<?php } else { ?> 
										<p>Silahkan Login untuk Mengirim Komentar/Testimoni</p>

									<?php };?>



								</div>
								<div role="tabpanel" class="tab-pane" id="Tab3">

												<?php 
												$komentar = shl_db::table("komentar")->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")->where("id_produk",url_segment(5))->where("id_balasan", 0)->where("komentar.status_komentar","Komentar")->get();
												foreach ($komentar as $row) { ?>
												
									<div class="person-info">
										<h3 class="person-name"><?=$row['nama'];?></h3>
										<div class="product-item-rating"> <?php for($tgl=1; $tgl<=$row['rating']; $tgl++){ ?><i class="icon icon-star-fill"></i> <?php };?></div>
										<div class="person-subname"><i><?=tgl_indo($row['tgl_komentar']);?></i></div>
										<p><?=$row['komentar'];?></p>

									</div>
												<?php };?>

								</div>
								<div role="tabpanel" class="tab-pane" id="Tab4">
																								<?php 
												$testimoni = shl_db::table("komentar")->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")->where("id_produk",url_segment(5))->where("id_balasan", 0)->where("komentar.status_komentar","Testimoni")->get();
												foreach ($testimoni as $row) { ?>
												
									<div class="person-info">
										<h3 class="person-name"><?=$row['nama'];?></h3>
										<div class="product-item-rating"> <?php for($tgl=1; $tgl<=$row['rating']; $tgl++){ ?><i class="icon icon-star-fill"></i> <?php };?></div>
										<div class="person-subname"><i><?=tgl_indo($row['tgl_komentar']);?></i></div>
										<p><?=$row['komentar'];?></p>

									</div>
												<?php };?>

								</div>

							</div>
						</div>
					</div>
				</div>

				</form>
			</main>
			<!-- /Page Content -->


<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>