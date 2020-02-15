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
			<div class="col-md-6" id="kolomB">
			<div class="panel widget light-widget panel-bd-left ">
				<div class="panel-heading no-title">
					<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-folder-open-o"></i> </span> Manage Table </h3>
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
					<h5><?= anchor('admin/settings/generate/table/'.$select_table["SCHEMA_NAME"],'Create Table', array('class' => 'btn btn-primary'));?></h5>
					<hr />
					<div id="data_table"></div>
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
function load_table()
{
 	var url_table = '<?=base_url()?>admin/settings/generate/list_table/'+'<?=$select_table["SCHEMA_NAME"]?>';
  	$.ajax({
   		url:url_table,
   		method:"POST",
   		success:function(data){
		    $('#data_table').html(data);
   		}
  	});
}
load_table();

// HAPUS DATA
function _delete(tbname){
	alert(tbname);
}

$(document).ready(function(e){

	$(document).on('click', '#btnDelete',function(e){
    	var tbname = $(this).attr('data-tbname');
    	var dbname = $(this).attr('data-dbname');

    	var _newUrl = '<?=base_url()?>admin/settings/generate/drop_table';
    	     swal({title: "Are you sure?",text: "Benarkah Data ini dihapus?!",type: "warning",
        showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
        allowOutsideClick: false}).then(function (isConfirm) {
           $.post(_newUrl,{tbname:tbname, dbname:dbname} ,
            function(){ load_table();
            })
        }).catch(swal.noop);
	});

	
    
    // var id = [];
    // $(':checkbox:checked').each(function(i){
    //     id[i] = $(this).val();})
    // if(id.length === 0){swal("Peringatan!", "Belum Ada Data terseleksi", "error").catch(swal.noop);
    //     return false;
    // }else{
    //     swal({title: "Are you sure?",text: "Benarkah Data ini dihapus?!",type: "warning",
    //     showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
    //     allowOutsideClick: false}).then(function (isConfirm) {
    //        $.post(_newUrl,{id:id} ,
    //         function(){ 
    //             for(var i=0; i<id.length; i++){
    //             $('tr#'+id[i]+'').css('background-color', '#ccc');
    //             $('tr#'+id[i]+'').fadeOut('slow');
    //             }
    //             setTimeout(function(){showList('goto');}, 2000);
    //         })
    //     }).catch(swal.noop);
    // }

})


</script>

