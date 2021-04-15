<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
    <section class="content-header">
      <h1>
        Data Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Produk</a></li>
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
              <h3 class="box-title">Data Produk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Diskon</th>
                                <th>Berat</th>
                                <?php if ($users['isAdmin'] == 0) {?>
                                <th align="center"><a href="<?=base_url();?>/administrator/general/produk/tambah" class="btn btn-success btn-sm">
                      <i class="glyphicon glyphicon-plus"></i> <?php };?>
                    </a></th>
                </tr>
                </thead>
                <tbody>
                            <?php
                            $no = 0;
                            foreach ($produk as $row)
                            {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['nama_produk'];?></td>
                                <td><?=$row['kategori_produk'];?></td>
                                <td><?=rupiah($row['harga_produk']);?></td>
                                <td><?=$row['stok'];?></td>
                                <td><?=$row['diskon'];?>%</td>
                                <td><?=$row['berat'];?> Gram</td>


                                <?php if ($users['isAdmin'] == 0) {?>
                                <td align="center">
                        <a class="btn btn-primary btn-sm" href="<?=base_url();?>/administrator/general/produk/perbaiki/<?=$row['id_produk'];?>">
                            <i class="glyphicon glyphicon-pencil"></i></a>
                         <a class="btn btn-danger btn-sm" href="<?=base_url();?>/administrator/general/produk/hapus/<?=$row['id_produk'];?>">
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
    <form method="post" action="<?=base_url();?>/administrator/general/produk/tambah" enctype="multipart/form-data">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Produk</h3>
            </div>
            <!-- /.box-header -->
                         <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Produk</label> 
                            <input class='form-control' type='text' name='nama_produk' value='' />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Produk</label> 
                            <select class="form-control" name="kategori_produk">
                                <option>Food</option>
                                <option>Non Food</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label> 
                            <input class='form-control' type='text' name='harga_produk' value='' />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label> 
                            <input class='form-control' type='number' name='stok' value='' />
                        </div>
                        <div class="form-group">
                            <label>Diskon</label> 
                            <input class='form-control' type='number' name='diskon' value='' />
                        </div>
                        <div class="form-group">
                            <label>Berat (Gram)</label> 
                            <input class='form-control' type='number' name='berat' value='' />
                        </div>




                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" name="gambar_produk" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </section>
            </div>

            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/produk"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
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
    <form method="post" action="<?=base_url();?>/administrator/general/produk/perbaiki/<?=$produk['id_produk'];?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-heading"> Data <span class="semi-bold">Produk</span> </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Produk</label> 
                            <input class='form-control' type='text' name='nama_produk' value='<?=$produk['nama_produk'];?>' />
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Produk</label> 
                            <select class="form-control" name="kategori_produk">
                                <option><?=$produk['kategori_produk'];?></option>
                                <option>Food</option>
                                <option>Non Food</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label> 
                            <input class='form-control' type='text' name='harga_produk' value='<?=$produk['harga_produk'];?>' />
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Produk</label> 
                            <textarea name="deskripsi_produk" class="form-control ckeditor"><?=$produk['deskripsi_produk'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok</label> 
                            <input class='form-control' type='number' name='stok' value='<?=$produk['stok'];?>' />
                        </div>

                        <div class="form-group">
                            <label>Diskon</label> 
                            <input class='form-control' type='number' name='diskon' value='<?=$produk['diskon'];?>' />
                        </div>
                        <div class="form-group">
                            <label>Berat (Gram)</label> 
                            <input class='form-control' type='number' name='berat' value='<?=$produk['berat'];?>' />
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <img src="<?=shl_view::resources("public/images/".$produk['gambar_produk']);?>" class="img-responsive" style="width:200px; margin-bottom:10px;">
                                    <input type="file" name="gambar_produk" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                          <a class="btn btn-primary pull-right" href="<?=base_url();?>/administrator/general/produk"> Kembali <i class="glyphicon glyphicon-arrow-left"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
