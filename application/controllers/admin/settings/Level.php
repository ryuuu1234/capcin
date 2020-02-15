<?php

		 		if (!defined('BASEPATH'))
		 			exit('No direct script access allowed');

		 		class Level extends MY_Controller
		 		{	
		 			function __construct()
		 			{
		 				parent::__construct();
		 				$this->load->model(array('level_mdl'));
		 				$this->perPage = 10;
		 				$this->urii = 4;
		 				date_default_timezone_set('Asia/Jakarta');
		 				cek_login_admin();
    		}

    public function index()
		    {	
		    	$data['subtitle']='';
		    	$this->template->administrator('admin_v/settings/v_level', $data);
			}

    public function view_data()
			{	
				if (!$this->input->is_ajax_request()) {
					exit('Anda tidak berhak akses langsung dari Url');
				}
				$count = $this->level_mdl->count_all();
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
				$query = $this->level_mdl->_fetch_dataTable($conditions);
				$jumlah = $this->level_mdl->_count_dataTable($conditions);
				$jml_all = $this->level_mdl->count_all();

	    $dataListString .='		<table class="table table-striped table-hover no-head-border" style="valign: midlle;">
				<thead class="vd_bg-green vd_white">
				<tr>
				<th width="5%"><div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div></th>
				         <th><a href="javascript:void(0)" class="col-sort vd_white" id="nama" data-order="desc">Nama</a></th>
				         <th class="text-right">Opsi</th></tr></thead><tbody>';
		if ($query->num_rows()>0) {
					foreach($query->result() as $row)
						{	
				$id = $row->id;
				$nama = $row->nama;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
		// ==========================================================================================
				$edit_data = base_url().'admin/settings/level/add_update/'.$id;
					$preview = base_url().'admin/settings/level/preview/?id='.$id; 
					    //========================================================
				$dataListString .= 
					'<tr id="'.$id.'">
					<td>
					<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" />
					</td>
						<td>'.$nama.'</td>
						<td class="text-right">
						<div class="btn-group">
	                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
	                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
	                        <li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
	                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
	                        
	                      </ul>
	                    </div>
						</tr>';

						}
							// ===========akhir foreach========================
							//check if no data in database, then display No Data message
					} else {
						$dataListString .= '<tr><td colspan="7" style="text-align:center; color:#c0434d;"><i class="fa fa-frown-o"></i> No Data Found</td></tr>';}
						$dataListString .= '<tr><td colspan="7"><i class=""> <b style="color:black;">'.$jumlah.'</b> Data ditampilkan dari <b style="color:black;">'.$jml_all.'</b> 
						Data Keseluruhan</i></td>
						</tr>';
						$dataListString .= '</tbody></table>';
									return $dataListString;
					}

	function preview() // =================PREVIEW
	{	
		$id = $_GET['id'];
		//$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);		
		$this->template->administrator("admin_v/settings/v_preview_level", $data);
	}
	

	function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->level_mdl->_get_by_id($id);
		$data = array(
	        "nama"=>$get->nama,
	);

		return $data;
	}
	

	function edit_data() // =================EDIT DATA
	{	
		$id = $_GET['id'];
		$get['form'] = $this->level_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	

	function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$this->level_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->input->post('id', TRUE);
		$this->level_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);
	        $data["nama"]=$this->input->post("nama",TRUE);
return $data;
	}
	

	function _validate() // =================VALIDASI
	{	
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
	        if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		};
	}
	

	function delete_data() // =================DELETE DATA
	{	
		$id = $this->input->post('id');
		foreach ($id as $id) {
			
			$this->level_mdl->_delete_where(['id'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	}