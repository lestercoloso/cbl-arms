<?php
$config['industry_type']  	= ['1'=>'N/A','2'=>'N/A', '3'=>'N/A'];
$config['customer_status']  = ['1'=>'Active', '0'=>'Inactive'];
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
								'id'				=> 'create_are',
								'col'				=> 'area',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Contact Person',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_person',
								'col'				=> 'contact_person',
								'form_class'		=> 'form-control'],

								['type' 			=> 'normal',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_department',
								'col'				=> 'department',
								'form_class'		=> 'form-control'],

								['type' 			=> 'hide',
								'id'				=> 'create_department_id',
								'col'				=> 'department']
							];


$config['book_shipment'][] = [
								
								['type' 			=> 'select',
								'label'				=> 'Mode of Shipping',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'mode_of_shipping',
								'id'				=> 'create_mode_of_shipping',
								'options'			=> array_merge([''=>'Select Mode'],$config['mode_of_shipment'])
								],
								
								['type' 			=> 'select',
								'label'				=> 'Vehicle Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_vehicle_type',
								'col'				=> 'vehicle_type',
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
								'form_class'		=> 'form-control'
								],

								['type' 			=> 'hide',
								'id'				=> 'create_driver_id',
								'col'				=> 'driver_id'],

								['type' 			=> 'select',
								'label'				=> 'Status',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_booking_status',
								'col'				=> 'booking_status',
								'form_class'		=> 'form-control',
								'options'			=> array_merge([''=>'Select Status'],$config['status']) 
								],
								
								['type' 			=> 'time',
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
								'extra'				=> 'cm.',
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