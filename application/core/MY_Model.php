<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $table;
  public $id;
	public function __construct(){
		parent::__construct();
	}

	function _get_all(){
		return $this->db->get($this->table)->result();
	}

  function get_all_order_desc(){
    return $this->db->order_by($this->column_order, 'DESC')->get($this->table);
  }

	function _get_by_id($id){
		return $this->db->where($this->id, $id)->limit(1)->get($this->table)->row();
	}

	function _get_where($where){
		return $this->db->where($where)->get($this->table)->result();
	}

  function _get_where_order($where){
    return $this->db->where($where)->order_by($this->column_order, 'ASC')->get($this->table)->result();
  }

  function _get_where_group($select,$where, $group, $order, $ascDesc){
    return $this->db->select($select)
                     ->where($where)
                      ->group_by($group)
                      ->order_by($order, $ascDesc) 
               ->get()->result();
  }

  function _get_where_limit($where, $limit){
    return $this->db->where($where)->limit($limit)->get($this->table)->result();
  }

  function _get_where_row($where){
    return $this->db->where($where)->limit(1)->get($this->table)->row();
  }

  function _get_like($like){
    return $this->db->like($like)->get($this->table)->result();
  }
   function _get_where_like($where, $like){
    return $this->db->where($where)->like($like)->get($this->table)->result();
  }

  function _count_like($like){
    return $this->db->like($like)->get($this->table)->num_rows();
  }

  function _count_where($where){
    return $this->db->where($where)->get($this->table)->num_rows();
  }

  function _insert($data){
    $this->db->insert($this->table, $data);
  }

  function _insert_by_api($data){
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows();
  }

  function _insert_multi($data){
    $this->db->insert_batch($this->table, $data);
  }

  function _delete($id){
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

  function _delete_by_id_api($id){
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
    return $this->db->affected_rows();
  }

  function _delete_where($where = null){
    $this->db->where($where);
    $this->db->delete($this->table);
  }

  function _update($data = null, $id){
    $this->db->update($this->table, $data, [$this->id => $id]);
  }

  function _updated_by_api($data, $id){
    $this->db->update($this->table, $data, [$this->id => $id]);
    return $this->db->affected_rows();
  }

  function _update_where($data = null, $where = null){
    $this->db->update($this->table, $data, $where);
  }

	// ==========================================================================ini untuk tabel Ajax======================
	function count_all(){
      if ($this->where != '') {
           $this->db->where($this->where);
        }
      return $this->db->get($this->table)->num_rows();
     }

     function fetch($params = array())
     {
      
      $this->db->select($this->column)->from($this->table);
       if(!empty($params['search']['searching'])){
            $this->db->like($this->column_search, $params['search']['searching']);
        }

        if(!empty($params['search']['kelas'])){
            $this->db->like($this->column_search, $params['search']['kelas']);
        }

        $this->db->order_by($this->order, $this->asc);
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
     }

     function fetch_tabel($params = array())
     {
      
      $this->db->select($this->column)->from($this->table);
      // $this->db->where($where);
        $i=0;
        // $search = $params['search']['searching'];
        foreach ($this->column_search as $item){
            if(!empty($params['search']['searching'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $params['search']['searching']);
                }else{
                    $this->db->or_like($item, $params['search']['searching']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            if(!empty($params['search']['kelas'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $params['search']['kelas']);
                    // $this->db->or_like($item, $params['search']['rombel']);
                }else{
                    $this->db->or_like($item, $params['search']['kelas']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            if(!empty($params['search']['rombel'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $params['search']['rombel']);
                    // $this->db->or_like($item, $params['search']['rombel']);
                }else{
                    $this->db->or_like($item, $params['search']['rombel']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        // $column = $params['column']['column_name'];
        // $order = $params['orderBy']['order'];
        if(!empty($params['search']['sortBy']) && !empty($params['search']['column_name'])) {
          $this->db->order_by($params['search']['column_name'], $params['search']['sortBy']);
        } else {
          $this->db->order_by($this->column_order, $this->desc);
        }
        // $this->db->order_by($this->order, $this->desc);
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
     }

     function fetch_details($cond)
     {
      $this->fetch_tabel($cond);
      return $this->db->get();
     }

     function _count_filtered($cond)
     {
       $this->fetch_tabel($cond);
       $query = $this->db->get();
       return $query->num_rows();
     }

     function _count_all_filtered($params = array())
     {
      
      $this->db->select($this->column)->from($this->table);
      if ($this->where != '') {
           $this->db->where($this->where);
        }
        $i=0;
        // $search = $params['search']['searching'];
        foreach ($this->column_search as $item){
            if(!empty($params['search']['searching'])) 
            { 
                if($i===0){
                    $this->db->group_start(); 
                    $this->db->like($item, $params['search']['searching']);
                }else{
                    $this->db->or_like($item, $params['search']['searching']);
                }
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            if(!empty($params['search']['kelas'])) 
            { 
                if($i===0){
                    $this->db->group_start(); 
                    $this->db->like($item, $params['search']['kelas']);
                }else{
                    $this->db->or_like($item, $params['search']['kelas']);
                }
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            if(!empty($params['search']['rombel'])) 
            { 
                if($i===0){
                    $this->db->group_start(); 
                    $this->db->like($item, $params['search']['rombel']);
                }else{
                    $this->db->or_like($item, $params['search']['rombel']);
                }
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }

        $query = $this->db->get();
        return $query->num_rows();
     }

     //============================================================================================================================================DATATABELBARU
     function dataTabel($params = array()){
        $this->db->select($this->column)->from($this->table);
        $i=0;
        if ($this->where != '') {
           $this->db->where($this->where);
        }
       
        // $search = $params['search']['searching'];
        foreach ($this->column_search as $item){
            if(!empty($params['search']['searching'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $params['search']['searching']);
                }else{
                    $this->db->or_like($item, $params['search']['searching']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            if(!empty($params['search']['kategori'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->where($item, $params['search']['kategori']);
                    // $this->db->or_like($item, $params['search']['rombel']);
                }else{
                    $this->db->or_where($item, $params['search']['kategori']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            if(!empty($params['search']['brand'])) // if datatable send POST for search
            { 
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $params['search']['brand']);
                    // $this->db->or_like($item, $params['search']['rombel']);
                }else{
                    $this->db->or_like($item, $params['search']['brand']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;}
        //order data
        if(empty($params['search']['order_by']) && empty($params['search']['column']) ) {
          // $this->db->order_by($params['search']['column_name'], $params['search']['order_by']);
          $this->db->order_by($this->column_order, $this->desc);
        } else {
          $this->db->order_by($params['search']['column'], $params['search']['order_by']);
          // $this->db->order_by($this->column_order, $this->desc);
        }
        //limit data
        // $this->db->limit($params['rowsPerPage'], $params['startIndex']);/
        if(array_key_exists("startIndex",$params) && array_key_exists("rowsPerPage",$params)){
            $this->db->limit($params['rowsPerPage'],$params['startIndex']);
        }elseif(!array_key_exists("startIndex",$params) && array_key_exists("rowsPerPage",$params)){
            $this->db->limit($params['rowsPerPage']);
        }
     }

     function _fetch_dataTable($cond){
        $this->dataTabel($cond);
        return $this->db->get(); 
     }

     function _count_dataTable($cond)
     {
       $this->dataTabel($cond);
       $query = $this->db->get();
       return $query->num_rows();
     }
     // ==========================================================================ini untuk select ==============================================================================================

     function _select_max(){
      $this->db->select_max($this->select_max);
      return $this->db->get($this->table)->row($this->select_max);
    }
     function _select_max_where($where){
      $this->db->select_max($this->select_max);
      $this->db->where($where);
      return $this->db->get($this->table)->row($this->select_max);
    }

    // show column
    function _show_column()
    {
      $my_query = 'show columns from '.$this->table;
      $query = $this->db->query($my_query);
      return $query;
    }
}
