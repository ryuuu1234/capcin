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
				<div class="col-md-12" id="kolomA">

					<div class="panel widget light-widget panel-bd-left vd_bdl-green">


						<div class="panel-heading no-title">
							<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-bar-chart-o"></i> </span> Form <?=$this->uri->segment(3)?> </h3>
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
							<div class="row">
								

								<div class="col-md-9">
									<form class="form-horizontal" action="#" role="form" id="add-form">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Aplikasi</label>
											<div class="col-sm-7 controls">
												<input class="width-70" name="nama" type="text" placeholder="Input" data-toggle="tooltip" data-placement="top" data-original-title="Input Nama Aplikasi">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Alamat</label>
											<div class="col-sm-7 controls">
												<input class="width-70" name="alamat" type="text" placeholder="Input" data-toggle="tooltip" data-placement="top" data-original-title="Input Alamat">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Kota</label>
											<div class="col-sm-7 controls">
												<input class="width-70" name="kota" type="text" placeholder="Input" data-toggle="tooltip" data-placement="top" data-original-title="Input Nama Kota">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Telp</label>
											<div class="col-sm-7 controls">
												<input class="width-70" name="telp" type="text" placeholder="Input" data-toggle="tooltip" data-placement="top" data-original-title="Input no. Telp">
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0)" id="upload-link-avatar" onclick="upload_logo(1)" >
									<div class="form-group">
                              			<div class="form-img text-center mgbt-xs-15"> 
                              				<img id="imagex" alt="logo-app" src=""> 
                              			</div>
                					</div></a>
                					<form action="#" id="form-image-avatar" method="post" enctype="multipart/form-data" style="margin-top:0px;">
			                            <div class="form-group">
			                              <input type="hidden" id="action_page_avatar" name="action_page_avatar" value="<?=base_url('admin/settings/app/upload_photo/');?>"/>
			                              <input type="file" name="gambar_inputx" id="gambar_inputx" style="display:none;">
			                              <div id="msg-img-uploadx"></div>
			                          </div>
			                          <div class="form-group">
			                          <span id="btnGrup" style="display:none;">
			                                    <button type="submit" class="btn btn-success btn-xs">Simpan</button>
			                                </span>
			                          </div>
			                          <span id="btnSuksesLogin" style="color:green;"></span>
			                          <div id="msg-img-uploadx"></div>
			                        </form>     
								</div>
							</div>
							
							<hr />
							<div class="text-right">
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
	var id = 1;
	__edit(1);

// ini untuk tombol save
	$('#btnSave').click(function(){
		var btnNya = $('#btnSave');
		btnNya.html('<i class="fa fa-spinner fa-spin vd_white"></i> Please Wait');
		btnNya.prop('disabled', true);

		id == ''? _newUrl = window.location.href + '/save_data':_newUrl = window.location.href + '/update_data';
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

// edit data
function __edit(id)
{	
	var url = window.location.href+'/';
	var _newUrl = url+'edit_data?id='+id;
	$.ajax({
		url : _newUrl,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{ 
			const obj = data.form
			const arr = Array.from(Object.keys(obj), k=>[`${k}`, obj[k]]);

			for (var i = 0; i < arr.length; i++) 
			{ 
				$('[name="'+arr[i][0]+'"]').val(arr[i][1]);
						
			}
			var myImage = data.form.logo;
			var base_url = window.location.origin;
			var noImage = base_url+'/assets/images/author/noimage.png';
			var yesImage = base_url+'/assets/images/logo/'+myImage;
			if (myImage == null || myImage == '') {
				$("#imagex").attr("src",noImage);
			}else	{
				$("#imagex").attr("src",yesImage);
			}
						
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Data Error Bruuh....');
		}
	});
}

// Upload Logo
function upload_logo(id)
{ 

  $('#gambar_inputx:hidden').trigger('click');
  $('#gambar_inputx').change(function() {
            $('#msg-img-uploadx').empty();
            var file =  this.files[0];
            var imagefile = file.type;
            var size = file.size;
            var match= ['image/jpeg','image/png','image/jpg'];
            if(size > 2097152){
                    alert("gambar tidak boleh lebih dari 2MB");
                    return false;
              }
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) 
            {
                alert('Ekstensi gambar tidak valid');
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imgLoginUploadAvatar;
                reader.readAsDataURL(this.files[0]);

            }
        });
  function imgLoginUploadAvatar(e) {

            $('#preview-image').attr('src', e.target.result);
            $('#preview-image').attr('class', 'img-responsive thumbnail');
                // $("#btnGrup-"+id).show();
                $("#form-image-avatar").trigger('submit');
        };

        $(document).ready(function(e) {
       $('#form-image-avatar').on('submit', (function(e) {
            e.preventDefault();
            $('#msg-img-uploadx').empty();
            $('#loading-img-upload').show();
            var action_page_avatar = $('#action_page_avatar').val();
            $.ajax({
                url: action_page_avatar + id, // url to wich the request is send
                type: "POST",               // type to request
                data: new FormData(this),   // data send to server, a set of key/value pairs {i.e. form fields and values}
                contentType: false,         // the content vtype to sending data to server
                cache: false,               // to unable request pages to be cached
                processData: false,         // to send DOMDocument or non processed data file it is set false
                success: function(resp)     // a function to be called if request data succeeds
                {
                    $('#loading-img-upload').hide();
                    // $('#btnGroupLogin').hide();
                    $('#btnSuksesLogin').html('Gambar Sukses di Upload dan disimpan.');
                    $('#btnSuksesLogin').fadeOut(3000);
                    // $('#btnGroupLogin').show();
                     $('#gambar_inputx').val('');
                    window.location.reload();
                    console.log(resp);
                    resp = JSON.parse(JSON.stringify(resp));
                }
            });
        }));
    });
     
}
</script>
</script>

