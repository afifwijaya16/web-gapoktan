<?php

include ("./mpdf/mpdf.php");



include "koneksi.php";



ob_start();

if (!function_exists("rupiah"))
{
  function rupiah($harga)
  {
    return "Rp ".number_format($harga,0,',','.');
  }
};

  function tgl_indo($tanggal)
  {
    $tgl = date("N d n Y",strtotime($tanggal));
    
    $splittgl = explode(" ",$tgl);

    $arr_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");

    $hari = $arr_hari[$splittgl[0]];

    $tgl = $splittgl[1];

    $arr_bulan = array(1=>"Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

    $bulan = $arr_bulan[$splittgl[2]];

    $tahun = $splittgl[3];

    return $hari.", ".$tgl." ".$bulan." ".$tahun."";
  };


?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>LAPORAN PENJUALAN/PENDAPATAN</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link href="bootstrap.min.css" rel="stylesheet" media="screen">

    

    <!-- css yang digunakan ketika dalam mode screen -->

    <link href="style.css" rel="stylesheet" media="screen">

    

    <!-- ss yang digunakan tampilkan ketika dalam mode print -->

    <link href="print.css" rel="stylesheet" media="print">

    

    <script src="jquery-1.8.3.min.js"></script>

    <script src="jquery.PrintArea.js"></script>

    <script>

        (function($) {

            // fungsi dijalankan setelah seluruh dokumen ditampilkan

            $(document).ready(function(e) {

                

                // aksi ketika tombol cetak ditekan

                $("#cetak").bind("click", function(event) {

                    // cetak data pada area <div id="#data-mahasiswa"></div>

                    $('#data-mahasiswa').printArea();

                });

            });

        }) (jQuery);

    </script>

    <style type="text/css">

    .tegak {

positon:absolute;

top:60px;

-moz-transform: rotate(-90deg);

-webkit-transform: rotate (-90deg);

-o-transform:rotate (-90deg);

-ms-transform:rotate(-90deg);

transform: rotate(-90deg);

margin-top: 18px;

}



    </style>

</head>



<body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;'>



<div class="container">

    <div class="val">

<img src="logoheader.png" height="80">
<table width="100%" border="0">
  <tr>
    <td align="center">
        <h3 align="center">LAPORAN PENJUALAN/PENDAPATAN</h3>
        <h2 align="center">GAPOKTAN GADING REJO</h2>
        



  </tr>
</table>
<hr>

        <div align="center"><h5 align="center">Periode : <?=$_POST['dari_tgl'];?> s/d <?=$_POST['sampai_tgl'];?> </h5></div>



        <div id="data-mahasiswa" align="left">

                            <table class="table table-bordered" width="100%">
                                <thead>

                                  <tr>
                                <th>No</th>
                                <th>ID Order</th>                                
                                <th>Nama Pelanggan</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>QTY</th>
                                <th>Sub Total</th>
                                <th>Tgl. Order</th>
                                  </tr>
                              </thead>
                            <tbody>

                            <?php
                            $grandtotal = 0;
                            $query=mysql_query("select * from keranjang,produk,pelanggan,transaksi,users WHERE users.id_users=produk.id_users AND keranjang.id_produk=produk.id_produk AND keranjang.id_pelanggan=pelanggan.id_pelanggan AND transaksi.id_transaksi=keranjang.id_transaksi AND date(tgl_transaksi) BETWEEN '$_POST[dari_tgl]' AND '$_POST[sampai_tgl]' ORDER BY tgl_transaksi DESC");


                            while ($row=mysql_fetch_array($query)) {

                              $no++;
                            ?>


                          <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['id_keranjang'];?></td>
                                <td><?=$row['nama'];?></td>
                                <td><?=$row['nama_produk'];?></td>
                                <td><?=rupiah($row['harga_beli']);?></td>                                
                                <td><?=$row['jumlah_pesanan'];?></td>
                                <td><?=rupiah($subtotal=$row['harga_beli'] * $row['jumlah_pesanan']); $grandtotal+=$subtotal; ?></td>
                                <td><?=tgl_indo($row['tgl_transaksi']);?></td>
  </tr>

                        
<?php };?>
                          <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>                                
                                <td><b>Omset</b></td>
                                <td><b><?=rupiah($grandtotal); ?></b></td>
                                <td></td>
  </tr>


                        </tbody>

                    </table>

<table width="100%" border="0">
  <tr>
    <td> Bandar Lampung, <?=date("d-M-Y");?> <br><br> Mengetahui, <br>Kepala GAPOKTAN  <br><br><br><br> NONI</td>
    <td><br><br><br> Admin <br><br><br><br><br> Sri Lestari</td>
  </tr>
</table>

</div>







</body>

</html>

<?php 





$mpdf = new Mpdf();

$mpdf->WriteHTML(ob_get_clean());

$mpdf->Output();

?>