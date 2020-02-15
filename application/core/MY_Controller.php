<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function viewTableTanpaDataTable($count)
	{	
		$conditions = array();
		$keyword = $this->input->post("keyword");
		$currentPage = intval($this->input->post("currentPage"));
		$rowsPerPage = $this->input->post("rowsPerPage");
		$navAction = $this->input->post("navAction");
		$column = $this->input->post("column");
		$ascDesc = $this->input->post("ascDesc");

		$subKategori = $this->input->post('subKategori');
	    $rombel = $this->input->post('brand');

		// $tblCol = $this->input->post("tblCol");

			// if($ascDesc == 'desc'){
			//     	$order = 'asc';
			//     }else {
			//     	$order = 'desc';
			//     }
	    $ascDesc == 'desc'? $order = 'desc':$order='asc';

	  	// $limitx = $this->perPage;
	        if(!empty($ascDesc)){
	            $conditions['search']['order_by'] = $order;
	        }
	        if(!empty($column)){
	            $conditions['search']['column'] = $column;
	        }
	        if(!empty($keyword)){
	            $conditions['search']['searching'] = $keyword;
	        }
	        if(!empty($subKategori)){
	            $conditions['search']['kategori'] = $subKategori;
	        }
	        if(!empty($rombel)){
	            $conditions['search']['brand'] = $rombel;
	        }

	        $totalRow = $count;
			$totalPages = $totalRow/$rowsPerPage;
			// $totalPages = 500;
			if($totalRow%$rowsPerPage>0){$totalPages = intval($totalPages) + 1;}

	        //Get the target page number
	        // $sortBy = '';
	        // $column_name = '';
	        // $column = 'id';	
			$targetPage = 1;
			$nav_btn_disable = array();
			if($navAction=='first'){
			$targetPage = 1;
			}elseif($navAction=='prev'){
			$targetPage = $currentPage-1;
			}elseif($navAction=='next'){
			$targetPage = $currentPage+1;
			}elseif($navAction=='last'){
			$targetPage = $totalPages;
			}elseif($navAction=='goto'){
			$targetPage = $currentPage;
			}
			

			//Get goto select list
			$gotoSelectNum = array();
			for($i=1;$i<=$totalPages;$i++){
			$gotoSelectNum[] = $i;
			}	
			//Check button to be disable or enable
			if($totalPages==1 or $totalPages==0){
			$nav_btn_disable = array('nav_first'=>0,'nav_prev'=>0,'nav_next'=>0,'nav_last'=>0);
			}elseif($targetPage==1){
			$nav_btn_disable = array('nav_first'=>0,'nav_prev'=>0,'nav_next'=>1,'nav_last'=>1);
			}elseif($targetPage==$totalPages){
			$nav_btn_disable = array('nav_first'=>1,'nav_prev'=>1,'nav_next'=>0,'nav_last'=>0);
			}else{
			$nav_btn_disable = array('nav_first'=>1,'nav_prev'=>1,'nav_next'=>1,'nav_last'=>1);
			}	
			//Applying data to be shown according to the criteria [targetPage,rowsPerPage]
			$startIndex = ($targetPage-1)*$rowsPerPage;
			
			$conditions['startIndex'] = $startIndex;
			$conditions['rowsPerPage'] = $rowsPerPage;
			// $conditions['tblCol'] = $tblCol;
			
			//store all variable to an array
			$data = array(
				'list'=> $this->data_table($conditions), //ini untuk tabel
				'targetPage'=>$targetPage, // ini untuk navigasi pagination
				'totalPages'=>$totalPages, // ini total pagesnya
				'gotoSelectNum'=>$gotoSelectNum, //ini untuk goto select page
				'nav_btn_disable'=>$nav_btn_disable,
				'columnName'=>$column,
				'order_by'=>$order,
				); // ini disable buttonnya
				
			//convert array to json object, and return it back to ajax
			echo json_encode($data);


	}

	 //file upload function
	function do_upload_users() {

		$config['upload_path'] 		= './assets/images/users/big/';
		$config['allowed_types']	= 'gif|png|jpg|jpeg';


		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar_input');
		$upload_data = $this->upload->data();

		$profile_picture = $upload_data['file_name'];
		$this->_generate_thumb_users($profile_picture);
		return $profile_picture;
	}

	function _generate_thumb_users($profile_picture)
    {
    	$config['image_library'] = 'gd2';
		$config['source_image'] = './assets/images/users/big/'.$profile_picture;
		$config['new_image'] = './assets/images/users/small/'.$profile_picture;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 85;
		$config['height']       = 100;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
    }



}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */