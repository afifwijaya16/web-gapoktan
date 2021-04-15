<?php
ob_start();
?>

			<!-- Page Content -->
			<main class="page-main">

				<div class="block">
					<div class="container">
						<!-- Wellcome text -->
						<div class="text-center bottom-space">
							<h1 class="size-lg no-padding">Hasil Pencarian <span class="logo-font custom-color"><?=$_GET[kw];?></span> </h1>
							<div class="line-divider"></div>
							</p>
						</div>
						<!-- /Wellcome text -->
					</div>
				</div>


							<!-- Products Grid -->
							<div class="products-grid five-in-row product-variant-3">

								<?php 
								$keyword = $_GET['kw'];
								$produk = shl_db::sql_query("SELECT * FROM produk WHERE nama_produk like '%$keyword%'")->get();
								foreach ($produk as $row) { 

								if(!empty(shl_session::get("id_pelanggan"))) { 
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								} else {
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								}

								if (shl_session::get("total_transaksi") >= 2) {
									$diskon_pelanggan = $row['harga_produk'] * $row['diskon_pelanggan']/100; 
									$harga = $row['harga_produk'] - $diskon_pelanggan;									
									$harga_coret=$row['harga_produk'];
								} else {

								if ($row['diskon'] != 0){
									$diskon = $row['harga_produk'] * $row['diskon']/100; 
									$harga = $row['harga_produk'] - $diskon;
									$harga_coret=$row['harga_produk'];
								} else {
									$harga = $row['harga_produk'];
								}

								}
									?> 
								
								<!-- Product Item -->
								<div class="product-item large">
									<div class="product-item-inside">
										<!-- Product Label -->
										<div class="product-item-label label-new"><span>New</span></div>
										<!-- /Product Label -->
										<div class="product-item-info">
											<!-- Product Photo -->
											<div class="product-item-photo">
												<!-- product inside carousel -->
												<div class="carousel-inside fade" data-ride="carousel">
													<div class="carousel-inner">
														<div class="item active">
															<a href="<?=$url;?>"><img class="product-image-photo" src="<?=base_url();?>/resources/public/images/<?=$row['gambar_produk'];?>" alt=""></a>
														</div>

													</div>

												</div>
												<!-- /product inside carousel -->
												<!-- Product Actions -->
												<div class="product-item-actions">
													<div class="actions-primary">
														<a href="<?=$url;?>">
														<button class="btn btn-sm btn-invert add-to-cart"> <i class="icon icon-cart"></i><span>Beli</span> </button>
													</a>
													</div>


												</div>
												<!-- /Product Actions -->
											</div>
											<!-- /Product Photo -->
											<!-- Product Details -->
											<div class="product-item-details">
												<div class="product-item-name"> <a title="Boyfriend Short" href="<?=$url;?>" class="product-item-link"><?=$row['nama_produk'];?>  <br> Stok : <?=$row['stok'];?></a> </div>
												<div class="product-item-description"><?=$row['deskripsi_produk'];?> </div>
												<div class="price-box"> <span class="price-container"> <span class="price-wrapper"> 
													<?php if ($row['diskon'] != 0){ ?> 
														<span class="old-price"><?=rupiah($harga_coret);?></span>

													<?php }?>

													<span class="special-price"><?=rupiah($harga);?></span> </span>
													</span>
												</div>
												<!-- Product Actions -->
												<div class="product-item-actions">
													<div class="actions-primary">
														<a href="<?=$url;?>">
														<button class="btn btn-sm btn-invert add-to-cart" data-product="789123"> <i class="icon icon-cart"></i><span>Beli</span> </button>
													</a>
													</div>
												</div>
												<!-- /Product Actions -->
											</div>
											<!-- /Product Details -->
										</div>
									</div>
								</div>
								<!-- /Product Item -->
								<?php }; ?>

							</div>
							<!-- /Products Grid -->

			</main>
			<!-- /Page Content -->

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>