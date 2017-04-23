<?php

$config['storage_type']  = $db->getconfig('storage_type');;
$config['wh_status']  = ['1'=>'Active', '0'=>'Inactive'];


$config['warehouse_location'][] = [
								
								['type' 			=> 'normal',
								'label'				=> 'WH Location Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control not_mandatory',
								'col'				=> 'code',
								'id'				=> 'create-wh_location_code',
								],
								
								['type' 			=> 'input',
								'label'				=> 'Warehouse Location',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'location',
								'id'				=> 'create-location',
								],

								
								['type' 			=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'address',
								'id'				=> 'create-address',
								],

								['type' 			=> 'checkbox',
								'label'				=> 'Storage Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create-storage_types',
								'col'				=> 'storage_type',
								'form_class'		=> 'multiple',
								'options'			=> $config['storage_type']
								],

							];


?>