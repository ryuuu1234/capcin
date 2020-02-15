<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('users_mdl', 'level_mdl'));
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}

	public function index()
	{
		$data="";
		$this->template->administrator('admin_v/settings/v_edit_profile', $data);
	}

	function edit_data()
	{
		$id = $_GET['id'];
		$get['form'] = $this->users_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}

	//UPDATE DATA
	function update_data()
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->session->userdata('user_id');
		$this->users_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

	function _fetch_data()
	{	
		// $uri = $this->uri->segment(5);
		$data['nama'] = $this->input->post('nama', TRUE);
		$data['username'] = $this->input->post('username', TRUE);
		return $data;
	}

	function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("username") == ""){$data["inputerror"][] = "username";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	//upload logo
	public function upload_photo($id)
	{
		try{
			if (!empty($_FILES['gambar_inputx']['name'])){
				$picture = $this->do_upload();
			}else{
				$picture = '';
			}
			$get = $this->users_mdl->_get_by_id($id);
			$photo = $get->photo;
			// $photo_small = $get->photo_small;
			if ($photo != ''){
				unlink('./assets/images/users/big/' .$photo);
				unlink('./assets/images/users/small/' .$photo);
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

	function do_upload() {

		$config['upload_path'] 		= './assets/images/users/big/';
		$config['allowed_types']	= 'gif|png|jpg|jpeg';


		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar_inputx');
		$upload_data = $this->upload->data();

		$profile_picture = $upload_data['file_name'];
		$this->_generate_thumb($profile_picture);
		return $profile_picture;
	}

	function _generate_thumb($profile_picture)
    {
    	$config['image_library'] = 'gd2';
		$config['source_image'] = './assets/images/users/big/'.$profile_picture;
		$config['new_image'] = './assets/images/users/small/'.$profile_picture;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 85;
		$config['height']       = 100;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
    }

}

/* End of file Profile.php */
/* Location: ./application/controllers/admin/settings/Profile.php */