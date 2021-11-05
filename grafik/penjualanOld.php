<!DOCTYPE html>
<?php
function getBulan($bln){
    switch ($bln){
     case 1:
      return "Januari";
      break;
     case 2:
      return "Februari";
      break;
     case 3:
      return "Maret";
      break;
     case 4:
      return "April";
      break;
     case 5:
      return "Mei";
      break;
     case 6:
      return "Juni";
      break;
     case 7:
      return "Juli";
      break;
     case 8:
      return "Agustus";
      break;
     case 9:
      return "September";
      break;
     case 10:
      return "Oktober";
      break;
     case 11:
      return "November";
      break;
     case $_POST[sampai_bulan]:
      return "Desember";
      break;
    }
   };

   function bln_aja($bulan_a){
   $bulan = getBulan(substr($bulan_a,5,2));
   return $bulan;  
 	}; 


?>
<html>
<head>
	<title>GRAFIK PENJUALAN</title>
	<script type="text/javascript" src="chartjs/Chart.js"></script>
</head>
<body>
	<style type="text/css">
	body{
		font-family: roboto;
	}

	table{
		margin: 0px auto;
	}
	</style>


	<center>
		<h2>GRAFIK PENJUALAN </h2>
	</center>


	<?php 
	include 'koneksi.php';
	?>

	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Bulan/Tahun</th>
				<th>Total Pendapatan</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$data = mysqli_query($koneksi,"SELECT SUM(jumlah_pesanan) as total, tgl_transaksi   FROM keranjang,transaksi WHERE keranjang.id_transaksi=transaksi.id_transaksi AND MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
			while($d=mysqli_fetch_array($data)){
               $tgl = explode(" ",$d['tgl_transaksi']);
               $tahun = explode("-",$tgl[0]);
				?>
				<tr>
					<td  align="center"><?php echo $no++; ?></td>
					<td><?=bln_aja($tgl[0]);?> <?=$tahun['0'];?></td>
					<td align="center"><?php echo $d['total']; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [
					<?php  $surat = mysqli_query($koneksi,"SELECT SUM(jumlah_pesanan) as total, tgl_transaksi   FROM keranjang,transaksi WHERE keranjang.id_transaksi=transaksi.id_transaksi AND MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
						while($row=mysqli_fetch_array($surat)){	
						$tahun = explode("-",$row['tgl_transaksi']); ?> 

					"<?=bln_aja($row['tgl_transaksi']);?> <?=$tahun[0];?>",

					<?php };?>
				],
				datasets: [{
					label: '',
					data: [ 
					<?php $surat = mysqli_query($koneksi,"SELECT SUM(jumlah_pesanan) as total, tgl_transaksi   FROM keranjang,transaksi WHERE keranjang.id_transaksi=transaksi.id_transaksi AND MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
					while($row=mysqli_fetch_array($surat)){	?> 
					<?=$row['total'];?>,
					<?php };?>
					],
					backgroundColor: [
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(54, 162, 235, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(255,99,132,1)'

					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>