<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgedb extends CI_Model {

	// kosongkan user database jika ingin lihat semua database
	function database($database)
	{
		$query = $this->db->query(" SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME LIKE '$database%'");
		return $query->result_array();
	}

	// pilih table dari database
	function select_table($nama){
		return $query= $this->db->query("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA where SCHEMA_NAME='$nama'");
	}

	// show table
	function showTables($nama)
	{
		return $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$nama'")->result_array();
	}

	// lihat struktur table
	function structure($nama_db, $nama_table)
	{
		// return $this->db->query("SELECT * FROM information_schema.columns where TABLE_NAME='$nama' ")->result();
		return $query= $this->db->query("
			SELECT *
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_SCHEMA = '$nama_db'
			AND TABLE_NAME = '$nama_table'
			"
		)->result();

	}

	function cek_table($nama_db, $nama_table)
	{
		// return $this->db->query("SELECT * FROM information_schema.columns where TABLE_NAME='$nama' ")->result();
		return $query= $this->db->query("
			SELECT *
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_SCHEMA = '$nama_db'
			AND TABLE_NAME = '$nama_table'
			"
		);

	}

	function tbname($nama)
	{
		return $this->db->query("SELECT * FROM information_schema.columns where TABLE_NAME='$nama' ")->row_array();
	}

	// seleksi database berdasarkan namanya
	function selectDb($db){
		$query = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");
		return $query->row_array();
	}

	// ADD TABLE

	function addTables($dbname,$tbname,$nama,$type,$length,$null,$index,$ai)
	{
		$jumlah =count($nama);
		$this->db->query("CREATE TABLE $dbname.$tbname( tugas INT )");
		for ($x = 0; $x <$jumlah; $x++) {
				$this->db->query("ALTER TABLE $dbname.$tbname ADD $nama[$x] $type[$x]($length[$x]) $null[$x] $index[$x] $ai[$x] ");
		}
		$this->db->query("ALTER TABLE $dbname.$tbname DROP COLUMN tugas ");
	}

}

/* End of file Forgedb.php */
/* Location: ./application/models/Forgedb.php */