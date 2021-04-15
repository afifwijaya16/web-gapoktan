<?php
ob_start();
?>

			<!-- Page Content -->
			<main class="page-main">
				<div class="block">
					<div class="container">
						<ul class="breadcrumbs">
							<li><a href="<?=base_url;?>"><i class="icon icon-home"></i></a></li>
							<li>/<span>Orderan Saya</span></li>
						</ul>
					</div>
				</div>
				<div class="block">
					<div class="container">
						<table width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Ongkir</th>
                                <th>Grandtotal</th>
                                <th>Alamat Pengiriman</th>
                                <th>Status</th>
                                <th>Tgl</th>
                                <th>Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Ket</th>                                

                    </a></th>
                </tr>
                </thead>							

                <tbody>
								<?php 
								$transaksi = shl_db::table("transaksi")->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->where("id_pelanggan", shl_session::get("id_pelanggan"))->get();
								foreach ($transaksi as $row) { 
                                    $pembayaran = shl_db::table("pembayaran")->where("id_transaksi", $row['id_transaksi'])->order_by("tgl_pembayaran", DESC)->single();
									$no++;

                                     if ($row['berat'] <= 1000) {
                                        $total_ongkir=$row['harga_ongkir'];
                                     } else if ($row['berat'] >= 1000) {
                                        $total_ongkir=$row['harga_ongkir'] * 2;                                        
                                     }


									?>                 	

                            <tr>
                                <td><?=$no;?></td>
                                <td>
                                	<table width="100%" class="table table-bordered table-striped">
                                		<?php
                                		$keranjang = shl_db::table("keranjang")->join("produk","produk.id_produk","keranjang.id_produk")->where("id_transaksi", $row['id_transaksi'])->get();
                                		foreach ($keranjang as $val) { ?>

                                		<tr>
                                			<td><a href="<?=base_url()."/front/general/statis/detail_produk/".$val['id_produk'];?>"><?=$val['nama_produk'];?></a> | <?=$val['jumlah_pesanan'];?> x <?=rupiah($val['harga_beli']);?> = <?=rupiah($total=$val['jumlah_pesanan'] * $val['harga_produk']);?>  <br> </td>
                                		</tr>
                                		<?php };?>

                                	</table>


                                </td>
                                <td><?=rupiah($total_ongkir);?></td>
                                <td><?=rupiah($grand=$row['grandtotal'] + $total_ongkir);?></td>
                                <td><?=$row['alamat_pengiriman'];?>, <?=$row['kecamatan'];?>, <?=$row['kabupaten'];?></td>
                                <td><?=$row['status_transaksi'];?></td>
                                <td><?php $tgl = explode(" ",$row['tgl_transaksi']);
                                    echo tgl_indo($tgl[0]);?> <?=$tgl[1];?>
                                </td>
                                <td><?php if ($pembayaran['status_pembayaran'] != 'Done') {?> <a href="<?=base_url();?>/front/general/statis/pembayaran/?id=<?=$row['id_transaksi'];?>&rp=<?=$grand;?>"><button class="btn btn-sm btn-invert add-to-cart"> <i class="icon icon-dollar"></i><span>BAYAR</span> </button></a><?php };?></td>
                                <td><?=$pembayaran['status_pembayaran'];?></td>
                                <td><?=$pembayaran['keterangan_pembayaran'];?></td>
                            </tr>
                        <?php };?>

                </tbody>

						</table>


					</div>
				</div>
			</main>
			<!-- /Page Content -->
			<?php
shl_view::layout("front/exception/index",ob_get_clean());
?>