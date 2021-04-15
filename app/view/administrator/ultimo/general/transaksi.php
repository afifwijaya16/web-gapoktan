<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->

    <?php
    if (empty($act))
    {
    ?>
    <section class="content-header">
      <h1>
        Data Transaksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Transaksi</h3>
              <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/transaksi/pelanggan">Tambah</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-btransaksied table-striped">
                <thead>
                <tr>
                                <th>ID Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Ongkir</th>
                                <th>Grand Total</th>
                                <th>Alamat Pengiriman</th>
                                <th>Status</th>
                                <th>Tgl.</th>
                                <th>Action</th>


                
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($transaksi as $row)
                            {


                                     if ($row['berat'] <= 1000) {
                                        $total_ongkir=$row['harga_ongkir'];
                                     } else if ($row['berat'] >= 1000) {
                                        $total_ongkir=$row['harga_ongkir'] * 2;                                        
                                     }

                            if($row['kabupaten'] == 'Bandar Lampung') {
                                $ongkos = 150000;
                            } else {
                                $ongkos = 200000;
                            }


                            $no++;
                            ?>
                            <tr>
                                <td><?=$row['id_transaksi'];?></td>
                                <td><?=$row['nama'];?> - <?=$row['telepon'];?></td>
                                <td>
                                    
                                    <table width="100%" class="table table-bordered table-striped">
                                        <?php
                                        $keranjang = shl_db::table("keranjang")->join("produk","produk.id_produk","keranjang.id_produk")->where("id_transaksi", $row['id_transaksi'])->get();
                                        foreach ($keranjang as $val) { ?>
                                        <tr>
                                            <td><?=$val['nama_produk'];?> | <?=$val['jumlah_pesanan'];?> x <?=rupiah($val['harga_beli']);?> = <?=rupiah($total=$val['jumlah_pesanan'] * $val['harga_beli']);?>  <br> </td>
                                        </tr>
                                        <?php };?>

                                    </table>                                    
                                </td>
                                <td><?=rupiah($total_ongkir);?></td>
                                <td>
                                    <?php 
                                    if ($row['jasa_pasang'] == 'Dipasangkan') {
                                    
                                    echo rupiah($grand=$row['grandtotal'] + $total_ongkir + $ongkos);

                                    } else {

                                    echo rupiah($grand=$row['grandtotal'] + $total_ongkir);                                        
                                    }
                                        
                                    ?>

                                    </td>
                                    
                                <td><?=$row['alamat_pengiriman'];?>, <?=$row['kecamatan'];?>, <?=$row['kabupaten'];?></td>
                               <td><?=$row['status_transaksi'];?></td>

                                <td><?php $tgl = explode(" ",$row['tgl_transaksi']);
                                    echo tgl_indo($tgl[0]);?> <?=$tgl[1];?>
                                </td>


                                <?php if ($users['isAdmin'] == 0) {?>
                                <td align="center">
                        <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/transaksi/perbaiki/<?=$row['id_transaksi'];?>">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/transaksi/hapus/<?=$row['id_transaksi'];?>">
                            <i class="glyphicon glyphicon-trash"></i></a>
                        </td> <?php };?>

                            </tr>
                            <?php } ?>
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?php
    }
    else if ($act == "perbaiki")
    {
    ?>
    <section class="content-header">
      <h1>
        Data Transaksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
      </ol>
    </section>

    <form method="post" action="<?=base_url();?>/administrator/general/transaksi/perbaiki/<?=$transaksi['id_transaksi'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Transaksi</span> </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status Transaksi</label> 
                            <select class="form-control" name="status_transaksi">
                                <option><?=$transaksi['status_transaksi'];?></option>
                                <option>On Progress</option>
                                <option>Done</option>
                            </select>
                        </div>

                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/transaksi"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    } else if ($act == "laporan_pendapatan"){ ?>

    <div class="col-sm-12">

        <form method="post" action="<?=base_url();?>/laporan/index.php" target="_blank" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-heading"> Laporan <span class="semi-bold">Pendapatan</span> </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Dari Tanggal</label> 
                                <input class='form-control' type='date' name='dari_tgl' value='' />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sampai Tanggal</label> 
                                <input class='form-control' type='date' name='sampai_tgl' value='' />
                            </div>


                        </div>
                    </section>
                </div>
                
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Cetak</button>

                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
    <?php } else if ($act == "laporan_stok"){ ?>
   

    <div class="col-sm-12">

        <form method="post" action="<?=base_url();?>/laporan/stok.php" target="_blank" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-heading"> Laporan <span class="semi-bold">Stok</span> </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Dari Tanggal</label> 
                                <input class='form-control' type='date' name='dari_tgl' value='' />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sampai Tanggal</label> 
                                <input class='form-control' type='date' name='sampai_tgl' value='' />
                            </div>


                        </div>
                    </section>
                </div>
                
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Cetak</button>

                        </div>
                    </section>
                </div>
            </div>
        </form>

    </div>
    <?php } else if ($act == "laporan_pembeli"){ ?>
    <div class="col-sm-12">

        <form method="post" action="<?=base_url();?>/laporan/pembeli.php" target="_blank" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-heading"> Laporan <span class="semi-bold">Pelanggan</span> </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Dari Tanggal</label> 
                                <input class='form-control' type='date' name='dari_tgl' value='' />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sampai Tanggal</label> 
                                <input class='form-control' type='date' name='sampai_tgl' value='' />
                            </div>


                        </div>
                    </section>
                </div>
                
                <div class="col-sm-12">
                    <section class="panel default blue_title h4">
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Cetak</button>

                        </div>
                    </section>
                </div>
            </div>
        </form>

    </div>


    <?php }  else if ($act == "grafik") { ?>
            <div class="col-sm-12">

    <form method="post" action="<?=base_url();?>/grafik/penjualan.php" target="_blank" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Grafik <span class="semi-bold">Penjualan</span> </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Dari Bulan</label>
                            <select class="form-control" name="dari_bulan">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sampai Bulan</label>
                            <select class="form-control" name="sampai_bulan">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun</label>
                            <select class="form-control" name="tahun">

                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                            </select>
                        </div>


                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Cetak</button>

                    </div>
                </section>
            </div>
        </div>
    </form>

            </div>

            <div class="col-sm-12">

    <form method="post" action="<?=base_url();?>/grafik/pendapatan.php" target="_blank" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Grafik <span class="semi-bold">Pendapatan</span> </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Dari Bulan</label>
                            <select class="form-control" name="dari_bulan">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sampai Bulan</label>
                            <select class="form-control" name="sampai_bulan">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tahun</label>
                            <select class="form-control" name="tahun">

                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                            </select>
                        </div>



                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Cetak</button>

                    </div>
                </section>
            </div>
        </div>
    </form>

            </div>



    <?php
    }
    else if ($act == "pelanggan")
    {
    ?>
  <form method="post" action="<?=base_url();?>/administrator/general/transaksi/pelanggan/" enctype="multipart/form-data">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi - Step 1</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Pelanggan</label> 
                            <?=shl_form::dropdown("id_pelanggan", shl_db::table("pelanggan")->select("id_pelanggan, concat(nama,' - ',telepon) as nama"), "", ["class" => "form-control"]);?>
                        </div>



                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Next</button>

                    </div>
                </section>
            </div>
        </div>

          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </form>
    <?php
    } else if ($act == "keranjang")
    {
    ?>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->


        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi - Step 2</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">

<table class="table table-bordered">
           <tr>

                                <td>No</td>
                                <td>Produk</td>
                                <td>Stok (PCS)</td>
                                <td>Harga</td>
                                <td>QTY</td>
                                <td>Action</td>
                                <tr>
        <?php
        $produk = shl_db::table("produk")->get();

        foreach ($produk as $row) { 

            $n++;

            ?>
        
    <form method="post" action="<?=base_url();?>/administrator/general/transaksi/keranjang/<?=url_segment(5);?>?eks=tambah" >
       <tr>

                                <td><?=$n;?></td>
                                <td><?=$row['nama_produk'];?></td>
                                <td><?=$row['stok'];?></td>
                                <td><?=rupiah($row['harga_produk']);?></td>

                                <td>
                                    <?php 
                                    $pel = shl_db::table("transaksi")->where("id_pelanggan", url_segment(5))->order_by("tgl_transaksi", desc)->single();

                                    ?>

                                    <input type='hidden' name='id_transaksi' value='<?=$pel['id_transaksi'];?>'/>
                                    <input type='hidden' name='harga_beli' value='<?=$row['harga_produk'];?>'/>
                                    <input type='hidden' name='id_produk' value='<?=$row['id_produk'];?>'/>
 
                                    <input class='form-control' type='number' required='required' name='jumlah_pesanan' value='' placeholder="Jumlah" /> 

                                </td>
                                <td> <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i></button></td>
        <tr>
    </form>

        <?php 
       } 
        ?>
</table>


                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">

            </div>
            </div>


          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <form method="post" action="<?=base_url();?>/administrator/general/transaksi/keranjang/<?=url_segment(5);?>?ts=<?=$pel['id_transaksi'];?>" >
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi - Step 2</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">


                                        <table class="table table-no-border">
                        <tbody>
                            <?php
                            $keranjang = shl_db::table("keranjang")->join("produk","produk.id_produk","keranjang.id_produk")->where("keranjang.id_transaksi",$pel['id_transaksi'])->get();
                            $no = 0;
                            $grandtotal = 0;
                            $totalberat = 0;
                            foreach ($keranjang as $pl)
                            {

                            $no++;
                            ?>
                            <tr>
                                <td><?=$pl['nama_produk'];?></td>
                                <td> <?=$pl['jumlah_pesanan'];?> x <?=rupiah($pl['harga_beli']);?> </td>
                                <td><?=rupiah($sub_total=$pl['jumlah_pesanan'] * $pl['harga_beli']);?></td>
                                <td><a href="<?=base_url();?>/administrator/general/transaksi/keranjang/<?=url_segment(5);?>/<?=$pl['id_keranjang'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data akan dihapus ?')"><i class="fa fa-trash-o"></i> </a></td>
                            
                            </tr>
                            <?php $grandtotal += $sub_total; 
                                    $totalberat += $pl['berat'];

                                } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b><?=rupiah($grandtotal);?></b></td>
                                <td></td>

                            </tr>

                        </tbody>
                    </table>


                        <h2>Alamat Pengiriman</h2>
                        <input type='hidden' name='status_transaksi' value='Pending'/>
                        <input type='hidden' name='grandtotal' value='<?=$grandtotal;?>'/>
                        <input type='hidden' name='total_berat' value='<?=$totalberat;?>'/>



                                 <div class="form-group">
                                <label>Kabupaten - Kecamatan - Ongkir/Kg</label>
                            <?=shl_form::dropdown("id_ongkir", shl_db::table("ongkir")->select("id_ongkir, concat(kabupaten,' - ',kecamatan,' - ',harga_ongkir) as nama")->order_by("id_ongkir", ASC), "", ["class" => "form-control dashed"]);?>
                        </div>

                                     <div class="form-group">
                                    <label>Alamat Pengiriman</label>
                                    <textarea class="form-control dashed" name="alamat_pengiriman" required="required">
                                    </textarea>
                                </div>

                                    


                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <a href="<?=base_url();?>/administrator/general/transaksi/perbaiki/<?=url_segment(5);?>?bayar=1">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Next</button></a>

                    </div>
                </section>
            </div>
            </div>
                </form>


          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->



      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
