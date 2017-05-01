<?php

$config['item_type']  = $db->getconfig('item_type');
$config['unit_of_measurement']  = $db->getconfig('unit_of_measurement');
$config['unit_of_measurement_2']  = $db->getconfig('unit_of_measurement_2');
$config['unit_of_measurement_3']  = $db->getconfig('unit_of_measurement_3');
$config['storage_type']  = $db->getconfig('storage_type');


$config['inventory'][] = [ 
								['type' 			=> 'normal',
								'label'				=> 'Item ID',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'form_class'		=> 'form-control',
								'col'				=> 'item_id',
								'id'				=> 'additional-item_id',
								'extra'				=> '<label class="extra-checkbox"><input type="checkbox"  col="non_sku" id="add-non_sku" class="form-control">Non-SKU</label>'
								],					

								['type' 			=> 'input',
								'label'				=> 'Stock No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-stock_no',
								'col'				=> 'stock_no',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'input',
								'label'				=> 'Bar Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-bar_code',
								'col'				=> 'bar_code',
								'form_class'		=> 'form-control',
								],


								['type' 			=> 'input',
								'label'				=> 'Case Bar Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-casebar_code',
								'col'				=> 'case_bar_code',
								'form_class'		=> 'form-control',
								],								

								['type' 			=> 'select',
								'label'				=> 'Storage Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-storage_type',
								'col'				=> 'storage_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Storage type'],$config['storage_type']) 
								]
							];



$config['inventory'][] = [ 


								['type' 			=> 'select',
								'label'				=> 'Item Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-item_type',
								'col'				=> 'item_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Item Type'],$config['item_type']) 
								],

								['type' 			=> 'input',
								'label'				=> 'Item Description',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-item_description',
								'col'				=> 'item_description',
								'form_class'		=> 'form-control',
								],


								['type'		 		=> 'number',
								'label'				=> 'Floor Level',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-floor_level',
								'col'				=> 'floor_level',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Ceiling Level',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-ceiling_level',
								'col'				=> 'ceiling_level',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Replenish Level',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-replenish_level',
								'col'				=> 'replenish_level',
								'form_class'		=> 'form-control',
								],

						];



$config['packaging_details'][] = [ 	

								['type' 			=> 'select',
								'label'				=> 'UOM 1',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom1',
								'col'				=> 'uom_1',
								'form_class'		=> 'form-control uom-select not_mandatory',
								'options'			=> array_merge([''=>'Select UOM 1'],$config['unit_of_measurement']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_1" id="add-uom_1" class="form-control extra uom_1 not_mandatory" placeholder="Qty">' 
								],

								['type' 			=> 'select',
								'label'				=> 'UOM 2',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom2',
								'col'				=> 'uom_2',
								'form_class'		=> 'form-control uom-select not_mandatory',
								'options'			=> array_merge([''=>'Select UOM 2'],$config['unit_of_measurement_2']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_2" id="add-uom_2" class="form-control extra uom_2 not_mandatory" placeholder="Qty">' 
								],

								['type' 			=> 'select',
								'label'				=> 'UOM 3',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom3',
								'col'				=> 'uom_3',
								'form_class'		=> 'form-control uom-select not_mandatory',
								'options'			=> array_merge([''=>'Select UOM 3'],$config['unit_of_measurement_3']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_3" id="add-uom_3" class="form-control extra uom_3 not_mandatory" placeholder="Qty">' 
								],


								['type'		 		=> 'number',
								'label'				=> 'Carton per Pallet',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-carton_per_pallet',
								'col'				=> 'carton_per_pallet',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Share Pallet Group',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-share_pallet_group',
								'col'				=> 'share_pallet_group',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Unit Cost',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-unit_cost',
								'col'				=> 'unit_cost',
								'form_class'		=> 'form-control',
								],

						]; 



$config['packaging_details'][] = [ 							

								['type'		 		=> 'number',
								'label'				=> 'Length',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-length',
								'col'				=> 'length',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Width',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-width',
								'col'				=> 'width',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],
								
								['type'		 		=> 'number',
								'label'				=> 'Height',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-height',
								'col'				=> 'height',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Weight',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-weight',
								'col'				=> 'weight',
								'extra'				=> 'Kg.',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'normal',
								'label'				=> 'CBM',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-cbm',
								'col'				=> 'cbm',
								'form_class'		=> 'form-control number_form',
								],

								['type'		 		=> 'number',
								'label'				=> 'Unit Price',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-unit_price',
								'col'				=> 'unit_price',
								'form_class'		=> 'form-control',
								],								

							];





?>