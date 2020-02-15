<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller
{
	public function index()
	{
		$this->load->view('example');
	}

	public function trigger_event()
	{
		// Load the library.
		// You can also autoload the library by adding it to config/autoload.php
		//kirim ke pusher
		require_once(APPPATH.'views/vendor/autoload.php');
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new PusherPusher(
			'c1b487e073e0124e259f', //ganti dengan App_key pusher Anda
			'957bd2852df4338c1a80', //ganti dengan App_secret pusher Anda
			'905496', //ganti dengan App_id pusher Anda
			$options
		);
 
		$data['message'] = 'success';
		$pusher->trigger('my-channel', 'my-event', $data);

		if ($event === TRUE)
		{
			echo 'Event triggered successfully!';
		}
		else
		{
			echo 'Ouch, something happend. Could not trigger event.';
		}
	}
}
