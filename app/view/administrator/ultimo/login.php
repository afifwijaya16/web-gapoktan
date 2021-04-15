<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> LOGIN ADMIN GAPOKTAN GADING REJO</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="shortcut icon" href="<?=base_url();?>/resources/logogpn.png">
<link href="<?=shl_view::resources("ultimo/css/font-awesome.css");?>" rel="stylesheet" type="text/css" />
<link href="<?=shl_view::resources("ultimo/css/bootstrap.min.css");?>" rel="stylesheet" type="text/css" />
<link href="<?=shl_view::resources("ultimo/css/animate.css");?>" rel="stylesheet" type="text/css" />
<link href="<?=shl_view::resources("ultimo/css/admin.css");?>" rel="stylesheet" type="text/css" />
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  
  
  
  <section id="home" name="home">
        <div id="headerwrap">
            <div class="container">
                <div class="row centered">
                    <div class="login_page">
  <div style="background: orange; " class="login_content">
      <img src="<?=base_url();?>/resources/logogpn.png" style="width:30%">
      <div style="background: orange; "class="panel-heading border login_heading">LOGIN ADMIN <br> <?=$pesan;?></div>	
 <form  class="form-horizontal" method="post" action="#">
      <div class="form-group">
                <div class="col-sm-10">
          <?php echo shl_form::error("email");?>
          <input type="email" placeholder="Email" name="email" class="form-control">
        </div>
      </div>
      <div class="form-group">
        
        <div class="col-sm-10">
          <?=shl_form::error("password");?>
          <input type="password" placeholder="Password" name="password" class="form-control">
        </div>
      </div>
      <div class="form-group">
                            <div class=" col-sm-10">
                              <div class="checkbox checkbox_margin">
                                <label class="lable_margin">
                                <input type="checkbox"><p class="pull-left"> Ingat saya</p></label>
   
              <a href="#">
              <button class="btn btn-default pull-right" type="submit">Masuk</button>
              </a></div>
        </div>
      </div>
      
    </form>
 </div>
  </div>
   <img class="img-responsive" src="<?=base_url();?>/resources/loginadmin.jpg" width="100%" alt="">
  
  
  
  
  
  
  
</div>
<!--\\\\\\\ wrapper end\\\\\\-->






<script src="<?=shl_view::resources("ultimo/js/jquery-2.1.0.js");?>"></script>
<script src="<?=shl_view::resources("ultimo/js/bootstrap.min.js");?>"></script>
<script src="<?=shl_view::resources("ultimo/js/common-script.js");?>"></script>
<script src="<?=shl_view::resources("ultimo/js/jquery.slimscroll.min.js");?>"></script>
</body>
</html>
