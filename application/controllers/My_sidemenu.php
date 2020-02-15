<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_sidemenu extends CI_Controller {

	public function index()
	{
		
	}

	public function fetch()
	{	
		$output = '';
		$menu = $this->db->where(['id_main <'=>1])->order_by('urut')->get('appmenu');
		$output .= '<ul>';
		// INI UNTUK MENU MAIN
		foreach ($menu->result() as $key)
		{
			$main = $key->is_main; 
	        $id_menu = $key->id; 
	        $id_main = $key->id_main;

	        $urlnya = base_url().$key->url;
	        if ($main == 0 ) {
	        	$output .= '<li id="menu-'.$id_menu.'">
							<a href="'.$urlnya.'">
								<span class="menu-icon"><i class="'.$key->icon.'"></i></span> 
								<span class="menu-text">'.$key->controller.'</span> 
								<!-- Jika Pakai Badge -->
								<!-- <span class="menu-badge"><span class="badge vd_bg-red">78</span></span> -->
							</a> 
						</li>';
	        }else {
	        	// INI UNTUK SUBMENU
	        	$output .= '<li id="menu-'.$id_menu.'">
							<a href="#" data-action="click-trigger">
								<span class="menu-icon"><i class="'.$key->icon.'"></i></span> 
								<span class="menu-text">'.$key->controller.'</span>  
								<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
							</a>
							<div class="child-menu"  data-action="click-target">
								<ul>';
							$sub_menu = $this->db->where(['id_main'=>$id_menu])->order_by('urut')->get('appmenu');
							foreach ($sub_menu->result() as $s) 
							{	
								$urlSub = base_url().$s->url;
								$output .= '
									<li id="menu-'.$s->id.'">
										<a href="'.$urlSub.'">
											<span class="menu-text">'.$s->controller.'</span>  
										</a>
									</li>
								';
							}
				$output .= '</ul></div></li>';					
	        }
		}// endforeach
		$output .= '</ul>';
		echo $output;
	} 

}

/* End of file My_sidemenu.php */
/* Location: ./application/controllers/My_sidemenu.php */