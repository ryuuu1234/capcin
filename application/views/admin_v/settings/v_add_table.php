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
				
					<div class="panel widget light-widget panel-bd-left vd_bdl-yellow">

						<div class="panel-heading no-title">
							<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-folder-open-o"></i> </span> Form <?=$this->uri->segment(3)?> Table</h3>
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
							<form id="id_form" action=" <?= base_url('admin/settings/generate/addTables') ?>" method="post" autocomplete ="off">
								<table class="table">
									<tr>
										<td><input type="button" name="add_btn" value="Add" id="add_btn" class="btn vd_btn vd_bg-green"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									</tr>
									<tr>
										<td>Table Name</td>
									</tr>
									<tr>
										<td><input type="hidden" name="database" value="<?php echo $database['SCHEMA_NAME']?>">
											<input type="text" id="tbname" name="tbname" class="form-control">
										</td>
									</tr>
									<tr>
										<td>Name</td><td>Type</td><td>Length/Values <a href="#" data-toggle="tooltip" data-placement="right" title="if coloumn type is enum,please enter the values using this format: 'a','b','c'... ">?</a></td><td>Null</td><td>Index</td><td>A_I</td><td>&nbsp;</td>
									</tr>
									<tbody id="container">
										<!-- nanti rows nya muncul di sini -->
									</tbody>
									<tr>
										<td><input type="submit" name=submit value="Save" class="btn btn-primary"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
									</tr>
								</table>
							</form>
							<div class="text-right">
								<a href="<?=$lanjut;?>" class="btn btn-success">Lanjut <i class="fa fa-location-arrow"></i></a>
								<?= anchor('admin/settings/generate/manage_table/'.$database['SCHEMA_NAME'],'Manage Table', array('class' => 'btn btn-primary'));?>
							</div>
							<hr/>
							<div class="well">
                				<p></p>
                    			<h4><b style="color:blue;">CATATAN</b></h4>
			                    <ul>
			                        <li><font color="#FF0000">Jika Tabel Sudah Ada <b>KLIK LANJUT</b></font>
			                        </li> 
			                    </ul>                              
                			</div>
						</div><!-- .panel-body--> 
					</div><!-- .panel-widget--> 	
			</div><!-- .col-->
			
		</div><!-- .row--> 
		<!-- AKHIR CONTENT -->

			
		</div>
	</div><!-- .vd_content --> 
</div><!-- .vd_container --> 
</div><!-- .vd_content-wrapper --> 


<?php if ($this->session->flashdata(md5('duplikat'))) : ?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo $this->session->flashdata(md5('duplikat'));?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div> <!-- end div -->
<?php endif; ?>


<script>
$(document).ready(function() {
    var count = 0;
    $("#add_btn").click(function(){
        count += 1;
        var Add = $("#tbname").val();
		if(Add !=""){
            $('#container').append(
                         '<tr class="records">'
                     + '<td><input id="nama[]" name="nama[]" type="text" class="form-control"></td>'
                     + '<td><select id="type[]" name="type[]" class="form-control"><option value="INT">INT</option><option value="VARCHAR">VARCHAR</option><option value="TEXT">TEXT</option><option value="DATE">DATE</option><option value="ENUM">ENUM</option><option value="DECIMAL">DECIMAL</option><option value="FLOAT"> FLOAT</option><option value="DOUBLE">DOUBLE</option></select></td>'
                     + '<td><input id="length[]" name="length[]" type="text" class="form-control"></td>'
                     + '<td><input id="null[]" name="null[]" type="checkbox" value="NULL" class="form-control"></td>'
                     + '<td><select id="index[]" name="index[]" class="form-control"><option></option><option value="PRIMARY KEY">PRIMARY</option><option value="UNIQUE KEY">UNIQUE</option><option value="TEXT">TEXT</option><option value="DATE">DATE</option><option value="INDEX KEY">INDEX</option><option value="FULLTEXT KEY">FULLTEXT</option><option value="SPATIAL KEY"> SPATIAL</option></select></td>'
                     + '<td><input id="ai[]" name="ai[]" type="checkbox" value="AUTO_INCREMENT" class="form-control"></td>'
                );
            return false;
    	}else {
    		alert("isi Nama Table terlebih dahulu")
    	}
    });
        
});
</script>

<script>
	$('#myModal').modal('show');
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

