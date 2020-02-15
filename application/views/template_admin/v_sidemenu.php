 <style type="text/css">
.hilang {
  display: none !important;
}
.tampak {
  display: "";
}
</style>	
<div class="vd_navbar vd_nav-width vd_navbar-tabs-menu vd_navbar-left  ">

<div class="navbar-tabs-menu clearfix">
		<span class="expand-menu" data-action="expand-navbar-tabs-menu">
			<span class="menu-icon menu-icon-left">
				<i class="fa fa-ellipsis-h"></i>
				<span class="badge vd_bg-red">
					20
				</span>                    
			</span>
			<span class="menu-icon menu-icon-right">
				<i class="fa fa-ellipsis-h"></i>
				<span class="badge vd_bg-red">
					20
				</span>                    
			</span>                
		</span>
		<div class="menu-container">
			<div class="vd_mega-menu-wrapper">
				<div class="vd_mega-menu">
					<ul class="mega-ul">
						<li class="profile mega-li" id="side-nav-profile"> 
							<a data-action="click-trigger" href="#" class="mega-link"> 

								<span class="mega-image"><img alt="example image" src="<?=image_user()?>"></span>               
								<span class="mega-name">
									<span class="append-word vd_grey">Selamat Datang,</span><br/>
									<?=nama_user()?><span class="child-menu-icon"><i class="fa fa-caret-down fa-fw"></i></span> 
								</span>
							</a> 
							<div data-action="click-target" class="vd_mega-menu-content  width-xs-2  right-xs" style="display: none;">
								<div class="child-menu"> 
									<div class="content-list content-menu">
										<ul class="list-wrapper pd-lr-10">
											<li> 
												<a href="<?=base_url('admin/settings/profile')?>"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Edit Profile</div> </a> </li>
												<li class="line"></li>                
												<li> <a href="<?=base_url('admin/file/users/ganti_password/?id=').$this->session->userdata("user_id")?>"> <div class="menu-icon"><i class=" fa fa-cogs"></i></div> <div class="menu-text">Ganti Password?</div> </a> </li>
												<li> <a href="#"> <div class="menu-icon"><i class="  fa fa-key"></i></div> <div class="menu-text">Lock</div> </a> </li>
												<li> <a href="<?=base_url('site_rules/logout')?>"> <div class="menu-icon"><i class=" fa fa-sign-out"></i></div>  <div class="menu-text">Sign Out</div> </a> </li>
												<li class="line"></li>                
												<li> <a href="#"> <div class="menu-icon"><i class=" fa fa-question-circle"></i></div> <div class="menu-text">Help</div> </a> </li>
												<li> <a href="#"> <div class="menu-icon"><i class=" glyphicon glyphicon-bullhorn"></i></div> <div class="menu-text">Report a Problem</div> </a> 
											</li>                   
										</ul>
									</div> 
								</div> 
							</div>     

						</li> 

					</ul>                        	
				</div>                
			</div>
		</div>                                                   
	</div>
	<!-- NAVBAR SIDEMENU -->
		<!-- jika ada navbar lagi diatas menu -->
	<!-- END NAVBAR SIDEMENU -->
	<div class="navbar-menu clearfix">
		<div class="vd_panel-menu hidden-xs">
			<span data-original-title="Expand All" data-toggle="tooltip" data-placement="bottom" data-action="expand-all" class="menu" data-intro="<strong>Expand Button</strong><br/>To expand all menu on left navigation menu." data-step=4 >
			<i class="fa fa-sort-amount-asc"></i>
		</span>                   
	</div>
	<br>
	<div class="vd_menu" id="respSidemenu">
		<?php $menu = $this->db->where(['id_main <'=>1])->order_by('urut')->get('appmenu');?>
		<ul>
			<!-- INI UNTUK MENU MAIN -->
	         <?php foreach ($menu->result() as $key) :
	            $main = $key->is_main; 
	            $id_menu = $key->id; 
	            $id_main = $key->id_main;
	            ?>
	         <?php if ($main == 0 ) { ?>  
			<li id="menu-<?=$id_menu;?>">
				<a href="<?=base_url();?><?=$key->url;?>">
					<span class="menu-icon"><i class="<?=$key->icon?>"></i></span> 
					<span class="menu-text"><?=$key->controller?></span> 
					<!-- Jika Pakai Badge -->
					<!-- <span class="menu-badge"><span class="badge vd_bg-red">78</span></span> -->
				</a> 
			</li>
			<?php } else { ?> 
			<!-- INI UNTUK SUBMENU -->
			<li id="menu-<?=$id_menu;?>">
				<a href="javascript:void(0)" data-action="click-trigger">
					<span class="menu-icon"><i class="<?=$key->icon?>"></i></span> 
					<span class="menu-text"><?=$key->controller?></span>  
					<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
				</a>
				<div class="child-menu"  data-action="click-target">
					<ul>
						<?php $sub_menu = $this->db->where(['id_main'=>$id_menu])->order_by('urut')->get('appmenu');
                              foreach ($sub_menu->result() as $s) { ?>
						<li id="menu-<?=$s->id;?>">
							<a href="<?=base_url();?><?=$s->url;?>">
								<span class="menu-text"><?=$s->controller;?></span>  
							</a>
						</li>
						<?php } ?>
					</ul>   
				</div>
			</li>
			<?php } ?>
            <?php endforeach;?>
			

		</ul>
<!-- Head menu search form ends -->         
	</div>             
</div>
<div class="navbar-spacing clearfix">
</div>
<div class="vd_menu vd_navbar-bottom-widget">
	<ul>
		<li>
			<a href="<?=base_url('site_rules/logout')?>">
				<span class="menu-icon"><i class="fa fa-sign-out"></i></span>          
				<span class="menu-text">Logout</span>             
			</a>

		</li>
	</ul>
</div>     
</div> 

<script>
$(document).ready(function() {
  var level = '<?=$this->session->userdata("level");?>';
  if(level !=1){
    $.ajax({
          url : '<?=base_url("site_rules/get_akses")?>',
          type: "POST",
          data: {level:level},
          dataType: "JSON",
          success: function(data){
           $.each(data, function(i, item) {
              // console.log(data[i].id_menu);
              $("#menu-"+data[i].id_menu).addClass("hilang");
              
          })
          // alert('wuykiyu');
         }, error(data){
          alert('error');
         }  
        });
  }
});
</script>