
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login | <?=app_name()?></title>
    <meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template, Vendroid" />
    <meta name="description" content="Login Pages - Responsive Admin HTML Template">
    <meta name="author" content="Venmond">
    
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    
    
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/admin/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/admin/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/admin/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/admin/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=base_url()?>assets/admin/img/ico/favicon.png">
    
    
    <!-- CSS -->
       
    <!-- Bootstrap & FontAwesome & Entypo CSS -->
    <link href="<?=base_url()?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/admin/css/font-awesome-ie7.min.css"><![endif]-->
    <link href="<?=base_url()?>assets/admin/css/font-entypo.css" rel="stylesheet" type="text/css">    

    <!-- Fonts CSS -->
    <link href="<?=base_url()?>assets/admin/css/fonts.css"  rel="stylesheet" type="text/css">
               
    <!-- Plugin CSS -->
    <link href="<?=base_url()?>assets/admin/plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">    
    <link href="<?=base_url()?>assets/admin/plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/plugins/pnotify/css/jquery.pnotify.css" media="screen" rel="stylesheet" type="text/css">    
	<link href="<?=base_url()?>assets/admin/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"> 
   
         
    <link href="<?=base_url()?>assets/admin/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">    
    <link href="<?=base_url()?>assets/admin/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">    
    <link href="<?=base_url()?>assets/admin/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/admin/plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css">            

	<!-- Specific CSS -->
	    
     
    <!-- Theme CSS -->
    <link href="<?=base_url()?>assets/admin/css/theme.min.css" rel="stylesheet" type="text/css">
    <!--[if IE]> <link href="<?=base_url()?>assets/admin/css/ie.css" rel="stylesheet" > <![endif]-->
    <link href="<?=base_url()?>assets/admin/css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->
    <!-- Responsive CSS -->
        	<link href="<?=base_url()?>assets/admin/css/theme-responsive.min.css" rel="stylesheet" type="text/css"> 
    <!-- for specific page in style css -->
        
    <!-- for specific page responsive in style css -->
    
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/admin/custom/custom.css" rel="stylesheet" type="text/css">

    <!-- Head SCRIPTS -->
    <script type="text/javascript" src="<?=base_url()?>assets/admin/js/modernizr.js"></script> 
    <script type="text/javascript" src="<?=base_url()?>assets/admin/js/mobile-detect.min.js"></script> 
    <script type="text/javascript" src="<?=base_url()?>assets/admin/js/mobile-detect-modernizr.js"></script> 
    
</head>    

<body id="pages" class="full-layout no-nav-left no-nav-right  nav-top-fixed background-login     responsive remove-navbar login-layout   clearfix" data-active="pages "  data-smooth-scrolling="1">     
<div class="vd_body">
<!-- Header Start -->

<!-- Header Ends --> 
<div class="content">
  <div class="container"> 
    
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_content-section clearfix">
            <div class="vd_login-page">
              <div class="heading clearfix">
                <div class="logo">
                  <h2 class="mgbt-xs-5"><img src="<?=app_logo()?>" alt="logo"></h2>
                </div>
                <h4 class="text-center font-semibold vd_grey">LOGIN TO YOUR ACCOUNT</h4>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="login-icon entypo-icon" style="margin-top:-10px;"> <i class="icon-key"></i> </div>
                  <form class="form-horizontal" id="login-form" action="<?=base_url('login/auth')?>" role="form" method="post">
                  <div class="alert alert-danger vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Maaf!</strong> Change a few things up and try submitting again. </div>
                  <div class="alert alert-success vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>. </div>                  
                    <div class="form-group  mgbt-xs-20">
                      <div class="col-md-12">
                        <div class="label-wrapper sr-only">
                          <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-user"></i> </span>
                          <input type="text" placeholder="Email" id="email" name="email" class="required" required autocomplete="off">
                        </div>
                        <div class="label-wrapper">
                          <label class="control-label sr-only" for="password">Password</label>
                        </div>
                        <div class="vd_input-wrapper" id="password-input-wrapper" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                          <input type="password" placeholder="Password" id="password" name="password" class="required" required>
                        </div>
                      </div>
                    </div>
                    <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center mgbt-xs-5">
                        <button class="btn vd_bg-green vd_white width-100" type="submit" id="login-submit">Login</button>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="vd_checkbox">
                              <input type="checkbox" id="checkbox-1" value="1">
                              <label for="checkbox-1" style="font-size:10px;"> Remember me</label>
                            </div>
                          </div>
                          <div class="col-xs-6 text-right">
                            <div class=""> <a href="pages-forget-password.html">Forget Password? </a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Panel Widget -->
              <!-- <div class="register-panel text-center font-semibold"> <a href="pages-register.html">CREATE AN ACCOUNT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div> -->
            </div>
            <!-- vd_login-page --> 
            
          </div>
          <!-- .vd_content-section --> 
          
        </div>
        <!-- .vd_content --> 
      </div>
      <!-- .vd_container --> 
    </div>
    <!-- .vd_content-wrapper --> 
    
    <!-- Middle Content End --> 
    
  </div>
  <!-- .container --> 
</div>
<!-- .content -->

<!-- Footer Start -->
  <footer class="footer-2"  id="footer">      
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
              <div class=" col-xs-12">
                <div class="copyright text-center">
                  	Copyright &copy;2014 Venmond Inc. All Rights Reserved 
                </div>
              </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
  </footer>
<!-- Footer END -->

</div>

<!-- .vd_body END  -->
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<!--
<a class="back-top" href="#" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

<!-- Javascript =============================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/jquery.js"></script> 
<!--[if lt IE 9]>
  <script type="text/javascript" src="<?=base_url()?>assets/admin/js/excanvas.js"></script>      
<![endif]-->
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/bootstrap.min.js"></script> 
<script type="text/javascript" src='<?=base_url()?>assets/admin/plugins/jquery-ui/jquery-ui.custom.min.js'></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/caroufredsel.js"></script> 
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/breakpoints/breakpoints.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script> 

<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/tagsInput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/blockUI/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/pnotify/js/jquery.pnotify.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/admin/js/theme.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin/custom/custom.js"></script>
 
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript">
$(document).ready(function() {
	
		"use strict";
	
        var form_register_2 = $('#login-form');
        var error_register_2 = $('.alert-danger', form_register_2);
        var success_register_2 = $('.alert-success', form_register_2);
        var alertx = $('.alert');

        form_register_2.validate({
            errorElement: 'div', //default input error message container
            errorClass: 'vd_red', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
				
                email: {
                    required: true,
                },				
                password: {
                    required: true,
					minlength: 4
                },
				
            },

            messages : {
				
                email: {
                    required: "Email Harap diisi",
                },				
                password: {
                    required: "Password Harap diisi",
					minlength: "Tidak boleh kurang dari 4 karakter",
                },
				
            },
			
			errorPlacement: function(error, element) {
				if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){
					element.parent().append(error);
				} else if (element.parent().hasClass("vd_input-wrapper")){
					error.insertAfter(element.parent());
				}else {
					error.insertAfter(element);
				}
			}, 
			
            invalidHandler: function (event, validator) { //display error alert on form submit              
                success_register_2.hide();
                error_register_2.hide();


            },

            highlight: function (element) { // hightlight error inputs
		
				$(element).addClass('vd_bd-red');
				$(element).parent().siblings('.help-inline').removeClass('help-inline hidden');
				if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {
					$(element).siblings('.help-inline').removeClass('help-inline hidden');
				}

            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label, element) {
                label
                    .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon
                	.closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
				$(element).removeClass('vd_bd-red');

					
            },
    		submitHandler: function (form) {
				$(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>')/*.addClass('disabled').attr('disabled')*/;					
                
                $.ajax({
		            url: form.action,
		            type: form.method,
		            data: $(form).serialize(),
		            dataType: "JSON",
		            success: function(data) 
		            {
                		if (data.status == false) {

                			alertx.html('<span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oops! </strong> '+data.messages+'.')
                			success_register_2.hide();
                			error_register_2.show();
                			setTimeout(function(){
                				error_register_2.slideUp();
                				$(form).find('#login-submit').html('Login')
                			},2000)

                		}else
                		{
                			alertx.html('<span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Good job! </strong> '+data.messages+'.')
                			success_register_2.show();
                			error_register_2.hide();
                			setTimeout(function(){window.location.href = "<?=base_url('site_rules')?>"},1000); 
                		}

		            }            
		        });			
            }
        });	
	
	
});
</script> 

</body>
</html>