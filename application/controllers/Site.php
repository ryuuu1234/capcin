<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public $app = 'core/layouts/app';
    public $navigation = 'core/elements/navigation';
    public $foot_nav = 'core/elements/foot_nav';
    
    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data = [
			'title' => 'Capcin App', // ini title atas
            'navigation' => $this->navigation, // ini header lah
			'menu' => 'home',
            'page' => 'sites/index', // page yg ditampilkan
            'foot_nav' => $this->foot_nav, // footer
		];

		$this->load->view($this->app, $data);
	}

	public function notFound()
	{
		$data = [
			'title' => 'Halaman Tidak Ditemukan | Sehat Yuk',
			'page' => 'sites/error'
		];

		$this->load->view($this->app, $data);
	}
}
