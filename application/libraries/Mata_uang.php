<?php 

class Mata_uang{
	function rupiah($rp = "", $uang) 
	{	
		$format = $rp. ' '.number_format($uang, 0,',','.');
	    return $format;
	}
}