<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inputan_template 
{
	function __construct()
	{
		$this->ci =&get_instance();
	}

	function for_text_input($nama, $autocomplete)
	{	
		$class_div = "controls";
		$class_input = "";

		$label = ucfirst(str_replace("_", " ", $nama)) ;

		$inputan = '<label for="'.$nama.'" class="control-label" >'.$label.' </label>
								<div class="'.$class_div.'">
									<input type="text" class="'.$class_input.'" id="'.$nama.'" name="'.$nama.'" placeholder="Masukkan '.$label.'" autocomplete="'.$autocomplete.'" >
								</div>';
		return $inputan;
	}
}
