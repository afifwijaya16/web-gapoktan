<?php
ob_start();
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
?>
<!--\\\\\\\ contentpanel start\\\\\\-->

    <?php if (empty($act)) { ?>
    
    <?php } else if ($act == "laporan_pendapatan"){ ?>

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

    <?php } ?>
<?php shl_view::layout("administrator/ultimo/index", ob_get_clean());?>
