<?php 

class Format_tgl
{

	function indo($tanggal) 
	{	
		$format = date_format(date_create($tanggal), 'd F Y');
	    return $format;
	}

	function barat($tanggal) 
	{	
		$format = date_format(date_create($tanggal), 'd-M-Y');
	    return $format;
	}

	function mysql($tanggal) 
	{	
		$format = date_format(date_create($tanggal), 'Y-m-d');
	    return $format;
	}

	function nama_hari($tanggal){
	$hari = $format = date_format(date_create($tanggal), 'D');
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}


}

