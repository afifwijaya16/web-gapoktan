<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
    <section class="content-header">
      <h1>
        Data Ongkir
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Ongkir</a></li>
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
              <h3 class="box-title">Data Ongkir</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Ongkir</th>
                                <th><a href="<?=base_url();?>/administrator/general/ongkir/tambah" class="btn btn-success btn-sm">
                      <i class="glyphicon glyphicon-plus"></i></a></th>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($ongkir as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['kabupaten'];?></td>
                                <td><?=$row['kecamatan'];?></td>
                                <td><?=rupiah($row['harga_ongkir']);?></td>

                                <td align="center">
                        <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/ongkir/perbaiki/<?=$row['id_ongkir'];?>">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/ongkir/hapus/<?=$row['id_ongkir'];?>">
                            <i class="glyphicon glyphicon-trash"></i></a>
                        </td> 

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
    <form method="post" action="<?=base_url();?>/administrator/general/ongkir/tambah" enctype="multipart/form-data">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Ongkir</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Kabupaten</label> 
                            <input class='form-control' type='text' name='kabupaten' value='' />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kecamatan</label> 
                            <input class='form-control' type='text' name='kecamatan' value='' />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ongkir</label> 
                            <input class='form-control' type='text' name='harga_ongkir' value='' />
                        </div>



                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/ongkir"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    <form method="post" action="<?=base_url();?>/administrator/general/ongkir/perbaiki/<?=$ongkir['id_ongkir'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Ongkir</span> </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kabupaten</label> 
                            <input class='form-control' type='text' name='kabupaten' value='<?=$ongkir['kabupaten'];?>' />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kecamatan</label> 
                            <input class='form-control' type='text' name='kecamatan' value='<?=$ongkir['kecamatan'];?>' />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ongkir</label> 
                            <input class='form-control' type='text' name='harga_ongkir' value='<?=$ongkir['harga_ongkir'];?>' />
                        </div>


                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/ongkir"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
