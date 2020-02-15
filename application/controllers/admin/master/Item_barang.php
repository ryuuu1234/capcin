<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Item_barang extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('item_barang_mdl', 'satuan_mdl'));
		$this->perPage = 10;
		$this->urii = 4;
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}

	public function index()
	{	
		$data['data_satuan']=$this->satuan_mdl->_get_all();
		$this->template->administrator('admin_v/master/v_item_barang', $data);
	}

	

	public function view_data()
	{	
		if (!$this->input->is_ajax_request()) {
			exit('Anda tidak berhak akses langsung dari Url');
		}
		$count = $this->item_barang_mdl->count_all();
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
		$query = $this->item_barang_mdl->_fetch_dataTable($conditions);
		$jumlah = $this->item_barang_mdl->_count_dataTable($conditions);
		$jml_all = $this->item_barang_mdl->count_all();

		$class_table = "table table-striped table-hover table-responsive no-head-border";
		$class_head = "vd_bg-green vd_white";
		$class_right = "text-right";

				// row table
		$dataListString .= '<table class="'.$class_table.'" style="valign: midlle;">';
		$dataListString .= '<thead class="'.$class_head.'">
		<tr>';
				// INI UNTUK CEK LIST			
		$dataListString .= '<th width="5%">
		<div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div>  </th>';
		$column = $this->item_barang_mdl->_show_column();
		$column_name = array();
		foreach ($column->result() as $key) 
		{	
			$column_name[] = $key->Field;

		}
				$class_tr = "text-right"; // class rata kanan

				$eliminasi = array("id", "date_created", "date_updated", "id_log", "limit_stok"); // eliminasi column
				$filter_header = array_diff($column_name, $eliminasi);

				$with_class_tr = array("harga_beli", "harga_jual_cust", "harga_jual_umum", "stok", "gudang" );// ini yang pake class text-right
				
				foreach ($filter_header as $filter_header) 
				{	
					$ditemukan = $this->strpos_arr($filter_header, $with_class_tr); // Will echo True
					$ditemukan == $filter_header? $class=$class_tr: $class="";
					$dataListString .= '<th class="'.$class.'"><a href="javascript:void(0)" class="col-sort vd_white" id="'.$filter_header.'" data-order="desc">'.ucfirst(str_replace("_", " ", $filter_header)).'</a></th>';
						

				}
						$option_header = '<th class="'.$class_tr.'">Option</th>';
						$dataListString .= $option_header;
				// $rownya

				// $dataListString .= $this->_head_table($kirim);
					$dataListString .= '</tr>
					</thead>';
					$dataListString .= '<tbody>';

					if ($query->num_rows()>0) {
						foreach($query->result() as $row)
						{	
							$id = $row->id;
							$barcode = $row->barcode;
							$nama = $row->nama;
							$satuan = $row->satuan;
							$harga_beli = $row->harga_beli;
							$harga_jual_cust = $row->harga_jual_cust;
							$harga_jual_umum = $row->harga_jual_umum;
							$stok = $row->stok;
							$gudang = $row->gudang;
							$limit_stok = $row->limit_stok;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
							$edit_data = base_url().'admin/master/item_barang/add_update/'.$id;
							$preview = base_url().'admin/master/item_barang/preview/?id='.$id; 

							$tombol = '<div class="btn-group">
							<a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
							<ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
							<li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
							<li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>
							
							</ul>
							</div>';
		// ==========================================================================================
							$dataListString .= 
							'<tr id="'.$id.'">
							<td>
							<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" /></td>
							<td >'.$barcode.'</td>
							<td>'.$nama.'</td>
							<td>'.$satuan.'</td>
							<td class="'.$class_tr.'">'.$harga_beli.'</td>
							<td class="'.$class_tr.'">'.$harga_jual_cust.'</td>
							<td class="'.$class_tr.'">'.$harga_jual_umum.'</td>
							<td class="'.$class_tr.'">'.$stok.'</td>
							<td class="'.$class_tr.'">'.$gudang.'</td>
							<td class="'.$class_tr.'">'.$tombol.'</td>

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
					function strpos_arr($haystack, $needle) {
						if(!is_array($needle)) $needle = array($needle);
						foreach($needle as $what) {
							if(($pos = strpos($haystack, $what))!==false) return $pos;
						}
						return false;
					}				

					function _head_table($data)
					{	
						$row = $data['head'];
						$class_table = $data['class_table'];
						$class_head = $data['class_head'];
						$class_right = $data['class_right'];

						$table = '';
						$table .= '<table class="'.$class_table.'" style="valign: midlle;">';
						$table .= '<thead class="'.$class_head.'">
						<tr>';
		// INI UNTUK CEK LIST			
						$table .= '<th width="5%">
						<div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div>  </th>';
		// INI ISI HEADNYA				
						foreach ($row as $nama => $class) {

							$table .= '<th class="'.$class.'" ><a href="javascript:void(0)" class="col-sort vd_white" id="'.strtolower($nama).'" data-order="desc">'.$nama.'</a></th>';
						}
						
						$table .= '</tr>
						</thead>';
						return $table;		 	
					}				

	function preview() // =================PREVIEW
	{	
		$id = $_GET['id'];
		//$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);		
		$this->template->administrator("admin_v/master/v_preview_item_barang", $data);
	}
	

	function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->item_barang_mdl->_get_by_id($id);
		$data = array(
			"barcode"=>$get->barcode,
			"nama"=>$get->nama,
			"satuan"=>$get->satuan,
			"harga_beli"=>$get->harga_beli,
			"harga_jual_cust"=>$get->harga_jual_cust,
			"harga_jual_umum"=>$get->harga_jual_umum,
			"stok"=>$get->stok,
			"limit_stok"=>$get->limit_stok,
		);

		return $data;
	}
	

	function edit_data() // =================EDIT DATA
	{	
		$id = $_GET['id'];
		$get['form'] = $this->item_barang_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	

	function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$this->item_barang_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$id=$this->input->post('id', TRUE);
		$this->item_barang_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);
		$data["barcode"]=$this->input->post("barcode",TRUE);
		$data["nama"]=$this->input->post("nama",TRUE);
		$data["satuan"]=$this->input->post("satuan",TRUE);
		$data["harga_beli"]=$this->input->post("harga_beli",TRUE);
		$data["harga_jual_cust"]=$this->input->post("harga_jual_cust",TRUE);
		$data["harga_jual_umum"]=$this->input->post("harga_jual_umum",TRUE);
		$data["stok"]=$this->input->post("stok",TRUE);
		$data["limit_stok"]=$this->input->post("limit_stok",TRUE);
		return $data;
	}
	

	function _validate() // =================VALIDASI
	{	
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if($this->input->post("barcode") == ""){$data["inputerror"][] = "barcode";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("satuan") == ""){$data["inputerror"][] = "satuan";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("harga_beli") == ""){$data["inputerror"][] = "harga_beli";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("harga_jual_cust") == ""){$data["inputerror"][] = "harga_jual_cust";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("harga_jual_umum") == ""){$data["inputerror"][] = "harga_jual_umum";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("stok") == ""){$data["inputerror"][] = "stok";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("limit_stok") == ""){$data["inputerror"][] = "limit_stok";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
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
			
			$this->item_barang_mdl->_delete_where(['id'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
}