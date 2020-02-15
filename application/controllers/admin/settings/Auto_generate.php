<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_generate extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array("sidemenu_mdl", "forgedb"));
		$this->load->library(array("buat_controller", "buat_view", "buat_model"));
		date_default_timezone_set("Asia/Jakarta");
		cek_login_admin();
	}

	public function index()
	{
		//harap tabel sudah tersedia

		$table = $this->input->post('table_name');
		$controller = $this->input->post('controller');
		$model = $this->input->post('model');
		$url_controller = $this->input->post('letak_controller');
		$letak_view = $this->input->post('letak_view');
		$url_view = $this->input->post('letak_view')."/v_".strtolower($controller);

		$list_hasil = array();

		//BUAT CONTROLLER
		$folder_controller = './application/controllers/'.$url_controller; 
		if((!file_exists($folder_controller))&&(!is_dir($folder_controller))) // jika tidak ditemukan folder dimaksud
		{ 
		 	//memasukan fungsi mkdir (buat folder)
			$fdc = mkdir ($folder_controller);
			if($fdc){
		 		//lalu buat controllernya
				$this->buat_controller->generate($url_controller, $controller, $table, $model, $url_view, $letak_view);
				$txt_hasil[] = "<b>CONTROLLER :</b>" .$folder_controller."/".$controller;
			}
		} else {
			// jika ditemukan langsung buat controller
			$this->buat_controller->generate($url_controller, $controller, $table, $model, $url_view, $letak_view);
			$txt_hasil[] = "<b>CONTROLLER :</b>" .$folder_controller."/".$controller;
		}

		// buat view
		$folder_view = './application/views/'.$letak_view; 
		if((!file_exists($folder_view))&&(!is_dir($folder_view))) // jika tidak ditemukan folder dimaksud
		{ 
		 	//memasukan fungsi mkdir (buat folder)
			$fdv = mkdir ($folder_view);
			if($fdv){
		 		//lalu buat viewnya
				$this->buat_view->generate($table, $controller, $url_view);
				$txt_hasil[] = "<b>VIEW :</b>" .$folder_view."/";
			}
		} else {
			//lalu buat viewnya
			$this->buat_view->generate($table, $controller, $url_view);
			$txt_hasil[] = "<b>VIEW :</b>" .$folder_view."/";
		}


		//Buat view preview
		$url_prev = $letak_view."/v_preview_".strtolower($controller);
		$this->buat_view->generate_preview($table, $letak_view, $url_prev, $controller);

		// Buat Model
		$this->buat_model->generate($table, $model);
		$txt_hasil[] ="<b>MODEL       :</b>"."./application/models/".$model;

		$data['messages'] = 'File berhasil dibuat';
		$data['txt_hasil'] = $txt_hasil;
		echo json_encode($data);  
		exit();

	}

}

/* End of file Auto_generate.php */
/* Location: ./application/controllers/admin/settings/Auto_generate.php */