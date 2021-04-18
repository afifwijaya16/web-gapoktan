<?php ob_start(); ?>

<main class="page-main">
	<div class="block">
		<div class="container">
			<div class="text-center bottom-space">
				<h1 class="size-lg no-padding">Promosi Produk Kami </h1>
				<div class="line-divider"></div>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<?php $no = 0; foreach ($statis as $row) { $no++; ?>
		<div class="row">
            <!-- Center column -->
            <div class="col-md-6">
                <div class="blog-post">
                    <div class="blog-content">
                        <h3 class="blog-title"><?=$row['judul'];?></h3>
                        <h3 class="blog-title"><?=$row['tgl_posting'];?></h3>
						<div class="blog-text">
							<div class="box-body">
								<div class="row">
									<div class="col-md-6">
										<img src="<?=base_url();?>/resources/public/images/<?php echo $row['gambar'];?>" style="width:100%">
									</div>
									<div class="col-md-6">
										<p class="card-text"><?php echo $row['isi_halaman'];?></p>
									</div>
								</div>
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