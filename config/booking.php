<?php
$config['vehicle'] = !empty($config['vehicle']) ? $config['vehicle'] : [];
$config['driver']  = !empty($config['driver']) ? $config['driver'] : [];
$config['vehicle_type']  = $db->getconfig('vehicle_type');
$config['vehicle_status']  = $db->getconfig('vehicle_status');
$config['mode_of_shipment']  = $db->getconfig('mode_of_shipping');
$config['status']  = $db->getconfig('booking_status');
$config['transaction_type']  = $db->getconfig('transaction_type');
$config['storage_type']  = $db->getconfig('storage_type');
$config['unit_of_measurement']  = $db->getconfig('unit_of_measurement');
$config['unit_of_measurement_2']  = $db->getconfig('unit_of_measurement_2');
$config['unit_of_measurement_3']  = $db->getconfig('unit_of_measurement_3');
$config['item_type']  = $db->getconfig('item_type');
$config['book_shipment'][] = [
								
								['type' 			=> 'normal',
								'label'				=> 'Booking No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'booking_no',
								'id'				=> 'create_booking_no',
								],
								
								['type' 			=> 'normal',
								'label'				=> 'Booking Date',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_booking_date',
								],

								['type' 		=> 'select',
								'label'				=> 'Customer Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_customer_name',
								'col'				=> 'customer_name',
								'form_class'		=> 'form-control',
								'placeholder'		=> 'Select Customer Name',
								],

								['type' 			=> 'hide',
								'id'				=> 'create_customer_id',
								'col'				=> 'customer_id'],

								['type' 		=> 'normal',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address',
								'col'				=> 'address',
								'form_class'		=> 'form-control',
								],

								['type' 		=> 'select',
								'label'				=> 'Area',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area',
								'col'				=> 'area',
								'form_class'		=> 'form-control'
								],

								['type' 			=> 'select',
								'label'				=> 'Contact Person',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_person',
								'col'				=> 'contact_person',
								'form_class'		=> 'form-control'
								],



								['type' 			=> 'hide',
								'id'				=> 'create_contact_id',
								'col'				=> 'contact_id'],

								['type' 			=> 'hide',
								'id'				=> 'create_contact',
								'col'				=> 'contact']
							];


$config['book_shipment'][] = [

								['type' 			=> 'normal',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_department',
								'col'				=> 'department',
								'form_class'		=> 'form-control'],
								
								['type' 			=> 'select',
								'label'				=> 'Mode of Shipping',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'mode_of_shipping',
								'id'				=> 'create_mode_of_shipping',
								'options'			=> array_merge([''=>'Select Mode of Shipping'],$config['mode_of_shipment'])
								],
								
								// ['type' 			=> 'select',
								// 'label'				=> 'Vehicle Type',
								// 'parent_class' 		=> 'form-group col-sm-12',
								// 'subparent_class' 	=> 'col-sm-8',
								// 'form_class'		=> 'form-control',
								// 'id'				=> 'create_vehicle_type',
								// 'col'				=> 'vehicle_type',
								// 'options'			=> array_merge([''=>'Select Vehicle Type'],$config['vehicle_type'])
								// ],


								// ['type' 			=> 'select',
								// 'label'				=> 'Plate No.',
								// 'parent_class' 		=> 'form-group col-sm-12',
								// 'subparent_class' 	=> 'col-sm-8',
								// 'id'				=> 'create_plate_no',
								// 'col'				=> 'plate_no',
								// 'form_class'		=> 'form-control',
								// 'options'			=> array_merge([''=>'Select Plate No.'],$config['vehicle'])								
								// ],

								// ['type' 			=> 'select',
								// 'label'				=> 'Driver',
								// 'parent_class' 		=> 'form-group col-sm-12',
								// 'subparent_class' 	=> 'col-sm-8',
								// 'id'				=> 'create_driver',
								// 'col'				=> 'driver',
								// 'form_class'		=> 'form-control',
								// 'options'			=> array_merge([''=>'Select Driver'],$config['driver'])
								// ],

								// ['type' 			=> 'hide',
								// 'id'				=> 'create_driver_id',
								// 'col'				=> 'driver_id'],

								['type' 			=> 'select',
								'label'				=> 'Status',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_booking_status',
								'col'				=> 'booking_status',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Status'],$config['status']) 
								],
								
								['type' 			=> 'normal',
								'label'				=> 'Time Called',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_time_called',
								'col'				=> 'time_called',
								'form_class'		=> 'form-control'],
								
								['type' 			=> 'date',
								'label'				=> 'Date Time Ready',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_datetime_ready',
								'col'				=> 'date_ready',
								'form_class'		=> 'form-control'],

								['type' 			=> 'input',
								'label'				=> 'Document/Parcel',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'document',
								'id'				=> 'create_document',
								],
							];

$config['book_shipment'][] = [
								

								
								['type'		 		=> 'number',
								'label'				=> 'Weight',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_weight',
								'col'				=> 'weight',
								'extra'				=> 'kg.',
								'form_class'		=> 'form-control',
								],

								
								['type'		 		=> 'number',
								'label'				=> 'Length',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_length',
								'col'				=> 'length',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								
								['type'		 		=> 'number',
								'label'				=> 'Width',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_width',
								'col'				=> 'width',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],
								
								['type'		 		=> 'number',
								'label'				=> 'Height',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_height',
								'col'				=> 'height',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'input',
								'label'				=> 'Special Instruction',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_special_instruction',
								'col'				=> 'special_instruction',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'select',
								'label'				=> 'Transaction Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'craete_transaction_type',
								'col'				=> 'transaction_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Transaction Type'],$config['transaction_type']) 
								]

								
							];






$config['vehicleform'][] = [ 
								['type' 			=> 'normal',
								'label'				=> 'Vehicle No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'vehicle_no',
								'id'				=> 'create_vehicle_no',
								],

								['type' 			=> 'input',
								'label'				=> 'Vehicle Description',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_vehicle_desc',
								'col'				=> 'vehicle_desc',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'input',
								'label'				=> 'Plate No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_plate_no',
								'col'				=> 'plate_no',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'select',
								'label'				=> 'Vehicle Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'craete_vehicle_type',
								'col'				=> 'type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Vehicle Type'],$config['vehicle_type']) 
								],

								['type' 			=> 'select',
								'label'				=> 'Status',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'craete_vehicle_status',
								'col'				=> 'status',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Vehicle Status'],$config['vehicle_status']) 
								]
							];


$config['driver_form'][] = [ 
								['type' 			=> 'normal',
								'label'				=> 'Driver Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'code',
								'id'				=> 'create_driver_code',
								],

								['type' 			=> 'input',
								'label'				=> 'Driver Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_name',
								'col'				=> 'name',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'date',
								'label'				=> 'Birthday',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_birthday',
								'col'				=> 'birthday',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'number',
								'label'				=> 'Age',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_age',
								'col'				=> 'age',
								'form_class'		=> 'form-control',
								],


								['type' 			=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address',
								'col'				=> 'address',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'select',
								'label'				=> 'Vehicle Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'craete_vehicle_type',
								'col'				=> 'vehicle_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Vehicle Type'],$config['vehicle_type']) 
								]
							];



$config['inventory'][] = [ 
								['type' 			=> 'normal',
								'label'				=> 'Item ID',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'item_id',
								'id'				=> 'additional-item_id',
								],

								['type' 			=> 'input',
								'label'				=> 'Product Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-product_code',
								'col'				=> 'product_code',
								'form_class'		=> 'form-control',
								],

								['type' 			=> 'number',
								'label'				=> 'Bar Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-bar_code',
								'col'				=> 'bar_code',
								'form_class'		=> 'form-control',
								],


								['type' 			=> 'number',
								'label'				=> 'Case Bar Code',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-casebar_code',
								'col'				=> 'case_bar_code',
								'form_class'		=> 'form-control',
								],								

								['type' 			=> 'select',
								'label'				=> 'Item Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-item_type',
								'col'				=> 'item_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Item Type'],$config['item_type']) 
								],


								['type' 			=> 'select',
								'label'				=> 'UOM 1',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom1',
								'col'				=> 'uom_1',
								'form_class'		=> 'form-control uom-select',
								'options'			=> array_merge([''=>'Select UOM 1'],$config['unit_of_measurement']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_1" id="add-uom_1" class="form-control extra uom_1" placeholder="Qty">' 
								],

								['type' 			=> 'select',
								'label'				=> 'UOM 2',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom2',
								'col'				=> 'uom_2',
								'form_class'		=> 'form-control uom-select',
								'options'			=> array_merge([''=>'Select UOM 2'],$config['unit_of_measurement_2']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_2" id="add-uom_2" class="form-control extra uom_2" placeholder="Qty">' 
								],

								['type' 			=> 'select',
								'label'				=> 'UOM 3',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'additional-uom3',
								'col'				=> 'uom_3',
								'form_class'		=> 'form-control uom-select',
								'options'			=> array_merge([''=>'Select UOM 3'],$config['unit_of_measurement_3']),
								'extra'				=> '<input type="number" min=1 col="uom_qty_3" id="add-uom_3" class="form-control extra uom_3" placeholder="Qty">' 
								],

								['type' 			=> 'number',
								'label'				=> 'Packaging (pcs)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-packaging',
								'col'				=> 'packaging',
								'form_class'		=> 'form-control',
								],



						];

$config['inventory'][] = [ 
								['type' 			=> 'select',
								'label'				=> 'Storage Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-storage_type',
								'col'				=> 'storage_type',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Storage type'],$config['storage_type']) 
								],


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
								'label'				=> 'Unit Cost',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-unit_cost',
								'col'				=> 'unit_cost',
								'form_class'		=> 'form-control',
								],

								['type'		 		=> 'number',
								'label'				=> 'Unit Price',
								'parent_class' 		=> 'form-group col-sm-12',
								'id'				=> 'additional-unit_price',
								'col'				=> 'unit_price',
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


						];


$config['multiple_vehicle'] = [

								['type' 			=> 'select',
								'label'				=> 'Vehicle Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'additional-vehicle_type',
								'col'				=> 'vehicle_type',
								'options'			=> array_merge([''=>'Select Vehicle Type'],$config['vehicle_type'])
								],


								['type' 			=> 'select',
								'label'				=> 'Plate No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-plate_no',
								'col'				=> 'plate_no',
								'form_class'		=> 'form-control',
								// 'options'			=> array_merge([''=>'Select Plate No.'],$config['vehicle'])								
								],

								['type' 			=> 'select',
								'label'				=> 'Driver',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'additional-driver',
								'col'				=> 'driver',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Driver'],$config['driver'])
								],

							  ];						
?>