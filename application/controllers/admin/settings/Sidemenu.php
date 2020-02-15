<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidemenu extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('sidemenu_mdl', 'submenu_mdl'));

		$this->perPage = 10;
		$this->urii = 4;

		date_default_timezone_set("Asia/Jakarta");
		cek_login_admin();
	}
	public function index()
	{
		$data['subtitle']="Settings sidemenu administrator";
		$this->template->administrator('admin_v/settings/v_sidemenu', $data);
	}

	function view_data()
	{	
		if (!$this->input->is_ajax_request()) {
			exit('Anda tidak berhak akses langsung dari Url');
		}
		$sub = $this->input->post('subKategori', TRUE);
		$sub == ''? $count = $this->sidemenu_mdl->count_all() : $count = $this->submenu_mdl->count_all();
		
		// echo ($count); die();
		$this->viewTableTanpaDataTable($count);
	}

	public function data_table($conditions)
	{	

		$dataListString = '';
		$dataListString .= '<div style=" text-align:right; margin-top:10px; margin-bottom:10px;">
									<button type="submit" class="btn vd_btn vd_bg-green btn-xs" id="nav_first"><i class="fa fa-fast-backward"></i> First</button>
									<button type="submit" class="btn vd_btn vd_bg-green btn-xs" id="nav_prev"><i class="fa fa-caret-left"></i> Prev</button>
									<select class="nav_pageNum btn btn-default btn-xs width-10" id="nav_currentPage"></select>
									<button type="submit" class="btn vd_btn vd_bg-green btn-xs" id="nav_next">Next <i class="fa fa-caret-right"></i></button>
									<button type="submit" class="btn vd_btn vd_bg-green btn-xs" id="nav_last">Last <i class="fa fa-fast-forward"></i></button>
								</div>';
		// $i=$startIndex+1;
		$i= $conditions['startIndex']+1;
		$start = $conditions['startIndex'];
		$limit = $conditions['rowsPerPage'];	
		//Querying data from data
		//khusus kontroller ini saja
		$sub = $this->input->post('subKategori', TRUE);
		if ($sub == '') {
			$query = $this->sidemenu_mdl->_fetch_dataTable($conditions);
			$jumlah = $this->sidemenu_mdl->_count_dataTable($conditions);
			$jml_all = $this->sidemenu_mdl->count_all();
		} else {
			$query = $this->submenu_mdl->_fetch_dataTable($conditions);
			$jumlah = $this->submenu_mdl->_count_dataTable($conditions);
			$jml_all = $this->submenu_mdl->count_all();
		}


		

		$dataListString .='		<table class="table table-striped table-hover no-head-border" style="valign: midlle; border-bottom:1px solid green;">
		<thead class="vd_bg-green vd_white">
		<tr>
		<th width="5%">
		<div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div>  </th>
		<th><a href="javascript:void(0)" class="col-sort vd_white" id="controller" data-order="desc">controller</a></th>
		<th><a href="javascript:void(0)" class="col-sort vd_white" id="url" data-order="desc">url</a></th>
		<th>icon</th>
		<th>With Sub?</th>
		<th class="text-right"><i class="fa fa-gear"></i></th></tr></thead><tbody>';
		if ($query->num_rows()>0) {
			foreach($query->result() as $row)
			{	
				$id = $row->id;
				$controller = $row->controller;
				$url = $row->url;
				$icon = $row->icon;
				$is_main = $row->is_main;
				$id_main = $row->id_main;
				$urut = $row->urut;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
				// $edit_data = base_url().'admin/settings/sidemenu/add_update/'.$id;
				$id_data = $id;
				$preview = base_url().'admin/settings/sidemenu/preview?id='.$id_data;
				$url_submenu = base_url().'admin/settings/sidemenu/submenu';
				$autogen = base_url().'admin/settings/generate/auto_script/'.$id;
		// ==========================================================================================
				if ($is_main == 0) {
					$tombol = '<span class="label label-danger"> No Submenu</span>';
					$option ='	<div class="btn-group">
                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
                        <li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
                        <li><a href="'.$autogen.'" target="_blank"> <i class="fa fa-refresh" style="margin-right:10px;"></i>Autogen</a></li>
                      </ul>
                    </div>';
					
				}else{
					$tombol = '<a href="javascript:void(0)" onclick="__subKategori('.$id.')" class="btn vd_btn vd_bg-blue btn-xs"><i class="fa fa-plus"></i> Add Submenu</a>';
					$option ='	<div class="btn-group">
                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
                        <li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
                        
                      </ul>
                    </div>';
				}

				
			    //========================================================
				$dataListString .= 
				'<tr id="'.$id.'">
				<td>
				<div class="vd_checkbox checkbox-success" >
				<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" id="checkbox-'.$id.'" />
				<label for="checkbox-'.$id.'"></label></div>
				</td>
				<td>'.$controller.'</td>
				<td>'.$url.'</td>
				<td>'.$icon.'</td>
				<td>'.$tombol.'</td>
				<td class="text-right">'.$option.'</tr>';

			}
			// ===========akhir foreach========================
			//check if no data in database, then display No Data message
		} else {
			$dataListString .= '<tr><td colspan="6" style="text-align:center; color:#c0434d;"><i class="fa fa-frown-o"></i> No Data Found</td></tr>';
		}

		$dataListString .= '<tr><td colspan="6"><span class="label label-default"><i> <strong >'.$jumlah.'</strong> Data ditampilkan dari <strong >'.$jml_all.'</strong> 
		Data Keseluruhan</i></span></td>
		</tr>';
		$dataListString .= '</tbody></table>';
		$dataListString .= '<div style=" text-align:right; margin-top:-10px;">
									<button type="submit" class="btn vd_btn vd_bg-grey btn-xs" id="nav_first"><i class="fa fa-fast-backward"></i> First</button>
									<button type="submit" class="btn vd_btn vd_bg-grey btn-xs" id="nav_prev"><i class="fa fa-caret-left"></i> Prev</button>
									<select class="nav_pageNum btn btn-default btn-xs width-10" id="nav_currentPage"></select>
									<button type="submit" class="btn vd_btn vd_bg-grey btn-xs" id="nav_next">Next <i class="fa fa-caret-right"></i></button>
									<button type="submit" class="btn vd_btn vd_bg-grey btn-xs" id="nav_last">Last <i class="fa fa-fast-forward"></i></button>
								</div>';
		return $dataListString;
	}

	function preview()
	{
		$id = $_GET['id'];
		// $id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);
		$this->template->administrator('admin_v/settings/v_preview_sidemenu', $data);
	}

	function _fetch_data_from_dbById($id)
	{
		$get = $this->sidemenu_mdl->_get_by_id($id);
		$data = array(
			'controller'=>$get->controller,
			'url'=>$get->url,
			'icon'=>$get->icon,
			'is_main'=>$get->is_main,
			'id_main'=>$get->id_main,
			'urut'=>$get->urut,
		);

		return $data;
	} 

	// EDIT FORM
	function edit_data()
	{
		$id = $_GET['id'];
		$get['form'] = $this->sidemenu_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}


	//SIMPAN DATA
	function save_data()
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$this->sidemenu_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	//UPDATE DATA
	function update_data()
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->input->post('id', TRUE);
		$this->sidemenu_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	// INI JUGA DIRUBAH 
	function _fetch_data()
	{	
		$uri = $this->uri->segment(5);
		$data['controller'] = $this->input->post('controller', TRUE);
		$data['url'] = $this->input->post('url', TRUE);
		$data['icon'] = $this->input->post('icon', TRUE);
		
			$data['id_main'] = $this->input->post('id_main', TRUE);
			$data['is_main'] = $this->input->post('is_main', TRUE);
		$data['urut'] = $this->input->post('urut');

		return $data;
	}

	function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post("controller") == ""){$data["inputerror"][] = "controller";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("url") == ""){$data["inputerror"][] = "url";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("icon") == ""){$data["inputerror"][] = "icon";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("urut") == ""){$data["inputerror"][] = "urut";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	function delete_data()
	{
		$id = $this->input->post('id');
		foreach ($id as $id) {
			
			$this->sidemenu_mdl->_delete_where(['id'=>$id]);
		}
		
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}



	// INI HANYA UNTUK SUBMENU

	function submenu(){
		$data['subtitle']="Settings sidemenu administrator";
		$this->template->administrator('admin_v/settings/v_submenu', $data);
	}

	
}

	/* End of file Sidemenu.php */
/* Location: ./application/controllers/admin/settings/Sidemenu.php */