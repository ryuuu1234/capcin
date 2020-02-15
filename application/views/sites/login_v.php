<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow">
	<meta name="keywords" contnet="capcin, capcin yuk, API, PHP, CodeIgniter, JavaScript, Vue">
	<meta name="description" content="Aplikasi capcin indonesia">
	<meta name="author" content="Hariyadi">

	<title><?= $title ?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fav.png'); ?>"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/bulma-checkradio.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	
	<!-- <script src="https://unpkg.com/vue@2.5.16/dist/vue.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
    <script src="<?=base_url()?>assets/admin/js/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/admin/js/plugins.js"></script>
	<script src="<?= base_url('assets/admin/js/wow.min.js'); ?>"></script>

	<style>
		html {
			overflow: auto;
        }
        
        body {
            background-color: #f0f0f0;
		}

		#btnToTop {
			display: none;
			position: fixed;
			z-index: 30;
			bottom: 20px;
			right: 30px;
		}

		.m-t-50 {
			margin-top: 50px;
        }
        .m-t-20 {
			margin-top: 20px;
        }

        .back_hr_green {
            background-color: #1fae66 !important;
        }
        .hr_white {
            color: #ffffff !important;
        }
        .hr_red {
            color: #FF3860 !important;
        }


        .hr_hidden {
            display:none;
        }


        .error_red {
            font-size:11px;
            color: #FF3860 !important;
        }
        .vd_alert-icon {
        font-size: 32px;
        float: left;
        margin: -5px 15px 15px 0;
        }
        
        
        .login-icon {
            font-size: 68px;
            width: 120px;
            height: 120px;
            line-height: 114px;
            display: block;
            margin: 20px auto 30px;
            border-radius: 60px;
            border: 1px solid #FFFFFF;
            background-color: #D5D5D5;
            text-align: center;
            color: #FFFFFF;
        }
        .login-icon.entypo-icon {
                line-height: 126px;
        }

        /*  Back Top Button  */

#btnToTop.visible:hover {
  opacity: 1;
}
#btnToTop.visible:hover,
#btnToTop.visible:focus {
  color: #FFFFFF;
}
#btnToTop.visible {
  opacity: 0.75;
}

		@media only screen and (min-width : 320px) {

		}

		/* Extra Small Devices, Phones */ 
		@media only screen and (min-width : 480px) {

		}

		/* Small Devices, Tablets */
		@media only screen and (max-width : 768px) {
			body {
				background-color: #f0f0f0;
				font-size: 12px !important;
				font-weight: 400;
				}
				p {
				 	font-size: 12px !important;
				}
		}

		/* Medium Devices, Desktops */
		@media only screen and (min-width : 992px) {

		}

		/* Large Devices, Wide Screens */
		@media only screen and (min-width : 1200px) {

		}
	</style>
</head>
<body>
    <!-- ISNYA -->
    <section class=" is-fullheight">
	<div class="hero-body">
		<div class="container has-text-centered m-t-50 ">
            <div class="logo">
                  <h2 class="mgbt-xs-5"><img src="<?=app_logo()?>" alt="logo"></h2>
            </div>
            <h4 >LOGIN TO YOUR ACCOUNT</h4>
            <div class="login-icon entypo-icon" > <i class="m-t-20 fa fa-key"></i> </div>
            <div class="column is-6 is-offset-3">
            
                <form id="login-form" action="<?=base_url('login2/auth')?>" role="form" method="post">
                    <div class="notification is-danger hr_hidden">
                        <button class="delete"></button>
                        <div class="msg-alert">
                        <span class="vd_alert-icon"><i class="fa fa-exclamation-circle"></i></span><strong>Maaf!</strong> Ada yang salah... Mohon Ulagi lagi </div>
                        </div>
                    </div>
                    <div class="notification is-success hr_hidden">
                        <button class="delete"></button>
                        <div class="msg-alert">
                            
                        </div>
                    </div>
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" name="email" id="email" placeholder="E-mail" class="required" required >
                            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            <!-- <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span> -->
                        </div>
                        <!-- <p class="help is-danger">This email is invalid</p> -->
                    </div>

                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="password" name="password" id="password" placeholder="Password" >
                            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            <!-- <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span> -->
                        </div>
                        <!-- <p class="help is-danger">This email is invalid</p> -->
                    </div>
                    <div class="field">
                        <button class="button is-fullwidth back_hr_green hr_white m-t-20" type="submit" id="login-submit">Login</button>
                    </div>
                    <div class="field">
                        <div class="control">
                        <input class="is-checkradio is-small" id="exampleCheckbox" type="checkbox" name="exampleCheckbox" >
                        <label for="exampleCheckbox">Ingat saya</label>
                        </div>
                    </div>
                </form>

            </div>
		</div>
    </div>
    
</section>

	<button id="btnToTop" class="button is-dark visible">
		<i class="fas fa-chevron-circle-up"></i>
	</button>

	<script>
	window.onscroll = () => backToTop()
	function backToTop () {
		let body = $('body')

		if (body.scrollTop() <= 0) {
			$('#btnToTop').hide()
		
		} else {
			$('#btnToTop').show()
		}
	}


	$('#btnToTop').click(() => {
		$('html, body').animate(
			{ scrollTop: 0 },
			'slow'
		)
	})

	wow = new WOW({}).init();
    </script>
    <script>
    $(document).ready(function() {
	
    "use strict";

    var form_register_2 = $('#login-form');
    var error_register_2 = $('.is-danger', form_register_2);
    var success_register_2 = $('.is-success', form_register_2);
    var alertx = $('.notification');

    form_register_2.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'error_red', // default input error message class
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
                required: "Username Harap diisi",
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

                        alertx.html('<span class="vd_alert-icon"><i class="fa fa-exclamation-circle "></i></span><strong>Oops! </strong> '+data.messages+'.')
                        success_register_2.hide();
                        error_register_2.show();
                        setTimeout(function(){
                            error_register_2.slideUp();
                            $(form).find('#login-submit').html('Login')
                        },2000)

                    }else
                    {
                        alertx.html('<span class="vd_alert-icon"><i class="fa fa-check-circle "></i></span><strong>Good job! </strong> '+data.messages+'.')
                        success_register_2.show();
                        error_register_2.hide();
                        setTimeout(function(){window.location.href = "<?=base_url('site_rules')?>"},1000); 
                    }

                }            
            });

            // setTimeout(function(){window.location.href = "index.html"},2000)	 ; 				
        }
    });	


});
</script>
    </script>

</body>
</html>
