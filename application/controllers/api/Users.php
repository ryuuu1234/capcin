<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Users extends REST_Controller 
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
        $this->load->model(array('users_mdl','app_login', 'register_mdl'));
        $this->load->library(array('form_validation', 'Authorization_Token'));
		date_default_timezone_set('Asia/Jakarta');
    }
    
    /**
        * User Register
        * --------------------------
        * @param: nama
        * @param: username
        * @param: email
        * @param: id_level
        * @param: password
        * --------------------------
        * @method: POST
        * @link : api/user/register 
    */
    public function register_post()
    {   
        # XSS Filtering (https://codeigniter.com/user_guide/libraries/security.html?highlight=security)
        $_POST = $this->security->xss_clean($_POST); 

        # Form Validation
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[t_users.username]|alpha_numeric|max_length[80]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[t_users.email]|max_length[80]');
        $this->form_validation->set_rules('id_level', 'Level', 'trim|required|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_message('required', 'Tidak Boleh kosong');
        $this->form_validation->set_message('is_unique', '{field}');
        $this->form_validation->set_message('max_length', '{field} harus tidak lebih dari {param} characters.');

        if ($this->form_validation->run() == FALSE)
        {
            // Form validation errors
            $message = array(
                'status'=> false,
                'errors'=> $this->form_validation->error_array(),
                'message'=> 'validation errors',
            );

            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
        else
        {
            // print_r($_POST);
            $insert_data = array(
                'nama'=> $this->input->post('nama', TRUE),
                'username'=> $this->input->post('username', TRUE),
                'email'=> $this->input->post('email', TRUE),
                'id_level'=> $this->input->post('id_level', TRUE),
                'password'=>  password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT,['cost'=> 10]),
                'status'=> 0,
                'created_at'=> time(),
            );

            // Insert User in database
            // print_r($insert_data);
            // $this->users_mdl->_insert($insert_data);
            $output = $this->register_mdl->_insert_by_api($insert_data);
            // var_dump($output);
            if ($output > 0) {
                $message = array(
                    'status'=> true,
                    'message'=> 'User registration successfully',
                );
                $this->response($message, REST_Controller::HTTP_OK);

                
            }else{
                // Error
                $message = array(
                    'status'=> false,
                    'errors'=> '',
                    'message'=> 'Maaf, Registrasi error , Harap ulangi',
                );
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

     /**
        * User Login With API
        * --------------------------
        * @param: username or email
        * @param: password
        * --------------------------
        * @method: POST
        * @link : api/user/login 
    */

    public function login_post()
    {
         # XSS Filtering (https://codeigniter.com/user_guide/libraries/security.html?highlight=security)
         $_POST = $this->security->xss_clean($_POST); 

         # Form Validation
         $this->form_validation->set_rules('email', 'Email', 'trim|required');
         $this->form_validation->set_rules('password', 'Password', 'trim|required');
 
         $this->form_validation->set_message('required', '{field} Tidak Boleh kosong');
 
         if ($this->form_validation->run() == FALSE)
         {
             // Form validation errors
             $message = array(
                 'status'=> false,
                 'errors'=> $this->form_validation->error_array(),
                 'message'=> 'validation errors',
             );
 
             $this->response($message, REST_Controller::HTTP_NOT_FOUND);
         }
         else
         {
            // load Login Function
            $output = $this->app_login->__user_login($this->input->post('email'), $this->input->post('password'));

            if (!empty($output) AND $output != FALSE) 
            {   
                if ($output->status == 0 ) {
                    $message = array(
                        'status'=> false,
                        'message'=> 'Kamu sudah tidak aktif',
                    );
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                } else {
                    
                    $token_data['id'] = $output->id;
                    $token_data['nama'] = $output->nama;
                    $token_data['username'] = $output->username;
                    $token_data['email'] = $output->email;
                    $token_data['level'] = $output->level;
                    $token_data['status'] = $output->status;
                    $token_data['time'] = time();
    
                    $user_token = $this->authorization_token->generateToken($token_data);
                    
                    // print_r($this->authorization_token->userData()); exit;
                    // Login success
                    $return_data = [
                        'id'=>$output->id,
                        'nama'=>$output->nama,
                        'username'=>$output->username,
                        'email'=>$output->email,
                        'level'=>$output->level,
                        'token' => $user_token
                    ];
                    $message = array(
                        'status'=> true,
                        'data'=> $return_data,
                        'message'=> 'User Login successful',
                    );
                    $this->response($message, REST_Controller::HTTP_OK);
                }
                // generate token
            }else{

                // Login Error
                $message = array(
                    'status'=> false,
                    'message'=> 'Invalid username or password',
                );
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
         }
    }

    // public function index_get() // get
    // {
    //     $id = $this->get('id');
    //     if ($id === Null) {
    //         $users = $this->users_mdl->_get_all();
    //     } else {
    //         $users = $this->users_mdl->_get_by_id($id);
    //     }
    //     if ($users) 
    //     {
    //         $this->set_response([
    //             'status' => true,
    //             'data' => $users
    //         ], REST_Controller::HTTP_OK); // OK
    //     } else {
    //         $this->set_response([
    //             'status' => false,
    //             'data' => "Data tidak ditemukan"
    //         ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUNd
    //     }
    // }
    
    // public function index_delete() // delete
    // {
    //     $id = $this->delete('id');

    //     if ($id === Null) 
    //     {
    //         $this->set_response([
    //             'status' => false,
    //             'message' => "Tentukan id nya!!!"
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     } else {
    //         $delete = $this->users_mdl->_delete_by_id_api($id);
    //         if ($delete > 0 ) 
    //         {
    //             $message = [
    //                 'status' => true,
    //                 'id'    => $id,
    //                 'message' => 'berhasil dihapus!'
    //             ];
    //             $this->set_response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code
    //         } else {
    //             $this->set_response([
    //                 'status' => false,
    //                 'message' => "id tidak ditemukan!"
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
    //     }
        
    // }
    
    // public function index_post()
    // {
    //     $data = array(

    //         'nama' => $this->post('nama'),
    //         'username' => $this->post('username'),
    //         'email' => $this->post('email'),
    //         'telp' => $this->post('telp'),
    //     );

    //     if ($this->users_mdl->_insert_by_api($data) > 0) 
    //     {
    //         $message = [
    //             'status' => true,
    //             'message' => 'data baru berhasil ditambahkan'
    //         ];
    //         $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    //     } else {
    //         $this->set_response([
    //             'status' => false,
    //             'message' => "data baru tidak berhasil ditambahkan"
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }

    // public function index_put()
    // {   
    //     $id = $this->put('id');
    //     $data = array(

    //         'nama' => $this->put('nama'),
    //         'username' => $this->put('username'),
    //         'email' => $this->put('email'),
    //         'telp' => $this->put('telp'),
    //     );

    //     if ($this->users_mdl->_updated_by_api($data, $id) > 0) 
    //     {
    //         $message = [
    //             'status' => true,
    //             'message' => 'data berhasil diupdate'
    //         ];
    //         $this->set_response($message, REST_Controller::HTTP_OK); // ok
    //     } else {
    //         $this->set_response([
    //             'status' => false,
    //             'message' => "data tidak berhasil diupdate"
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */