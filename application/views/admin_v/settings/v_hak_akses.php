<style type="text/css">
.sort {

	list-style: none;
	border:1px #ddd solid;
	color:#73879C;
	padding: 10px;
	margin-bottom: 4px;
	/*cursor: none;*/
	margin-left: -0px;
}
</style>

<div class="vd_content-wrapper">
	<div class="vd_container">
		<div class="vd_content clearfix">
			<div class="vd_head-section clearfix">
				<div class="vd_panel-header">
					<ul class="breadcrumb">
						<?php 
						$uri3= $this->uri->segment(3);
						$uri2= $this->uri->segment(2);
						$uri1= $this->uri->segment(1);

						?>
						<?php if ($uri3 == '') { ?>
						<li><a href="<?=base_url()?><?=$uri1?>/<?=$uri2?>"><?=ucfirst($uri1)?></a> </li>
						<li class="active"><?=ucfirst($uri2)?></li>
						<?php } else{?>
						<li><a href="javascript:void(0)"><?=ucfirst($uri1)?></a> </li>
						<li><a href="<?=base_url()?><?=$uri1?>/<?=$uri2?>/<?=$uri3?>"><?=ucfirst($uri2)?></a> </li>	
						<li class="active"><?=ucfirst($uri3)?></li>
						<?php }?>
						<?php ?>
					</ul>
					<div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
					<div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
					<div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
					<div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
				</div>

			</div>
		</div><!-- vd_head-section -->

		<!-- INI HEADLINE TITLE -->
		<div class="vd_title-section">
			<div class="vd_panel-header">
				<h1><?=ucfirst($uri3)?></h1>
			</div>
		</div><!-- vd_title-section -->
		<div class="vd_content-section clearfix">
		<!-- INI CONTENT -->
		<div class="row">
			<div class="col-md-4" id="kolomA">
				
					<div class="panel widget light-widget panel-bd-left vd_bdl-yellow">

						<div class="panel-heading no-title">
							<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-file-text"></i> </span> Level User </h3>
							<div class="vd_panel-menu">
		  						<div data-action="refresh" class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Refresh"> <i class="icon-cycle"></i> </div>
		  						<div class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Config">
		    					<div data-action="click-trigger" class="menu-trigger"> <i class="icon-cog"></i> </div>
		    					<div class="vd_mega-menu-content  width-xs-2  left-xs" data-action="click-target">
		      					<div class="child-menu">
		        				<div class="content-list content-menu">
		          					<ul class="list-wrapper pd-lr-10">
		            					<li> <a href="#"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Panel Menu</div> </a> </li>
		          					</ul>
		        				</div>
		      					</div>
		    					</div>
		  						</div>
		  						<div class="menu entypo-icon" data-placement="bottom" data-toggle="tooltip" data-original-title="Close" data-action="close"> <i class="icon-cross"></i> </div>
							</div><!-- vd_panel-menu --> 
						</div>
						<div class="panel-body">

							<form action="" method="post" id="valid-form">
							<div class="form-group">
								<label class="control-label">Pilih Salah Satu level</label>
								<select class="form-control" name="level" id="level">
									<option value=""> Pilih Level Users</option>
									<?php foreach ($level as $key):?>
										<option value="<?=$key->id?>"<?php if($akses == $key->id ) {echo "selected";}?>><?=$key->nama?></option>
									<?php endforeach;?>
								</select>
							</div>
						</form>
						<div class="form-group">
							<div class="pull-left">
								<button type="button" class="btn btn-primary" name="go" id="go" onclick ="__go()">Go</button>
							</div>
						</div>
							
						</div>
					</div>	
			</div>
			<div class="col-md-8" id="kolomB">
			<div class="panel widget light-widget panel-bd-left ">
				<div class="panel-heading no-title">
					<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-folder-open-o"></i> </span> Sidemenu </h3>
					<div class="vd_panel-menu">
  						<div data-action="refresh" class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Refresh"> <i class="icon-cycle"></i> </div>
  						<div class="menu entypo-icon smaller-font" data-placement="bottom" data-toggle="tooltip" data-original-title="Config">
    					<div data-action="click-trigger" class="menu-trigger"> <i class="icon-cog"></i> </div>
    					<div class="vd_mega-menu-content  width-xs-2  left-xs" data-action="click-target">
      					<div class="child-menu">
        				<div class="content-list content-menu">
          					<ul class="list-wrapper pd-lr-10">
            					<li> <a href="#"> <div class="menu-icon"><i class=" fa fa-user"></i></div> <div class="menu-text">Panel Menu</div> </a> </li>
          					</ul>
        				</div>
      					</div>
    					</div>
  						</div>
  						<div class="menu entypo-icon" data-placement="bottom" data-toggle="tooltip" data-original-title="Close" data-action="close"> <i class="icon-cross"></i> </div>
					</div><!-- vd_panel-menu --> 
				</div>

				<div class="panel-body">
					<label class="control-label">Pilih Hak Akses Menu</label>
						<hr>
						<?php if ($akses != "") { ?>
						<ul id="sortlist">
							<?php $i= 1; foreach ($menu as $key) : 
							$id = $key->id;
							$query = $this->akses_mdl->_get_where(['id_level'=>$akses, 'id_menu'=>$id]);
								if (count($query) > 0){
									$tombol = '<a href="javascript:void(0)" class="btn vd_btn vd_bg-grey btn-sm" data-id="'.$id.'" id="btnMenuNonAktif"> None</a>';
								}else{
									$tombol = '<a href="javascript:void(0)" class="btn btn-info btn-sm" data-id="'.$id.'" id="btnMenuAktif"> Aktif</a>';
								}
							?>
							<li class="sort" style = "background-color:white; " >

								<table>
									<td><?=$tombol?></td>
									<td style="margin-left: 10px;"> <b><?= $key->controller ?></b></td>
								</table>

							</li>
							<ul>
								<?php if ($key->is_main == 1) { ?>
								<?php 
								$sub_menu = $this->db->get_where('appmenu', ['id_main'=>$key->id]);
								foreach ($sub_menu->result() as $s) : 
									$id_submenu = $s->id;
									$query2 = $this->db->get_where('akses_menu', ['id_level'=>$akses, 'id_menu'=>$id_submenu]);
										if ($query2->num_rows() > 0){
											$tombol_sub = '<a href="javascript:void(0)" class="btn vd_btn vd_bg-grey btn-sm" data-id="'.$id_submenu.'" id="btnMenuNonAktif"> None</a>';
										}else{
											$tombol_sub = '<a href="javascript:void(0)" class="btn btn-info btn-sm" data-id="'.$id_submenu.'" id="btnMenuAktif"> Aktif</a>';
										}
									?>
									<li class="sort" style = "background-color:white; " >
										<table>
											<td><?=$tombol_sub?></td>
											<td><?= $s->controller ?></td>
										</table>
									</li>
								<?php endforeach; ?>
								<?php } ?>
							</ul>
						<?php endforeach; ?>
					</ul>
					<?php } ?>
				</div>

			</div><!-- .panel widget -->
			</div><!-- .col-sm --> 
		</div><!-- .row--> 
<!-- AKHIR CONTENT -->

			
		</div>
	</div><!-- .vd_content --> 
</div><!-- .vd_container --> 
</div><!-- .vd_content-wrapper --> 

<script>
function __go()
{
	var level = $('#level').val();
	if (level != '') {
		window.location = '<?=base_url("admin/settings/hak_akses/level/")?>'+level;
	} else {
		alert('Pilih Data Level terlebih dahulu');
	}
	// alert(level);
}	

$(document).on('click', '#btnMenuAktif', function() {
		var id = $(this).attr('data-id');
		var level = $('#level').val();
		var url = '<?=base_url()?>admin/settings/hak_akses/simpan_akses'
		$.ajax({
	        url : url,
	        type: "POST",
	        data: {id:id, level:level},
	        dataType: "JSON",
	        success: function(data){
	             window.location.reload();   
	        },error: function (jqXHR, textStatus, errorThrown) {
	            alert('error broo...');
	            console.log(jqXHR.responseText);
	            console.log(errorThrown);
	        }   
	    });
	});
</script>

