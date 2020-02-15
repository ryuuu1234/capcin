
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<html><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Admin | <?=app_name()?></title>
	<meta name="keywords" content="HTML5 Template, CSS3, All Purpose Admin Template" />
	<meta name="description" content="Layouts Medium Profile - Responsive Admin HTML Template">
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
	<link href="<?=base_url()?>assets/admin/css/theme.css" rel="stylesheet" type="text/css">
	<!--[if IE]> <link href="<?=base_url()?>assets/admin/css/ie.css" rel="stylesheet" > <![endif]-->
	<link href="<?=base_url()?>assets/admin/css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css --> 
	<!-- Responsive CSS -->
	<link href="<?=base_url()?>assets/admin/css/theme-responsive.min.css" rel="stylesheet" type="text/css">
	<!-- for specific page in style css -->
	<!-- for specific page responsive in style css -->
	<!-- Custom CSS -->
	<link href="<?=base_url()?>assets/admin/custom/custom.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/admin/custom/my-custom-style.css" rel="stylesheet" type="text/css">
	<!-- sweet alerts -->
	<link href="<?=base_url();?>assets/admin/css/sweetalert2.min.css" rel="stylesheet">
	<!-- sweet alerts -->
	<script src="<?=base_url();?>assets/admin/js/sweetalert/sweetalert2.min.js"></script>
	<!-- Head SCRIPTS -->
	<script type="text/javascript" src="<?=base_url()?>assets/admin/js/modernizr.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>assets/admin/js/mobile-detect.min.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>assets/admin/js/mobile-detect-modernizr.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>assets/admin/js/jquery.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>assets/admin/js/theme.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/admin/custom/custom.js"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="<?=base_url()?>assets/admin/js/html5shiv.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/admin/js/respond.min.js"></script>     
  <![endif]-->
  
</head>    

<body id="layouts" class="full-layout  no-nav-right  nav-top-fixed      responsive    clearfix" data-active="layouts "  data-smooth-scrolling="1">     
	<div class="vd_body">
		<!-- Header Start -->
		<?php echo $top_bar;?>
		<!-- Header Ends --> 
		<div class="content">
			<div class="container">
			<!-- Middle Content Start -->
			<!-- SIDEMENU DISINI -->
			<?php echo $sidebar;?>
			<!-- END SIDEMENU  -->
			<!-- CONTENT DISINI -->
			<?php echo $content;?>
			<!-- .content -->
			<!-- Middle Content End --> 
			</div><!-- .container --> 
		</div>
		<!-- Footer Start -->
		<footer class="footer-2"  id="footer">      
			<div class="vd_bottom ">
				<div class="container">
					<div class="row">
						<div class=" col-xs-12">
							<div class="copyright text-center">
								Copyright &copy;2019 <?=app_name()?>. All Rights Reserved 
							</div>
						</div>
					</div><!-- row -->
				</div><!-- container -->
			</div>
		</footer>
		<!-- Footer END -->

	</div>

<!-- .vd_body END  -->
<a id="back-top" href="<?=base_url()?>assets/admin/#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>
<!--
	<a class="back-top" href="<?=base_url()?>assets/admin/#" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

	<!-- Javascript =============================================== --> 
	<!-- Placed at the end of the document so the pages load faster --> 

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
<script type="text/javascript" src="<?=base_url()?>assets/admin/js/myjsfile/notification-my.js"></script>



<!-- Specific Page Scripts Put Here --> 
<script type="text/javascript" src="<?=base_url()?>assets/admin/plugins/google-code-prettify/prettify.js"></script>
<script type="text/javascript" >
"use strict";
jQuery(document).ready(function($){prettyPrint();});
</script>

<!-- Specific Page Scripts END -->
<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->

<!-- <script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-XXXXX-X']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>  -->

<!-- Notification wellcome -->
<!-- <script>
	  setTimeout(function() { notification("topright","notify","fa fa-exclamation-triangle vd_yellow","Welcome Administrator!","Click on <i class='fa fa-question-circle vd_red'></i> Question Mark beside filter to take a view layout tour guide"); },1500)	 ;
</script> -->

</body>
</html>