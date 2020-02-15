<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('submenu_mdl'));

		date_default_timezone_set("Asia/Jakarta");
		cek_login_admin();
	}
	function _remap($method, $params=array())
    {
        $method_exists = method_exists($this, $method);
        $methodToCall = $method_exists ? $method : 'index';
        $this->$methodToCall($method_exists ? $params : $method);
    }
	public function index($id)
	{	
		// echo($this->uri->segment(4));
		$data['subtitle']="Settings sidemenu administrator";
		$this->template->administrator('admin_v/settings/v_sidemenu', $data);
	}

	public function sub($id)
	{	
		// $data['uri'] = '';
		$data['url_table'] = base_url().'admin/settings/submenu/list_sidemenu/'.$id;
		$data['url_save'] = base_url().'admin/settings/submenu/save_menu';
		$data['url_edit'] = base_url().'admin/settings/submenu/edit_menu/';
		$data['subtitle']="Settings Submenu administrator";
		$this->template->administrator('admin_v/settings/v_submenu', $data);
	}

	public function list_sidemenu($sub)
	{	
		// $sub = $this->uri->segment(5);
		// die($sub);
		$table = '';
		$table .= '<table class="table table-striped table-hover" style ="border-bottom: 2px #DDDDDD solid; border-top: 2px #DDDDDD solid; vertical-align: middle;">';
		$table .= '<thead style="background-color:#95a5a6; color:white;">
		<th>Controller</th>
		<th>Url</th>
		<th>Icon</th>
		<th>With Sub?</th>
		<th>Option</th>
		</thead>
		<tbody>';

		
		if ($sub == '') {
			$sidemenu = $this->submenu_mdl->_get_where_order(['id_main <'=>1]);
		} else {
			$sidemenu = $this->submenu_mdl->_get_where_order(['id_main'=>$sub]);
		}
		
		if (count($sidemenu) > 0) {
			foreach ($sidemenu as $key) {
				$url_submenu = base_url().'admin/settings/submenu/create_submenu/'.$key->id;
				$url_edit = base_url().'admin/settings/submenu/edit_menu/'.$key->id;
				$url_delete = base_url().'admin/settings/submenu/delete_main/'.$key->id;

				$autocode = base_url().'auto/generate/table/'.$key->url;
				if ($key->is_main == 0) {
					$tombol = 'No';
					
				}else{
					$tombol = '<a href="'.$url_submenu.'" class="btn btn-dark btn-xs">>> Create Submenu</a>';
				}

				if ($sub == '') {
					$tombol_opsi = '<button class="btn btn-info btn-xs" onclick="_edit('.$key->id.')"><i class="fa fa-pencil"></i> Edit</button>
									        <button class="btn btn-danger btn-xs" id="btnHapus" data-url="'.$url_delete.'" data-id="'.$key->id.'"><i class="fa fa-trash"></i></button>';
				} else {
					$tombol_opsi = '
					<a href="'.$autocode.'" target="_blank" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Auto"><i class="fa fa-refresh"></i> Generate</a>
					<button class="btn btn-info btn-xs" onclick="_edit('.$key->id.')"><i class="fa fa-pencil"></i> Edit</button>
									        <button class="btn btn-danger btn-xs" id="btnHapus" data-url="'.$url_delete.'" data-id="'.$key->id.'"><i class="fa fa-trash"></i></button>
						
									        ';
				}


				$table .= '<tr>
				<td>'.$key->controller.'</td>
				<td>'.$key->url.'</td>
				<td>'.$key->icon.'</td>
				<td>'.$tombol.'</td>
				<td>'.$tombol_opsi.'</td>
				
				</tr>';
			}//foreach end
		}else{
			$table .= '<tr>
			<td  colspan="5" class="c-text">DATA TIDAK ADA</td>
			</tr>';
		}

		$table .= '</tbody></table>';
		echo $table;
	}//end function


	function view_data()
	{	
		if (!$this->input->is_ajax_request()) {
			exit('Anda tidak berhak akses langsung dari Url');
		}
		$count = $this->submenu_mdl->count_all();
		// echo ($count); die();
		$this->viewTableTanpaDataTable($count);
	}

	public function data_table($conditions)
	{	

		$dataListString = '';
		// $i=$startIndex+1;
		$i= $conditions['startIndex']+1;
		$start = $conditions['startIndex'];
		$limit = $conditions['rowsPerPage'];	
		//Querying data from data
		$query = $this->submenu_mdl->_fetch_dataTable($conditions);
		$jumlah = $this->submenu_mdl->_count_dataTable($conditions);
		$jml_all = $this->submenu_mdl->count_all();

		$dataListString .='		<table class="table table-striped table-hover no-head-border" style="valign: midlle;">
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
				$id_data = $this->encryptku->encode($id);
				$preview = base_url().'admin/settings/sidemenu/preview?id='.$id_data;
				$url_submenu = base_url().'admin/settings/sidemenu/?data='.$id;
		// ==========================================================================================
				if ($is_main == 0) {
					$tombol = '<span class="label label-danger"> No Submenu</span>';
					
				}else{
					$tombol = '<a href="'.$url_submenu.'" class="btn vd_btn vd_bg-blue btn-xs"><i class="fa fa-plus"></i> Add Submenu</a>';
				}

				$option ='	<div class="btn-group">
                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
                        <li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
                      </ul>
                    </div>
				';
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
		return $dataListString;
	}

	function preview()
	{
		$id_data = $_GET['id'];
		$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);
		$this->template->administrator('admin_v/settings/v_preview_sidemenu', $data);
	}

	function _fetch_data_from_dbById($id)
	{
		$get = $this->submenu_mdl->_get_by_id($id);
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
		$get['form'] = $this->submenu_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}


	//SIMPAN DATA
	function save_data()
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$this->submenu_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	//UPDATE DATA
	function update_data()
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->input->post('id', TRUE);
		$this->submenu_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	// INI JUGA DIRUBAH 
	function _fetch_data()
	{	
		$uri = $this->uri->segment(5);
		$data['controller'] = $this->input->post('controller');
		$data['url'] = $this->input->post('url');
		$data['icon'] = $this->input->post('icon');
		if ($uri == '') {
			$data['id_main'] = 0;
			$data['is_main'] = $this->input->post('is_main');
		}else {
			$data['id_main'] = $uri;
			$data['is_main'] = 0;
		}
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
			
			$this->submenu_mdl->_delete_where(['id'=>$id]);
		}
		
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}



	// INI HANYA UNTUK SUBMENU
	function create_submenu()
	{	
		$uri = $this->uri->segment(5);
		$data = '';
		$this->template->administrator('admin_v/settings/v_sidemenu', $data);
	}

}

	/* End of file Sidemenu.php */
/* Location: ./application/controllers/admin/settings/Sidemenu.php */