<?php

function app_name()
{
	$ci =&get_instance();

	$ci->load->model('app_mdl');
	$app = $ci->db->where(['id'=>1])->get('t_app');
	// num_rows($app < 1)? $get = '': $get = $app->row();
	// $title = $get->nama;
	if ($app->num_rows()>0) {
		$get = $app->row();
		$title = $get->nama;
	}
	return $title;
}

function cek_login_admin()
{
	$ci =&get_instance();

	// $ci->load->model('users_mdl');
	$id = $ci->session->userdata('user_id');
	$level = $ci->session->userdata('level');
	// num_rows($app < 1)? $get = '': $get = $app->row();
	// $title = $get->nama;
	if ($id == "" || $level >= 4) //jika id=kosong ato level lebi besar sm dgn 3 
	{
		redirect('site_rules');
	}
}

function app_logo()
{
	$ci =&get_instance();

	$ci->load->model('app_mdl');
	$app = $ci->db->where(['id'=>1])->get('t_app');
	// num_rows($app < 1)? $get = '': $get = $app->row();
	// $title = $get->nama;
	if ($app->num_rows()>0) {
		$get = $app->row();
		$logo = $get->logo;
		$src = base_url().'assets/images/logo/'.$logo;
	} else{
		$src = base_url().'assets/admin/img/logo.png';
	}
	return $src;
}

function image_user()
{
	$ci =&get_instance();

	// $ci->load->model('users_mdl');
	$id = $ci->session->userdata('user_id');
	$user = $ci->db->where(['id'=>$id])->get('t_users');
	// num_rows($app < 1)? $get = '': $get = $app->row();
	// $title = $get->nama;
	if ($user->num_rows()>0) {
		$get = $user->row();
		$photo = $get->photo;
		$src = base_url().'assets/images/users/small/'.$photo;
		if ($photo == '' || $photo == null) {
			$src = base_url().'assets/images/users/nouser.png';
		}
	} else{
		$src = base_url().'assets/images/users/nouser.png';
	}
	return $src;
}

function nama_user()
{
	$ci =&get_instance();

	// $ci->load->model('users_mdl');
	$id = $ci->session->userdata('user_id');
	$user = $ci->db->where(['id'=>$id])->get('t_users');
	// num_rows($app < 1)? $get = '': $get = $app->row();
	// $title = $get->nama;
	if ($user->num_rows()>0) {
		$get = $user->row();
		$nama = $get->nama;
	} else{
		$nama = '';
	}
	return $nama;
}

function id_session()
{
	$ci =&get_instance();

	// $ci->load->model('users_mdl');
	$id = $ci->session->userdata('user_id');
	
	return $id;
}


