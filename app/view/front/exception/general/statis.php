<?php
ob_start();
?>
<div role="main" class="main">

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">WISATA LAMPUNG</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1><?=$statis['judul'];?></h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-posts">
                    <article class="post post-large">
                        <div class="post-content">
                            <div class="img-thumbnail">
                                <img class="img-responsive"
                                    src="<?=base_url();?>/resources/public/images/<?=$statis['gambar'];?>" alt=""
                                    width="100%">
                            </div>

                            <h2><a href="#"><?=$statis['judul'];?></a></h2>
                            <p><?=$statis['isi_halaman'];?></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>