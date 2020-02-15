<?php
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model(array('app_login'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{	
		if ($this->session->userdata('login'))
		{
			redirect('site_rules');
		}
		$data="";
		$this->load->view('v_login', $data);
	}

	function auth()
	{	
		$email = $this->input->post('email', TRUE);
		$pass = $this->input->post('password', TRUE); 

		$cek = $this->app_login->__get_where($email);

		if ($cek->num_rows()>0) 
		{
			$get_user = $cek->row();

			if (password_verify($pass, $get_user->password)) 
			{
				
				$data_session = array(
						'user_id'=>$get_user->id,
						'level' =>$get_user->level,
						'nama' 	=> $get_user->nama,
						'ip'=> $this->input->ip_address(),
						'login'	=> TRUE
					);
				// JIKA MEMENUHI SEMUA PERSYARATAN
				$this->session->set_userdata($data_session);
				if ($this->session->userdata('login')) 
					{	
						// simpan ke database sessinya
								// $time = date('Y-m-d H:i:s');
								// $int = strtotime($time);
								// $save = array(
								// 	'id_user' => $this->session->userdata('pengguna'),
								// 	'nama' => $this->session->userdata('nama'),
								// 	'ip'=> $this->session->userdata('ip'),
								// 	'agent' => $this->agent->browser().' '.$this->agent->version(),
								// 	'date_login' => $int,
								// 	'tanggal' => date('Y-m-d'),
								// 	'login_jam' =>date("H:i:s"),
								// 	'status' =>1
								// );
								// $this->log_mdl->_insert($save);
						// redirect('site_rules');//
						$data['messages'] = 'Sesi Tersimpan ... Harap Tunggu';
						$data['status'] = true;
						$data['user_id'] = $get_user->id;
						echo json_encode($data);
						exit();	
					}//if3

			} else {
					//jika password salah
					// $flash_msg ="Password yang Anda Masukkan salah";
					// $value = '<div class="alert alert-danger alert-message" role="alert">'.$flash_msg.'</div>';
					// $this->session->set_flashdata('message', $value);
					
					// redirect('login');
					$data['messages'] = 'Password yang anda masukkan Salah';
					$data['status'] = false;
					echo json_encode($data);
					exit();	
			}//if2

		} else {
				//jika username tidak ada
				// $flash_msg ="Username yang Anda Masukkan salah";
				// $value = '<div class="alert alert-danger alert-message" role="alert">'.$flash_msg.'</div>';
				// $this->session->set_flashdata('message', $value);
				// $this->session->set_flashdata('alert', 'Password yang Anda Masukkan salah...');
				// redirect('login');
				$data['messages'] = 'Username Tidak terdaftar';
				$data['status'] = false;	
				echo json_encode($data);
				exit();	
		}//if1

		

		// if ($this->session->userdata('login'))
		// {
		// 	redirect('site_rules');
		// }

	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */