<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class Register_mdl extends MY_Model
		{
			var $column_order = 'id';
			var $column_search = array("id","nama","username","email","id_level","status");
			// var $where = ['status'=>0];
		function __construct(){
				parent::__construct();
				$this->table = 't_register';
				// $this->join1 = 't_r_kategori b', 'b.id_item = a.id', 'left';
				// $this->join2 = 't_r_brand c', 'c.id_item = a.id', 'left';
				$this->column = '*';
				$this->order = 'id';
				$this->asc = 'asc';
				$this->desc = 'desc';
				$this->id = 'id';
				// $this->where =  array('removed_at <>'=>null);
				$this->where = "";
			}
		}
		