<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Apilogin extends REST_Controller 
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
		$this->load->model(array('users_mdl', 'app_login'));
		date_default_timezone_set('Asia/Jakarta');
	}

    public function index_get() // get
    {   
        $email = $this->get('email', TRUE);
        $pass = $this->get('password', TRUE); 
        
        $cek = $this->app_login->__get_where($email);

        if ($cek->num_rows()>0) 
		{
			$get_user = $cek->row();

			if (password_verify($pass, $get_user->password)) 
			{
				$this->set_response([
                    'status' => true,
                    'msg' => 'Good Job'
                ], REST_Controller::HTTP_OK); // OK
						
			} else {

                $this->set_response([
                    'status' => true,
                    'msg' => 'Password Anda Salah.. Ulangi!'
                ], REST_Controller::HTTP_OK); // OK
			}//if2

		} else {
            $this->set_response([
                'status' => false,
                'msg' => "Email tidak Terdaftar"
            ], REST_Controller::HTTP_OK); // NOT_FOUNd
				// exit();	
		}
        // if ($data === Null) {
        //     $users = $this->users_mdl->_get_all();
        // } else {
        //     $users = $this->users_mdl->_get_where_row($data);
        // }
        // if ($users) 
        // {
        //     $this->set_response([
        //         'status' => true,
        //         'data' => 'Good Job'
        //     ], REST_Controller::HTTP_OK); // OK
        // } else {
        //     $this->set_response([
        //         'status' => false,
        //         'data' => "Data tidak ditemukan"
        //     ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUNd
        // }
    }
    
    

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */