<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{	
		date_default_timezone_set('Asia/Jakarta');
		$tgl = 1581707748;
		// $coba = date_format(date_create($tgl), 'Y-m-d H:i:s');
		// echo date("Y-m-d H:i:s", strtotime($tgl));die;
		$date_created = strtotime($tgl);
		$fff = date_format(date_create($date_created), 'Y-m-d H:i:s');
		$a = $this->selisih_waktu($tgl);
		echo $a; die;
		// echo $$this->selisih_waktu($fff); die();
		// echo date('d m Y H:i:s',$strt); die();
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

	function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
	}

	function extract_array($data)
	{	
		// $hasil = $data['select_tb'];
		// return $hasil;
	}

	function table($data)
	{	
		$row = $data['row'];
		$isi = $data['isi_list'];

		$table = '<table>';
		$table .= '<thead>
					<tr>';
			foreach ($row as $key => $value) {
						$table .= '<th>'.$value.'</th>';
					}
						
		$table .= '</tr>
				 	</thead>';

		$table .= '<tbody>';
			$i=0;
			foreach ($isi as $list) {
				$table .= '<tr>';
				$jml_row = count($row);
					for ($i=0; $i < $jml_row ; $i++) { 
						$table .= '<td>'.$list->$row[$i].'</td>';
					}
						

						// <td>'.$list->nama.'</td>
						
						// <td>'.$list->level.'</td>
				$table .= '</tr>';
			}
					
		$table .= '</tbody>';
		$table .= '</table>';
		return $table;
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */