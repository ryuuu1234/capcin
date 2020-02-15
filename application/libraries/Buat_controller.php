<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buat_controller 
{
	function __construct()
	{
		$this->ci =&get_instance();
		$this->ci->load->model(array("forgedb"));
	}

	function generate($url_controller, $controller, $table, $model, $url_view, $letak_view)
	{	
		$path = "./application/controllers/".$url_controller.'/'.$controller.'.php';

		$nama_db = $this->ci->db->database;
		$nama_table = $table;
		$all = $this->ci->forgedb->structure($nama_db, $nama_table);

		//=====================================================================================Mulai Dari sini 
		$handle = fopen ($path, "w"); 
		//=====================================================================================diganti sesuai 
		$nama_model = strtolower($model);

		$file = $controller;
		$folder = $url_controller;

		if (!$handle) { 
		 		$data['messages'] = 'Gagal Buat Folder';
		 		echo json_encode($data); exit();
		} 
		else 
		{ 
			// ================================================header n construct controller
			$string = "<?php

		 		if (!defined('BASEPATH'))
		 			exit('No direct script access allowed');

		 		class " . ucfirst($file) . " extends MY_Controller
		 		{	
		 			function __construct()
		 			{
		 				parent::__construct();
		 				\$this->load->model(array('$nama_model'));
		 				\$this->perPage = 10;
		 				\$this->urii = 4;
		 				date_default_timezone_set('Asia/Jakarta');
						cek_login_admin();
		 				";

			$string .= "
    		}";// ================================================Akhir Construct

    		$c_file = strtolower($file);
    		$ltk_controller = $url_controller."/".$c_file;

    		// =============================================================================index
		    $string .= "\n\n    public function index()
		    {	
		    	\$data['subtitle']='';
		    	\$this->template->administrator('$url_view', \$data);
			}";// =====================================================================Akhir index

			$string .= "\n\n    public function view_data()
			{	
				if (!\$this->input->is_ajax_request()) {
					exit('Anda tidak berhak akses langsung dari Url');
				}
				\$count = \$this->" .$nama_model. "->count_all();
				\$this->viewTableTanpaDataTable(\$count);
			}";// =====================================================================Akhir view data;


			$string .= "\n\n    public function data_table(\$conditions)
			{
				\$dataListString = '';
				// \$i=\$startIndex+1;
				\$i= \$conditions['startIndex']+1;
				\$start = \$conditions['startIndex'];
				\$limit = \$conditions['rowsPerPage'];	
				//Querying data from data
				\$query = \$this->" .$nama_model. "->_fetch_dataTable(\$conditions);
				\$jumlah = \$this->" .$nama_model. "->_count_dataTable(\$conditions);
				\$jml_all = \$this->" .$nama_model. "->count_all();"."\n";

				$string .= '$class_table = "table table-striped table-hover table-responsive no-head-border";
							$class_head = "vd_bg-green vd_white";
							$class_right = "text-right";';

							

				$string .= "\n\n\t    \$dataListString .='		".'<table class="\'.$class_table.\'" style="valign: midlle;">
				<thead class="\'.$class_head.\'">
				<tr>
				<th width="5%"><div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div></th>'."\n";
				foreach ($all as $key) 
				{
					$column_name = $key->COLUMN_NAME;
					$data_type = $key->DATA_TYPE;
					$extra = $key->EXTRA;

					if ($extra != 'auto_increment') 
					{
						$string .= "\t\t\t\t         ".'<th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="'.$column_name.'" data-order="desc">'.ucfirst(str_replace("_"," ",$column_name)).'</a></th>'."\n";
					}
				}

				$string .= "\t\t\t\t         ".'<th class="text-right">Opsi</th></tr></thead><tbody>\';'."\n";
				$string .= "\t\tif (\$query->num_rows()>0) {
					foreach(\$query->result() as \$row)
						{	\n";
					foreach ($all as $key) 
					{
						$column_name = $key->COLUMN_NAME;
						$data_type = $key->DATA_TYPE;
						$extra = $key->EXTRA;

						$string .= "\t			".'$'.$column_name.' = $row->'.$column_name.';'."\n";

					}
					$string .= "		".'// =========================================================================================='."\n";
					$string .= "		".'// KALAU MAU DITAMBAHI KONDISI LAINNYA'."\n";
					$string .= "		".'// =========================================================================================='."\n";
					$string .= "\t			\$edit_data = base_url().'$folder/$c_file/add_update/'.\$id;
					\$preview = base_url().'$folder/$c_file/preview/?id='.\$id; 
					    //========================================================";
					$string .= "\n\t\t\t\t\$dataListString .= 
					'<tr id=\"'.\$id.'\">
					<td>
					<input type=\"checkbox\" name=\"hapus_id[]\" class=\"delete_row\" value=\"'.\$id.'\" />
					</td>\n";
					foreach ($all as $key) 
					{
						$column_name = $key->COLUMN_NAME;
						$data_type = $key->DATA_TYPE;
						$extra = $key->EXTRA;
						if ($extra != 'auto_increment') 
						{	
							$string .= "\t\t\t\t\t\t".'<td class="">\'.$'.$column_name.'.\'</td>'."\n";
						}
					}

						$string .= "\t\t\t\t\t\t".'<td class="text-right">
						<div class="btn-group">
	                      <a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
	                      <ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
	                        <li><a href="javascript:void(0)" onclick="__edit(\'.$id.\')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
	                        <li><a href="\'.$preview.\'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
	                        
	                      </ul>
	                    </div>
						</tr>\';

						}
							// ===========akhir foreach========================
							//check if no data in database, then display No Data message
					} else {
						$dataListString .= \'<tr><td colspan="7" style="text-align:center; color:#c0434d;"><i class="fa fa-frown-o"></i> No Data Found</td></tr>\';}
						$dataListString .= \'<tr><td colspan="7"><i class=""> <b style="color:black;">\'.$jumlah.\'</b> Data ditampilkan dari <b style="color:black;">\'.$jml_all.\'</b> 
						Data Keseluruhan</i></td>
						</tr>\';
						$dataListString .= \'</tbody></table>\';
						'."";
						$string .= "\t\t\t".'return $dataListString;
					}'."";
	// preview
					
		
		$string .="\n\n\t".'function preview() // =================PREVIEW
	{	
		$id = $_GET[\'id\'];
		//$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);		
		$this->template->administrator("'.$letak_view."/v_preview_".$c_file.'", $data);
	}
	'."";	


	$string .="\n\n\t".'function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->'.$nama_model.'->_get_by_id($id);
		$data = array('."\n";
		foreach ($all as $key) 
				{
					$column_name = $key->COLUMN_NAME;
					$data_type = $key->DATA_TYPE;
					$extra = $key->EXTRA;

					if ($extra != 'auto_increment') 
					{
						$string .= "\t        ".'"'.$column_name.'"=>$get->'.$column_name.','."\n";
					}
				}

	$string .='	);

		return $data;
	}
	'."";				

		$string .="\n\n\t".'function edit_data() // =================EDIT DATA
	{	
		$id = $_GET[\'id\'];
		$get[\'form\'] = $this->'.$nama_model.'->_get_where_row([\'id\'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	'."";	

		$string .="\n\n\t".'function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data[\'date_created\'] = date(\'Y-m-d H:i:s\');
		$this->'.$nama_model.'->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	'."";	

		$string .="\n\n\t".'function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data[\'date_updated\'] = date(\'Y-m-d H:i:s\');
		$id=$this->input->post(\'id\', TRUE);
		$this->'.$nama_model.'->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	'."";	

		$string .="\n\n\t".'function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);'."\n";

		foreach ($all as $key) 
		{
			$column_name = $key->COLUMN_NAME;
			$data_type = $key->DATA_TYPE;
			$extra = $key->EXTRA;

			if ($extra != 'auto_increment' && $column_name != 'date_created' && $column_name !='date_updated' && $column_name != 'id_log') 
				{
					$string .= "\t        ".'$data["'.$column_name.'"]=$this->input->post("'.$column_name.'",TRUE);'."\n";
				}
		}

		$string .= "\t        ".'$data["id_log"]=id_session();'."\n";

		$string .= 'return $data;
	}
	'."";	


	$string .="\n\n\t".'function _validate() // =================VALIDASI
	{	
		$data = array();
		$data[\'error_string\'] = array();
		$data[\'inputerror\'] = array();
		$data[\'status\'] = TRUE;'."\n";

		foreach ($all as $key) 
		{
			$column_name = $key->COLUMN_NAME;
			$data_type = $key->DATA_TYPE;
			$extra = $key->EXTRA;

			if ($extra != 'auto_increment' && $column_name != 'date_created' && $column_name !='date_updated' && $column_name != 'id_log')  
				{
					$string .= "\t        ".'if($this->input->post("'.$column_name.'") == ""){$data["inputerror"][] = "'.$column_name.'";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}'."\n";
				}
		}

		$string .= 'if($data[\'status\'] === FALSE)
		{
			echo json_encode($data);
			exit();
		};
	}
	'."";	

	$string .="\n\n\t".'function delete_data() // =================DELETE DATA
	{	
		$id = $this->input->post(\'id\');
		foreach ($id as $id) {
			
			$this->'.$nama_model.'->_delete_where([\'id\'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	'."";	

	$string .= '}';


		// ==================================================================================
		fwrite($handle, $string);			
		}//else
	return fclose($handle);	
	}//generate
}