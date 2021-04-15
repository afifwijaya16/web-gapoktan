<?php
$id = shl_session::get("id_users");
$users = shl_db::table("users")->where("id_users", $id)->single();
$not = shl_db::table("transaksi")->join("ongkir","ongkir.id_ongkir","transaksi.id_ongkir")->join("pelanggan","pelanggan.id_pelanggan","transaksi.id_pelanggan")->select("COUNT(id_transaksi) as status")->where("status_transaksi", "Pending")->single();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMINISTRATOR GAPOKTAN GADING REJO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="shortcut icon" href="<?=base_url();?>/resources/logogpn.png">
  <link rel="stylesheet" href="<?=base_url();?>/resources/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>/resources/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>/resources/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet"
    href="<?=base_url();?>/resources/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>/resources/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>/resources/admin/dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?=base_url();?>/resources/admin/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?=base_url();?>/resources/admin/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="{{url('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>GAPOKTAN</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MENU </b></span>
      </a>
      <div id="app">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="background:#06C">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
              &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=base_url();?>/resources/logogpn.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?=$users['name'];?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li><a href="<?=base_url();?>/administrator/dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>


          <?php if ($users['isAdmin'] == 0) { ?>
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url();?>/administrator/general/statis"><i class="fa fa-circle-o"></i> Data
                  Promosi</a></li>
              <li><a href="<?=base_url();?>/administrator/general/galery"><i class="fa fa-circle-o"></i> Data
                  Galery</a></li>
              <li><a href="<?=base_url();?>/administrator/general/produk"><i class="fa fa-circle-o"></i> Data Produk</a>
              </li>
              <li><a href="<?=base_url();?>/administrator/general/komentar"><i class="fa fa-circle-o"></i>Komentar
                  Produk</a></li>
              <li><a href="<?=base_url();?>/administrator/general/ongkir"><i class="fa fa-circle-o"></i> Ongkos
                  Kirim</a></li>
              <li><a href="<?=base_url();?>/administrator/users/users"><i class="fa fa-circle-o"></i> Admin</a></li>

            </ul>
          </li>

          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Data Penjualan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url();?>/administrator/general/transaksi"><i class="fa fa-circle-o"></i> Data
                  Penjualan - <?=$not['status'];?> Pending</a></li>
              <li><a href="<?=base_url();?>/administrator/general/pembayaran"><i class="fa fa-circle-o"></i> Konfirmasi
                  Pembayaran</a></li>
              <li><a href="<?=base_url();?>/administrator/general/pelanggan"><i class="fa fa-circle-o"></i>
                  Pelanggan</a></li>

            </ul>
          </li>

          <?php };?>

          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url();?>/administrator/general/transaksi/laporan_pendapatan"><i
                    class="fa fa-circle-o"></i> Laporan Penjualan/Pendapatan</a></li>
              <li><a href="<?=base_url();?>/administrator/general/transaksi/laporan_stok"><i
                    class="fa fa-circle-o"></i>Laporan Stok Barang</a></li>
              <li><a href="<?=base_url();?>/administrator/general/transaksi/laporan_pembeli"><i
                    class="fa fa-circle-o"></i> Laporan Data Pelanggan</a></li>
            </ul>
          </li>


          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Grafik</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url();?>/administrator/general/transaksi/grafik/pendapatan"><i
                    class="fa fa-circle-o"></i> Grafik Penjualan</a></li>
              <li><a href="<?=base_url();?>/administrator/general/transaksi/grafik/penjualan"><i
                    class="fa fa-circle-o"></i>Grafik Pendapatan</a></li>
            </ul>
          </li>



          <li><a href="<?=base_url();?>/administrator/login/logout"><i class="fa fa-circle-o"></i> Logout</a></li>



        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- bagian content -->
      <?=shl_view::render_body("index");?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="background:#06C">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2020 <a href="<?=base_url();?>/resources/admin/https://adminlte.io"></a>.</strong> Ervia
      DR
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <i class="menu-icon fa fa-user bg-yellow"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                  <p>New phone +1(800)555-1234</p>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                  <p>nora@example.com</p>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                  <p>Execution time 5 seconds</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="label label-danger pull-right">70%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Update Resume
                  <span class="label label-success pull-right">95%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Laravel Integration
                  <span class="label label-warning pull-right">50%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                </div>
              </a>
            </li>
            <li>
              <a href="<?=base_url();?>/resources/admin/javascript:void(0)">
                <h4 class="control-sidebar-subheading">
                  Back End Framework
                  <span class="label label-primary pull-right">68%</span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Allow mail redirect
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Other sets of options are available
              </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Expose author name in posts
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Allow the user to show his name in blog posts
              </p>
            </div>
            <!-- /.form-group -->

            <h3 class="control-sidebar-heading">Chat Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Show me as online
                <input type="checkbox" class="pull-right" checked>
              </label>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Turn off notifications
                <input type="checkbox" class="pull-right">
              </label>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Delete chat history
                <a href="<?=base_url();?>/resources/admin/javascript:void(0)" class="text-red pull-right"><i
                    class="fa fa-trash-o"></i></a>
              </label>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?=base_url();?>/resources/admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=base_url();?>/resources/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?=base_url();?>/resources/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url();?>/resources/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
  </script>
  <!-- SlimScroll -->
  <script src="<?=base_url();?>/resources/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?=base_url();?>/resources/admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url();?>/resources/admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=base_url();?>/resources/admin/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })
    })
  </script>
</body>

</html>