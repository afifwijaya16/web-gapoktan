<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GAPOKTAN GADING REJO</title>
	<meta name="author" content="BigSteps">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<link rel="shortcut icon" href="<?=base_url();?>/resources/logogpn.png">

	<!-- Vendor -->
	<link href="<?=base_url();?>/resources/seiko/js/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/js/vendor/slick/slick.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/js/vendor/swiper/swiper.min.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/js/vendor/magnificpopup/dist/magnific-popup.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/js/vendor/nouislider/nouislider.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/js/vendor/darktooltip/dist/darktooltip.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/css/animate.css" rel="stylesheet">

	<!-- Custom -->
	<link href="<?=base_url();?>/resources/seiko/css/style.css" rel="stylesheet">
	<link href="<?=base_url();?>/resources/seiko/css/megamenu.css" rel="stylesheet">

	<!-- Color Schemes -->
	<!-- your style-color.css here  -->


	<!-- Icon Font -->
	<link href="<?=base_url();?>/resources/seiko/fonts/icomoon-reg/style.css" rel="stylesheet">

	<!-- Google Font -->
	<link
		href="<?=base_url();?>/resources/seiko/https://fonts.googleapis.com/css?family=Oswald:300,400,700|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i"
		rel="stylesheet">

</head>

<body class="boxed">
	<!-- Loader -->
	<div id="loader-wrapper" class="off">
		<div class="cube-wrapper">
			<div class="cube-folding">
				<span class="leaf1"></span>
				<span class="leaf2"></span>
				<span class="leaf3"></span>
				<span class="leaf4"></span>
			</div>
		</div>
	</div>

	<!-- /Loader -->
	<div class="fixed-btns">
		<!-- Back To Top -->
		<a href="<?=base_url();?>/resources/seiko/#" class="top-fixed-btn back-to-top"><i
				class="icon icon-arrow-up"></i></a>
		<!-- /Back To Top -->
	</div>
	<div id="wrapper">
		<!-- Page -->
		<div class="page-wrapper">
			<!-- Header -->
			<header class="page-header variant-2 fullboxed sticky always">
				<div class="navbar" style="background: #00BFFF">
					<div class="container">
						<!-- Menu Toggle -->
						<div class="menu-toggle"><a href="<?=base_url();?>/resources/seiko/#"
								class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
						<!-- /Menu Toggle -->

						<!-- Header Links -->
						<div class="header-links">

							<!-- Header Account -->
							<div class="header-link dropdown-link header-account">
								<a href="#"><i class="icon icon-user"></i></a>
								<div class="dropdown-container right">

									<?php  if (empty(shl_session::get("id_pelanggan"))) { ?>


									<div class="title">Registrasi Akun</div>
									<div class="top-text">Jika anda sudah memiliki akun, silahkan Login.</div>
									<!-- form -->
									<form action="<?=base_url();?>/front/general/statis/login" method="POST">
										<input type="text" name="email" maxlength="35" class="form-control"
											placeholder="E-mail*">
										<input type="password" maxlength="25" name="password" class="form-control"
											placeholder="Password*">
										<button type="submit" class="btn">Login</button>
									</form>
									<!-- /form -->
									<div class="title">ATAU</div>
									<div class="bottom-text">Buat <a
											href="<?=base_url();?>/front/general/statis/registrasi">Akun Baru</a></div>

									<?php } else { 
										$id = shl_session::get("id_pelanggan");
										$mem = shl_db::table("pelanggan")->where("id_pelanggan", $id)->single();
										?>

									<div class="title">Hallo, <?=$mem['nama'];?></div>
									<div class="top-text">Selamat Datang di GAPKTAN Gading Rejo.</div>


									<?php };?>

								</div>
							</div>
							<!-- /Header Account -->
						</div>
						<!-- /Header Links -->
						<!-- Header Search -->
						<div class="header-link header-search header-search">
							<div class="exp-search">
								<form method="GET" action="<?=base_url();?>/front/general/statis/cari">
									<input class="exp-search-input" placeholder="Kata Kunci" type="text" name="kw"
										value="">
									<input class="exp-search-submit" type="submit" value="">
									<span class="exp-icon-search"><i class="icon icon-magnify"></i></span>
									<span class="exp-search-close"><i class="icon icon-close"></i></span>
								</form>
							</div>
						</div>
						<!-- /Header Search -->
						<!-- Logo -->
						<div class="header-logo">
							<a href="<?=base_url();?>" title="Logo"><img src="<?=base_url();?>/resources/logoheader.png"
									width="200px" height="50px">
						</div>
						<!-- /Logo -->
						<!-- Mobile Menu -->
						<div class="mobilemenu dblclick">
							<div class="mobilemenu-header">
								<div class="title">MENU</div>
								<a href="<?=base_url();?>/resources/seiko/#" class="mobilemenu-toggle"></a>
							</div>
							<div class="mobilemenu-content">
								<ul class="nav">
									<li><a href="<?=base_url();?>">Home</a></li>
									<li><a href="<?=base_url();?>/front/general/statis/kategori/?id=Paket">Galery</a>
									</li>
									<?php  if (shl_session::get("status") == 'Reseller') { ?>
									<li><a href="<?=base_url();?>/front/general/statis/kategori/?id=Sparepart">
											Reseller</a></li>
									<?php };?>



									<?php 

									if (empty(shl_session::get("id_pelanggan"))) { ?>
									<li><a href="<?=base_url();?>/front/general/statis/registrasi">Registrasi</a></li>
									<li><a href="<?=base_url();?>/front/general/statis/login">Login</a></li>
									<?php } else { ?>
									<li><a href="<?=base_url();?>/front/general/statis/order">Order</a></li>
									<li><a href="<?=base_url();?>/front/general/statis/cart">Cart</a></li>

									<li><a href="<?=base_url();?>/front/general/statis/logout">Logout</a></li>
									<?php };?>

								</ul>
							</div>
						</div>
						<!-- Mobile Menu -->
						<!-- Mega Menu -->
						<div class="megamenu fadein blackout">
							<ul class="nav">
								<li><a href="<?=base_url();?>">Home</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/tentangkami">Tentang Kami</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/promosi_produk">Promosi</a></li>
								<?php  if (shl_session::get("status") == 'Reseller') { ?>
								<li><a href="<?=base_url();?>/front/general/statis/kategori/?id=Reseller"> Reseller</a>
								</li>
								<?php };?>

								<li><a href="<?=base_url();?>/front/general/galery/index">Galery</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/panduan">Panduan</a></li>
								<?php 

									if (empty(shl_session::get("id_pelanggan"))) { ?>
								<?php } else { ?>
								<li><a href="<?=base_url();?>/front/general/statis/order">Order</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/cart">Cart</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/profil">Profile</a></li>
								<li><a href="<?=base_url();?>/front/general/statis/logout">Logout</a></li>
								<?php };?>
							</ul>
						</div>
						<!-- /Mega Menu -->
					</div>
				</div>
			</header>
			<!-- /Header -->
			<!-- content -->
			<?=shl_view::render_body("index");?>
			<!-- end content -->

			<!-- Footer -->
			<footer class="page-footer variant2 fullboxed" style="background: #00BFFF">

				<div class="footer-middle">
					<div class="container">
						<div class="row">


							<div class="col-md-6 col-lg-6">
								<div class="footer-block collapsed-mobile">
									<div class="title">
										<h4>MY MENU</h4>
										<div class="toggle-arrow"></div>
									</div>
									<div class="collapsed-content">
										<ul class="marker-list">


											<?php 
									if (empty(shl_session::get("id_pelanggan"))) { ?>
											<li><a
													href="<?=base_url();?>/front/general/statis/registrasi">Registrasi</a>
											</li>
											<li><a href="<?=base_url();?>/front/general/statis/login">Login</a></li>
											<?php } else { ?>
											<li><a href="<?=base_url();?>/front/general/statis/order">Order</a></li>
											<li><a href="<?=base_url();?>/front/general/statis/cart">Cart</a></li>

											<li><a href="<?=base_url();?>/front/general/statis/logout">Logout</a></li>
											<?php };?>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-6 col-lg-6">
								<div class="footer-block collapsed-mobile">
									<div class="title">
										<h4>CONTACT US</h4>
										<div class="toggle-arrow"></div>
									</div>
									<div class="collapsed-content">
										<ul class="simple-list">
											<li><i class="icon icon-phone"></i>0811725401</li>
											<li><i
													class="icon icon-close-envelope"></i>gapoktan.gadingrejo@gmail.com</a>
											</li>
											<li><i class="icon icon-clock"></i>09:00 - 17:00</li>
										</ul>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p class="text-center"> Copyright @2020 Kiki Rejeki </p>
			</footer>
			<!-- /Footer -->
			<a class="back-to-top back-to-top-mobile" href="<?=base_url();?>/resources/seiko/#">
				<i class="icon icon-angle-up"></i> To Top
			</a>
		</div>
		<!-- Page Content -->
	</div>

	<!-- Modal Quick View -->
	<div class="modal quick-view zoom" id="quickView">
		<div class="modal-dialog">
			<div class="modalLoader-wrapper">
				<div class="modalLoader bg-striped"></div>
			</div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">&#10006;</button>
			</div>
			<div class="modal-content">
				<iframe></iframe>
			</div>
		</div>
	</div>
	<!-- /Modal Quick View -->


	<!-- jQuery Scripts  -->
	<script src="<?=base_url();?>/resources/seiko/js/vendor/jquery/jquery.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/bootstrap/bootstrap.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/swiper/swiper.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/slick/slick.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/parallax/parallax.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/isotope/isotope.pkgd.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/magnificpopup/dist/jquery.magnific-popup.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/countdown/jquery.countdown.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/nouislider/nouislider.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/ez-plus/jquery.ez-plus.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/tocca/tocca.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/bootstrap-tabcollapse/bootstrap-tabcollapse.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/scrollLock/jquery-scrollLock.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/darktooltip/dist/jquery.darktooltip.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/vendor/instafeed/instafeed.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/megamenu.min.js"></script>
	<script src="<?=base_url();?>/resources/seiko/js/app.js"></script>


	<div class="modal" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php $pro = shl_db::table("produk")->single(); ?>

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
												<a href="#"><img class="product-image-photo"
														src="<?=base_url();?>/resources/public/images/<?=$pro['gambar_produk'];?>"
														alt=""></a>
											</div>

										</div>

									</div>
									<!-- /product inside carousel -->
									<!-- Product Actions -->
									<div class="product-item-actions">
										<div class="actions-primary">
											<a href="#">
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
											class="product-item-link"><?=$pro['nama_produk'];?></a>
									</div>
									<div class="product-item-description"><?=$pro['deskripsi_produk'];?> </div>
									<div class="price-box"> <span class="price-container"> <span class="price-wrapper">
												<span class="old-price"></span> <br><span
													class="special-price"><?=$pro['harga_produk'];?></span> </span>
										</span>
									</div>
								</div>
								<!-- /Product Details -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
  		$(document).ready(function() {
			if (window.location.href == 'http://localhost/gapoktan/') {
				$(window).on('load', function () {
					$('#myModal').modal('show');
				});
			}
		});
		
	</script>
</body>

</html>