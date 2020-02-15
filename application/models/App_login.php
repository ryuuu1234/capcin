<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_login extends CI_Model {

	protected $table = 't_users';
	// protected $table = 't_register';


	function __construct()
	{
		parent::__construct();
		
	}
// 
	function __get_where($user)
	{
		return $this->db->from($this->table)->where(['email'=>$user])->get();
		
	}

	/**
        * User Login Model
        * --------------------------
        * @param: username or email
        * @param: password
        * --------------------------
    */

	function __user_login($email, $password)
	{
		$this->db->where('email', $email)
		->or_where('username', $email);

		$q = $this->db->get($this->table);
		

		if ($q->num_rows()> 0) // jika ditemukan
		{	$lev = $q->row('level');
			if($lev>=3){
				$user_pass = $q->row('password');
				if (password_verify($password, $user_pass)) 
				{
					return $q->row();
				}
			}
			return FALSE;
		}else{
			return FALSE;
		}

	}
	
}
