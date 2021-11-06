<?php
ob_start();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->
<section class="content-header">
    <h1>
        Data Galery
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url();?>/resources/admin/#"><i class="fa fa-dashboard"></i> Galery</a></li>
    </ol>
</section>
<section class="content">
    <?php if (empty($act)) { ?>
    
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Galery</h3>
            </div>
            <div class="row">
                <div class="col-sm-4 pull-right">
                    <div class="form-group search_group pull-right">

                        <a href="<?=base_url();?>/administrator/general/galery/tambah" class="btn btn-primary"><i
                                class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th> 
                            <th>Action </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; foreach ($galery as $row) { $no++; ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$row['judul'];?></td>
                                <td><?php $tgl = explode(" ",$row['tgl_posting']);
                                echo tgl_indo($tgl[0]);?>
                                </td>

                                <td align="center"><a
                                        href="<?=base_url();?>/administrator/general/galery/perbaiki/<?=$row['id_galery'];?>"
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                                <td align="center"><a
                                        href="<?=base_url();?>/administrator/general/galery/hapus/<?=$row['id_galery'];?>"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    
    <?php
    }
    else if ($act == "tambah")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/galery/tambah" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel default blue_title h2">
                    <div class="panel-heading"><span class="semi-bold">Tambah Galery</span> </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input class='form-control' type='text' name='judul' value='' />
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Nama Komentator">Tanggal Posting </label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input class='form-control' type='date' name='tgl_posting'
                                                value='<?=date("Y-m-d");?>' />
                                        </div>
                                        <div class="col-sm-6">
                                            <input class='form-control' type='time' name='tgl_posting2'
                                                value='<?=date("h:i");?>' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Isi galery</label> <?=shl_form::error("isi_galery");?>
                            <textarea name="isi_galery" class="form-control ckeditor"></textarea>
                        </div>


                    </div>
                </section>

            </div>


            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"
                            onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i>
                            Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    else if ($act == "perbaiki")
    {
    ?>
    <form method="post" action="<?=base_url();?>/administrator/general/galery/perbaiki/<?=$galery['id_galery'];?>"
        enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel default blue_title h2">
                    <div class="panel-heading"><span class="semi-bold">Edit Informasi</span> </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input class='form-control' type='text' name='judul' value='<?=$galery['judul'];?>' />
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Nama Komentator">Tanggal Posting </label>
                                    <div class="row">
                                        <?php
                                        $tgl = explode(" ",$galery['tgl_posting']);
                                        ?>
                                        <div class="col-sm-6">
                                            <input class='form-control' type='date' name='tgl_posting'
                                                value='<?=$tgl[0];?>' />
                                        </div>
                                        <div class="col-sm-6">
                                            <input class='form-control' type='time' name='tgl_posting2'
                                                value='<?=$tgl[1];?>' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <img src="<?=shl_view::resources("public/images/".$galery['gambar']);?>"
                                        class="img-responsive" style="width:200px; margin-bottom:10px;">
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Isi galery</label> <?=shl_form::error("isi_galery");?>
                            <textarea name="isi_galery"
                                class="form-control ckeditor"><?=$galery['isi_galery'];?></textarea>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-12">
                <section class="panel default blue_title h4">
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"
                            onclick="return confirm('Yakin data akan disimpan ?')"><i class="fa fa-save"></i>
                            Simpan</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> Batal</button>
                    </div>
                </section>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
</section>

<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>