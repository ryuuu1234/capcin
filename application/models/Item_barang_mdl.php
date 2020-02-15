<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class Item_barang_mdl extends MY_Model
		{
			var $column_order = 'id';
			var $column_search = array("barcode","nama","satuan","harga_beli","harga_jual_cust","harga_jual_umum","stok","limit_stok",);
		function __construct(){
				parent::__construct();
				$this->table = 't_item_barang';
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
		