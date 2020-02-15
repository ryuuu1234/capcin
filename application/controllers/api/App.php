<?php
use Restserver\Libraries\REST_Controller;
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class App extends REST_Controller 
{

	function __construct()
	{
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
		parent::__construct();
		$this->load->model(array('app_mdl'));
		date_default_timezone_set('Asia/Jakarta');
	}

    public function index_get() // get
    {
        $id = 1;
        
            $users = $this->app_mdl->_get_by_id($id);
        
        if ($users) 
        {   
            $data = array(
                'nama'=>$users->nama,
                'alamat'=>$users->alamat,
                'kota'=>$users->kota,
                'telp'=>$users->telp,
                'logo'=>base_url().'assets/images/logo/'.$users->logo,
            );
            $this->set_response([
                'status' => true,
                'data' => $data
            ], REST_Controller::HTTP_OK); // OK
        } else {
            $this->set_response([
                'status' => false,
                'data' => "Data tidak ditemukan"
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUNd
        }
    }

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */