<?php
ob_start();
?>

<main class="page-main">
	<div class="block">
		<div class="container">
			<div class="text-center bottom-space">
				<h1 class="size-lg no-padding">Galery </h1>
				<div class="line-divider"></div>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<?php $no = 0; foreach ($galery as $row) { $no++; ?>
		<div class="row">
            <!-- Center column -->
            <div class="col-md-2">
                <div class="blog-post">
                    <div class="blog-content">
                        <h3 class="blog-title"><?=$row['judul'];?></h3>
						<div class="blog-text">
							<div class="box-body">
								<img src="<?=base_url();?>/resources/public/images/<?php echo $row['gambar'];?>" style="width:150px; height:150px;">
								<p class="card-text"><?php echo $row['isi_galery'];?></p>
                                <h3 class="blog-title"><?=$row['tgl_posting'];?></h3>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<?php } ?>
	</div>
</main>

<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>