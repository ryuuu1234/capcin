<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hak_akses extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('users_mdl', 'level_mdl', 'akses_mdl', 'sidemenu_mdl'));
		$this->perPage = 10;
		$this->urii = 4;
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}
	public function index()
	{
		$data['akses'] = '';
		$data['menu'] = '';
		$data['level'] = $this->level_mdl->_get_all();
		$this->template->administrator('admin_v/settings/v_hak_akses.php', $data);
	}

	function level($id)
	{
		$data['akses'] = $id;
		$data['menu'] = $this->sidemenu_mdl->_get_where(['id_main <'=>1]);
		$data['level'] = $this->level_mdl->_get_where(['id >'=>1]);
		$this->template->administrator('admin_v/settings/v_hak_akses.php', $data);
	}

	function simpan_akses()
	{
		$id_menu = $this->input->post('id');
		$level = $this->input->post('level');
		$data['id_level'] = $level;
		$data['id_menu'] = $id_menu;
		$simpan = $this->akses_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}

}

/* End of file Hak_akses.php */
/* Location: ./application/controllers/admin/settings/Hak_akses.php */