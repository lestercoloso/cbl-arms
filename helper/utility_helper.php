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

function stylessheet($path){
	$stylepath = '/assets/css/';
	return $stylepath.$path."?".rand();
}

function javascript($path){
	$jspath = '/assets/js/';
	return $jspath.$path."?".rand();
}

function bowerpath($path){
	$origin = '/bower_components/';
	return $origin.$path;
}

function construct_style($array = []){
	$return = '';
	foreach($array as $styles){
		echo '<link rel="stylesheet" href="'.$styles.'" />'.PHP_EOL;		
	}

}
function construct_js($array = []){
	$return = '';
	foreach($array as $js){
		echo '<script src="'.$js.'"></script>'.PHP_EOL;		
	}

}

function get_date($date=''){

	if($date=='0000-00-00' || empty($date)){
		$return = '';
	}else if(!empty($date)){
		$return = date('m/d/Y', strtotime($date));
	}
	return $return;
}

function save_date($date=''){
	return (!empty($date)) ? date('Y-m-d', strtotime($date)) : '';
}

function CreateWarehouseLinks($links){

	$return = [];
	foreach($links as $key=>$link){
		if($_SERVER['PHP_SELF']=='/'.$link['link'].'.php'){
			$return['selected'] = "tabs-".$key;
			$return['active'] = $key;
			$return['menu'] .= '<li><a href="#'.$return['selected'].'">'.$link['name'].'</a></li>';	
				
		}else{
			$return['menu'] .= '<li><a href="'.$link['link'].'.php'.'">'.$link['name'].'</a></li>';				
		}
	 	
	}

	return $return;
}


function construct_form($arr){
	$return = '';
	foreach ($arr as $data){
		if($data['type']=='hide'){
			$return .='<input name="'.$data['col'].'" class="not_mandatory" col="'.$data['col'].'" type="hidden"  id="'.$data['id'].'">';
			continue;
		}


		$return .='<div class="'.$data['parent_class'].'" id="'.$data['id'].'_container"  title="'.$data['title'].'">';

			if(stristr($data['form_class'], 'not_mandatory') === FALSE) {
				$data['label'] = $data['label']." *";
			}

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
						<span id="'.$data['col'].'_error" class="text-danger">'.$data['note'].'</span>';
		}else  if($data['type']=='password'){
			$return .='<input name="'.$data['col'].'" '.$data['additionals'].' type="password"  col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" placeholder="'.$data['placeholder'].'">
						<span id="'.$data['col'].'_error" class="text-danger">'.$data['note'].'</span>';
		}else if($data['type']=='number'){
		$return .='<input name="'.$data['col'].'" '.$data['additionals'].' type="number" min="1" col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" placeholder="'.$data['placeholder'].'">
						<span id="'.$data['col'].'_error" class="text-danger">'.$data['note'].'</span>';
		}else if($data['type']=='date'){
		$return .='<div class="input-group date  col-sm-12  create-date">
			<input type="text" class="'.$data['form_class'].'" name="'.$data['col'].'" col="'.$data['col'].'" id="'.$data['id'].'"  placeholder="'.$data['placeholder'].'">
			<span class="input-group-addon">
			<span class="fa fa-calendar"></span>
			</span></div>';

		}else if($data['type']=='time'){
		$return .='<div class="input-group date  col-sm-12  create-date">
			<input type="text" class="'.$data['form_class'].'" name="'.$data['col'].'" col="'.$data['col'].'" id="'.$data['id'].'"  placeholder="'.$data['placeholder'].'">
			<span class="input-group-addon">
			<span class="glyphicon glyphicon-time"></span>
			</span></div>';

		}else if($data['type']=='checkbox'){
			$return .='<div class="checkbox" id="'.$data['id'].'">';
			if(!empty($data['options'])){
				foreach ($data['options'] as $key => $option){
					$return .='<label><input type="checkbox" col="'.$data['col'].'" value="'.$key.'" name="'.$data['col'].'"><span>'.$option.'</span></label> &nbsp;';
				}
			$return .= '</div>';	
			}
		}else if($data['type']=='radio'){

			if(!empty($data['options'])){
				$line=0;					
				foreach ($data['options'] as $key => $option){
					$line++;
					$checked = '';
					$cls = '';
					if($line==1){
						$checked = 'checked';
						$cls = 'first';
					}

					$return .='<label class="radio-inline">
								<input type="radio"  value="'.$option.'" class="'.$cls.'" col="'.$data['col'].'" name="'.$data['col'].'" '.$checked.'>'.$option.'
								</label>';
				}
			}
		}else if($data['type']=='normal'){
			$return .='<input name="'.$data['col'].'" type="text" '.$data['additionals'].' col="'.$data['col'].'" id="'.$data['id'].'"  class="'.$data['form_class'].'" disabled="disabled" value="'.$data['value'].'">';
		}

		
		$return .='</div>';
		
		if(!empty($data['extra'])){
			$return .= '<div class="col-sm-2 extra">'.$data['extra'].'</div>';
		}

		$return .='</div>';

	}

	return $return;


}

function construct_maintenance($array=[],$db){
	foreach($array as $key=>$arr){

		echo '<div class="col-sm-12 optionlist" id="'.$key.'">
				<label class="col-sm-3">'.$arr.'</label>
				<div class="col-sm-5">
				<select id="select-'.$key.'" class="form-control"><option value="">Select '.$arr.'</option>';
		foreach($db->getconfig($key, 'maintenance') as $id=>$maintenance){
			echo '<option value="'.$id.'">'.$maintenance.'</option>'.PHP_EOL;
		}


		echo	'</select></div>
				<div class="col-sm-4">
				<button class="button-class custombutton add-maintenance">Add</button>
				<button class="button-class custombutton edit-maintenance">Edit</button>
				<button class="button-class custombutton delete-maintenance">Delete</button>
				</div>
			</div>'.PHP_EOL;
	}

}


function construct_maintenance_pallet($array=[],$db){
	echo '<form><table  border="1" class="maintenance_table"> <thead><tr><th>Description</th><th>Expiration Tracking</th><th>Batch Tracking</th></tr></thead><tbody>';	

	foreach($array as $key=>$arr){

		echo '<tr id="'.$key.'"> 
					<td>'.$arr.'</td> 
					'.$db->radio_maintenance_html($key).'
			  </tr>';
		}


		echo	'</table>
				<div class="table_button">
				<span class="custombutton add-pallet table_btn" >Save</span>
				<button class="custombutton reset-pallet table_btn" type="reset" value="Reset">Reset</button>
				</div></form>'.PHP_EOL;

}

function buttonchecked(){



}


function htmloption($array = []){
	$content = "";
	foreach ($array as $key => $value) {
		$content .="<option value=\"".$key."\">".$value."</option>";
	}
	return $content;
}


?>