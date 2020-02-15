<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array('app_back'));

		date_default_timezone_set("Asia/Jakarta");
		cek_login_admin();
		$this->output->enable_profiler(FALSE);
	}
	public function index()
	{	
		$data="";
		$this->template->administrator('admin_v/v_dashboard', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */