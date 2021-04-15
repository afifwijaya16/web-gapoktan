<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
    <section class="content-header">
      <h1>
        Data Pelanggan
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Pelanggan</a></li>
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
              <h3 class="box-title">Data Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Status</th>
                                <td align="center"><a class="btn btn-success btn-sm" href="<?=base_url();?>/administrator/general/pelanggan/tambah/"><i class="glyphicon glyphicon-plus"></i></a></td>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($pelanggan as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['nama'];?></td>
                                <td><?=$row['telepon'];?></td>
                                <td><?=$row['email'];?></td>
                                <td><?=$row['status_pelanggan'];?></td>



                                <?php if ($users['isAdmin'] == 0) {?>
                                <td align="center">
                         <a class="btn btn-success btn-sm" href="<?=base_url();?>/administrator/general/pelanggan/perbaiki/<?=$row['id_pelanggan'];?>">
                            <i class="glyphicon glyphicon-edit"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/pelanggan/hapus/<?=$row['id_pelanggan'];?>">
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
    else if ($act == "tambah")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/pelanggan/tambah" enctype="multipart/form-data">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pelanggan</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label> 
                            <input class='form-control' type='text' name='nama' value='' />
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label> 
                            <input class='form-control' type='text' name='telepon' value='' />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label> 
                            <input class='form-control' type='text' name='email' value='' />
                        </div>


                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/pelanggan"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    <form method="post" action="<?=base_url();?>/administrator/general/pelanggan/perbaiki/<?=$pelanggan['id_pelanggan'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Pelanggan</span> </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label> 
                            <input class='form-control' type='text' name='nama' value='<?=$pelanggan['nama'];?>' />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label> 
                            <input class='form-control' type='text' name='telepon' value='<?=$pelanggan['telepon'];?>' />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label> 
                            <input class='form-control' type='text' name='email' value='<?=$pelanggan['email'];?>' />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label> 
                            <select class="form-control" name="status_pelanggan">
                                <option>Umum</option>
                                <option>Reseller</option>
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
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/pelanggan"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
