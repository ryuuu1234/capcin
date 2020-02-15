<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class Bahan_baku_mdl extends MY_Model
		{
			var $column_order = 'id';
			var $column_search = array("nama","satuan","harga_beli","stok_awal","date_created","date_updated","id_log",);
		function __construct(){
				parent::__construct();
				$this->table = 't_bahan_baku';
				// $this->join1 = 't_r_kategori b', 'b.id_item = a.id', 'left';
				// $this->join2 = 't_r_brand c', 'c.id_item = a.id', 'left';
				$this->column = '*';
				$this->order = 'id';
				$this->asc = 'asc';
				$this->desc = 'desc';
				$this->id = 'id';
				$this->where = "";
			}
		}
		