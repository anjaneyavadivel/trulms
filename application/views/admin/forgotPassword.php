<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TruLMS - Forgot Password</title>
        <link rel="icon" type="image/ico" href="<?= base_url(); ?>assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/animate.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="<?= base_url(); ?>assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>





    <body id="minovate" class="appWrapper">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->












        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">




            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Tru</span>LMS</h3></div>
                <div class="container w-420 p-15 bg-white mt-40 text-center">

                    <h2 class="text-light text-greensea">Forgot Password?</h2>
                    <?php if(isset($error) && $error==1){?>
                    <div class="alert alert-lightred hideclass">
                        <?=$error_msg?> 
                    </div>
<!--                    <div class="alert alert-success hideclass">
                        <?=$error_msg?> 
                    </div>-->
                    <?php }?>
                    <?=form_open_multipart(base_url().'forgot-password',array('id'=>'form-login','class'=>'form-validation mt-20','data-parsley-validate'=>''));?>
                    
                        <p class="help-block text-left">
                            Enter your e-mail address below to reset your password.
                        </p>

                        <div class="form-group">
                          <input type="username" id="username" class="form-control underline-input" required placeholder="Email ID / Phone No" data-parsley-email-phone="#username">
                        </div>
                    <div class="bg-slategray lt wrap-reset mt-40 text-left">
                        <p class="m-0">
                            <input type="submit" name="submit" id="login-submit" class="btn btn-greensea b-0 text-uppercase pull-right" value="Submit">
                            <a href="<?=base_url().'login'?>" class="btn btn-lightred b-0 text-uppercase">Back</a>
                        </p>
                    </div>

                    <?=form_close();?>

                </div>
                
            

            </div>



        </div>
        <!--/ Application Content -->

        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= base_url(); ?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>-->

        <script src="<?= base_url(); ?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>
        <script src="<?= base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/screenfull/screenfull.min.js"></script>
        <!--/ vendor javascripts -->

        <script src="<?= base_url(); ?>assets/js/vendor/parsley/parsley.min.js"></script>



        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url(); ?>assets/js/main.js"></script>
        <!--/ custom javascripts -->
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function () {
                    $('.hideclass').hide();
                }, 10000);
              });
            
            window.ParsleyValidator.addValidator('emailPhone', 
            function (value, requirement) {
                var mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})|([0-9]{10})+$/;
                if (!mailFormat.test(value)) {
                    return false;
                }return true;
            }, 32)
            .addMessage('en', 'emailPhone', 'Enter the vaild Email or Phone number');

            $(window).load(function(){
                $('#login-submit').on('click', function(){
                    //$('#form-login').submit();
                });
            });
        </script>

        <!--/ Page Specific Scripts -->
    </body>
</html>
