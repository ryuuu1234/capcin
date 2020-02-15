<?php

function textInput($nama, $autocomplete,$col='12',$type="text", $class_input = "" )
{	
	$class_div = "controls";
	
	$label = ucfirst(str_replace("_", " ", $nama)) ;

	$inputan = '<div class="col-md-'.$col.'">
					<label for="'.$nama.'" class="control-label" >'.$label.' </label>
						<div class="'.$class_div.'">
							<input type="'.$type.'" class="'.$class_input.'" id="'.$nama.'" name="'.$nama.'" placeholder="Masukkan '.$label.'" autocomplete="'.$autocomplete.'" >
							<div class="vd_red error-string" id="error-'.$nama.'"></div>
						</div>
						
				</div>		';
	return $inputan;
}

function selectInput($nama, $col='12', $data=array(), $class_input = "" )
{	
	$class_div = "controls";
	
	$label = ucfirst(str_replace("_", " ", $nama)) ;

	$inputan = '';

	$inputan .= '
				<div class="col-md-'.$col.'">
					<label for="'.$nama.'" class="control-label" >'.$label.' </label>
						<div class="'.$class_div.'">
							<select name="'.$nama.'" id="'.$nama.'" class="'.$class_input.'">
											<option value="">--Pilih '.$label.'--</option>';
											foreach ($data as $key)
											{
												$inputan .= '<option value="'.$key->id.'">'.$key->nama.'</option>';
											}
	$inputan .= '									
							</select>
							<div class="vd_red error-string" id="error-'.$nama.'"></div>			
						</div>
				</div>		';
	return $inputan;
}