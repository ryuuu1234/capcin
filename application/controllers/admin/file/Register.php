<?php

		 		if (!defined('BASEPATH'))
		 			exit('No direct script access allowed');

		 		class Register extends MY_Controller
		 		{	
		 			function __construct()
		 			{
		 				parent::__construct();
		 				$this->load->model(array('register_mdl', 'level_mdl', 'users_mdl'));
		 				$this->perPage = 10;
		 				$this->urii = 4;
		 				date_default_timezone_set('Asia/Jakarta');
						cek_login_admin();
		 				
    		}

    public function index()
		    {	
		    	$data['subtitle']='';
		    	$this->template->administrator('admin_v/file/v_register', $data);
			}

    public function view_data()
			{	
				if (!$this->input->is_ajax_request()) {
					exit('Anda tidak berhak akses langsung dari Url');
				}
				$count = $this->register_mdl->count_all();
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
				$query = $this->register_mdl->_fetch_dataTable($conditions);
				$jumlah = $this->register_mdl->_count_dataTable($conditions);
				$jml_all = $this->register_mdl->count_all();
				$class_table = "table table-striped table-hover table-responsive no-head-border";
							$class_head = "vd_bg-green vd_white";
							$class_right = "text-right";

	    $dataListString .='		<table class="'.$class_table.'" style="valign: midlle;">
				<thead class="'.$class_head.'">
				<tr>
				<th width="5%"><div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div></th>
				         <th class="">#</th>
				         <th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="nama" data-order="desc">Nama</a></th>
				         <th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="username" data-order="desc">Username</a></th>
				         <th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="email" data-order="desc">Email</a></th>
				         <th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="id_level" data-order="desc">level</a></th>
				         <th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="status" data-order="desc">Status</a></th>
				         
				         <th class="text-right">Opsi</th></tr></thead><tbody>';
		if ($query->num_rows()>0) {
					foreach($query->result() as $row)
						{	
				$id = $row->id;
				$nama = $row->nama;
				$username = $row->username;
				$email = $row->email;
				$id_level = $row->id_level;
				$status = $row->status;
				$created_at = $row->created_at;
				$updated_at = $row->updated_at;
				$removed_at = $row->removed_at;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
		$get_level = $this->level_mdl->_get_by_id($id_level);
				$this->level_mdl->_count_where(['id'=>$id_level]) > 0 ? $levelx = $get_level->nama: $levelx = "invalid level"; 
				$levelx == 'invalid level'? $class_lbl ="danger": $class_lbl = "warning"; 
				$status == 0? $txt_status = "inConfirm": $txt_status = "active";
				$status == 0? $class_status = "danger": $class_status = "primary";
				if($status == 0){
					$statusX = '<button data-id="'.$id.'" data-status="'.$status.'" class="btn btn-'.$class_status.' btn-xs btnConfirmed">'.$txt_status.'
					</button>';
				} else {
					$statusX = '<span class="label label-primary">'.$txt_status.'</span>';
				}
				$url_confirm = base_url().'admin/file/users/konfirm_users?id='.$id.'&status='.$status;
				$page = $this->uri->segment(5);
		// ==========================================================================================
				$edit_data = base_url().'admin/file/register/add_update/'.$id;
					$preview = base_url().'admin/file/register/preview/?id='.$id; 
					    //========================================================
				$dataListString .= 
					'<tr id="'.$id.'">
					<td>
					<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" />
					</td>
						<td class="">'.$i++.'</td>
						<td class="">'.$nama.'</td>
						<td class="">'.$username.'</td>
						<td class="">'.$email.'</td>
						<td class="midle-align"><span class="label label-'.$class_lbl.'">'.$levelx.'</span></td>
						<td class="midle-align">
							'.$statusX.'
						</td>
						
						
						<td class="text-right">
						<div class="btn-group">
	                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
	                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
	                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
	                      </ul>
	                    </div>
						</tr>';

						}
							// ===========akhir foreach========================
							//check if no data in database, then display No Data message
					} else {
						$dataListString .= '<tr><td colspan="8" style="text-align:center; color:#c0434d;"><i class="fa fa-frown-o"></i> No Data Found</td></tr>';}
						$dataListString .= '<tr><td colspan="8"><i class=""> <b style="color:black;">'.$jumlah.'</b> Data ditampilkan dari <b style="color:black;">'.$jml_all.'</b> 
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
		$this->template->administrator("admin_v/file/v_preview_register", $data);
	}

	function konfirm_users()
	{
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status', TRUE);

		$status == 0? $confirm=1:$confirm = 0;

		$this->register_mdl->_update(
			[
				'status'=>$confirm,
				'removed_at'=>time(),
			], $id);
		$reg = $this->register_mdl->_get_by_id($id);
		$insert_user = array(
			'nama'=>$reg->nama,
			'username'=>$reg->username,
			'email'=>$reg->email,
			'password'=>$reg->password,
			'level'=>$reg->id_level,
			'status'=>$reg->status,
			'date_created'=>time(),
		);	
		$this->users_mdl->_insert($insert_user);	
		echo json_encode(array("status"=>true));
	}	
	

	function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->register_mdl->_get_by_id($id);
		$data = array(
	        "id"=>$get->id,
	        "nama"=>$get->nama,
	        "username"=>$get->username,
	        "email"=>$get->email,
	        "id_level"=>$get->id_level,
	        "status"=>$get->status,
	        "created_at"=>$get->created_at,
	        "updated_at"=>$get->updated_at,
	        "removed_at"=>$get->removed_at,
	);

		return $data;
	}
	

	function edit_data() // =================EDIT DATA
	{	
		$id = $_GET['id'];
		$get['form'] = $this->register_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	

	function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data['date_created'] = date('Y-m-d H:i:s');
		$this->register_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data['date_updated'] = date('Y-m-d H:i:s');
		$id=$this->input->post('id', TRUE);
		$this->register_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);
	        $data["id"]=$this->input->post("id",TRUE);
	        $data["nama"]=$this->input->post("nama",TRUE);
	        $data["username"]=$this->input->post("username",TRUE);
	        $data["email"]=$this->input->post("email",TRUE);
	        $data["id_level"]=$this->input->post("id_level",TRUE);
	        $data["status"]=$this->input->post("status",TRUE);
	        $data["created_at"]=$this->input->post("created_at",TRUE);
	        $data["updated_at"]=$this->input->post("updated_at",TRUE);
	        $data["removed_at"]=$this->input->post("removed_at",TRUE);
	        $data["id_log"]=id_session();
return $data;
	}
	

	function _validate() // =================VALIDASI
	{	
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
	        if($this->input->post("id") == ""){$data["inputerror"][] = "id";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("username") == ""){$data["inputerror"][] = "username";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("email") == ""){$data["inputerror"][] = "email";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("id_level") == ""){$data["inputerror"][] = "id_level";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("status") == ""){$data["inputerror"][] = "status";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("created_at") == ""){$data["inputerror"][] = "created_at";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("updated_at") == ""){$data["inputerror"][] = "updated_at";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
	        if($this->input->post("removed_at") == ""){$data["inputerror"][] = "removed_at";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
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
			
			$this->register_mdl->_delete_where(['id'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	}