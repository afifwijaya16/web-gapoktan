<!DOCTYPE html>
<html lang="en">
<head>
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

     function rupiah($harga)
	{
		return "Rp ".number_format($harga,0,',','.');
	} 
?>

<?php 
	include 'koneksi.php';
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #container {
            height: 400px; 
        }

        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px; 
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
        table{
            margin: 0px auto;
        }
    </style>
</head>
<body>
    <figure class="highcharts-figure">
        <div id="container"></div>
        <!-- <p class="highcharts-description">
            Chart with buttons to modify options, showing how options can be changed
            on the fly. This flexibility allows for more dynamic charts.
        </p> -->

        <button id="plain">Plain</button>
        <button id="inverted">Inverted</button>
        <button id="polar">Polar</button>
    </figure>
    <div>
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
                $data = mysqli_query($koneksi,"SELECT SUM(grandtotal) as total, tgl_transaksi   FROM transaksi WHERE MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
                while($d=mysqli_fetch_array($data)){
                $tgl = explode(" ",$d['tgl_transaksi']);
                $tahun = explode("-",$tgl[0]);
                    ?>
                    <tr>
                        <td  align="center"><?php echo $no++; ?></td>
                        <td><?=bln_aja($tgl[0]);?> <?=$tahun['0'];?></td>
                        <td align="center"><?php echo rupiah($d['total']); ?></td>
                    </tr>
                    <?php 
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
    const chart = Highcharts.chart('container', {
        title: {
            text: 'GRAFIK PENDAPATAN'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                <?php 
					$surat = mysqli_query($koneksi,"SELECT SUM(grandtotal) as total, tgl_transaksi   FROM transaksi WHERE MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
					while($row=mysqli_fetch_array($surat)){	
                    $tahun = explode("-",$row['tgl_transaksi']);
						?> 

					"<?=bln_aja($row['tgl_transaksi']);?> <?=$tahun[0];?>",

					<?php };?>
            ]
        },
        series: [{
            type: 'column',
            colorByPoint: true,
            data: [
                <?php $surat = mysqli_query($koneksi,"SELECT SUM(grandtotal) as total, tgl_transaksi   FROM transaksi WHERE MONTH(tgl_transaksi) BETWEEN '$_POST[dari_bulan]' AND '$_POST[sampai_bulan]' AND YEAR(tgl_transaksi)='$_POST[tahun]'  GROUP BY MONTH(tgl_transaksi)");
					while($row=mysqli_fetch_array($surat)){	?> 

					<?=$row['total'];?>,

					<?php };?>
            ],
            showInLegend: false
        }]
    });

    document.getElementById('plain').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    document.getElementById('inverted').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    document.getElementById('polar').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });
    </script>
</body>
</html>