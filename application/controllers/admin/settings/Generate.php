<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array("sidemenu_mdl", "forgedb"));
		date_default_timezone_set("Asia/Jakarta");
		cek_login_admin();
	}

	public function index()
	{
		echo"ok";
	}

	function auto_script($id)
	{
		// $letak = $this->uri->segment(4);
		// $controller = $this->uri->segment(5);
		$menu = $this->sidemenu_mdl->_get_by_id($id);
		$rcontroller = $menu->controller;
		$controller = strtolower(str_replace(" ", "_", $rcontroller));
		$view = "v_".$controller;
		$letak_controller = str_replace('/'.$controller, '', $menu->url);
		$letak_view = str_replace('/', '_v/', $letak_controller);
		$table_list = $this->db->list_tables();

		$data['table_list'] = $table_list;
		$data['letak_controller'] = $letak_controller;
		$data['letak_view'] = $letak_view;
		$data['controller'] = $controller;
		$data['view'] = $view;
		$data['url_gen'] = base_url().'admin/settings/auto_generate';

		$submit = $this->input->post('submit');
		if ($submit == 'Generate') {
			$hasil = 'No table selected.';
			$data['hasil'] = $hasil;
		}
		$this->template->administrator('admin_v/settings/v_autogen', $data);
	}






	// ==============================================INI UNTUK TABLE=======================================

	public function table($id)
	{	
		$get = $this->sidemenu_mdl->_get_by_id($id);
		$db = $this->db->database;
		// $folder = $this->uri->segment(4);
		// $controller = $this->uri->segment(5);
		$data['lanjut'] = base_url().'admin/settings/generate/auto_script/'.$id;
		$data['database'] = $this->forgedb->selectDb($db);
		$this->template->administrator('admin_v/settings/v_add_table', $data);
	}

	function AddTables()
	{
		$dbname = $this->input->post('database');
		$tbname = $this->input->post('tbname');
		$nama = $this->input->post('nama');
		$type = $this->input->post('type');
		$length =$this->input->post('length');
		$null = $this->input->post('null');
		$index = $this->input->post('index');
		$ai =$this->input->post('ai');
		// $cek = $this->db->query("SELECT * FROM information_schema.columns where TABLE_NAME='$tbname' ");
		$cek = $this->forgedb->cek_table($dbname, $tbname);
		if ($cek->num_rows() > 0) {
			$url = base_url('admin/settings/generate/AddTables/'.$dbname);
			$this->session->set_flashdata(md5("duplikat"),"Table Sudah Ada,Coba Nama Lain");
			// die("Table Sudah Ada,Coba Nama Lain");
			redirect($url,'refresh');
		}else{
			$this->forgedb->AddTables($dbname,$tbname,$nama,$type,$length,$null,$index,$ai);
			$url= base_url('admin/settings/generate/manage_table/'.$dbname);
			redirect($url,'refresh');
		}
	}

	public function create_new_table($id)
	{
		$db = $id;
		$data['database'] = $this->forgedb->selectDb($db);
		$this->template->administrator('admin_v/settings/v_add_table', $data);
	}

	// INI UNTUK MANAGEMENT TABLE
	function manage_table($nama_db)
	{
		$nama =$nama_db; 
		$data['select_table'] = $this->forgedb->select_table($nama)->row_array();
		$data['table'] = $this->forgedb->showTables($nama);
		$data['url_hapus'] = base_url().'admin/settings/generate/drop_table/'.$nama."/";
		$this->template->administrator('admin_v/settings/v_show_select_table', $data);
	}

	function drop_table()
	{	
		$dbname = $this->input->post('dbname');
		$table = $this->input->post('tbname');
		$this->load->dbforge();
		$cek = $this->forgedb->cek_table($dbname, $table);
		if ($cek->num_rows()>0) {
			$this->dbforge->drop_table($table);
			$data['message'] = "sukses";
		} else {
			$data['message'] = "table yang dimaksud tidak ada";
		}
		echo json_encode($data);
	}

	public function list_table($dbname)
	{	
		
		$table = '';
		$table .= '<table class="table table-striped table-hover no-head-border" style="valign: midlle;">
		<thead class="vd_bg-green vd_white">
		<tr>
		<th width="5%">#</th>
		<th>Nama Table</th>
		<th class="text-right"><i class="fa fa-gear"></i></th>
		</tr></thead><tbody>';

		$all_table = $this->forgedb->showTables($dbname);
		$select_table = $this->forgedb->select_table($dbname)->row_array();

		if (count($all_table) > 0) {
			$i=1;
			foreach ($all_table as $row) {

				$preview = base_url().'admin/settings/generate/checkTable/'.$select_table["SCHEMA_NAME"]."/".$row["TABLE_NAME"];
				$delete = base_url().'admin/settings/generate/drop_table/'.$select_table["SCHEMA_NAME"]."/".$row["TABLE_NAME"];

				$option ='	<div class="btn-group">
                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
                        <li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
                        <li><a href="#" data-tbname="'.$row["TABLE_NAME"].'" data-dbname="'.$select_table["SCHEMA_NAME"].'" id="btnDelete"> <i class="fa fa-trash-o" style="margin-right:10px;"></i>Drop</a></li>
                        
                      </ul>
                    </div>';

				$table .= '<tr>
				<td>'.$i++.'</td>
				<td>'.$row['TABLE_NAME'].'</td>
				<td class="text-right">'.$option.'</td>
				
				</tr>';
			}//foreach end
		}else{
			$table .= '<tr>
			<td  colspan="3" class="c-text">DATA TIDAK ADA</td>
			</tr>';
		}

		$table .= '</tbody></table>';
		echo $table;
	}//end function



}

/* End of file Generate.php */
/* Location: ./application/controllers/admin/settings/Generate.php */