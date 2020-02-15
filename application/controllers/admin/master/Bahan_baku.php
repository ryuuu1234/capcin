<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Bahan_baku extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('bahan_baku_mdl', 'satuan_mdl'));
		$this->perPage = 10;
		$this->urii = 4;
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}

	public function index()
	{	
		$data['satuan']=$this->satuan_mdl->_get_all();
		$this->template->administrator('admin_v/master/v_bahan_baku', $data);
	}

	public function view_data()
	{	
		if (!$this->input->is_ajax_request()) {
			exit('Anda tidak berhak akses langsung dari Url');
		}
		$count = $this->bahan_baku_mdl->count_all();
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
		$query = $this->bahan_baku_mdl->_fetch_dataTable($conditions);
		$jumlah = $this->bahan_baku_mdl->_count_dataTable($conditions);
		$jml_all = $this->bahan_baku_mdl->count_all();
		$class_table = "table table-striped table-hover table-responsive no-head-border";
		$class_head = "vd_bg-green vd_white";
		$class_right = "text-right";

		$dataListString .='		<table class="'.$class_table.'" style="valign: midlle;">
		<thead class="'.$class_head.'">
		<tr>
		<th width="5%"><div class="vd_checkbox checkbox-danger" ><input type="checkbox" onclick="toggle(this);" id="checkbox-all" /><label for="checkbox-all"></label></div></th>
		<th class=""><a href="javascript:void(0)" class="col-sort vd_white" id="nama" data-order="desc">Nama</a></th>
		<th class="'.$class_right.'"><a href="javascript:void(0)" class="col-sort vd_white" id="harga_beli" data-order="desc">Harga beli</a></th>
		<th class="'.$class_right.'"><a href="javascript:void(0)" class="col-sort vd_white" id="stok_awal" data-order="desc">Stok awal</a></th>
		<th class="text-right">Opsi</th></tr></thead><tbody>';
		if ($query->num_rows()>0) {
			foreach($query->result() as $row)
			{	
				$id = $row->id;
				$nama = $row->nama;
				$satuan = $row->satuan;
				$harga_beli = $row->harga_beli;
				$stok_awal = $row->stok_awal;
				$date_created = $row->date_created;
				$date_updated = $row->date_updated;
				$id_log = $row->id_log;
		// ==========================================================================================
		// KALAU MAU DITAMBAHI KONDISI LAINNYA
				$get_sat = $this->satuan_mdl->_get_by_id($satuan);
				$nama_satuan = $get_sat->nama;
		// ==========================================================================================
				$edit_data = base_url().'admin/master/bahan_baku/add_update/'.$id;
				$preview = base_url().'admin/master/bahan_baku/preview/?id='.$id; 
					    //========================================================
				$dataListString .= 
				'<tr id="'.$id.'">
				<td>
				<input type="checkbox" name="hapus_id[]" class="delete_row" value="'.$id.'" />
				</td>
				<td class="">'.$nama.'</td>
				<td class="'.$class_right.'">'.$this->mata_uang->rupiah("Rp. ",$harga_beli).',- <i class="vd_red"> Per '.$nama_satuan.'</i></td>
				<td class="'.$class_right.'">'.$stok_awal.'</td>
				<td class="text-right">
				<div class="btn-group">
				<a href="#" class="vd_grey" data-toggle="dropdown"> <i class="icon-ellipsis"></i> </a>
				<ul class="dropdown-menu" role="menu" style=" border-left: inset; left: -140px;">
				<li><a href="javascript:void(0)" onclick="__edit('.$id.')"><i class="fa fa-pencil" style="margin-right:10px;"></i> Edit</a></li>
				<li><a href="'.$preview.'"> <i class="fa fa-eye" style="margin-right:10px;"></i>View</a></li>

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

	function preview() // =================PREVIEW
	{	
		$id = $_GET['id'];
		//$id = $this->encryptku->decode($id_data);
		$data = $this->_fetch_data_from_dbById($id);		
		$this->template->administrator("admin_v/master/v_preview_bahan_baku", $data);
	}
	

	function _fetch_data_from_dbById($id) // =================fetchdbByid
	{	
		$get = $this->bahan_baku_mdl->_get_by_id($id);
		$data = array(
			"nama"=>$get->nama,
			"satuan"=>$get->satuan,
			"harga_beli"=>$get->harga_beli,
			"stok_awal"=>$get->stok_awal,
			"date_created"=>$get->date_created,
			"date_updated"=>$get->date_updated,
			"id_log"=>$get->id_log,
		);

		return $data;
	}
	

	function edit_data() // =================EDIT DATA
	{	
		$id = $_GET['id'];
		$get['form'] = $this->bahan_baku_mdl->_get_where_row(['id'=>$id]);
		$this->output->set_output(json_encode($get));
	}
	

	function save_data() // =================SAVE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data["date_created"]=date('Y-m-d H:i:s');
		$this->bahan_baku_mdl->_insert($data);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function update_data() // =================UPDATE DATA
	{	
		$this->_validate();
		$data = $this->_fetch_data();
		$data["date_updated"]=date('Y-m-d H:i:s');
		$id=$this->input->post('id', TRUE);
		$this->bahan_baku_mdl->_update($data, $id);
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
	

	function _fetch_data() // =================FETCH DATA
	{	
		$uri = $this->uri->segment(5);
		$data["nama"]=$this->input->post("nama",TRUE);
		$data["satuan"]=$this->input->post("satuan",TRUE);
		$data["harga_beli"]=preg_replace('/\D/','',$this->input->post("harga_beli",TRUE));
		$data["stok_awal"]=$this->input->post("stok_awal",TRUE);
		$data["id_log"]=id_session();
		return $data;
	}
	

	function _validate() // =================VALIDASI
	{	
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post("nama") == ""){$data["inputerror"][] = "nama";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("satuan") == ""){$data["inputerror"][] = "satuan";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("harga_beli") == ""){$data["inputerror"][] = "harga_beli";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}
		if($this->input->post("stok_awal") == ""){$data["inputerror"][] = "stok_awal";$data["error_string"][] = "Harap Diisi";$data["status"] = FALSE;}

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
			
			$this->bahan_baku_mdl->_delete_where(['id'=>$id]);
		}
		$this->output->set_output(json_encode(array("status" => TRUE)));
	}
}