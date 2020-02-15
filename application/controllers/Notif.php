<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('register_mdl'));
		$this->perPage = 10;
		$this->urii = 4;
		date_default_timezone_set('Asia/Jakarta');
		cek_login_admin();
	}

	public function index(){

	}

	public function dataJsonnya()
	{
		$jml = 0;
		$list = '';
		$jml = $this->register_mdl->_count_where(['status'=>0]);//
		$this->load->library('format_tgl');			
		if($jml<=0)
		{
			return FALSE;
		} else{
			$not_reg = $this->register_mdl->_get_where(['status'=>0]);
			foreach ($not_reg as $key ) 
			{	
				$date_created = $key->created_at;
				// $original = date_format(date_create($date_created), 'Y-m-d H:i:s');
				$lm_wktu = $this->selisih_waktu($date_created); // perlu perbaikan
				$url = base_url()."admin/file/register";
				$list .= '
						<li> 
							<a href="'.$url.'"> 
								<div class="menu-icon vd_yellow"><i class="fa fa-user"></i></div> 
								<div class="menu-text"> Ada User baru yg butuh di konfirmasi 
									<div class="menu-info"><span class="menu-date">'.$lm_wktu.'</span></div>
								</div> 
							</a> 
						</li>';
			}
			
			$data = array(
				'jml'=>$jml,
				'list' => $list,
			);
	
			echo json_encode($data);
		}	

		
	}

	function selisih_waktu($original)
	{
		$chunks = array(
			array(60 * 60 * 24 * 365, 'tahun'),
			array(60 * 60 * 24 * 30, 'bulan'),
			array(60 * 60 * 24 * 7, 'minggu'),
			array(60 * 60 * 24, 'hari'),
			array(60 * 60, 'jam'),
			array(60, 'menit'),
		);
		
		$today = time();
		$since = $today - $original;
		
		if ($since > 604800)
		{
			$print = date("M jS", $original);
			if ($since > 31536000)
			{
			$print .= ", " . date("Y", $original);
			}
			return $print;
		}
		
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
		
			if (($count = floor($since / $seconds)) != 0)
			break;
		}
		
		$print = ($count == 1) ? '1 ' . $name : "$count {$name}";
		return $print . ' yang lalu';
	}

	function polling()
	{
		set_time_limit(0);
		$data_source_file = $this->dataJsonnya();
		// main loop
		while (true) {

			// if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
			$last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;

			// PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
			clearstatcache();
			// get timestamp of when file has been changed the last time
			$last_change_in_data_file = filemtime($data_source_file);

			// if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
			if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {

				// get content of data.txt
				$data = $data_source_file;

				// put data.txt's content and timestamp of last data.txt change into array
				$result = array(
					'data_from_file' => json_decode($data),
					// 'timestamp' => $last_change_in_data_file
				);

				// encode to JSON, render the result (for AJAX)
				$json = json_encode($result);
				echo $json;

				// leave this loop step
				break;

			} else {
				// wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
				sleep( 1 );
				continue;
			}
		}
	}

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */