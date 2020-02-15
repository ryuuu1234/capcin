<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('users_mdl', 'level_mdl'));
		$this->perPage = 10;
		$this->urii = 4;
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}

	public function index()
	{	
		$data['level']=$this->level_mdl->_get_where(['id >' => 1]);
		$this->template->administrator('admin_v/file/v_users', $data);
	}

	public function view_data()
	{	
		if (!$this->input->is_ajax_request()) {
			exit('Anda tidak berhak akses langsung dari Url');
		}
		$count = $this->users_mdl->count_all();
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
		$query = $this->users_mdl->_fetch_dataTable($conditions);
		$jumlah = $this->users_mdl->_count_dataTable($conditions);
		$jml_all = $this->users_mdl->count_all();

		$dataListString .='		<table class="table table-striped table-hover no-head-border" style="valign: midlle;">
		<thead class="vd_bg-green vd_white">
		<tr>
		<th width="5%"><div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div></th>

		<th width="5%">Photo</th>
		<th><a href="javascript:void(0)" class="vd_white col-sort" id="nama" data-order="desc">Details</a></th>
		<th><a href="javascript:void(0)" class="col-sort vd_white" id="level" data-order="desc">Level</a></th>
		<th>Status</th>
		<th class="text-right">Opsi</th></tr></thead><tbody>';
		if ($query->num_rows()>0) {
			foreach($query->result() as $row)
			{	
				$id = $row->id;
				$nama = $row->nama;
				$username = $row->username;
				$email = $row->email;
				$password = $row->password;
				$level = $row->level;
				$photo = $row->photo;
				$status = $row->status;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
				$get_level = $this->level_mdl->_get_by_id($level);
				$this->level_mdl->_count_where(['id'=>$level]) > 0 ? $levelx = $get_level->nama: $levelx = "invalid level"; 
				$levelx == 'invalid level'? $class_lbl ="danger": $class_lbl = "warning"; 
				$status == 0? $txt_status = "inConfirm": $txt_status = "active";
				$status == 0? $class_status = "danger": $class_status = "primary";
				$url_confirm = base_url().'admin/file/users/konfirm_users?id='.$id.'&status='.$status;
				$page = $this->uri->segment(5);
				$action_page = base_url().'admin/file/users/upload_image/';
				// ==============================================
				$loading = base_url()."assets/images/loading.gif";
				$filename = "./assets/images/users/small/".$photo ;
				$ada_foto = (!file_exists($filename) || $photo == '')? base_url()."assets/images/users/nouser.png" : base_url()."assets/images/users/small/".$photo;
		// ==========================================================================================
				$edit_data = base_url().'admin/file/users/add_update/'.$id;
				$preview = base_url().'admin/file/users/preview/?id='.$id; 
				$ganti_password = base_url().'admin/file/users/ganti_password/?id='.$id;
				// ========================================================
				$fotonya = '<a href="javascript:void(0);" id="upload-link" onclick="upload_foto('.$id.')" data-id="'.$id.'" data-page="'.$page.'" data-toggle="tooltip" data-placement="top" title="Upload Foto">
				<img id="preview-image-'.$id.'" src="'.$ada_foto.'" alt="Empty" width="50" class="img-responsive" style="border-radius:40%;" />
				</a>
				<form action="#" id="form-image-'.$id.'" method="post" enctype="multipart/form-data" style="margin-top:0px;">
				<div class="form-group">
				<input type="hidden" id="action_page_'.$id.'" name="action_page_'.$id.'" value="'.$action_page.'"/>
				<input type="file" name="gambar_input" id="gambar_input_'.$id.'" class="form-control" style="display:none;">
				<div id="msg-img-upload-'.$id.'"></div>
				</div>
				<div class="form-group">
				<span id="btnGrup-'.$id.'" style="display:none;">
				<button type="submit" class="btn btn-success btn-xs">Simpan</button>
				</span>
				<span id="loading-img-upload-'.$id.'" style="display: none;"><img src="'.$loading.'" alt=""></span>
				</div>
				<span id="btnSuksesLogin-'.$id.'" style="color:green;"></span>
				<div id="msg-img-upload-'.$id.'"></div>
				</form>';
				//========================================================
				$detailnya = '<i>Nama : </i><b>'.$nama.'</b>
				<p><i>Username : </i><b>'.$username.'</b></p>
				<p style="margin-top:-10px;"><i>Email : </i><b>'.$email.'</b></p>
				';
				// -========================================================
				$dataListString .= 
				'<tr id="'.$id.'">
				<td>
				<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" />
				</td>
				<td>'.$fotonya.'</td>
				<td class="midle-align">'.$detailnya.'</td>
				<td class="midle-align"><span class="label label-'.$class_lbl.'">'.$levelx.'</span></td>
				<td class="midle-align"><button data-id="'.$id.'" data-status="'.$status.'" class="btn btn-'.$class_status.' btn-xs btnConfirmed">'.$txt_status.'</button></td>
				<td class="text-right midle-align">
				<div class="btn-group">
				<a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
				<ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
				<li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
				<li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
				<li><a href="'.$ganti_password.'"> <i class="fa fa-key" style="margin-right:10px;"></i>Ganti Password</a></li>

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

	function konfirm_users()
	{
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status', TRUE);

		$status == 0? $confirm=1:$confirm = 0;

		$this->users_mdl->_update(['status'=>$confirm], $id);
		echo json_encode(array("status"=>true));
	}	

	function ganti_password()
	{	
		$id = $_GET['id'];
		//$id = $this->encryptku->decode($id_data);
		$data['id_data'] = $id;		
		$this->template->administrator("admin_v/file/v_ganti_password", $data);
	}

	function update_password()
	{	
		$this->_validasi_password();
		$pass = password_hash($this->input->post('pass', TRUE), PASSWORD_DEFAULT,['cost'=> 10]);
		$data['password'] = $pass;
		$id = $this->input->post('id');
		$this->users_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	function _validasi_password()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$pass = $this->input->post('password', TRUE);

		$conf = $this->input->post('pass', TRUE);

		if($pass == "") {
					$data["inputerror"][]="password"; 
					$data["error_string"][]="Harap Diisi"; 
					$data["status"]=FALSE; 
		}
		if($conf == "") {
					$data["inputerror"][]="pass"; 
					$data["error_string"][]="Harap Diisi"; 
					$data["status"]=FALSE; 
		}
		if($conf != $pass) {
					$data["inputerror"][]="pass"; 
					$data["error_string"][]="inputan tidak sama .. ulangi lagi yaa..."; 
					$data["status"]=FALSE; 
		}

		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}		

	function preview() // =================PREVIEW
	{	
		$id = $_GET['id'];
		//$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);		
		$this->template->administrator("admin_v/file/v_preview_users", $data);
	}
	

	function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->users_mdl->_get_by_id($id);
		$photo = $get->photo;
		$filename = "./assets/images/users/small/".$photo ;
				$ada_foto = (!file_exists($filename) || $photo == '')? base_url()."assets/images/users/nouser.png" : base_url()."assets/images/users/big/".$photo;
		$data = array(
			"nama"=>$get->nama,
			"username"=>$get->username,
			"password"=>$get->password,
			"level"=>$get->level,
			"photo"=>$ada_foto,
		);

		return $data;
	}
	

	function edit_data() // =================EDIT DATA
	{	
		$id = $_GET['id'];
		$get['form'] = $this->users_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	

	function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$pass = password_hash('123456789', PASSWORD_DEFAULT,['cost'=> 10]);
		$data['password'] = $pass;
		$date_created = date('Y-m-d H:i:s');
		$data['date_created'] = strtotime($date_created);
		$this->users_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->input->post('id', TRUE);
		$date_updated = date('Y-m-d H:i:s');
		$data['date_created'] = strtotime($date_updated);
		$this->users_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);
		$data["nama"]=$this->input->post("nama",TRUE);
		$data["username"]=$this->input->post("username",TRUE);
		$data["level"]=$this->input->post("level",TRUE);
		$data["email"]=$this->input->post("email",TRUE);
		return $data;
	}
	

	function _validate() // =================VALIDASI
	{	
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$email = $this->input->post('email', TRUE);
		$valid_mail = $this->is_email_valid($email);
		$cek_email = $this->users_mdl->_count_where(['email'=>$email]);
		if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("username") == ""){$data["inputerror"][] = "username";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($email== ""){
			$data["inputerror"][] = "email";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;
		} else if($valid_mail == FALSE ){
			$data["inputerror"][] = "email";$data["error_string"][] = "email tidak valid";$data["status"] = FALSE;
		} else if($cek_email >= 1 ){
			$data["inputerror"][] = "email";$data["error_string"][] = "email sudah digunakan!";$data["status"] = FALSE;
		}
		
		if($this->input->post("level") == ""){$data["inputerror"][] = "level";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		};
	}

	function is_email_valid($email) {
		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", trim($email))) {
			return TRUE;
		}
		return FALSE;
	}
	

	function delete_data() // =================DELETE DATA
	{	
		$id = $this->input->post('id');
		foreach ($id as $id) {
			
			$this->users_mdl->_delete_where(['id'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	// upload image
	function upload_image($id)
	{
		try{
			if (!empty($_FILES['gambar_input']['name'])){
				$picture = $this->do_upload_users();
			}else{
				$picture = '';
			}
			$get = $this->users_mdl->_get_by_id($id);
			$photo = $get->photo;
			// $photo_small = $get->photo_small;
			if ($photo != ''){
				unlink('./assets/images/users/big/' .$get->photo);
				unlink('./assets/images/users/small/' .$get->photo);
			}
			// update / insert data baru
			$Data = array('photo' => $picture);
			// transferring data to model for saving image name in databse table
			$update_pict = $this->users_mdl->_update($Data,$id);
			if ($update_pict) {
				// give response
				$data['statusMessage'] = "Tersimpan...";
				echo json_encode($data); exit;
			}
		}catch(Exception $e){
			$data['statusMessage'] = $e->getMessage();
			echo json_encode($data);
			exit;
		}

	}



}