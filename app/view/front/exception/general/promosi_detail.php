<?php
ob_start();
$pro = shl_db::table("statis")->where("id_halaman",url_segment(5))->single();
?>
<!-- Page Content -->
<main class="page-main">
    <div class="block">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="index.html"><i class="icon icon-home"></i></a></li>
                <li>/<span>Detail Statis</span></li>
            </ul>
        </div>
    </div>

    <div class="block product-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <!-- Product Gallery -->
                    <div class="main-image">
                        <img src="<?=base_url();?>/resources/public/images/<?php echo $pro['gambar'];?>" class="zoom"
                            alt=""
                            data-zoom-image="<?=base_url();?>/resources/public/images/<?php echo $pro['gambar'];?>" />
                        <div class="dblclick-text"><span>Double click for zoom</span></div>
                        <a href="<?=base_url();?>/resources/public/images/<?php echo $pro['gambar'];?>" class="zoom-link"><i
                                class="icon icon-zoomin"></i></a>
                    </div>

                    <!-- /Product Gallery -->
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="product-info-block classic">

                        <div class="product-name-wrapper">
                            <h1 class="product-name"><?=$pro['judul'];?></h1>
                        </div>
                        <div class="product-actions">
                            <p class="card-text">
								<?php echo $pro["isi_halaman"];?>
							</p>
                        </div>
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