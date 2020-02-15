<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_rules extends CI_Controller {

	public function index()
	{	
		$id=$this->session->userdata('user_id');
		$level=$this->session->userdata('level');
		echo $level;

		if ($level == 1 || $level ==2) { // ini root dan admin level
			redirect('admin/dashboard');
		} else  { // ini untuk level lainnya
			redirect('site');
		}

	}

	function get_akses()
	{
		$level = $this->input->post('level');
		$this->load->model('akses_mdl');
		$query = $this->akses_mdl->_get_where(['id_level'=>$level]);
		$data=$query;
		echo json_encode($data);
		
	}

	public function logout()
	{	
		// $ses_id = $this->session->userdata('pengguna');
		// $data['status'] = 0;
		// $data['logout_jam'] = date("H:i:s");
		// $this->m_log->_update_where($data, ['id_user'=>$ses_id]);
		$this->session->sess_destroy();
		redirect('site');
	}

}

/* End of file Site_rules.php */
/* Location: ./application/controllers/Site_rules.php */