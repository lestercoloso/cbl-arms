<?php

function pdie($array){
	echo '<pre>';
	print_r($array);
	die();
}

function jdie($array){
	header('Content-Type: application/json');
	die(json_encode($array));
}


function get_config($file){
	$configfile = fopen($file, "r") or die("Unable to open file!");
	$dbconfig = array();
		while($row = fgets($configfile)) {
			$num = explode("=", $row);
			$dbconfig[$num[0]] = $num[1];
		}
	fclose($configfile);
	return $dbconfig;
}

function construct_form($arr){
	$return = '';
	foreach ($arr as $data){
		$return .='<div class="'.$data['parent_class'].'" id="'.$data['id'].'_container" >';
		
		if(!empty($data['label'])){
			if(empty($data['label_class'])){
				$return	.='<label class="col-sm-4">'.$data['label'].'</label>';	
			}else{
				$return	.='<label class="'.$data['label_class'].'">'.$data['label'].'</label>';	
			}
		}

		$data['subparent_class'] = !empty($data['subparent_class']) ? $data['subparent_class'] : 'col-sm-8';
		$return .= '<div class="'.$data['subparent_class'].'">';		
		
		if($data['type']=='select'){
			$return .='<select class="'.$data['form_class'].'" name="'.$data['col'].'" id="'.$data['id'].'" col="'.$data['col'].'"  data-placeholder="'.$data['placeholder'].'">';
				
			if(!empty($data['options'])){
				foreach ($data['options'] as $key => $option){
					$return .="<option value='$key'>$option</option>";
				}
			}

			$return .='</select><div class="hide" id="'.$data['id'].'_loader"><i class="fa fa-circle-o-notch fa-spin" style=""></i> Loading...</div>';
						
		}else if($data['type']=='input'){
			$return .='<input name="'.$data['col'].'" '.$data['additionals'].' type="text"  col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" placeholder="'.$data['placeholder'].'">
						<span id="'.$data['col'].'_error" class="text-danger"></span>';
		}else if($data['type']=='number'){
		$return .='<input name="'.$data['col'].'" '.$data['additionals'].' type="number"  col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" placeholder="'.$data['placeholder'].'">
						<span id="'.$data['col'].'_error" class="text-danger"></span>';
		}else if($data['type']=='date'){
		$return .='<div class="input-group date  col-sm-12  create-date">
			<input type="text" class="'.$data['form_class'].'" name="'.$data['col'].'" col="'.$data['col'].'" id="'.$data['id'].'"  placeholder="'.$data['placeholder'].'">
			<span class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</span></div>';

		}else if($data['type']=='checkbox'){

			if(!empty($data['options'])){
				foreach ($data['options'] as $key => $option){
					$return .='<div class="checkbox">
							  		<label><input type="checkbox" value="'.$key.'" name="'.$data['col'].'"><span>'.$option.'</span></label>
							   </div>';
				}
			}
		}else if($data['type']=='radio'){

			if(!empty($data['options'])){
				foreach ($data['options'] as $key => $option){

					$return .='<label class="radio-inline">
								<input type="radio"  value="'.$key.'" name="'.$data['col'].'">'.$option.'
								</label>';
				}
			}
		}else if($data['type']=='normal'){
			$return .='<input name="'.$data['col'].'" type="text" '.$data['additionals'].' col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" disabled="disabled">';
		}

		
		$return .='</div>';
		
		if(!empty($data['extra'])){
			$return .= '<div class="col-sm-2">'.$data['extra'].'</div>';
		}

		$return .='</div>';

	}

	return $return;


}



?>