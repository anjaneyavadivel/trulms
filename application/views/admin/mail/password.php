
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LOGIN COFIRMATION</title>
<!--<link href="styles.css" rel="stylesheet">-->
<style>
@font-face {
 font-family: 'ProximaNova-Regular';
 src: url('assets/email/ProximaNova-Regular.eot?#iefix') format('assets/email/embedded-opentype'), url('assets/email/ProximaNova-Regular.woff') format('assets/email/woff'), url('assets/email/ProximaNova-Regular.ttf') format('assets/email/truetype'), url('assets/email/ProximaNova-Regular.svg#ProximaNova-Regular') format('assets/email/svg');
 font-weight: normal;
 font-style: normal;
}
</style>
</head>
<body>
<div id="wrapper" style="width:560px;background:#f3f3f3;margin:0 auto;box-sizing:border-box;">
  <div class="pad_10" style="padding:10px;">
    <div class="container" style=" font-family: 'ProximaNova-Regular'; width:100%;margin:0 auto;font-size:13px;">
      <header>
        <div id="logo" class="pull-left" style="float:left;width:320px;
	margin-bottom:10px;">  <img src="<?php echo base_url()?>assets/img/logo.png" alt="brand_logo" height="35" width="250"> </div>
        <div class="header-right pull-right" style="float:right"> <a href="<?php echo base_url()?>" style="background:url(assets/email/home-icon.png) no-repeat;
	display:block;height:28px;color:#999;text-decoration:none;padding-left:18px;margin-top:15px;">Home </a> </div>
        <div class="clearfix" style="display:block;clear:both;"></div>
      </header>
      <div class="content-container" style="background:#FFF;
	 box-sizing: border-box;
	 width:100%;
	 text-align:center;
	 line-height:24px;
	 letter-spacing:.3px">
        <h3 style="display:block;
	text-align:center;
	background:#e65f2b;
	color:#FFF;
	font-size:20px;
	margin:0;
	padding:25px 0;"><strong>LOGIN COFIRMATION</strong></h3>
        <div class="pad_10">
          <div class="content">
           
            <div class="details m-t-15" style="padding:0 10px; 
width: 100%;
box-sizing: border-box;">
              <div class="right-block" style="display:block;text-align:left;">
                <h4 style="margin:10px auto; text-transform:uppercase;color:#e65f2b;text-align:center; border-bottom:2px solid #EBEBEB; width:180px; ">TruLms Pasword</h4>
               <div style="margin-bottom:5px">
                Your Pasword : <?=$pword?>
                 </div>
               <div style="margin-bottom:5px">
                <a href="<?php echo base_url('')?>" target="_blank">CLICK HERE TO LOGIN</a>
                 </div>
                  </div>

            </div>
            <div class="clearfix" style="display:block;clear:both;"></div>
              </div>
        </div>
      </div>
      <!--EO content Container-->
      
      
      <!--EOF footer--> 
      
    </div>
    <!--EO container--> 
  </div>
</div>
<!--EOF wrapper-->

</body>
</html>
<?php //exit;?>