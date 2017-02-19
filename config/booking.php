<?php
$config['vehicle'] = !empty($config['vehicle']) ? $config['vehicle'] : [];
$config['driver']  = !empty($config['driver']) ? $config['driver'] : [];
$config['mode_of_shipment']  = $db->getconfig('mode_of_shipment');
$config['status']  = $db->getconfig('booking_status');
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

								['type' 		=> 'input',
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

								['type' 			=> 'normal',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_department',
								'col'				=> 'department',
								'form_class'		=> 'form-control'],

								['type' 			=> 'hide',
								'id'				=> 'create_contact_id',
								'col'				=> 'contact_id']
							];


$config['book_shipment'][] = [
								
								['type' 			=> 'select',
								'label'				=> 'Mode of Shipping',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'mode_of_shipping',
								'id'				=> 'create_mode_of_shipping',
								'options'			=> array_merge([''=>'Select Mode of Shipping'],$config['mode_of_shipment'])
								],
								
								['type' 			=> 'select',
								'label'				=> 'Vehicle Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_vehicle_type',
								'col'				=> 'vehicle_type',
								'options'			=> array_merge([''=>'Select Vehicle Type'],$config['vehicle'])
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
								'label'				=> 'Driver',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_driver',
								'col'				=> 'driver',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Driver'],$config['driver'])
								],

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
							];

$config['book_shipment'][] = [
								
								['type' 			=> 'input',
								'label'				=> 'Document / Parcel',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'document',
								'id'				=> 'create_document',
								],
								
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
								'label'				=> 'Length (Dimension)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_length',
								'col'				=> 'length',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],

								
								['type'		 		=> 'number',
								'label'				=> 'Width (Dimension)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'create_width',
								'col'				=> 'width',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control',
								],
								
								['type'		 		=> 'number',
								'label'				=> 'Height (Dimension)',
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
								]

								
							];





?>