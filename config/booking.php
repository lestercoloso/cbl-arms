<?php
$config['mode_of_shipment']  = ['1'=>'Sea Freight', '2'=>'Air Freight'];
$config['status']  = ['1'=>'Cancelled Pick Up', '2'=>'For Monitoring'];
$config['book_shipment']['Shipper Information'] = [
								
								0=>['type' 			=> 'normal',
								'label'				=> 'Shipper Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'shipper_name',
								'id'				=> 'create_shipper_name',
								],
								1=>['type' 			=> 'normal',
								'label'				=> 'Company',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'comapany',
								'id'				=> 'create_company',
								],

								2 => ['type' 		=> 'input',
								'label'				=> 'Contact No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'contact_no',
								'form_class'		=> 'form-control',
								'placeholder' 		=> ''
								],

								3 => ['type' 		=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_email',
								'col'				=> 'email',
								'form_class'		=> 'form-control',
								],

								4 => ['type' 		=> 'input',
								'label'				=> 'TIN No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_tin_no',
								'col'				=> 'tin_no',
								'form_class'		=> 'form-control'
								],

								5 => ['type' 		=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_department',
								'col'				=> 'department',
								'form_class'		=> 'form-control'],

								6 => ['type' 		=> 'input',
								'label'				=> 'Business Style',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_business_style',
								'col'				=> 'business_style',
								'form_class'		=> 'form-control'],

								7 => ['type' 		=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_address',
								'col'				=> 'address',
								'form_class'		=> 'form-control'],

								9 => ['type' 		=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_city',
								'col'				=> 'city',
								'form_class'		=> 'form-control'],

								10 => ['type' 		=> 'input',
								'label'				=> 'Area',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_area',
								'col'				=> 'area',
								'form_class'		=> 'form-control'],

							];





?>