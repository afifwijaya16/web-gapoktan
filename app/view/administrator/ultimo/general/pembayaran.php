<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
    <section class="content-header">
      <h1>
        Data Pembayaran
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Pembayaran</a></li>
      </ol>
    </section>
    <?php
    if (empty($act))
    {
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Metode</th>
                                <th>Bukti Transfer</th>
                                <th>Lihat</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tgl. Transfer</th>                                
                                <th align="center"></th>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($pembayaran as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['id_transaksi'];?></td>
                                <td><?=$row['metode_pembayaran'];?></td>                                
                                <td><img src="<?=shl_view::resources("public/images/".$row['bukti_transfer']);?>" class="img-responsive" style="width:200px; margin-bottom:10px;"></td>
                                <td><a class="btn btn-success btn-sm" href="<?=shl_view::resources("public/images/".$row['bukti_transfer']);?>" target="_blank">
                            <i class="glyphicon glyphicon-eye"></i> Lihat</a></td>
                                <td><?=$row['status_pembayaran'];?></td>
                                <td><?=$row['keterangan_pembayaran'];?></td>


                                <td><?php $tgl = explode(" ",$row['tgl_pembayaran']);
                                    echo tgl_indo($tgl[0]);?> - <?=$tgl[1];?> WIB
                                </td>

                                <?php if ($users['isAdmin'] == 0) {?>
                                <td align="center">

                        <a class="btn btn-success btn-sm" href="<?=base_url();?>/administrator/general/pembayaran/perbaiki/<?=$row['id_pembayaran'];?>">
                            <i class="glyphicon glyphicon-edit"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/pembayaran/hapus/<?=$row['id_pembayaran'];?>">
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
    }     else if ($act == "perbaiki")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/pembayaran/perbaiki/<?=$pembayaran['id_pembayaran'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Pelanggan</span> </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label> 
                            <select class="form-control" name="status_pembayaran">
                                <option><?=$pembayaran['status_pembayaran'];?></option>
                                <option>Done</option>
                                <option>Failed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan Pembayaran</label> 
                            <input class='form-control' type='text' name='keterangan_pembayaran' value='<?=$pembayaran['keterangan_pembayaran'];?>' />
                        </div>


                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/pembayaran"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
