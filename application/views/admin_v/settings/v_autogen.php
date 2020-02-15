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
			<div class="panel widget light-widget panel-bd-left ">
				<div class="panel-heading no-title">
					<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-folder-open-o"></i> </span> Table <?=$this->uri->segment(3)?> </h3>
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
					<form action="" method="POST" id="add-form">
	                    <div class="form-group">
	                        <label>Select Table - <a href="#" onclick="_refresh()">Refresh</a></label>
	                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
	                            <option value="">Please Select</option>
	                            <?php
	                            foreach ($table_list as $table) {?>
	                                <option value="<?php echo $table?>" ><?php echo $table?></option>
	                            <?php }?>
	                        </select>
	                    </div>
	                    <div class="form-group">
                        	<label>Custom Controller Name</label>
                        	<input type="text" id="controller" name="controller" value="<?php echo $controller ?>" class="form-control" placeholder="Controller Name" />
                    	</div>
                    	<div class="form-group">
                        	<label>Letak Controller</label>
                        	
                        	<input type="text" id="letak_controller" name="letak_controller" value="<?=$letak_controller?>" class="form-control" placeholder="Letak Controller" />
                    	</div>
                    	<div class="form-group">
                        	<label>Custom View Name</label>
                        	<input type="text" id="view" name="view" value="<?php echo $view ?>" class="form-control" placeholder="View Name" />
                    	</div>
                    	<div class="form-group">
                        	<label>Letak View</label>
                        	
                        	<input type="text" id="letak_view" name="letak_view" value="<?=$letak_view?>" class="form-control" placeholder="Letak View" />
                    	</div>
                    	<div class="form-group">
                        	<label>Custom Model Name</label>
                        	<input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    	</div>
                    	
                    </form>
	                <div class="text-right">
	                	<button name="generate" id="generate" data-url="<?=$url_gen;?>" class="btn btn-primary" onclick="_generate()">Generate</button>
	            	</div>
				</div>

			</div><!-- .panel widget -->
			</div><!-- .col-sm --> 
			<div class="col-md-8" id="kolomB">
			<div class="panel widget light-widget panel-bd-left ">
				<div class="panel-heading no-title">
					<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-folder-open-o"></i> </span> TXT Hasil </h3>
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
					<div id="list" style="border: 1px solid grey; width:auto; height:300px; padding:20px; background-color:#EDEDED; ">
                	</div>
				</div>

			</div><!-- .panel widget -->
			</div><!-- .col-sm --> 
		</div><!-- .row--> 
<!-- AKHIR CONTENT -->

			
		</div>
	</div><!-- .vd_content --> 
</div><!-- .vd_container --> 
</div><!-- .vd_content-wrapper --> 

<script type="text/javascript">
    setname();
	function _refresh(){
		window.location.reload();
	}

    function capitalize(s) {
        return s && s[0].toUpperCase() + s.slice(1);
    }

    function setname() {
        document.getElementById('controller').value = capitalize('<?=$controller;?>');
        document.getElementById('model').value = capitalize('<?=$controller;?>') + '_mdl';
    }

    function _generate()
    {   
        var url = $('#generate').attr('data-url');
        var table_name = $('#table_name').val();
        if (table_name == '') {
             notif_('error');
        } else {

            $.ajax({
            url : url,
            type: "POST",
            data: $('#add-form').serialize(),
            dataType: "JSON",
            success: function(resp){
                    resp = JSON.parse(JSON.stringify(resp));
                        var arr = resp.txt_hasil;
                        var list = document.getElementById('list');
                        createList(arr, list);
                        $('#list-hasil').html('<p>'+resp.txt_hasil+'</p>');
                    notif_('success');
                }
            });

             
        }
    }

    function createList(items, parent){
      var ul = document.createElement('ul');
      parent.appendChild(ul);
      items.forEach(function generateList(item) {
        var li = document.createElement('li');
        ul.appendChild(li);
        if(Array.isArray(item)){
          createList(item, li);
        } else {
            li.innerHTML = item;
        }
      });
    }

    function simpanData()
    {

      var urlSave = document.getElementById("btnSave").getAttribute("data-url"); 
      // alert(urlSave);
        var id = $('input[name="id_data"]').val();
        if (id != '') {
          urlX = urlSave + id;
        }else{
          urlX = urlSave;
        }
        $.ajax({
            url : urlX,
            type: "POST",
            data: $('#add-form').serialize(),
            dataType: "JSON",
            success: function(data){
                if (data.status){  // jika sukses masukkan ke tabel tutup modal
                    $('#add-form')[0].reset();
                    new PNotify({
                                      title: 'Success !!!',
                                      text: 'Data yang anda masukkan sukses tersimpan!',
                                      type: 'success',
                                      styling: 'bootstrap3'
                                  });
                }else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    { 
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                    }
                }
            },error: function (jqXHR, textStatus, errorThrown) {
                alert('error broo...');
            }   
        });
    }


</script>

