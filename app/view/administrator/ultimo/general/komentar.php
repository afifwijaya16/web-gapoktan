<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
    <section class="content-header">
      <h1>
        Data Komentar
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Komentar</a></li>
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
              <h3 class="box-title">Data Komentar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Status</th>
                                <th>Balas</th>
                                <th></th>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($komentar as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['nama'];?> <?=$row['telepon'];?></td>
                                <td><?=$row['nama_produk'];?></td>
                                <td><?=$row['rating'];?></td>
                                <td><?=$row['komentar'];?></td>
                                <td><?=$row['status_komentar'];?></td>
                                <td><a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/komentar/tambah/<?=$row['id_komentar'];?>">
                            <i class="glyphicon glyphicon-pencil"></i> Balas</a></td>


                                <td align="center">
                        <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/komentar/perbaiki/<?=$row['id_komentar'];?>">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/komentar/hapus/<?=$row['id_komentar'];?>">
                            <i class="glyphicon glyphicon-trash"></i></a>
                        </td> 

                            </tr>

                            <?php 
                            $balasan = shl_db::table("komentar")->join("produk","produk.id_produk","komentar.id_produk")->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")->where("id_balasan", $row['id_komentar'])->order_by("id_komentar", ASC)->get();
                            foreach ($balasan as $val) {
                            ?>

                            <tr>
                                <td></td>
                                <td><?=$val['nama'];?> <?=$val['telepon'];?></td>
                                <td><?=$val['nama_produk'];?></td>
                                <td><?=$val['rating'];?></td>
                                <td><?=$val['komentar'];?></td>
                                <td><?=$val['status_komentar'];?></td>
                                <td></td>
                                <td align="center"></td> 

                            </tr>
                        <?php };?>

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
    else if ($act == "tambah")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/komentar/tambah" enctype="multipart/form-data">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Balas Komentar</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">
                        <?php 
                            $dkomentar = shl_db::table("komentar")->join("produk","produk.id_produk","komentar.id_produk")->join("pelanggan","pelanggan.id_pelanggan","komentar.id_pelanggan")->where("id_komentar", url_segment(5))->single();
                        ?>
                        <input type="hidden" name="id_balasan" value="<?=$dkomentar['id_komentar'];?>">
                        <input type="hidden" name="id_users" value="<?=shl_session::get("id_users");?>">
                        <input type="hidden" name="id_produk" value="<?=$dkomentar['id_produk'];?>">
                        <input type="hidden" name="id_pelanggan" value="<?=$dkomentar['id_pelanggan'];?>">
                        <input type="hidden" name="rating" value="<?=$dkomentar['rating'];?>">
                        <input type="hidden" name="status_komentar" value="<?=$dkomentar['status_komentar'];?>">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Pelanggan</label> 
                            <input type="text" class="form-control" value="<?=$dkomentar['nama'];?>" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Produk</label> 
                            <input type="text" class="form-control" value="<?=$dkomentar['nama_produk'];?>" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Komentar</label> 
                            <textarea class="form-control" readonly="readonly">
                                <?=$dkomentar['komentar'];?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Balasan</label> 
                            <textarea class="form-control" name="komentar">
                                
                            </textarea>
                        </div>



                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/komentar"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    }
    else if ($act == "perbaiki")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/komentar/perbaiki/<?=$komentar['id_komentar'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Status</span> </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label> 
                            <select class="form-control" name="status_komentar">
                                <option>Komentar</option>
                                <option>Testimoni</option>
                                
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
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/komentar"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
