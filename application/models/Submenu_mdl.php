<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu_mdl extends MY_Model {

	var $column_order = 'urut';
	var $column_search = array("controller", "id_main");
	
	function __construct(){
		parent::__construct();
		$this->table = 'appmenu';
		// $this->join1 = 't_r_kategori b', 'b.id_item = a.id', 'left';
		// $this->join2 = 't_r_brand c', 'c.id_item = a.id', 'left';
		$this->column = '*';
		$this->order = 'urut';
		$this->asc = 'desc';
		$this->desc = 'asc';
		$this->id = 'id';
		
		$this->where = array('id_main >'=>0);
		// $this->select_max = 'nis';
	}

}

/* End of file Sidemenu_mdl.php */
/* Location: ./application/models/Sidemenu_mdl.php */