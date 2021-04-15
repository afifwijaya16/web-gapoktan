<?php
ob_start();
?>

			<!-- /Header -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="index.html"><i class="icon icon-home"></i></a></li>
							<li>/<span>FAQ </span></li>
						</ul>
					</div>
				</div>

				<div class="block">
					<div class="container">
						<div class="title center">
							<h2>FAQ </h2>
						</div>
						<div class="row">


												<?php 
												$komentar = shl_db::table("komentar")->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")->where("id_balasan", 0)->where("komentar.status_komentar","FAQ")->get();
												foreach ($komentar as $row) { $n++; ?>
							<div class="col-sm-4">
								<div class="person">
									<div class="person-photo">
										<img src="images/person/person-01.jpg" alt="">
									</div>
									<div class="person-info">
										<h3 class="person-name">Nomor <?=$n;?></h3>
										<div class="person-subname">Pertanyaan</div>
										<p><?=$row['komentar'];?></p>
										<div class="person-subname">Jawaban</div>
										<?php $jawaban = shl_db::sql_query("SELECT * FROM komentar WHERE id_balasan='$row[id_komentar]' ORDER BY tgl_komentar ASC")->get();
												foreach ($jawaban as $jb) { ?>
										<p><?=$jb['komentar'];?></p>
									<?php };?>
	
									</div>
								</div>
							</div>
						<?php };?>


						</div>
					</div>
				</div>


			</main>
<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>