<?php
ob_start();
$pending = shl_db::table("transaksi")->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->join("pelanggan","pelanggan.id_pelanggan","transaksi.id_pelanggan")->select("COUNT(id_transaksi) as status")->where("status_transaksi", "Pending")->single();
$progress = shl_db::table("transaksi")->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->join("pelanggan","pelanggan.id_pelanggan","transaksi.id_pelanggan")->select("COUNT(id_transaksi) as status")->where("status_transaksi", "On Progress")->single();
$done = shl_db::table("transaksi")->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->join("pelanggan","pelanggan.id_pelanggan","transaksi.id_pelanggan")->select("COUNT(id_transaksi) as status")->where("status_transaksi", "Done")->single();
?>
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$pending['status'];?></h3>

              <p>Transaksi Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$progress['status'];?></h3>

              <p>Transaksi On Progress</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$done['status'];?></h3>

              <p>Transaksi Done</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>

          </div>
        </div>        



        <!-- ./col -->
      </div>
      <!-- /.row -->

    
  <img src="<?=base_url();?>/resources/homeadmin.jpg" style="width:100%">
</p>
            
            
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
shl_view::layout("administrator/ultimo/index", ob_get_clean());
?>