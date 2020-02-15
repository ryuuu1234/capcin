<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    /*untuk bottom bar*/
.mobile-bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      will-change: transform;
      transform: translateZ(0);
      display: flex;
      height: 55px;
      box-shadow: 0 -2px 5px -2px #333;
      background-color: #fff;
}
.mobile-bottom-nav i {
    font-size: 20px;
}
a.mobile-bottom-nav__item {
  flex-grow: 1;
  text-align: center;
  font-size: 11px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  color:#636e72;
}
.activeX {
  color: #FF3860 !important;
}
.mobile-bottom-nav__item-content {
  display: flex;
  flex-direction: column;
}
</style>

 <!-- INI JIKA DI MOBILE -->
 <div id="foot">
 
    <div class="mobile-bottom-nav is-hidden-desktop">
          
        <a href="<?=base_url()?>" data-toggle="page" class="mobile-bottom-nav__item">
            <div class="mobile-bottom-nav__item-content">
                <i class="fa fa-home"></i>
                Beranda
            </div>      
        </a>
        <a href="<?=base_url()?>front/logbook" class="mobile-bottom-nav__item">       
            <div class="mobile-bottom-nav__item-content">
                <i class="fa fa-info-circle"></i>
                Informasi
            </div>
        </a>
        <a href="<?=base_url()?>front/profile" class="mobile-bottom-nav__item">
            <div class="mobile-bottom-nav__item-content">
                <i class="fa fa-user-tie"></i>
                Profile
            </div>      
        </a>
        
        <?php if (!$this->session->userdata('login')) {?>
            <a href="<?=base_url()?>login2" class="mobile-bottom-nav__item">
                <div class="mobile-bottom-nav__item-content">
                    <i class="fa fa-sign-in-alt"></i>
                    Login
                </div>
            </a>

            <?php } else {?>
            <a href="<?=base_url()?>site_rules/logout" class="mobile-bottom-nav__item">
                <div class="mobile-bottom-nav__item-content">
                     <i class="fa fa-sign-out-alt"></i>
                    Logout
                </div>      
            </a>
        <?php }?>
    </div>
 </div>

 <script>
    $(document).ready(function(){
        var url = window.location.href;
        var navItems = document.querySelectorAll("a.mobile-bottom-nav__item");
            for (var i = 0; i < navItems.length; i++) 
            { 
                
                if (navItems[i].href == url) {
                    navItems[i].classList.add('activeX');
                } 
                                       
            }   
    })        

    </script> 
