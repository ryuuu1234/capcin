<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buat_model 
{
	function __construct()
	{
		$this->ci =&get_instance();
		$this->ci->load->model(array("forgedb"));
	}

	function generate($table, $model)
	{	
		$path = "./application/models/".$model.'.php'; 
		$nama_db = $this->ci->db->database;
		$all = $this->ci->forgedb->structure($nama_db, $table);

		//=====================================================================================Mulai Dari sini 
		$handle = fopen ($path, "w"); 
		//=====================================================================================diganti sesuai kebutuhan
		// $nama_model = strtolower($model);

		if (!$handle) { 
			$data['messages'] = 'Gagal Buat Folder';
			echo json_encode($data); exit;
		} 
		else 
		{ 

			$string = '<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

		class '.$model.' extends MY_Model
		{
			var $column_order = \'id\';
			var $column_search = array(';

			foreach ($all as $key) 
			{
				$column_name = $key->COLUMN_NAME;
				$data_type = $key->DATA_TYPE;
				$extra = $key->EXTRA;
				if ($extra != 'auto_increment') 
				{
					$string .= "".'"'.$column_name.'",'."";
				}
			}
			$string .=");\n";
			$string .="\t\t".'function __construct(){
				parent::__construct();
				$this->table = \''.$table.'\';
				// $this->join1 = \'t_r_kategori b\', \'b.id_item = a.id\', \'left\';
				// $this->join2 = \'t_r_brand c\', \'c.id_item = a.id\', \'left\';
				$this->column = \'*\';
				$this->order = \'id\';
				$this->asc = \'asc\';
				$this->desc = \'desc\';
				$this->id = \'id\';
				$this->where = "";
			}
		}
		'."";

		// ==================================================================================
		fwrite($handle, $string);
		}
		return fclose($handle);
	}//akhir function buat_model()

}	