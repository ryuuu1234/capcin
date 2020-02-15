
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
						<?php if ($uri3 == "") { ?>
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
			<div class="row"><div class="col-md-4" id="kolomA">
				
				<div class="panel widget light-widget panel-bd-left vd_bdl-yellow">

					<div class="panel-heading no-title">
						<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-file-text"></i> </span> Form Ganti Password </h3>
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
						<form id="add-form" action="#" class="form-horizontal" role="form">
							<input type="hidden" name="id" id="id_data" value="<?=$id_data?>"/>
							<div class="row">
								<div class="col-md-12">
									<label for="nama" class="control-label" >Password Baru </label>
									<div class="controls">
										<input type="text" id="password" name="password" placeholder="Masukkan Password Baru" >
									</div>
								</div>  
								<div class="col-md-12">
									<label for="username" class="control-label" >Ketik Ulang </label>
									<div class="controls">
										<input type="text" id="pass" name="pass" placeholder="Ketik Ulang Password Baru" >
									</div>
								</div>      
							</div>
						</form>
						<hr /><div class="text-right">
						<button class="btn vd_btn vd_bg-grey" id="btnCancel">Cancel</button>
						<button class="btn vd_btn vd_bg-green" id="btnSave">Save</button>

					</div>
				</div>
			</div>	
		</div>

</div><!-- .row--> 
<!-- AKHIR CONTENT -->	
</div>
</div><!-- .vd_content --> 
</div><!-- .vd_container --> 
</div><!-- .vd_content-wrapper --> 
<script>
$(document).ready(function(){

	// ini untuk hilangkan error
	$("input").change(function(){
			$(this).removeClass('vd_bd-red');
			$(this).next().empty();
			$('#btnSave').text('Save');
			$('#btnSave').prop('disabled', false);	
		});
	$("select").change(function(){
			$(this).removeClass('vd_bd-red');
			$(this).next().empty();
			$('#btnSave').text('Save');
			$('#btnSave').prop('disabled', false);	
		});
	$("textarea").change(function(){
			$(this).removeClass('vd_bd-red');
			$(this).next().empty();
			$('#btnSave').text('Save');
			$('#btnSave').prop('disabled', false);	
		});
	// ini untuk tombol save
	$('#btnSave').click(function(){
		var id = $('#id_data').val();
		var btnNya = $('#btnSave');
		btnNya.html('<i class="fa fa-spinner fa-spin vd_white"></i> Please Wait');
		btnNya.prop('disabled', true);

		id == ''? _newUrl = window.location.href + '/save_data':_newUrl = '<?=base_url()?>admin/file/users/update_password/'+id;
		$.ajax({
				url : _newUrl,
				type: "POST",
				data: $('#add-form').serialize(),
				dataType: "JSON",
				success: function(data){
					if (data.status){  // jika sukses masukkan ke tabel tutup modal
						
						$('#add-form')[0].reset();
						notification("topright","success","fa fa-check-circle vd_green","Success Notification","Data Sukses Tersimpan. Good Job!");
						btnNya.text('Save');
						btnNya.prop('disabled', false);	
						__edit(id);
					}else{
						for (var i = 0; i < data.inputerror.length; i++) 
						{ 
							$('[name="'+data.inputerror[i]+'"]').addClass('vd_bd-red');
							$('[name="'+data.inputerror[i]+'"]').parent().append('<div class="vd_red error-string">'+ data.error_string[i] +'</div>'); 
						}
					}
					
				},error: function (jqXHR, textStatus, errorThrown) {
					notification("topright","error","fa fa-exclamation-circle vd_red","Error Notification","Ada yang Error Broo?. Error Data!");
				}   
			});					
	})

	// Cancel button
	$('#btnCancel').click(function(){
		window.location.reload();
	})	
})	
</script>