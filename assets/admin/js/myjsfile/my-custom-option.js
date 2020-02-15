var url = window.location.href+'/';

// Parse the URL parameter 
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

		
//--- start navigation btn
$("#nav_first").click(function(e){showList('first'); return false;});
$("#nav_prev").click(function(e){showList('prev'); return false;});
$("#nav_next").click(function(e){showList('next'); return false;});
$("#nav_last").click(function(e){showList('last'); return false;});
$("#nav_rowsPerPage").change(function(e){showList(''); return false;});
$("#nav_currentPage").change(function(e){showList('goto'); return false;});


showList('');                       
// START LIST FUNCTION
function showList(navAction){

	var _newUrl = url+'view_data';	
	
	var searchKategori = $("#kategori_txt").val();
	var subKategori = $("#subKategori").val();
	var searchBrand = $("#brand_txt").val();
	var searchKeyword = $("#search_txt").val(),
	currentPage = $("#nav_currentPage").val(),
	rowsPerPage = $("#nav_rowsPerPage").val(),
	column = $("#column").val(),
	ascDesc = $("#ascDesc").val();

	
	$.ajax({
		type: 'POST',
		url: _newUrl,
		data: {keyword:searchKeyword,subKategori:subKategori,currentPage:currentPage,rowsPerPage:rowsPerPage,navAction:navAction, column:column, ascDesc:ascDesc, kategori:searchKategori, brand:searchBrand},
		beforeSend: function(){
			$(function(e) { 
				_loading_modal();
			});
		},
		success: function(data){
			var data = JSON.parse(data);
            console.log(data.columnName, data.order_by);
            
            //push data to table
            $("#table_data_koe").html(data.list);
            //select or focus the target page
            $("#nav_currentPage").val(data.targetPage);
            //check if action is refresh, then reload the GOTO list
            if(navAction=='refresh' || navAction==''){
                //empty the list
                $('#nav_currentPage').empty();
                //append option item with value to select list
                $.each(data.gotoSelectNum, function(key, value) {   
                	$('#nav_currentPage').append($("<option></option>")
                // .append($('<li><a href="#" data-ci="'+value+'" id="mbh">'+value+'</a></li>'))
                .attr("value",value)
                .text("Page " + value)); 
                });
            }
            
            //show list page and record info
            if(data.totalPages==0){
            	$("#nav_info").html('<i class="fa fa-file-o"></i>&nbsp;&nbsp;&nbsp;List Empty');
            }else{
            	$("#nav_info").html('<i class="fa fa-file-o"></i>&nbsp;&nbsp;&nbsp;Page '+data.targetPage+' of '+data.totalPages);
            }
            //disable or enable pagination button
            $.each(data.nav_btn_disable, function (key, jdata) {if(jdata==1){$("#"+key).removeClass('disabled');}else{$("#"+key).addClass('disabled');}})

            // change data-order on table
            if(data.columnName != '' && data.order_by !=''){

            	(data.order_by == 'desc')? arrow = '&nbsp;&nbsp;&nbsp;<i class="fa fa-sort-amount-desc"></i>':arrow = '&nbsp;&nbsp;&nbsp;<i class="fa fa-sort-amount-asc"></i>';  
                  var d = document.getElementById(data.columnName);  //   Javascript
                  d.setAttribute('data-order' , data.order_by); 
                  $('#'+data.columnName).append(arrow);
              }
             	// hentikan loading/ loading stop  
             	$(function() {
             		setTimeout(function(){$("#modalLoading").modal('hide'); },1000)
				});       
				
              }, error: function(){
              	console.log('url undefine')
              }
          });
    // $.post(_newUrl,{keyword:searchKeyword,currentPage:currentPage,rowsPerPage:rowsPerPage,navAction:navAction, column:column, ascDesc:ascDesc, kategori:searchKategori, brand:searchBrand} ,
    //     beforeSend: function()
    // function(data){ 
    //     //parse json string to javascript json object

    // });                     
}// END LIST FUNCTION 

$(document).ready(function(e) {
//SHOW LIST WHEN DO STRING SEARCH
$("#subKategori").change(function(e){showList('');});
$("#brand_txt").change(function(e){showList('');});  
$("#search_txt").change(function(e){showList('');}); 
// $("#refreshTable").click(function(e){showList('refresh');});
$("#refreshTable").click(function(e){window.location.reload();});
// SHOW LIST ASC/DESC WHEN DO SOLUMN SHORT
$(document).on('click', '.col-sort',function(e){ 
    var columnName = $(this).attr("id"); 
    var sortBy = $(this).attr("data-order");
    // sortBy == 'desc'? sort = 'asc':sort='desc';
    $('#column').val(columnName);
    $('#ascDesc').val(sortBy); 
    showList('');
});
// upload foto
$(document).on('click', '.upload_link',function(e){
    idItem = $(this).attr('data-id');
    upload_foto(idItem);
});
// HAPUS DATA
$("#btnDelete").click(function(e){
    var page = $("#nav_currentPage").val();
    var _newUrl = url + '/delete_data'; 
    var id = [];
    $(':checkbox:checked').each(function(i){
        id[i] = $(this).val();})
    if(id.length === 0){swal("Peringatan!", "Belum Ada Data terseleksi", "error").catch(swal.noop);
        return false;
    }else{
        swal({title: "Are you sure?",text: "Benarkah Data ini dihapus?!",type: "warning",
        showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
        allowOutsideClick: false}).then(function (isConfirm) {
           $.post(_newUrl,{id:id} ,
            function(){ 
                for(var i=0; i<id.length; i++){
                $('tr#'+id[i]+'').css('background-color', '#ccc');
                $('tr#'+id[i]+'').fadeOut('slow');
                }
                setTimeout(function(){showList('goto');}, 2000);
            })
        }).catch(swal.noop);
    }
});

// Export to Excel
$('#btnExport').click(function(e){
    var _newUrl = $(this).attr('data-url'); var id = [];
   $(':checkbox:checked').each(function(i){
    id[i] = $(this).val();
   })
   
  if(id.length === 0){swal("Peringatan!", "Belum Ada Data terseleksi", "error").catch(swal.noop);
        return false;
    }else{
        $('#id_item').val(JSON.stringify(id));
        $('#form-export').attr('action', _newUrl);
        $('#submit').trigger('click');
   }
});
// Export to pdf
$('#btnExportPdf').click(function(e){
    var _newUrl = $(this).attr('data-url'); var id = [];
   $(':checkbox:checked').each(function(i){
    id[i] = $(this).val();
   })
   
  if(id.length === 0){swal("Peringatan!", "Belum Ada Data terseleksi", "error").catch(swal.noop);
        return false;
    }else{
        $('#id_item').val(JSON.stringify(id));
        $('#form-export').attr('action', _newUrl);
        $('#submit').trigger('click');
   }
});

});// END DOCUMENT

// FUNNCTION SELECT ALL
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}




// 
const kolomB = document.getElementById('kolomB');
const classKolomB = $('#kolomB').attr('class');
const xxx = document.querySelectorAll(".error-string");
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


	// ini untuk tombol close
	$('[data-action^="close"]').click(function() {
		var tutup  = $(this).closest(".widget").hide();
		if (tutup) {
			$('#kolomB').removeClass(classKolomB).addClass('col-md-12');
		}
	});

	// ini untuk tombol save
	$('#btnSave').click(function(){
		var btnNya = $('#btnSave');
		btnNya.html('<i class="fa fa-spinner fa-spin vd_white"></i> Please Wait');
		btnNya.prop('disabled', true);
		var id = $('[name="id"]').val();

		id == ''? _newUrl = window.location.href + '/save_data':_newUrl = window.location.href + '/update_data';
		$.ajax({
				url : _newUrl,
				type: "POST",
				data: $('#add-form').serialize(),
				dataType: "JSON",
				success: function(data){
					if (data.status){  // jika sukses masukkan ke tabel tutup modal
						
						$('#add-form')[0].reset();
						$('[name="id"]').val("");
						notification("topright","success","fa fa-check-circle vd_green","Success Notification","Data Sukses Tersimpan. Good Job!");
						btnNya.text('Save');
						btnNya.prop('disabled', false);	
						showList('');
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


		
});
// addNew Data
$('#newData').click(function(){			
    $('#kolomB').removeClass('col-md-12').addClass(classKolomB);
    $(".widget").show();
});	

// back
	function goBack() {
	  window.history.back();
	}

// edit data
function __edit(id)
{	
	$('#kolomB').removeClass('col-md-12').addClass(classKolomB);
    $(".widget").show();
	var _newUrl = url+'/edit_data?id='+id;
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
						
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Data Error Bruuh....');
		}
	});
}

function _loading_modal()
{
	var modalWait = '<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
					+'<div class="modal-dialog modal-sm">'
						+'<div class="modal-content">'
							
							+'<div class="modal-body">' 
									+'<div class="loading-spinner" id="loadingSpin">'
									+ '<h2><i class="fa fa-spinner fa-2x fa-spin vd_green"></i></h2>'	
									+ '<p class="vd_green"><b>Harap Menunggu....</b></p>'
									+'</div>'
							+'</div>'
							
						+'</div>'
					+'</div>'
				+'</div>'

	$('body').append(modalWait);
	
	
	$('#modalLoading').modal('show'); 				
}




