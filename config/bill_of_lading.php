<?php
$config['charges']  = ['DHL'=>'DHL', 'FEDEX'=>'FEDEX', 'LBC'=>'LBC', 'AIR21'=>'AIR21'];
$config['packaging_type']['document'] 	= ['Small'=>'Small', 'Large'=>'Large'];
$config['packaging_type']['parcel'] 	= ['Own'=>'Own', 'Others'=>'Others'];
$config['packaging_type']['crafting'] 	= ['Skeletal'=>'Skeletal', 'Close'=>'Close'];
// $config['subinventory_type'] = [''=>'Please Select', '1'=>'test1', '2'=>'test2'];

$config['add_shipment']['Shipper Information'] = [
								
								0=>['type' 			=> 'normal',
								'label'				=> 'Shipper Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								1=>['type' 			=> 'normal',
								'label'				=> 'Company',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_company',
								],

								2 => ['type' 		=> 'input',
								'label'				=> 'Contact No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'delivery_receipt',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder' 		=> ''
								],

								3 => ['type' 		=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								4 => ['type' 		=> 'input',
								'label'				=> 'TIN No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pallet_code_shipment',
								'col'				=> 'pallet_code',
								'form_class'		=> 'form-control'
								],

								5 => ['type' 		=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								6 => ['type' 		=> 'input',
								'label'				=> 'Business Style',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								7 => ['type' 		=> 'input',
								'label'				=> 'Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								9 => ['type' 		=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								10 => ['type' 		=> 'input',
								'label'				=> 'Area',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

							];



$config['add_shipment']['Package Content (Complete Description)'] = [
								
								0=>['type' 			=> 'input',
								'label'				=> 'Total Packages',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								1=>['type' 			=> 'input',
								'label'				=> 'Destination Type',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_company',
								],

								2 => ['type' 		=> 'input',
								'label'				=> 'Country/Zone',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'delivery_receipt',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder' 		=> ''
								],

								3 => ['type' 		=> 'input',
								'label'				=> 'Province/Zone',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								4 => ['type' 		=> 'input',
								'label'				=> 'Dimension',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'extra'				=> 'cm.',
								'form_class'		=> 'form-control not_mandatory',
								],

								5 => ['type' 		=> 'input',
								'label'				=> 'Actual Weight',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-6',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'extra'				=> 'kg.',
								'form_class'		=> 'form-control not_mandatory',
								],

								6 => ['type' 		=> 'input',
								'label'				=> 'Total Declared Value',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								7 => ['type' 		=> 'input',
								'label'				=> 'TDV % Applied',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								8 => ['type' 		=> '',
								'label'				=> 'Packaging Type',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								],

								9=>['type' 			=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Document',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'col'				=> 'packing_type_document',
								'options'			=> $config['packaging_type']['document']
								],

								10=>['type' 		=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Parcel',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'col'				=> 'packing_type_parcel',
								'options'			=> $config['packaging_type']['parcel']
								],

								11=>['type' 		=> 'radio',
								'parent_class' 		=> 'form-group col-sm-12 no-margin',
								'label'				=> 'Crafting',								
								'subparent_class' 	=> 'col-sm-8  no-wrap',
								'form_class'		=> 'form-control',
								'col'				=> 'packing_type_crafting',
								'options'			=> $config['packaging_type']['crafting']
								]
							];

$config['add_shipment']['Charges'] = [
								
								0=>['type' 			=> 'checkbox',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'col'				=> 'charges',
								'options'			=> $config['charges']
								]

						];

$config['add_shipment']['Additional Changes'] = [
								
								['type' 			=> 'input',
								'label'				=> 'ODA(Outside Delivery Area)',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								
								['type' 			=> 'input',
								'label'				=> 'Special Handling',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_company',
								],

								['type' 		=> 'normal',
								'label'				=> 'Declared Value',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'delivery_receipt',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder' 		=> ''
								],

								['type' 		=> 'input',
								'label'				=> 'Funmigation',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								['type' 		=> 'input',
								'label'				=> 'Export Declaration Fee',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pallet_code_shipment',
								'col'				=> 'pallet_code',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Address Correction Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Residential Delivery',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Non Stackable Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Crafting',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Label Cost',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],
								
								['type' 		=> 'input',
								'label'				=> 'DG Charge',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Demmurage Fee',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Back Load',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Total',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> '12% VAT',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Total Amount Due',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Discount Percent',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'normal',
								'label'				=> 'Final Contract Price',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control']

							
						];						

$config['add_shipment']['Recipient Information'] = [
								
								['type' 			=> 'Input',
								'label'				=> 'Recipient Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Recipient Company Name',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_company',
								],

								['type' 		=> 'input',
								'label'				=> 'Recipient Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'create_contact_no',
								'col'				=> 'delivery_receipt',
								'form_class'		=> 'form-control not_mandatory',
								'placeholder' 		=> ''
								],

								['type' 		=> 'input',
								'label'				=> 'City',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'invoice_no_shipment',
								'col'				=> 'invoice_no',
								'form_class'		=> 'form-control not_mandatory',
								],

								['type' 		=> 'input',
								'label'				=> 'Phone No.',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'pallet_code_shipment',
								'col'				=> 'pallet_code',
								'form_class'		=> 'form-control'
								],

								['type' 		=> 'input',
								'label'				=> 'Email Address',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control'],

								['type' 		=> 'input',
								'label'				=> 'Department',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'id'				=> 'quantity_shipment',
								'col'				=> 'quantity',
								'form_class'		=> 'form-control']

							
						];		
$config['add_shipment'][' '] = [
								
								['type' 			=> 'select',
								'label'				=> 'Mode of Shipping',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'select',
								'label'				=> 'Services',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'select',
								'label'				=> 'Delivery Instruction',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'select',
								'label'				=> 'Commodity Class',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'input',
								'label'				=> 'Document Attached',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
								['type' 			=> 'select',
								'label'				=> 'Mode of Payment',
								'parent_class' 		=> 'form-group col-sm-12',
								'subparent_class' 	=> 'col-sm-8',
								'form_class'		=> 'form-control',
								'id'				=> 'create_shipper_name',
								],
				];										


?>