<?php
ob_start();
?>
    <section class="content-header">
      <h1>
        Data Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
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
              <h3 class="box-title">Data Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th></th>
                                
                    </a></th>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($users as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['name'];?></td>
                                <td><?=$row['email'];?></td>
                                <td><?=$row['telepon'];?></td>

                                <?php if ($users['isAdmin'] == 0) {?>
                                <td align="center">
                        <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/users/users/perbaiki/<?=$row['id_users'];?>">
                            <i class="glyphicon glyphicon-pencil"></i></a>

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
    <form method="post" action="<?=base_url();?>/administrator/users/users/tambah" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Admin</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Admin</label>
                            <input class='form-control' type='text' name='name' value='' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label>
                            <input class='form-control' type='text' name='telepon' value='' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class='form-control' type='email' name='email' value='' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input class='form-control' type='password' name='password' value='' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Jabatan</label>
                            <select class="form-control" name="isAdmin">
                                <option value="1">Pimpinan</option>
                                <option value="0">Admin</option>
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
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/users/users"> Back <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    <form method="post" action="<?=base_url();?>/administrator/users/users/perbaiki/<?=$users['id_users'];?>" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Admin</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Admin</label>
                            <input class='form-control' type='text' name='name' value='<?=$users['name'];?>' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label>
                            <input class='form-control' type='text' name='telepon' value='<?=$users['telepon'];?>' required/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class='form-control' type='email' name='email' value='<?=$users['email'];?>' required/>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input class='form-control' type='password' name='password' value='<?=$users['password'];?>' required/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jabatan</label>
                            <select class="form-control" name="isAdmin">
                                <option value="1">Pimpinan</option>
                                <option value="0">Admin</option>
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
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/users/users"> Back <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
