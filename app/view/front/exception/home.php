<?php
ob_start();
?>

<!-- Page Content -->
<main class="page-main">

	<div class="block fullwidth full-nopad bottom-space">
		<div class="container">
			<!-- Main Slider -->
			<div class="mainSlider" data-thumb="true" data-thumb-width="230" data-thumb-height="100">
				<div class="sliderLoader">Loading...</div>
				<!-- Slider main container -->
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<!-- Slides -->
						<div class="swiper-slide" data-target="_blank">
							<!-- _blank or _self ( _self is default )-->
							<div class="wrapper">
								<figure><img src="<?=base_url();?>/resources/banner1.png" alt=""></figure>

							</div>
						</div>

						<div class="swiper-slide">
							<div class="wrapper">
								<figure><img src="<?=base_url();?>/resources/banner2.png" alt=""></figure>

							</div>
						</div>
						<div class="swiper-slide">
							<div class="wrapper">
								<figure><img src="<?=base_url();?>/resources/banner3.png" alt=""></figure>

							</div>
						</div>
					</div>
					<!-- pagination -->
					<div class="swiper-pagination"></div>
					<!-- pagination thumbs -->
					<div class="swiper-pagination-thumbs">
						<div class="thumbs-wrapper">
							<div class="thumbs"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Slider -->
		</div>
	</div>

	<div class="block">
		<div class="container">
			<!-- Wellcome text -->
			<div class="text-center bottom-space">
				<h1 class="size-lg no-padding"> <span class="logo-font text-primary">GAPOKTAN GADING REJO</span></h1>
				<div class="line-divider"></div>
				<p class="custom-color-alt"> <b>SELAMAT DATANG DI WEBSITE RESMI GABUNGAN KELOMPOK TANI GADING REJO</b>
					<p class="custom-color-alt"> "Kami Menyediakan Produk Unggulan Beras, Makanan Tradisional, Makanan
						Ternak dan Perkakas-Kerajinan"
					</p>
				</p>
			</div>
			<!-- /Wellcome text -->
		</div>
	</div>

	<div class="block fullwidth full-nopad ">
		<div class="container">
			<!-- Category Slider -->
			<div class="category-slider">
				<div class="item">
					<a href="<?=base_url();?>/front/general/statis/kategori/?id=Beras">
						<img src="<?=base_url();?>/resources/beras.png" alt="">
						<div class="caption">
							<div class="text-primary">Beras</div>
							<div class="btn">Belanja</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="<?=base_url();?>/front/general/statis/kategori/?id=Makanan Tradisional">
						<img src="<?=base_url();?>/resources/makanankhas.png" alt="">
						<div class="caption">
							<div class="text-primary">Makanan Tradisional</div>
							<div class="btn">Belanja</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="<?=base_url();?>/front/general/statis/kategori/?id=Makanan Ternak">
						<img src="<?=base_url();?>/resources/makananternak.png" alt="">
						<div class="caption">
							<div class="text-primary">Makanan Ternak</div>
							<div class="btn">Belanja</div>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="<?=base_url();?>/front/general/statis/kategori/?id=Perkakas-Kerajinan">
						<img src="<?=base_url();?>/resources/perkakas.png" alt="">
						<div class="caption">
							<div class="text-primary">Perkakas & Kerajinan</div>
							<div class="btn">Belanja</div>
						</div>
					</a>
				</div>

			</div>
			<!-- /Category Slider -->
		</div>
	</div>







	<!-- Products Grid -->
	<div class="products-grid five-in-row product-variant-3">
		<div class="title">
			<h2> Produk Diskon</h2>
			<div class="carousel-arrows"></div>
		</div>
		<?php 
								$diskon = shl_db::sql_query("SELECT * FROM produk WHERE diskon != 0")->limit(0,20)->get();
								foreach ($diskon as $row) {
								if(!empty(shl_session::get("id_pelanggan"))) { 
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								} else {
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								}


								if (shl_session::get("total_transaksi") > 3) {
									$diskon = $row['harga_produk'] * $row['diskon_pelanggan']/100; 
									$harga = $row['harga_produk'] - $diskon;									

								} else {

								if ($row['diskon'] != 0){
									$diskon = $row['harga_produk'] * $row['diskon']/100; 
									$harga = $row['harga_produk'] - $diskon;
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
									<a href="<?=$url;?>"><img class="product-image-photo"
											src="<?=base_url();?>/resources/public/images/<?=$row['gambar_produk'];?>"
											alt=""></a>
								</div>

							</div>

						</div>
						<!-- /product inside carousel -->
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
								</a>
							</div>


						</div>
						<!-- /Product Actions -->
					</div>
					<!-- /Product Photo -->
					<!-- Product Details -->
					<div class="product-item-details">
						<div class="product-item-name"> <a title="Boyfriend Short" href="<?=$url;?>"
								class="product-item-link"><?=$row['nama_produk'];?> <br> Stok : <?=$row['stok'];?></a>
						</div>
						<div class="product-item-description"><?=$row['deskripsi_produk'];?> </div>
						<div class="price-box"> <span class="price-container"> <span class="price-wrapper"> <span
										class="old-price"></span> <br><span
										class="special-price"><?=rupiah($harga);?></span> </span>
							</span>
						</div>
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart" data-product="789123"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
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





	<!-- Products Grid -->
	<div class="products-grid five-in-row product-variant-3">
		<div class="title">
			<h2>Best Seller</h2>
			<div class="carousel-arrows"></div>
		</div>
		<?php 
								$best = shl_db::sql_query("SELECT * FROM produk ORDER by Klik DESC")->limit(0,20)->get();
								foreach ($best as $row) {
								if(!empty(shl_session::get("id_pelanggan"))) { 
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								} else {
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								}


								if (shl_session::get("total_transaksi") > 3) {
									$diskon = $row['harga_produk'] * $row['diskon_pelanggan']/100; 
									$harga = $row['harga_produk'] - $diskon;									

								} else {

								if ($row['diskon'] != 0){
									$diskon = $row['harga_produk'] * $row['diskon']/100; 
									$harga = $row['harga_produk'] - $diskon;
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
									<a href="<?=$url;?>"><img class="product-image-photo"
											src="<?=base_url();?>/resources/public/images/<?=$row['gambar_produk'];?>"
											alt=""></a>
								</div>

							</div>

						</div>
						<!-- /product inside carousel -->
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
								</a>
							</div>


						</div>
						<!-- /Product Actions -->
					</div>
					<!-- /Product Photo -->
					<!-- Product Details -->
					<div class="product-item-details">
						<div class="product-item-name"> <a title="Boyfriend Short" href="<?=$url;?>"
								class="product-item-link"><?=$row['nama_produk'];?> <br> Stok : <?=$row['stok'];?></a>
						</div>
						<div class="product-item-description"><?=$row['deskripsi_produk'];?> </div>
						<div class="price-box"> <span class="price-container"> <span class="price-wrapper"> <span
										class="old-price"></span> <br><span
										class="special-price"><?=rupiah($harga);?></span> </span>
							</span>
						</div>
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart" data-product="789123"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
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



	<!-- Products Grid -->
	<div class="products-grid five-in-row product-variant-3">
		<div class="title">
			<h2>Semua Produk</h2>
			<div class="carousel-arrows"></div>
		</div>
		<?php 
								$produk= shl_db::sql_query("SELECT * FROM produk WHERE diskon = 0")->get();
								foreach ($produk as $row) {
								if(!empty(shl_session::get("id_pelanggan"))) { 
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								} else {
									$url = base_url()."/front/general/statis/detail_produk/".$row['id_produk'];
								}


								if (shl_session::get("total_transaksi") > 3) {
									$diskon = $row['harga_produk'] * $row['diskon_pelanggan']/100; 
									$harga = $row['harga_produk'] - $diskon;									

								} else {

								if ($row['diskon'] != 0){
									$diskon = $row['harga_produk'] * $row['diskon']/100; 
									$harga = $row['harga_produk'] - $diskon;
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
									<a href="<?=$url;?>"><img class="product-image-photo"
											src="<?=base_url();?>/resources/public/images/<?=$row['gambar_produk'];?>"
											alt=""></a>
								</div>

							</div>

						</div>
						<!-- /product inside carousel -->
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
								</a>
							</div>


						</div>
						<!-- /Product Actions -->
					</div>
					<!-- /Product Photo -->
					<!-- Product Details -->
					<div class="product-item-details">
						<div class="product-item-name"> <a title="Boyfriend Short" href="<?=$url;?>"
								class="product-item-link"><?=$row['nama_produk'];?> <br> Stok : <?=$row['stok'];?></a>
						</div>
						<div class="product-item-description"><?=$row['deskripsi_produk'];?> </div>
						<div class="price-box"> <span class="price-container"> <span class="price-wrapper"> <span
										class="old-price"></span> <br><span
										class="special-price"><?=rupiah($harga);?></span> </span>
							</span>
						</div>
						<!-- Product Actions -->
						<div class="product-item-actions">
							<div class="actions-primary">
								<a href="<?=$url;?>">
									<button class="btn btn-sm btn-invert add-to-cart" data-product="789123"> <i
											class="icon icon-cart"></i><span>Order</span> </button>
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