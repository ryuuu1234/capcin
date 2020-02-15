<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template 
{
	function __construct()
	{
		$this->ci =&get_instance();
	}

	function administrator($template, $data='')
	{	
		$cond['content'] = $this->ci->load->view($template, $data, TRUE);
		$cond['top_bar'] = $this->ci->load->view('template_admin/v_header', $data, TRUE);
		$cond['sidebar'] = $this->ci->load->view('template_admin/v_sidemenu', $data, TRUE);
		$this->ci->load->view('template_admin/v_template', $cond);
	}
}
